<?php
/**
 * Plugin Name: The McLaughlin Group - Contact
 * Description: Contact page, inquiry storage, and email notifications for site CTAs.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dmg_contact_recipient_email() {
	return get_option( 'dmg_contact_recipient_email', 'ddmclaugh@aol.com' );
}

function dmg_contact_seller_email() {
	return get_option( 'dmg_seller_email', 'ddmclaugh@aol.com' );
}

function dmg_contact_state_key( $token ) {
	$token = preg_replace( '/[^a-zA-Z0-9]/', '', (string) $token );
	return $token ? 'dmg_contact_state_' . $token : '';
}

function dmg_contact_current_state() {
	static $state = null;

	if ( null !== $state ) {
		return $state;
	}

	$state = [];
	if ( empty( $_GET['dmg_contact_state'] ) ) {
		return $state;
	}

	$key = dmg_contact_state_key( sanitize_text_field( wp_unslash( $_GET['dmg_contact_state'] ) ) );
	if ( ! $key ) {
		return $state;
	}

	$saved = get_transient( $key );
	if ( is_array( $saved ) ) {
		$state = $saved;
	}

	return $state;
}

function dmg_contact_store_state( $values, $errors, $form_error = '' ) {
	$token = wp_generate_password( 20, false, false );
	$key   = dmg_contact_state_key( $token );

	set_transient(
		$key,
		[
			'values'     => $values,
			'errors'     => $errors,
			'form_error' => $form_error,
		],
		15 * MINUTE_IN_SECONDS
	);

	return $token;
}

function dmg_contact_field_value( $key ) {
	$state = dmg_contact_current_state();
	if ( isset( $state['values'][ $key ] ) ) {
		return 'dmg_message' === $key ? sanitize_textarea_field( $state['values'][ $key ] ) : sanitize_text_field( $state['values'][ $key ] );
	}

	if ( isset( $_POST[ $key ] ) ) {
		return 'dmg_message' === $key ? sanitize_textarea_field( wp_unslash( $_POST[ $key ] ) ) : sanitize_text_field( wp_unslash( $_POST[ $key ] ) );
	}

	if ( isset( $_GET[ $key ] ) ) {
		return 'dmg_message' === $key ? sanitize_textarea_field( wp_unslash( $_GET[ $key ] ) ) : sanitize_text_field( wp_unslash( $_GET[ $key ] ) );
	}

	return '';
}

function dmg_contact_field_error( $key ) {
	$state = dmg_contact_current_state();

	return isset( $state['errors'][ $key ] ) ? sanitize_text_field( $state['errors'][ $key ] ) : '';
}

function dmg_contact_form_error() {
	$state = dmg_contact_current_state();

	return isset( $state['form_error'] ) ? sanitize_text_field( $state['form_error'] ) : '';
}

function dmg_contact_has_field_errors() {
	$state = dmg_contact_current_state();

	return ! empty( $state['errors'] ) && is_array( $state['errors'] );
}

function dmg_contact_field_a11y_attrs( $key, $error_id ) {
	$error = dmg_contact_field_error( $key );

	if ( ! $error ) {
		return '';
	}

	return ' aria-invalid="true" aria-describedby="' . esc_attr( $error_id ) . '"';
}

function dmg_contact_render_field_error( $key, $error_id, $class_name = 'dmg-field-error' ) {
	$error = dmg_contact_field_error( $key );
	if ( ! $error ) {
		return;
	}

	echo '<p id="' . esc_attr( $error_id ) . '" class="' . esc_attr( $class_name ) . '">' . esc_html( $error ) . '</p>';
}

function dmg_contact_inquiry_labels() {
	return [
		'' => 'Unassigned',
		'contact-us' => 'Contact Us',
		'sell-my-home' => 'Sell my home',
		'connect-with-us' => 'Connect with us',
		'local-expert' => 'Speak with a local expert',
		'reach-out' => 'Reach out',
		'schedule-consultation' => 'Schedule a consultation',
		'speak-with-dave' => 'Speak with Dave',
		'contact-dave' => 'Contact Dave',
		'open-listings'    => 'My Listings',
		'seller-inquiry'   => 'Seller Inquiry',
		'buyer-inquiry'    => 'Buyer Inquiry',
		'listing-inquiry'  => 'Listing Inquiry',
	];
}

add_action( 'init', function () {
	register_post_type( 'dmg_inquiry', [
		'labels' => [
			'name'          => 'Inquiries',
			'singular_name' => 'Inquiry',
			'add_new_item'  => 'Add New Inquiry',
			'edit_item'     => 'Edit Inquiry',
			'new_item'      => 'New Inquiry',
			'view_item'     => 'View Inquiry',
			'search_items'  => 'Search Inquiries',
			'not_found'     => 'No inquiries found',
			'menu_name'     => 'Inquiries',
			'all_items'     => 'All Inquiries',
		],
		'public'       => false,
		'show_ui'      => true,
		'show_in_menu' => true,
		'menu_position' => 22,
		'menu_icon'    => 'dashicons-email',
		'show_in_rest' => true,
		'has_archive'  => false,
		'rewrite'      => false,
		'supports'     => [ 'title' ],
	] );
} );

add_action( 'init', function () {
	$meta = [
		'dmg_inquiry_name'        => 'sanitize_text_field',
		'dmg_inquiry_email'       => 'sanitize_email',
		'dmg_inquiry_phone'       => 'sanitize_text_field',
		'dmg_inquiry_subject'     => 'sanitize_text_field',
		'dmg_inquiry_message'     => 'sanitize_textarea_field',
		'dmg_inquiry_source'      => 'sanitize_text_field',
		'dmg_inquiry_source_page' => 'esc_url_raw',
	];

	foreach ( $meta as $key => $sanitize ) {
		register_post_meta( 'dmg_inquiry', $key, [
			'type'              => 'string',
			'single'            => true,
			'show_in_rest'      => true,
			'sanitize_callback' => $sanitize,
			'auth_callback'     => function () { return current_user_can( 'edit_posts' ); },
		] );
	}
} );

add_action( 'add_meta_boxes', function () {
	add_meta_box(
		'dmg_inquiry_details',
		'Inquiry Details',
		function ( $post ) {
			$name    = get_post_meta( $post->ID, 'dmg_inquiry_name', true );
			$email   = get_post_meta( $post->ID, 'dmg_inquiry_email', true );
			$phone   = get_post_meta( $post->ID, 'dmg_inquiry_phone', true );
			$subject = get_post_meta( $post->ID, 'dmg_inquiry_subject', true );
			$msg     = get_post_meta( $post->ID, 'dmg_inquiry_message', true );
			$source  = get_post_meta( $post->ID, 'dmg_inquiry_source', true );
			$page    = get_post_meta( $post->ID, 'dmg_inquiry_source_page', true );
			?>
			<div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem 1.25rem;max-width:900px">
				<p><strong>Name</strong><br><?php echo esc_html( $name ?: '-' ); ?></p>
				<p><strong>Email</strong><br><?php echo esc_html( $email ?: '-' ); ?></p>
				<p><strong>Phone</strong><br><?php echo esc_html( $phone ?: '-' ); ?></p>
				<p><strong>Subject</strong><br><?php echo esc_html( $subject ?: '-' ); ?></p>
				<p style="grid-column:1/-1"><strong>Source CTA</strong><br><?php echo esc_html( ( dmg_contact_inquiry_labels()[ $source ] ?? $source ) ?: '-' ); ?></p>
				<p style="grid-column:1/-1"><strong>Source Page</strong><br><?php echo $page ? esc_html( $page ) : '-'; ?></p>
				<p style="grid-column:1/-1"><strong>Message</strong><br><?php echo nl2br( esc_html( $msg ?: '-' ) ); ?></p>
			</div>
			<?php
		},
		'dmg_inquiry',
		'normal',
		'high'
	);
} );

add_action( 'admin_post_nopriv_dmg_contact_submit', 'dmg_handle_contact_submit' );
add_action( 'admin_post_dmg_contact_submit', 'dmg_handle_contact_submit' );

function dmg_handle_contact_submit() {
	if ( ! isset( $_POST['dmg_contact_nonce'] ) || ! wp_verify_nonce( $_POST['dmg_contact_nonce'], 'dmg_contact_submit' ) ) {
		wp_safe_redirect( add_query_arg( [ 'dmg_contact_error' => 'nonce' ], wp_get_referer() ?: home_url( '/contact-us/' ) ) );
		exit;
	}

	$name    = isset( $_POST['dmg_name'] ) ? sanitize_text_field( wp_unslash( $_POST['dmg_name'] ) ) : '';
	$email   = isset( $_POST['dmg_email'] ) ? sanitize_email( wp_unslash( $_POST['dmg_email'] ) ) : '';
	$phone   = isset( $_POST['dmg_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['dmg_phone'] ) ) : '';
	$subject = isset( $_POST['dmg_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['dmg_subject'] ) ) : '';
	$message = isset( $_POST['dmg_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['dmg_message'] ) ) : '';
	$source  = isset( $_POST['dmg_source'] ) ? sanitize_text_field( wp_unslash( $_POST['dmg_source'] ) ) : 'contact-us';
	$page    = isset( $_POST['dmg_source_page'] ) ? esc_url_raw( wp_unslash( $_POST['dmg_source_page'] ) ) : '';
	$values  = [
		'dmg_name'        => $name,
		'dmg_email'       => $email,
		'dmg_phone'       => $phone,
		'dmg_subject'     => $subject,
		'dmg_message'     => $message,
		'dmg_source'      => $source,
		'dmg_source_page' => $page,
	];
	$errors  = [];

	if ( ! $name ) {
		$errors['dmg_name'] = 'Enter your name.';
	}
	if ( ! $email ) {
		$errors['dmg_email'] = 'Enter your email address.';
	} elseif ( ! is_email( $email ) ) {
		$errors['dmg_email'] = 'Enter a valid email address.';
	}
	if ( ! $phone ) {
		$errors['dmg_phone'] = 'Enter your phone number.';
	}
	if ( ! $subject ) {
		$errors['dmg_subject'] = 'Enter a subject.';
	}
	if ( ! $message ) {
		$errors['dmg_message'] = 'Enter your message.';
	}

	if ( $errors ) {
		$token = dmg_contact_store_state( $values, $errors, 'Please correct the fields below before sending your message.' );
		wp_safe_redirect( add_query_arg( [ 'dmg_contact_error' => 'required', 'dmg_contact_state' => $token ], wp_get_referer() ?: home_url( '/contact-us/' ) ) );
		exit;
	}

	$title = trim( $name . ' - ' . $subject );
	$post_id = wp_insert_post( [
		'post_type'    => 'dmg_inquiry',
		'post_status'   => 'publish',
		'post_title'    => $title,
		'post_content'  => $message,
		'meta_input'    => [
			'dmg_inquiry_name'        => $name,
			'dmg_inquiry_email'       => $email,
			'dmg_inquiry_phone'       => $phone,
			'dmg_inquiry_subject'     => $subject,
			'dmg_inquiry_message'     => $message,
			'dmg_inquiry_source'      => $source,
			'dmg_inquiry_source_page' => $page,
		],
	] );

	$source_label = dmg_contact_inquiry_labels()[ $source ] ?? $source;
	$subject_line = 'New Website Inquiry: ' . $subject;
	$body = implode( "\n", [
		'New contact form submission received.',
		'',
		'Name: ' . $name,
		'Email: ' . $email,
		'Phone: ' . $phone,
		'Subject: ' . $subject,
		'Source CTA: ' . $source_label,
		'Source Page: ' . $page,
		'',
		'Message:',
		$message,
	] );

	$to = ( false !== strpos( $source, 'sell' ) ) ? dmg_contact_seller_email() : dmg_contact_recipient_email();

	wp_mail(
		$to,
		$subject_line,
		$body,
		[
			'Content-Type: text/plain; charset=UTF-8',
			'Reply-To: ' . $name . ' <' . $email . '>',
		]
	);

	$redirect = add_query_arg(
		[
			'dmg_contact_success' => '1',
		],
		wp_get_referer() ?: home_url( '/contact-us/' )
	);

	if ( $post_id && ! is_wp_error( $post_id ) ) {
		wp_safe_redirect( $redirect );
		exit;
	}

	$token = dmg_contact_store_state( $values, [], 'We could not save your message. Please try again or contact us by phone.' );
	wp_safe_redirect( add_query_arg( [ 'dmg_contact_error' => 'save', 'dmg_contact_state' => $token ], wp_get_referer() ?: home_url( '/contact-us/' ) ) );
	exit;
}

add_action( 'admin_menu', function () {
	add_options_page(
		'Contact Settings',
		'Contact Settings',
		'manage_options',
		'dmg-contact-settings',
		'dmg_contact_settings_page'
	);
} );

function dmg_contact_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	if ( isset( $_POST['dmg_contact_settings_nonce'] ) && wp_verify_nonce( $_POST['dmg_contact_settings_nonce'], 'dmg_contact_settings_save' ) ) {
		if ( isset( $_POST['dmg_contact_recipient_email'] ) ) {
			update_option( 'dmg_contact_recipient_email', sanitize_email( wp_unslash( $_POST['dmg_contact_recipient_email'] ) ) );
		}
		if ( isset( $_POST['dmg_seller_email'] ) ) {
			update_option( 'dmg_seller_email', sanitize_email( wp_unslash( $_POST['dmg_seller_email'] ) ) );
		}
		echo '<div class="notice notice-success is-dismissible"><p>Settings saved.</p></div>';
	}
	?>
	<div class="wrap">
		<h1>Contact Settings</h1>
		<form method="post" action="">
			<?php wp_nonce_field( 'dmg_contact_settings_save', 'dmg_contact_settings_nonce' ); ?>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="dmg_contact_recipient_email">Buyer Lead Email</label></th>
					<td>
						<input type="email" id="dmg_contact_recipient_email" name="dmg_contact_recipient_email"
							value="<?php echo esc_attr( dmg_contact_recipient_email() ); ?>"
							class="regular-text" />
						<p class="description">Email address for buyer inquiries and general contact form submissions.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="dmg_seller_email">Seller Lead Email</label></th>
					<td>
						<input type="email" id="dmg_seller_email" name="dmg_seller_email"
							value="<?php echo esc_attr( dmg_contact_seller_email() ); ?>"
							class="regular-text" />
						<p class="description">Email address for seller inquiries (source containing &ldquo;sell&rdquo;).</p>
					</td>
				</tr>
			</table>
			<?php submit_button( 'Save Settings' ); ?>
		</form>
	</div>
	<?php
}

add_action( 'init', function () {
	$existing = get_page_by_path( 'contact-us', OBJECT, 'page' );
	if ( ! $existing ) {
		wp_insert_post( [
			'post_title'   => 'Contact Us',
			'post_name'    => 'contact-us',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		] );
	}

	if ( ! get_page_by_path( 'accessibility', OBJECT, 'page' ) ) {
		wp_insert_post( [
			'post_title'   => 'Accessibility',
			'post_name'    => 'accessibility',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		] );
	}
}, 20 );
