<?php
/**
 * Title: Contact Us
 * Slug: dmg/contact-us
 * Categories: featured
 * Inserter: false
 */

$name_value    = dmg_contact_field_value( 'dmg_name' );
$email_value   = dmg_contact_field_value( 'dmg_email' );
$phone_value   = dmg_contact_field_value( 'dmg_phone' );
$subject_value = dmg_contact_field_value( 'dmg_subject' );
$message_value = dmg_contact_field_value( 'dmg_message' );
$source_value  = dmg_contact_field_value( 'dmg_source' ) ?: 'contact-us';
$page_value    = dmg_contact_field_value( 'dmg_source_page' ) ?: home_url( '/contact-us/' );
$success       = isset( $_GET['dmg_contact_success'] );
$error         = isset( $_GET['dmg_contact_error'] );
$form_error    = function_exists( 'dmg_contact_form_error' ) ? dmg_contact_form_error() : '';
$has_errors    = function_exists( 'dmg_contact_has_field_errors' ) && dmg_contact_has_field_errors();

$contact_subjects = [
	'contact-us'           => 'Contact Us',
	'sell-my-home'         => 'Sell my home',
	'connect-with-us'      => 'Connect with us',
	'local-expert'         => 'Speak with a local expert',
	'reach-out'            => 'Reach out',
	'schedule-consultation'=> 'Schedule a consultation',
	'speak-with-dave'      => 'Speak with Dave',
];

if ( ! $subject_value && isset( $contact_subjects[ $source_value ] ) ) {
	$subject_value = $contact_subjects[ $source_value ];
}
?>

<!-- wp:html -->
<style>
	.dmg-contact-wrap { max-width: 1180px; margin: 0 auto; padding: 3rem 2rem 6rem; }
	.dmg-contact-hero { max-width: 760px; margin: 0 auto 3.5rem; text-align: center; }
	.dmg-contact-eyebrow-row {
		display:flex;
		align-items:center;
		justify-content:center;
		gap:0.625rem;
		margin:0 0 1rem;
	}
	.dmg-contact-eyebrow-icon { display:inline-flex; color:var(--wp--preset--color--primary); }
	.dmg-contact-eyebrow {
		margin:0;
		font-size:0.8125rem;
		font-weight:600;
		letter-spacing:0.25em;
		text-transform:uppercase;
		color:var(--wp--preset--color--gray-500);
	}
	.dmg-contact-title { font-size: clamp(2.25rem, 5vw, 3.75rem); line-height:1.05; letter-spacing:-0.02em; font-weight:700; margin:1rem 0 1rem; }
	.dmg-contact-intro { font-size:1.125rem; line-height:1.7; color:var(--wp--preset--color--gray-700); margin:0; }

	/* Layout: form on the left, contact info on the right. Vertically centered. */
	.dmg-contact-grid {
		display:grid;
		grid-template-columns: minmax(0, 1.25fr) minmax(0, 1fr);
		gap: 4rem;
		align-items: center;
	}

	/* Form card: clean, quiet, equal padding on all sides. */
	.dmg-contact-card--form {
		background:#fff;
		border:1px solid var(--wp--preset--color--gray-100);
		padding: 2.5rem;
	}

	/* Form fields: filled, soft, modern. */
	.dmg-contact-form {
		display: grid;
		gap: 1.25rem;
	}
	.dmg-contact-row {
		display: grid;
		grid-template-columns: repeat(2, minmax(0, 1fr));
		gap: 1.25rem;
	}
	.dmg-contact-field { display: flex; flex-direction: column; gap: 0.45rem; }
	.dmg-contact-field--full { width: 100%; }
	.dmg-contact-field label {
		font-size: 0.875rem;
		font-weight: 500;
		color: var(--wp--preset--color--gray-700);
		letter-spacing: 0.005em;
	}
	.dmg-contact-field label .req { color: var(--wp--preset--color--primary); margin-left: 0.15rem; }
	.dmg-contact-field input,
	.dmg-contact-field textarea,
	.dmg-contact-field select {
		width: 100%;
		border: 1px solid transparent;
		background: var(--wp--preset--color--gray-50);
		padding: 0.95rem 1.1rem;
		font: inherit;
		font-size: 1rem;
		color: var(--wp--preset--color--gray-900);
		transition: background 0.15s ease, border-color 0.15s ease, box-shadow 0.15s ease;
	}
	.dmg-contact-field input::placeholder,
	.dmg-contact-field textarea::placeholder {
		color: var(--wp--preset--color--gray-500);
	}
	.dmg-contact-field input:hover,
	.dmg-contact-field textarea:hover,
	.dmg-contact-field select:hover {
		background: var(--wp--preset--color--gray-100);
	}
	.dmg-contact-field input:focus,
	.dmg-contact-field textarea:focus,
	.dmg-contact-field select:focus {
		outline: none;
		background: #fff;
		border-color: var(--wp--preset--color--primary);
		box-shadow: 0 0 0 3px rgba(178, 0, 0, 0.12);
	}
	.dmg-contact-field textarea { min-height: 180px; resize: vertical; }

	/* Submit button: confident but not full-width, hover lift. */
	.dmg-contact-submit-row {
		display: flex;
		align-items: center;
		justify-content: space-between;
		gap: 1rem;
		margin-top: 0.5rem;
		flex-wrap: wrap;
	}
	.dmg-contact-submit {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		gap: 0.5rem;
		border: 0;
		cursor: pointer;
		padding: 1rem 2rem;
		background: var(--wp--preset--color--primary);
		color: #fff;
		font-weight: 600;
		font-size: 0.9375rem;
		letter-spacing: 0.01em;
		text-decoration: none;
		transition: background 0.15s ease, transform 0.15s ease, box-shadow 0.15s ease;
	}
	.dmg-contact-submit:hover {
		background: var(--wp--preset--color--primary-dark);
		transform: translateY(-1px);
		box-shadow: 0 6px 18px -8px rgba(178, 0, 0, 0.5);
	}
	.dmg-contact-submit-hint {
		font-size: 0.8125rem;
		color: var(--wp--preset--color--gray-500);
	}

	/* Right column: matching card with the same chrome as the form. */
	.dmg-contact-aside {
		display: grid;
		gap: 2rem;
		background: #fff;
		border: 1px solid var(--wp--preset--color--gray-100);
		padding: 2.5rem;
	}
	.dmg-contact-aside-block {}
	.dmg-contact-aside-label {
		display: block;
		font-size: 0.6875rem;
		font-weight: 700;
		letter-spacing: 0.22em;
		text-transform: uppercase;
		color: var(--wp--preset--color--primary);
		margin: 0 0 0.6rem;
	}
	.dmg-contact-aside-value {
		font-size: 1.0625rem;
		line-height: 1.55;
		color: var(--wp--preset--color--gray-900);
		margin: 0;
		font-weight: 500;
	}
	.dmg-contact-aside-value a {
		color: var(--wp--preset--color--gray-900);
		text-decoration: none;
		border-bottom: 1px solid var(--wp--preset--color--gray-300);
		transition: border-color 0.15s ease, color 0.15s ease;
	}
	.dmg-contact-aside-value a:hover {
		color: var(--wp--preset--color--primary);
		border-color: var(--wp--preset--color--primary);
	}
	.dmg-contact-aside-sub {
		font-size: 0.9375rem;
		line-height: 1.65;
		color: var(--wp--preset--color--gray-700);
		margin: 0.35rem 0 0;
	}
	.dmg-contact-aside-divider {
		border: 0;
		border-top: 1px solid var(--wp--preset--color--gray-100);
		margin: 0;
	}

	/* Inline alerts, refined. */
	.dmg-contact-alert {
		padding: 1rem 1.25rem;
		margin: 0 0 1.5rem;
		border-left: 3px solid;
		font-size: 0.9375rem;
	}
	.dmg-contact-alert--success { background:#f4faf6; border-color:#3b8a5a; color:#1f5c38; }
	.dmg-contact-alert--error   { background:#fdf6f6; border-color:var(--wp--preset--color--primary); color:#8c1f1f; }
	.dmg-contact-error-summary:focus { outline: 2px solid var(--wp--preset--color--primary); outline-offset: 3px; }
	.dmg-contact-field-error {
		margin: 0.1rem 0 0;
		font-size: 0.875rem;
		line-height: 1.45;
		color: #8c1f1f;
	}
	.dmg-contact-field input[aria-invalid="true"],
	.dmg-contact-field textarea[aria-invalid="true"] {
		border-color: #B20000;
		background: #fff;
	}

	@media (max-width: 900px) {
		.dmg-contact-grid { grid-template-columns: 1fr; gap: 2.5rem; align-items: stretch; }
	}
	@media (max-width: 600px) {
		.dmg-contact-wrap { padding: 2.5rem 1.25rem 4.5rem; }
		.dmg-contact-card--form,
		.dmg-contact-aside { padding: 1.75rem; }
		.dmg-contact-row { grid-template-columns: 1fr; gap: 1rem; }
		.dmg-contact-submit { width: 100%; }
		.dmg-contact-submit-row { justify-content: center; }
	}
</style>
<!-- /wp:html -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"3rem","bottom":"1rem","left":"2rem","right":"2rem"}}},"layout":{"type":"constrained","contentSize":"760px"}} -->
<section class="wp-block-group alignfull" style="padding-top:3rem;padding-right:2rem;padding-bottom:1rem;padding-left:2rem">
	<div class="dmg-contact-hero">
		<div class="dmg-contact-eyebrow-row">
			<span class="dmg-contact-eyebrow-icon" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16v16H4z"/><path d="m22 6-10 7L2 6"/></svg>
			</span>
			<p class="dmg-contact-eyebrow">Contact us</p>
		</div>
		<h1 class="dmg-contact-title">Let’s talk about your next move</h1>
		<p class="dmg-contact-intro">Whether you’re buying, selling, or just want a local opinion, send us a note and we’ll get back to you as soon as we can.</p>
	</div>
</section>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"1rem","bottom":"6rem","left":"2rem","right":"2rem"}}},"layout":{"type":"constrained","contentSize":"1180px"}} -->
<section class="wp-block-group alignfull" style="padding-top:1rem;padding-right:2rem;padding-bottom:6rem;padding-left:2rem">
	<div class="dmg-contact-wrap">
		<?php if ( $success ) : ?>
			<div class="dmg-contact-alert dmg-contact-alert--success">Thanks - your message has been sent. We’ll be in touch soon.</div>
		<?php endif; ?>
		<?php if ( $error && $form_error ) : ?>
			<div class="dmg-contact-alert dmg-contact-alert--error dmg-contact-error-summary" tabindex="-1">
				<p style="margin:0 0 0.5rem;font-weight:700"><?php echo esc_html( $form_error ); ?></p>
				<?php if ( $has_errors ) : ?>
					<ul style="margin:0;padding-left:1.25rem">
						<?php foreach ( [ 'dmg_name', 'dmg_email', 'dmg_phone', 'dmg_subject', 'dmg_message' ] as $field_key ) :
							$field_error = dmg_contact_field_error( $field_key );
							if ( ! $field_error ) { continue; }
						?>
							<li><a href="#<?php echo esc_attr( $field_key ); ?>"><?php echo esc_html( $field_error ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		<?php elseif ( $error ) : ?>
			<div class="dmg-contact-alert dmg-contact-alert--error">Please fill out all required fields before sending your message.</div>
		<?php endif; ?>

		<div class="dmg-contact-grid">
			<div class="dmg-contact-card--form">
				<form class="dmg-contact-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
					<input type="hidden" name="action" value="dmg_contact_submit" />
					<input type="hidden" name="dmg_source" value="<?php echo esc_attr( $source_value ); ?>" />
					<input type="hidden" name="dmg_source_page" value="<?php echo esc_attr( $page_value ); ?>" />
					<?php wp_nonce_field( 'dmg_contact_submit', 'dmg_contact_nonce' ); ?>

					<div class="dmg-contact-row">
						<div class="dmg-contact-field">
							<label for="dmg_name">Name<span class="req" aria-hidden="true">*</span></label>
							<input id="dmg_name" name="dmg_name" type="text" autocomplete="name" required placeholder="Your name" value="<?php echo esc_attr( $name_value ); ?>"<?php echo dmg_contact_field_a11y_attrs( 'dmg_name', 'dmg_name_error' ); ?> />
							<?php dmg_contact_render_field_error( 'dmg_name', 'dmg_name_error', 'dmg-contact-field-error' ); ?>
						</div>

						<div class="dmg-contact-field">
							<label for="dmg_email">Email<span class="req" aria-hidden="true">*</span></label>
							<input id="dmg_email" name="dmg_email" type="email" autocomplete="email" required placeholder="you@example.com" value="<?php echo esc_attr( $email_value ); ?>"<?php echo dmg_contact_field_a11y_attrs( 'dmg_email', 'dmg_email_error' ); ?> />
							<?php dmg_contact_render_field_error( 'dmg_email', 'dmg_email_error', 'dmg-contact-field-error' ); ?>
						</div>
					</div>

					<div class="dmg-contact-row">
						<div class="dmg-contact-field">
							<label for="dmg_phone">Phone<span class="req" aria-hidden="true">*</span></label>
							<input id="dmg_phone" name="dmg_phone" type="tel" autocomplete="tel" required placeholder="(555) 555-5555" value="<?php echo esc_attr( $phone_value ); ?>"<?php echo dmg_contact_field_a11y_attrs( 'dmg_phone', 'dmg_phone_error' ); ?> />
							<?php dmg_contact_render_field_error( 'dmg_phone', 'dmg_phone_error', 'dmg-contact-field-error' ); ?>
						</div>

						<div class="dmg-contact-field">
							<label for="dmg_subject">Subject<span class="req" aria-hidden="true">*</span></label>
							<input id="dmg_subject" name="dmg_subject" type="text" required placeholder="What's this about?" value="<?php echo esc_attr( $subject_value ); ?>"<?php echo dmg_contact_field_a11y_attrs( 'dmg_subject', 'dmg_subject_error' ); ?> />
							<?php dmg_contact_render_field_error( 'dmg_subject', 'dmg_subject_error', 'dmg-contact-field-error' ); ?>
						</div>
					</div>

					<div class="dmg-contact-field dmg-contact-field--full">
						<label for="dmg_message">Message<span class="req" aria-hidden="true">*</span></label>
						<textarea id="dmg_message" name="dmg_message" required placeholder="Tell us a little about what you need."<?php echo dmg_contact_field_a11y_attrs( 'dmg_message', 'dmg_message_error' ); ?>><?php echo esc_textarea( $message_value ); ?></textarea>
						<?php dmg_contact_render_field_error( 'dmg_message', 'dmg_message_error', 'dmg-contact-field-error' ); ?>
					</div>

					<div class="dmg-contact-submit-row">
						<span class="dmg-contact-submit-hint">We respond to most messages within 24 hours.</span>
						<button class="dmg-contact-submit" type="submit">
							Send message
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
						</button>
					</div>
				</form>
			</div>

			<aside class="dmg-contact-aside">
				<div class="dmg-contact-aside-block">
					<span class="dmg-contact-aside-label">Call</span>
					<p class="dmg-contact-aside-value"><a href="tel:+18182597775">(818) 259-7775</a></p>
					<p class="dmg-contact-aside-sub">Dave McLaughlin, direct line</p>
				</div>

				<hr class="dmg-contact-aside-divider" />

				<div class="dmg-contact-aside-block">
					<span class="dmg-contact-aside-label">Email</span>
					<p class="dmg-contact-aside-value"><a href="mailto:<?php echo esc_attr( dmg_contact_recipient_email() ); ?>"><?php echo esc_html( dmg_contact_recipient_email() ); ?></a></p>
				</div>

				<hr class="dmg-contact-aside-divider" />

				<div class="dmg-contact-aside-block">
					<span class="dmg-contact-aside-label">Visit</span>
					<p class="dmg-contact-aside-value">Keller Williams Westlake Village</p>
					<p class="dmg-contact-aside-sub">2475 Townsgate Road, Suite 160<br />Westlake Village, CA 91361</p>
				</div>
			</aside>
		</div>
	</div>
</section>
<!-- /wp:group -->

<?php if ( $error && $form_error ) : ?>
<!-- wp:html -->
<script>
(function () {
	var summary = document.querySelector('.dmg-contact-error-summary');
	if (summary) {
		summary.focus();
	}
}());
</script>
<!-- /wp:html -->
<?php endif; ?>
