# ADA Audit: The McLaughlin Group WordPress Site

Audit date: May 27, 2026

Audit target:
- Local WordPress Studio instance at `http://localhost:8881`
- Repo snapshot in `/Users/samrosenblad/Documents/~:Developer/TMG.com`
- Public logged-out experience only

Conformance baseline:
- Minimum legal/compliance floor for this audit: WCAG 2.1 AA
- Preferred remediation target: WCAG 2.2 AA

Reference baseline:
- `Realtor_website_ada_compliance.md`
- WCAG 2.2 / W3C update notes
- DOJ web accessibility guidance
- California Unruh Act / Civil Code section 51 context already summarized in the repo guide

## Executive Summary

Result: `partially meets minimum`

The current site has several accessibility strengths in its public shell, including a working skip link, page titles, basic landmark structure, keyboard-accessible primary navigation, visible native focus on most controls, and some reduced-motion support. Those strengths are not enough to support a clean minimum-compliance opinion for a public-facing realtor site because confirmed barriers remain in business-critical flows.

The highest-risk confirmed issues affect listing discovery and listing-detail consumption, which are core equal-access tasks for a real-estate site:
- Listing galleries output multiple property photos with empty `alt=""`, leaving key visual property content unavailable to screen-reader users.
- The homepage video player creates an unlabeled YouTube iframe and leaves keyboard focus on a wrapper `div` after activation.
- The listing-detail page has no rendered `<h1>`, weakening page structure and screen-reader navigation on a critical template.
- Low-contrast metadata labels on the listing-detail template fail WCAG contrast thresholds.

From a litigation-risk perspective, the site is not in the worst category because core navigation, contact entry points, and several page shells are operable. It is also not ready to be represented as materially compliant because confirmed defects exist on homepage media, listing cards, and listing-detail pages.

## Scope and Method

Representative rendered URLs reviewed:
- `/`
- `/areas/`
- `/areas/agoura-hills/`
- `/listings/`
- `/listings/1694-margate-place/`
- `/contact-us/`
- `/who-we-are/`
- `/testimonials/`
- `/we-give-back/royal-family-kids/`

Shared components reviewed in code:
- [header.html](/Users/samrosenblad/Documents/~:Developer/TMG.com/themes/dave-mclaughlin-group/parts/header.html)
- [footer.html](/Users/samrosenblad/Documents/~:Developer/TMG.com/themes/dave-mclaughlin-group/parts/footer.html)
- [header.js](/Users/samrosenblad/Documents/~:Developer/TMG.com/themes/dave-mclaughlin-group/assets/js/header.js)
- [carousels.js](/Users/samrosenblad/Documents/~:Developer/TMG.com/themes/dave-mclaughlin-group/assets/js/carousels.js)
- [functions.php](/Users/samrosenblad/Documents/~:Developer/TMG.com/themes/dave-mclaughlin-group/functions.php)
- [home-video.php](/Users/samrosenblad/Documents/~:Developer/TMG.com/themes/dave-mclaughlin-group/patterns/home-video.php)
- [home-listings.php](/Users/samrosenblad/Documents/~:Developer/TMG.com/themes/dave-mclaughlin-group/patterns/home-listings.php)
- [listing-detail.php](/Users/samrosenblad/Documents/~:Developer/TMG.com/themes/dave-mclaughlin-group/patterns/listing-detail.php)
- [contact-us.php](/Users/samrosenblad/Documents/~:Developer/TMG.com/themes/dave-mclaughlin-group/patterns/contact-us.php)
- [all-testimonials.php](/Users/samrosenblad/Documents/~:Developer/TMG.com/themes/dave-mclaughlin-group/patterns/all-testimonials.php)
- [dmg-contact.php](/Users/samrosenblad/Documents/~:Developer/TMG.com/mu-plugins/dmg-contact.php)

Rendered-test evidence used:
- Direct HTML inspection from the running localhost site
- Targeted Playwright keyboard checks on the homepage video and tab order
- Focused axe-core checks on the homepage and listing-detail page

## Findings Summary By Bucket

### Violations

| ID | Defect | Affected flow |
|---|---|---|
| V-01 | Listing gallery images render with empty alternative text | Finding listings, viewing listing details |
| V-02 | Homepage video interaction creates an unlabeled iframe and leaves focus on a replaced wrapper | Consuming video/media |
| V-03 | Listing-detail metadata labels fail minimum color contrast | Viewing listing details |
| V-04 | Testimonial star-rating wrapper uses prohibited `aria-label` on a plain `div` | Consuming testimonials/social proof |

### Required Remediation

| ID | Defect | Affected flow |
|---|---|---|
| R-01 | Listing-detail template has no rendered `<h1>` | Viewing listing details |
| R-02 | Contact and listing inquiry forms omit appropriate `autocomplete` tokens | Contacting the brokerage, listing inquiries |
| R-03 | Server-side form error recovery is generic and does not preserve field values across redirects | Contacting the brokerage, listing inquiries |

### Meets Minimum

| Area | Notes |
|---|---|
| Skip link and landmark shell | Homepage tab order exposes `Skip to content` first, and pages render `main` / `header` / `footer` landmarks. |
| Primary navigation basics | Desktop and mobile navigation buttons have usable labels and keyboard access in the rendered WordPress navigation block. |
| Page titles on core pages | Home, contact, area, testimonials, and listing pages expose meaningful `<title>` elements. |
| Basic form labeling | Contact and listing inquiry fields have explicit `<label for>` associations and required attributes. |

### Exceeds Minimum

| Area | Notes |
|---|---|
| Reduced-motion handling | Sticky header transitions and counter animation logic include `prefers-reduced-motion` handling in [header.css](/Users/samrosenblad/Documents/~:Developer/TMG.com/themes/dave-mclaughlin-group/assets/css/header.css) and [carousels.js](/Users/samrosenblad/Documents/~:Developer/TMG.com/themes/dave-mclaughlin-group/assets/js/carousels.js). |

## Detailed Findings

### V-01: Listing gallery images render with empty alternative text

Severity: High

Affected templates/components:
- Homepage featured listing cards
- Listing-detail gallery and photo-grid
- Content-entry dependency: attachment alt text in WordPress media library

Affected users:
- Screen-reader users
- Users relying on text alternatives when images do not load

Evidence:
- Rendered homepage listing cards include listing images with `alt=""`.
- Rendered listing-detail page includes the hero image with a descriptive alt, but the gallery and grid images below it still output `alt=""`.
- Example rendered evidence from `/listings/1694-margate-place/`: multiple gallery `<img>` tags with empty alt values.

Code path:
- [home-listings.php](/Users/samrosenblad/Documents/~:Developer/TMG.com/themes/dave-mclaughlin-group/patterns/home-listings.php)
- [listing-detail.php](/Users/samrosenblad/Documents/~:Developer/TMG.com/themes/dave-mclaughlin-group/patterns/listing-detail.php)

Why this matters:
- Property photos are not decorative on a realtor site. They are core sales content and often part of the decision to click, call, or schedule help.

WCAG mapping:
- WCAG 1.1.1 Non-text Content

Recommended fix:
- Require meaningful alt text on listing gallery attachments, or generate structured fallback alt text from listing address plus image sequence when media-library alt is blank.
- Treat this as both a template fix and a content-governance fix.

### V-02: Homepage video interaction creates an unlabeled iframe and leaves focus on a replaced wrapper

Severity: High

Affected templates/components:
- Homepage video section
- YouTube embed interaction

Affected users:
- Screen-reader users
- Keyboard-only users

Evidence:
- Keyboard activation of the first `.dmg-video-card` inserts a YouTube iframe with no `title`.
- After activation, focus remains on the `.dmg-video-card` wrapper rather than moving into a clearly named embedded player control.
- The wrapper is implemented as a focusable `div` with `role="button"` and replaced by injected iframe markup.

Code path:
- [home-video.php](/Users/samrosenblad/Documents/~:Developer/TMG.com/themes/dave-mclaughlin-group/patterns/home-video.php)

WCAG mapping:
- WCAG 4.1.2 Name, Role, Value
- WCAG 2.4.3 Focus Order

Recommended fix:
- Replace the focusable `div` with a native `button`.
- Set an explicit iframe `title` based on the selected video title.
- Move focus predictably after activation, or keep focus on a still-valid control that announces the new player state.

### V-03: Listing-detail metadata labels fail minimum color contrast

Severity: Medium

Affected templates/components:
- Listing-detail photo-toolbar labels
- Listing-detail detail-bar labels

Affected users:
- Low-vision users
- Users on mobile/in bright conditions

Evidence:
- Focused axe-core scan on `/listings/1694-margate-place/` reports six `color-contrast` violations.
- Confirmed examples:
  - `View` label contrast 4.29:1 on `#FAFAFA`
  - `Size` label contrast 4.29:1 on `#FAFAFA`
  - `Price`, `Beds`, `Baths`, `Sq Ft` labels contrast 3.39:1 on `#FAFAFA`

Code path:
- [listing-detail.php](/Users/samrosenblad/Documents/~:Developer/TMG.com/themes/dave-mclaughlin-group/patterns/listing-detail.php)

WCAG mapping:
- WCAG 1.4.3 Contrast (Minimum)

Recommended fix:
- Darken the metadata-label colors enough to clear 4.5:1 at the current text size.

### V-04: Testimonial star-rating wrapper uses prohibited `aria-label` on a plain `div`

Severity: Medium

Affected templates/components:
- Homepage testimonials carousel

Affected users:
- Screen-reader users

Evidence:
- Focused axe-core scan on `/` reports `aria-prohibited-attr`.
- Offending rendered node: `<div class="dmg-testimonial-stars ... " aria-label="5 out of 5 stars">`

Code path:
- Homepage carousel output comes from testimonial rendering logic; star wrappers use a plain `div` with `aria-label`.

WCAG mapping:
- WCAG 4.1.2 Name, Role, Value

Recommended fix:
- Replace the plain `div` with semantic text, or apply the label to a valid element/role pattern.
- A simple text node such as `5 out of 5 stars` visually hidden beside the icon group is usually the cleanest approach.

### R-01: Listing-detail template has no rendered `<h1>`

Severity: Medium

Affected templates/components:
- Listing-detail page

Affected users:
- Screen-reader users
- Keyboard users using heading navigation

Evidence:
- Rendered `/listings/1694-margate-place/` exposes `<title>` and multiple `<h2>` elements, but the address in the hero is output as a paragraph class `.dmg-listing-hero-address`, not a heading.

Code path:
- [listing-detail.php](/Users/samrosenblad/Documents/~:Developer/TMG.com/themes/dave-mclaughlin-group/patterns/listing-detail.php)

WCAG mapping:
- WCAG 1.3.1 Info and Relationships
- WCAG 2.4.6 Headings and Labels

Recommended fix:
- Render the address as the page’s `<h1>`.

### R-02: Contact and listing inquiry forms omit appropriate autocomplete tokens

Severity: Medium

Affected templates/components:
- Contact page form
- Listing inquiry form

Affected users:
- Users with cognitive disabilities
- Users with motor impairments
- Mobile users relying on autofill

Evidence:
- Rendered forms include labeled `name`, `email`, `phone`, `subject`, and `message` fields but no `autocomplete` attributes.

Code path:
- [contact-us.php](/Users/samrosenblad/Documents/~:Developer/TMG.com/themes/dave-mclaughlin-group/patterns/contact-us.php)
- [listing-detail.php](/Users/samrosenblad/Documents/~:Developer/TMG.com/themes/dave-mclaughlin-group/patterns/listing-detail.php)

WCAG mapping:
- WCAG 1.3.5 Identify Input Purpose

Recommended fix:
- Add appropriate tokens such as `name`, `email`, `tel`, and any justified purpose tokens for the remaining fields.

### R-03: Server-side form error recovery is generic and does not preserve field values across redirects

Severity: Medium

Affected templates/components:
- Contact page form
- Listing inquiry form
- Shared form handler

Affected users:
- Users with cognitive disabilities
- Users with motor impairments
- Users on unstable connections or with nonstandard input methods

Evidence:
- The shared handler in [dmg-contact.php](/Users/samrosenblad/Documents/~:Developer/TMG.com/mu-plugins/dmg-contact.php) redirects on required-field failure with only `dmg_contact_error=required`.
- The forms are written to repopulate from `$_POST` or `$_GET`, but the redirect does not send field values back.
- Error output is a generic banner and is not tied to specific invalid fields.

WCAG mapping:
- WCAG 3.3.1 Error Identification
- WCAG 3.3.3 Error Suggestion
- WCAG 3.3.7 Redundant Entry

Recommended fix:
- Preserve submitted values safely across server-side failure paths.
- Associate field-level errors with the specific controls through inline text and `aria-describedby`.

## Page-Template Rollup

| Scope | Finding IDs | Notes |
|---|---|---|
| Global/shared | V-02, V-04, R-02, R-03 | Media and form patterns recur across multiple pages. |
| Listing archive | V-01 | Listing card images on the homepage archive-style carousel already output empty alt text. |
| Listing detail | V-01, V-03, R-01, R-02, R-03 | Highest-risk template in current state. |
| Area pages | None confirmed as unique blockers in this pass | Structure generally present, but live content updates still need retesting. |
| Contact page | R-02, R-03 | Labels present, but autofill/error handling still below target. |

## Business-Journey Rollup

| Journey | Status | Notes |
|---|---|---|
| Finding listings | Partial | Navigation works, but listing-card imagery lacks meaningful text alternatives. |
| Viewing listing details | Below target | Missing `<h1>`, empty gallery-image alt text, and low-contrast metadata labels affect the core property page. |
| Contacting the brokerage | Partial | Forms are labeled and keyboard-usable, but autocomplete and error recovery are below target. |
| Scheduling help / requesting information | Partial | Same inquiry-form limitations apply to listing and contact flows. |
| Consuming video/media | Below target | Homepage video embed creates an unlabeled iframe with weak post-activation focus behavior. |
| Accessing office/contact information | Meets minimum | Footer and contact page expose readable phone, email, and address content. |

## Not Fully Testable / Vendor Follow-Up

The following items were not fully closed in this audit and should remain open until separately verified:

- Live production domain was not provided. This audit is against the local Studio instance at `http://localhost:8881`, not a public production host.
- Full assistive-technology matrix was not completed. `VoiceOver + Safari` and `NVDA + Chrome` retests are still required before any compliance claim.
- End-to-end email delivery for contact/listing forms was not verified in this pass.
- No public PDFs were found in the repo snapshot, uploads inventory, or reviewed public routes.
- IDX/MLS is not active yet per repo handoff; it remains a pre-launch vendor risk, not a current pass.
- The homepage video section depends on YouTube embeds and should be retested after remediation with the live vendor player behavior.
- Splide carousel behavior was reviewed in code and rendered markup, but should still be retested with screen readers after remediation.

## Recommended Remediation Order

1. Fix listing imagery alternatives, homepage video embed labeling/focus, and listing-detail contrast.
2. Add a real `<h1>` to the listing-detail template.
3. Add `autocomplete` tokens and field-level error recovery to both inquiry forms.
4. Clean up ARIA misuse in testimonials and re-run automated scans.
5. Retest desktop, mobile, keyboard-only, zoom/reflow, and screen-reader flows on the remediated templates.

## Retest Status

Current status: `Open`

No remediation retest was performed in this audit turn because this deliverable is an assessment and backlog, not a code-fix pass.
