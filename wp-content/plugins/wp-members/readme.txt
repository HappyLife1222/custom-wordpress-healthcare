﻿=== WP-Members Membership Plugin ===
Contributors: cbutlerjr
Tags: access, authentication, content, login, member, membership, password, protect, register, registration, restriction, subscriber
Requires at least: 4.0
Tested up to: 6.4
Stable tag: 3.4.9.3

License: GPLv3

== Description ==

The original membership plugin with content restriction, custom registration, and more.

=== Membership Sites. Simplified. ===

You need a membership site, but you want to focus on your business, not mastering a plugin. WP-Members is simple to use, easy to set up, yet flexible in every way imaginable.

__Simple to install and configure - yet customizable and scalable!__

= Features: =

* Restrict or hide posts, pages, and custom post types
* Limit menu items to logged in users
* User login, registration, and profile integrated into your theme
* Create custom registration and profile fields
* Notify admin of new user registrations
* Hold new registrations for admin approval
* Create post excerpt teaser content automatically
* [Shortcodes for login, registration, content restriction, and more](https://rocketgeek.com/plugins/wp-members/docs/shortcodes/)
* Create powerful customizations with [more than 120 action and filter hooks](https://rocketgeek.com/plugins/wp-members/docs/filter-hooks/)
* [A library of API functions for extensibility](https://rocketgeek.com/plugins/wp-members/docs/api-functions/)

WP-Members allows you to restrict content as restricted or hidden, limiting access to registered users.

A full Users Guide is [available here](https://rocketgeek.com/plugins/wp-members/docs/). The guide outlines the installation process, and also documents how to use all of the settings.

= Support =

There is [freely available documentation on the plugin's support site](https://rocketgeek.com/plugins/wp-members/docs/). Your question may be answered there. If you need assistance configuring the plugin or have questions on how to implement or customize features, [premium support is available](https://rocketgeek.com/product/wp-members-plugin-support/).

You can get priority support along with all of the plugin's premium extensions in one [cost saving Pro Bundle!](https://rocketgeek.com/product/wp-members-pro-bundle/)

= Premium Support =

Premium support subscribers have access to priority email support, examples, tutorials, and code snippets that will help you extend and customize the base plugin using the plugin's framework. [Visit the site for more info](https://rocketgeek.com/plugins/wp-members/support-options/).

= Free Extensions =

* [Stop Spam Registrations](https://rocketgeek.com/product/stop-spam-registrations/) - Uses stopforumspam.com's API to block spam registrations.
* [Send Test Emails](https://rocketgeek.com/product/send-test-emails/) - A utility to send test versions of the plugin's emails.

= Premium Extensions =

The plugin has several premium extensions for additional functionality. You can purchase any of them individually, or get them all for a significant discount in the Pro Bundle.

* [Advanced Options](https://rocketgeek.com/plugins/wp-members-advanced-options/) - adds additional settings to WP-Members for redirecting core WP created URLs, redirecting restricted content, hiding the WP toolbar, and more! Also includes integrations with popular plugins like WooCommerce, BuddyPress, bbPress, ADF, Easy Digital Downloads, and The Events Calendar.
* [Download Protect](https://rocketgeek.com/plugins/wp-members-download-protect/) - Allows you to restrict access to specific files, requiring the user to be logged in to access.
* [Invite Codes](https://rocketgeek.com/plugins/wp-members-invite-codes/) - set up invitation codes to restrict registration to only those with a valide invite code.
* [MailChimp Integration](https://rocketgeek.com/plugins/wp-members-mailchimp-integration/) - add MailChimp list subscription to your registation form.
* [Memberships for WooCommerce](https://rocketgeek.com/plugins/wp-members-memberships-for-woocommerce/) - Sell memberships through WooCommerce.
* [PayPal Subscriptions](https://rocketgeek.com/plugins/wp-members-paypal-subscriptions/) - Sell restricted content access through PayPal.
* [Security](https://rocketgeek.com/plugins/wp-members-security/) - adds a number of security features to the plugin such as preventing concurrent logins, registration form honey pot (spam blocker), require passwords be changed on first use, require passwords to be changed after defined period of time, require strong passwords, block registration by IP and email, restrict specified usernames from being registered.
* [Text Editor](https://rocketgeek.com/plugins/wp-members-text-editor/) - Adds an editor to the WP-Members admin panel to easily customize all user facing strings in the plugin.
* [User List](https://rocketgeek.com/plugins/wp-members-user-list/) - Display lists of users on your site. Great for creating user directories with detailed and customizable profiles.
* [User Tracking](https://rocketgeek.com/plugins/wp-members-user-tracking/) - Track what pages logged in users are visting and when.
* [WordPass Pro](https://rocketgeek.com/plugins/wordpass/) - Change your random password generator from gibberish to word-based passwords (can be used with or without WP-Members).

Get support along with all of the plugin's premium extensions in one [cost saving Pro Bundle!](https://rocketgeek.com/product/wp-members-pro-bundle/)


== Installation ==

WP-Members is designed to run "out-of-the-box" with no modifications to your WP installation necessary. Please follow the installation instructions below. __Most of the support issues that arise are a result of improper installation or simply not reading/following directions__.

= Basic Install: =

The best way to begin is to review the [Initial Setup Video](https://rocketgeek.com/plugins/wp-members/docs/videos/). There is also a complete [Users Guide available](https://rocketgeek.com/plugins/wp-members/docs/) that covers all of the plugin's features in depth.

1. Upload the `/wp-members/` directory and its contents to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress&reg;

You are ready to begin using WP-Members. Now follow the instructions titled "Locking down your site" below.

= Locking down your site: =

* To restrict posts, you will need to use the `<!--more-->` link in your posts. Content above to the "more" split will display on summary pages (home, archive, category) but the user will be required to login to view the entire post. You may also use the plugin's auto excerpt setting to create post excerpts automatically. If you do not use the "more" tag or the auto excerpt setting, full post content is going to show on archive templates, unless the post is marked as hidden.
* To begin restricting pages, change the plugin default setting for pages to be blocked. Unlike posts, the `<!--more-->` link is not necessary in the blocking of pages, but __must__ be used if you have the "show excerpts" setting turned on for pages.
* To protect comments, we recommend setting "Users must be registered and logged in to comment" under Settings > Discussion.
* On the Settings > General page, it is recommended that you uncheck "Anyone can register". While not required, this will prevent WP's native registration from colliding with WP-Members, especially if you are using any of the WP-Members additional registration fields.
* Under Settings > Reading, "For each article in a feed, show" is recommended to be set to "Summary."  WordPress installs with full feed settings by default. If you don't change this, your feeds will show full content.

= Additional Setup Information =

There are also some special pages that can be created with simple shortcodes:

* A User Profile page where registered members can edit their information and change/reset their password: [wpmem_profile]
* A Registration page available for those that need a specific URL for registrations (such as email marketing or banner ad landing pages). Note: this is strictly optional as a registration form can also be included by default on blocked content pages: [wpmem_form register]
* A Login page. This is also an optional page as the login form is included by default on blocked content. But if you need a specific login page, this can be created with a simple shortcode: [wpmem_form login]
* [And more shortcodes are available](https://rocketgeek.com/plugins/wp-members/docs/shortcodes/)!

Powerful cusotmizations can be constructed with [over 120 action and filter hooks](https://rocketgeek.com/plugins/wp-members/docs/filter-hooks/), as well as user accessible functions.


== Frequently Asked Questions ==

The FAQs are maintained at https://rocketgeek.com/plugins/wp-members/docs/faqs/


== Upgrade Notice ==

WP-Members 3.4.9 is a security update. Backup prior to upgrading is recommended, but rollback is possible. See changelog for a list of updates. Minimum WP version is 4.0.


== Screenshots ==

1. The default when viewing a blocked post - the plugin will deliver a login screen and registration form in place of blocked content (this default can be changed to other options).

2. Admin Panel - Options Tab - the various option settings for the plugin.

3. Admin Panel - Fields Tab - the plugin field manager allows you to manage (or delete) the installed extra fields and field order, and also add your own custom fields.

4. Admin Panel - Dialogs Tab - the major dialogs that the plugin uses for error and other messages can be edited in the plugin's admin panel.

5. Admin Panel - Emails Tab - all of the emails that are sent by the plugin can be edited in the admin panel.

6. Posts > All Posts - The plugin adds a column to the list of posts and pages to display if a post or page is unblocked or blocked (the opposite of whatver you have set for the plugin's default in the options tab).

7. Posts > Edit Post - The plugin adds a meta box to the post/page editor allowing you to set an individual post to be blocked or unblocked (the opposite of whatver your default setting is).

8. Responsive forms.


== Changelog ==

= 3.5.0 =

* WP-Members pluggable deprecated for use in theme functions.php (wpmem will be initialized when plugins are loaded).  If you have any WP-Members pluggable functions that load in the theme functions.php, you'll need to move these to another location, such as a custom plugin file.  Keep in mind, pluggable functions are no longer the preferred way of customizing (and have not been for many years) as most customizations, if not all, can be handled by using the plugin's filter and action hooks.

= 3.4.9.3 =

* Additional output escaping for user profile class.

= 3.4.9.2 =

* Early patch fix for export if memberships are enabled but there are no memberships defined (from 3.5.0 included fixes).
* Early patch fix for fields data list in admin notification email if HTML formatted email is enabled (from 3.5.0 included fixes).
* Security review and patches: Review shortcode object class for sanitizing all shortcode attributes and escaping all output.
* Security review and patches: Review admin user profile class for sanitizing all input and escaping all output.

= 3.4.9.1 =

* Update the allowed fields in the [wpmem_fields] shortcode when enabled.
* Update WP version compatibility.

= 3.4.9 =

* Security update for the [wpmem_fields] shortcode.  See the release notes on the support site for more detail.
* Adds wpmem_field_sc_meta_keys filter hook to filter meta keys allowed by the [wpmem_fields] shortcode (default: fields that are in the WP-Members Fields array).
* Adds wpmem_is_login(), wpmem_is_register(), and wpmem_is_profile() conditional functions.

= 3.4.8 =

* Fixes a 3.4.7 bug that causes "extra" user fields to not save option to add to user screen (users > all users).
* Fixes a 3.4.7 bug that throws a php error when saving settings in the main options tab.
* Fixes bug in 3.4.7 that causes custom fields array to be overwritten as empty when updating fields in the plugin's Fields tab.
* Fixes issues with updating WP-Members WooCommerce integration settings in the main WP-Members options tab.
* Security update in Fields tab reorder processing.
* Code improvement udpates to RS Captcha validation processing.
* Adds wpmem_get_form_state() API function (replaces checking $wpmem->regchk directly).

= 3.4.7 =

* Code improvement and database upgrade for admin user search functions; removes the wp_wpmembers_user_search_keys table and replaces it with wp_wpmembers_user_search_crud.
* Code improvement in the password reset function for situations where an error may result in an empty user object.
* Code improvement in REST API filtering of blocked content for situations where there may be additional (i.e. custom) values (such as those created by page builders).
* Code improvement in hidden posts checking in case the "post__not_in" query_var is not set.
* Code improvement to make sure required fields are required for the wp user profile, but allowable to be skipped by an admin.
* Code improvement to make sure all object variables are declared for php 8.2.
* Added timestamp field type.
* Added wpmem_get_membership_id() API function.
* Added wpmem_get_membership_slug() API function.
* Added wpmem_is_enabled() API function for checking if specific settings are enabled.
* Added "select all" option to several fields columns in the Fields tab.
* Added previous data array when updating user fields, can be used in filters to check for changes.
* Added ability to make WooCommerce products not purchaseable.
* Added wpmem_user_memberships shortcode to display a user's memberships.
* Added wpmem_user_membership_posts shortcode to display a list of membership restricted posts available to a user.
* Moved WooCommerce options out of "new feature" settings and expanded options.
* Added option to add WP-Members fields to the WooCommerce My Account user profile update.
* Added option to restrict WooCommerce product purchase if the product is set as restricted (requires that WC "product" custom post type be enabled for WP-Members).
* Added wpmem_remove_membership_from_post() to the API.
* Fix bug in wpmem_add_membership_to_post().

= 3.4.6 =

* Fixes a bug in the user profile update object class that prevented non-admin users from updating WP-Members custom fields in the dashboard profile view.
* Fixes some logic in the registration/profile update to check for a valid $user object (if it's a profile). It is rare that it wouldn't be, but this is a "just in case" to avoid unnecessary php notice errors.
* Adds wpmem_get_user_by_meta() API function to retrieve a $user object by user meta (WP's get_user_by() only does username, email, and ID).
* Adds wpmem_add_membership_to_post() API function to programmatically add a membership to a post.  Can be used for bulk and on-the-fly post restriction.
* Adds wpmem_add_membership_to_posts() API functions to programmatically add a membership to a group of posts (an array of IDs or comma separated IDs).  Can be used for bulk and on-the-fly post restriction.
* Adds wpmem_create_membership() API function to programmatically create a membership.  Can be used to create new memberships when hooked to other actions.
* Adds wpmem_create_username_from_email() API function.  If WooCommerce is installed, it will use the WC process, otherwise it uses a email user + number process until it finds a unique value.
* Adds wpmem_login_link(), wpmem_get_login_link(), wpmem_reg_link(), and wpmem_get_reg_link() for getting and displaying links to these identified pages (based on plugin's settings).
* Adds rktgk_wp_parse_args() to general plugin API. This is a utility function that functions like WP's wp_parse_args(), but is fully recursive (which wp_parse_args() is not).
* Adds rktgk_get_row() to the general plugin API. This is a utility that functions like WP's wpdb::get_row(), but incrporates wpdb::prepare() by default (saving a necessary step).
* Updates rktgk_build_html_tag() in the general plugin API to include an "echo" parameter to automatically print result to screen (false by default).
* Adds two new dialog message strings for acct_not_approved & acct_not_validated.
* Adds $tag for the form being generated in the wpmem_{$form}_defaults set of filters (login|changepassword|resetpassword|forgotusername).
* Adds author ID support for [wpmem_field] shortcode to display user meta data based on the post/page author ID (rather than the current user or querystring user).
* Adds filter support for "shortcode_atts_wpmem_profile"
* Improve message handling for password reset when moderated registration and confirmation link settings are enabled (and the user is not activated or confirmed).

= 3.4.5 =

* 3.4.4 is not compatible with [WP-Members Advanced Options](https://rocketgeek.com/plugins/wp-members-advanced-options/) when redirect to login is used.  This version corrects that issue by rolling back the change to only load membership restriction functions when the membership products setting is enabled.
* Adds wpmem_login_form_button_rows filter hook.
* Adds wpmem_pwd_reset_email_link filter hook
* Adds API functions wpmem_profile_url(), wpmem_pwd_reset_url(), wpmem_register_url(), wpmem_forgot_username_url(). 
* Adds API functions wpmem_get_membership_name(), wpmem_get_membership_meta(), wpmem_get_membership_post_list(), wpmem_get_post_memberships(), wpmem_get_memberships().
* Adds API functions wpmem_add_query_where(), wpmem_get_query_where(), wpmem_add_user_view_link(), wpmem_get_user_view_link(), wpmem_get_user_view_count().
* Updates user views to use new API functions and adds capability to more easily customize user views.
* Code improvement: update instances of deprecated function wpmem_gettext() to use wpmem_get_text().
* Code improvement: update wpmem_user_has_role(), $current_user global no longer necessary.
* Code improvement: update select2 library to version 4.1.0.
* CSS update: defines columns widths for Settings > WP-Members > Fields table.

= 3.4.4 =

* Adds excerpt to membership restricted content when excerpts are used and the user is logged in (should work the same as blocked content for a non-logged in user).
* Adds excerpt to wpmem_product_restricted_args arguments to be edited or removed using the filter.
* Adds [memberships] shortcode for admin notification email; this will include a list of memberships for the user in admin notification.
* Fixes potential issue with [wpmem_field] shortcode if field does not have a defined type.
* Updates to [wpmem_profile] and [wpmem_form password] for improved password reset.
* Moves password reset link actions to template_redirect action. This should resolve issues that occur when multiple instances of the_content are run (i.e. the appearance of an invalid key message upon completing the password reset).
* Moves export class to main user object (previously loaded from admin files). @todo Export class file also remains in admin for backward compatibility if file is called directly.
* Moves admin object load (back) to "init" action (from "admin_init") as later load can cause problems with extensions loading on the "wpmem_after_admin_init" action.
* Load dependencies after settings are loaded (allows for conditional loading of certain dependencies).
* Load membership/product restriction only if membership products setting is active.

= 3.4.3 =

* Simplified check_validated() and check_activated() functions, included check for null $user.
* Added wpmem_check_validated and wpmem_check_activated filter hooks.
* Added display="url" attribute to the [wpmem_field] shortcode for file and image field types.
* Fix undefined variable in password reset.
* Improve onboarding process for both new installs and updates.

= 3.4.2 =

* Applies checkbox CSS in add new user form.
* Code consolidation in admin options tab file (remove final use of wpmem_use_ssl()).
* Add wpmem_recaptcha_url filter to allow for changing the URL of the recaptcha script.
* Only apply pwd reset override on frontend (for login error).
* Fixes undefined $wpmem->reg_form_showing.
* Fixes a bug in the password change shortcode that causes a "too few arguments" error.
* Changes wpmem_is_user_current() to wpmem_user_is_current() for backwards compatibility with the plugin's premium PayPal extension.
* Added the action being done as a parameter passed to the wpmem_get_action action hook.
* Added support for arrays, urls, and classes to wpmem_sanitize_field() (alias of rktgk_sanitize_field()). This is in addition to the sanitization already supported.
* apply_custom_product_message() now runs do_shortcode() to natively support shortcodes in custom membership product messages.
* Fixed an issue that did not display the custom product message if the user was not logged in.
* Improved custom product message for non-logged in state (same function is used by both logged in and logged out processes, so cleaned up to handle both states the same).
* Bug fix in password reset that potentially truncates the reset link.
* Bug fix in admin notification email for HTML formatted email (wpautop() was not being applied to email content).
* Bug fix in wpmem_is_reg_type() that returned invalid object var.
* Added email arg for default linebreak.
* Added user ID to email filters.
* Added id, class, and wrapper attributes to [wpmem_logged_in] shortcode (wrapper defaults to "div" but can be changed to "span" or "p" or something else).
* Added user confirmed field to default export fields (if confirmation link setting is enabled).
* Added wpmem_set_user_membership(), wpmem_remove_user_membership(), and wpmem_get_user_memberships() API functions.
* Introduces new installer/onboarding for both new installs and upgrades.

= 3.4.1 =

* Revise the membership hierarchy logic (see release announcement for details).
* Changing "Product" text to "Membership" for clarity (was planned for 3.4.0).
* Changing "Block" text to "Restricted" for clarity (was planned for 3.4.0).
* Added wpmem_is_user_current() api function.
* Added attachements to email function.
* Added wpmem_email_attachments filter.
* Moves external libraries to "vendor" directory.
* Removes a overlooked use of wpmem_page_pwd_reset() which was deprecated as of 3.4.0.
* Sanitize email as email, not text.
* Fixes a bug in the user api for undefined variable when checking the user ip.
* Fixes a bug in 3.4.0 that causes an error in user export.
* Fixes a bug in 3.4.0 that causes the captcha validation to be run twice, resulting in failed captcha during registration.
* Fixes css issue that caused cursor change on all list table screens for drag-and-drop; should only show on Fields tab.

= 3.4.0 =

Here is a list of changes in 3.4.0, but for a more detailed look at the impact of some of these items, be sure to review https://rocketgeek.com/release-announcements/wp-members-3-4-0-wow/

* Rebuilds the login widget functions so there are filter hooks that more closely mimic the main body login filters. Every attempt was made to provide an HTML result that is the same as previous versions, as well as providing support for legacy dialog tags.
* Rebuilt and revised user export functionality.  Now includes an api function that can be used to customize user exports for a variety of uses.

New Feature Settings:
* The default password reset process is now the reset link. New installs will automatically have this setting.  Existing installs can change to this by toggling the setting to use the legacy option in Settings > WP-Members > Options > New Features.
* The default new registration process now uses the email confirmation link.  A user must confirm their email address prior to their account being able to log in.  New installs will automatically have this setting, but you may opt to use the legacy option by changing the setting in Settings > WP-Members > Options > New Features.
* The default emails at install reflect the above changes. Existing installs as always will not have their email content altered by the upgrade script.

* Post restricted message now completely separate from login form.
* Post restricted message now has new wrapper id - #wpmem_restricted_msg

* Improved redirect_to handling in login and register forms.  Can now specify a page by slug alone in the shortcode param for portability.
* Improved Google reCAPTCHA v3 ("invisible captcha") to optionally display on all pages (recommended by Google to improve user "score").
* Improved forms display in Customizer, now can view forms on blocked content (not just shortcode pages).
* Improved functionality of hidden posts. Now saved in WP settings (options) instead of as a transient.
* Improved user count transient. Now expires in 5 minutes instead of 30 seconds (will result in fewer loads of the query).

* Membership products now support hierarchy. This can be used for "levels" or for multiple expiration periods yet still only have to assign one membership to content for all child memberships.

* HTML email for WP-Members emails can be enabled as an option in the Emails tab.

* Login failed dialog now displays login form below the error. Removed "continue" (return) link from default message.
* Login failed dialog (#wpmem_msg) text centered in stylesheet instead of applying in the div tag. Best way to customize is using the WP Customizer.

* Updates to export function.
  - deprecated 'export_fields', use 'fields' instead.

* Clone menus is deprecated. The setting remains in place for users who have it enabled.  But if it is not enabled, the setting is no longer available.

* Expands Customizer functionality so logged out forms show on blocked content (not just shortcodes).

* Adds integration for WP's "registration_errors" filter hook, allowing for standarized custom validation and integration with other plugins.
  
New API functions:
* wpmem_is_reg_form_showing()
  
Deprecated functions:
* wpmem_inc_loginfailed()
* wpmem_inc_regmessage()
* wpmem_inc_login()
* wpmem_page_pwd_reset()
* wpmem_page_user_edit()
* wpmem_page_forgot_username()
* wpmem_inc_memberlinks()
* wpmem_gettext() - use wpmem_get_text() instead.
* $wpmem->texturize()

Bug fixes:
* Fixes a bug in the signon process that causes the "rememberme" option to be ignored.
* Fixes a bug in wpmem_is_blocked() that returns false when checking a specific post ID.
* Fixes a bug in the autoexcerpt function that caused a double "read more" link when excerpt length was set to zero.

= 3.3.9 =

* Fixed issue with WooCommerce My Account registration form that caused the last WP-Members field to duplicate the form label.
* Fixed issue that caused blanking of unused native WP fields when updating the WP-Members user profile.
* Fixed issue in both user email confirmation and password reset links when username contains a space (space was not url encoded).
* Fixed lower bulk menu "add field" item for adding a custom field in the Fields tab.
* Fixed issue where update settings button may not show on RS Captcha settings tab if plugin not installed (so couldn't change captcha type without going back to main options tab).
* Fixed issue in password reset link if user login value is truncated, causing the user ID to not be found.
* Add "membership" field type to [wpmem_field] accepted field types.
* Changes the "required" field indicator in the default terms checkbox to display next to the label instead of the input.
* Added filter for reCAPTCHA v3 validation score. Default value is 0.5, wpmem_recaptcha_score can filter this value.
* Added additional user views for the Users > All Users screen, can now screen by membership and email confirmed/not confirmed.
* Added additional actions for the Users > All Users screen.
* Added wpmem_user_set_as_confirmed action when user has confirmed their email or the admin has manually confirmed.
* Added wpmem_user_set_as_unconfirmed action when admin has manually unconfirmed a user.
* Added wpmem_validation_link filter.
* Added $defaults to be passed to wpmem_auto_excerpt_args filter.
* Removed jabber, aim, and yim fields from default WP fields for wp_insert_user(). They haven't been native for WP for awhile, and if needed, they can be added as a custom field using the same meta.

= 3.3.8 =

* This update does upgrade the plugin's db version. It adds a new email for user email validation during registration.
* Revised password reset, now uses WP's user_activation_key instead of custom meta.
* Revised email validation on registration, now users WP's user_activation_key instead of custom meta. 
* Revised email validation for cleaner use when moderated registration is active. Now, if registration is moderated, user must validate their email before notification is sent to admin. User cannot log in until admin approves the user. (Must enable WP Login Erroe setting in WP-Members options for complete messaging.)
* Revised email validation now has custom email.
* Added User Screen column for user email validation/confirmation, updated column for activation (uses dashicons instead of text).
* Improved handling of User Screen column labels so that if a label is changed in the WP-Members Fields manager, the column is automatically reflected without refreshing the wpmembers_utfields setting.
* When registration runs wp_insert_user(), the resulting $user object is captured and passed to the wpmem_register_redirect action.
* The default function in the WP-Members user object runs register_redirect() hooked to the wpmem_register_redirect action.  Previously, this was run at the default priority (10). This update moves it to priority 20 (so a custom redirect set at the default priority will run first).
* Can now customize the plugin's upload directory.
* Fixes issue with attachment URLs in user profile view when used in multisite.
* Added new feature settings for turning on/off WP-Members fields in WooCommerce My Account page registration and checkout registration.
* Added captcha support to native WP registration form.

= 3.3.7 =

* Added "Export All" button to top bulk menu (as previously only in lower)
* Updated export default date format for filename to YYYY-MM-DD
* Fixed bug in export if no users are selected
* Updated wpmem_sanitize_array() to accept "type" argument to define data type to be sanitized (currently only accepts integer|int, default sanitizes as text).
* Add WP-Members "checked by default" property to WooCommerce checkout registration checkbox fields.
* Added new conditional API function - wpmem_is_woo_active() for checking if WooCommerce is active.
* Added integer test/check to wpmem_sanitize_field(), now can sanitize multiselect, multicheckbox, textarea, email, file, image, and number fields.
* Revised "activation link" feature to "Confirmation link".


= 3.3.6 =

* Improved admin tab for captcha settings. You can now change the captcha type from the captcha tab (previously, you could only do this from the main options tab).
* Removed "pattern" attribute from number field type. HTML5 does not support this attribute for this input type.
* Fix issues with custom fields in admin/user dashboard profile. This involved a change to how fields were loaded for both display and validation (so that now it is a singular process).
* Fix undefined has_access() (replaced with API function) when renewing a membership.
* Fix issues with WooCommerce registration integration.
* Fix issue of undefined array keys if Really Simple Captcha is selected, but the plugin is not enabled.
* Fix issue that caused users to not be properly set when moderated registration is used along with BuddyPress and users are created manually.
* Fix issue in WP CLI wpmem settings command that caused error to be displayed when viewing content settings.

= 3.3.5 =

* Added optional new user validation link and password reset link (instead of sending password). This option will become the default setting in 3.4.0.
* Added optional login error message to fully utilize the WP login error.  This option will become the default setting in 3.4.0.
* Updated the default product restricted message to display required membership(s). This eliminates the custom message string "product_restricted" and replaces with two new ones: product_restricted_single and product_restricted_multiple. (Note this only affects the default message if no custom membership message is established in the membership properties).
* Added login/logout button to login/logout link api function wpmem_loginout() and shortcode [wpmem_loginout]. It will continue to display a hyperlink by default, but accepts arguments to display as a button. Also added ID and class options for link or button.
* Added [wpmem_login_button] to directly call the button format of [wpmem_loginout].
* Captcha options now have a static function that can be used to directly call captcha and validation.
* Fixed an issue where the Really Simple Captcha "not installed" error was returned as a string but evaluated as an array.
* Fixed an issue that caused the "membership" field selector/type to display as a text input in Users > Add New instead of a dropdown/select.
* Added user api functions wpmem_get_user_id(), wpmem_get_user_obj(), wpmem_get_users_by_meta().
* Added action hooks to membership product admin screen.
* Added wpmem_post_product filter to allow for filtering required products by post ID.
* Added wpmem_is_user_activated filter hook.
* wpmem_activate_user() now accepts a "notify" argument (defaults to true, set to false to not send a notification email).
* Added wpmem_get_users_by_meta(), wpmem_get_pending_users(), wpmem_get_activated_users(), and wpmem_get_deactivated_users().
* Added manage_options capability requirement for membership products custom post type.
* Updated WooCommerce registration handling.
* Added wpmem_is_reg_type(). Can be used withing wpmem_post_register_data to determine which registration type is being triggered.
* Added WP-CLI commands (see release announcement and documentation for more information on specific commands).
* Added support for hCaptcha (https://www.hcaptcha.com/).

= 3.3.4 =

* Updated pre_get_posts to merge post__not_in with any existing values. This will allow for better integration with other plugins (such as Search Exclude).
* Updated pre_get_posts to fire later (20) in case another plugin is adding values to be excluded. This will prevent any hidden posts from being dropped by the other plugin's process.
* Added wpmem_hidden_posts and wpmem_posts__not_in filters.
* Fixed logic in upload input type (image or file) to correct undefined variable ($file_type).
* Added function_exists check for wpmem_renew() (a PayPal extension function used in the core plugin).
* Fixed function name typo for wpmem_a_extend_user() (a PayPal extension function used in the core plugin).
* Updated product access shortcode error message to use the product_restricted message and changed the class to product_restricted_msg
* Updated CAPTCHA class for more flexibility (can now be implemented into API for calling directly in the login or other forms).
* Moved user export function from Admin API to User API.
* Fixed adding WP-Members fields to WooCommerce checkout.


= 3.3.3 =

* If WooCommerce is active, any standard WC user meta fields are removed from the WP-Members additional fields in the User Profile Edit (since they already display in the WC field blocks).
* When setting hidden posts, don't include posts from post types not set as handled by WP-Members. This prevents previously hidden posts from being included if the post type is no longer included for WP-Members.
* Set a default product for publishing posts/pages.
* Updated activation/deactivation processing so that a (admin) user cannot activate or deactivate themselves. Also, if a user has "edit_users" capability, they can log in without being activated.
* Load email "from" address with main settings rather than when email is sent. This corrects issues with Advanced Options extension, and also keeps the value loaded for use outside of WP-Members email function.
* WP 5.4 adds the wp_nav_menu_item_custom_fields action, so now WP-Members only loads its custom walker if WP is 5.3 or lower.
* Image file field type now shows an immediate preview when the "choose file" button is clicked and an image selected (both profile update and new registration).
* wpmem_login_failed_args updated to pass $args (similar to other _args filters in the plugin, now parses defaults).

= 3.3.2 =

* Added back shortcode menu item previously removed in 3.3.0.
* Added new handling in wpmem_is_blocked() for validating rest api requests.
* Added new wpmem_is_rest() function to the plugin's API, determines if the request is a rest request.
* Fixed issue with dropdown, mutliple select, and radio field types that allowed white space in resulting value.
* Fixed issue with register/profile update validation if email is removed via wpmem_fields filter hook.
* Fixed issue with prev/next post links to not show hidden posts if user is logged in but does not have a membership.
* Fixed issue with hidden posts when membership products are used. Hidden posts not assigned a membership remained hidden.
* Fixed issue with menus where logged in/logged out settings were not applied unless membership products were enabled.
* Moved wpmem_post_register_data action to fire hooked to user_register at priority 20. Changed email actions to fire at priority 25. See release announcement for more detail of implications.
* Code improvement to reCAPTCHA.
* Code improvement to excerpt generation.
* Code improvement to expiration date generation.
* Code improvement to hidden posts when using membership products.
* Code improvement changed user_register hook priority for post_register_data() to "9" to allow for custom meta fields to be available to any user_register function using the default priority (10) or later.

= 3.3.1 =

* Update membership product expiration to allow for a "no gap" expiration (i.e. renewal begins from expiration date, optional) or default (renewal begins from today or expiration date, whichever is later).
* Update user activation to use wp_set_password().
* Update display of membership product slugs to text (instead of a form input). They can't be edited.
* Added empty /inc/dialogs.php for customizations and plugins that try to include the legacy dialogs file.
* Updates to user profile screen which allows users with 'edit_users' capability (admins) to edit their own profile.
* Fixes a bug that caused the user profile display for a new user to say "reactivate" instead of "activate".
* Fixes a bug in the membership renewal that sets the individual date meta forward two periods instead of one.
* Fixes a bug in the hidden fields lookup that caused hidden posts with a membership limitation to not display to users who had a matching membership.
* Changed custom menu options to use wp_nav_menu_item_custom_fields action hook. This is a "made up" hook that is not actually part of WP. But somewhere along the line, some menu-focused plugins began using it in their custom walkers. By not using it in WP-Members, that caused some problems for users who also used one of those other plugins or themes. This updates shifts to use this "non-standard" action hook these other themes and plugins are using in order to apply some level of compatibility. 

Including all 3.3.0.x patches:
* Provides a workaround for a bug in the dialogs setting when custom dialogs are applied. This targets an issue specifically affecting users with the WP-Members Security extension installed. (3.3.0.4)
* Fixes a bug when products are enabled but no default is set. Allows for no default membership assigned at registration. (3.3.0.4)
* Fixes a bug that caused the post restricted message to display on the short form when it was in password reset and forgot username state. (3.3.0.4)
* Added wpmem_get_hidden_posts() API function to return an array of post IDs marked as hidden. (3.3.0.4)
* Fixes a shortcode issue for the [wpmem_logged_in] shortcode when using the meta_key attribute. 3.3.0 added a "compare" attribute, and with this addition, it broke the original default use of the shortcode. (3.3.0.3)
* Fixes an issue with registration/profile form fields when used in the profile. It was intended to introduce separate selection of fields for registration and profile update in 3.3.0. However, there is an issue that causes profile fields to both (1) not correctly display and (2) if they do, they do not update correctly. (3.3.0.2)
* Fixes issue when updating where the stylesheet selector indicates "use_custom" but the actual URL is to a default stylesheet. The problem can be corrected manually, but this fix applies the custom URL to the new standard setting for the defaults. (3.3.0.1)
* Fixes bug where any stylesheet other than the default reverts to the default ("no float"). This was due to the database version being wiped when settings were updated. This fix correctly applies the database version when updating settings. (3.3.0.1)
* Fixes bug when captcha is used (unknown validate() function). The validate() function should have been declared and used as a static method. This fix declares validate() as static and then uses it as such. (3.3.0.1)
* Fixes undefined string variable when successful registration is executed. (3.3.0.1)

= 3.3.0 =

* REMOVED [wp-members] shortcode tag. THIS TAG IS OBSOLETE WILL NO LONGER FUNCTION. See: https://rocketgeek.com/shortcodes/list-of-replacement-shortcodes/
* REMOVED tinymce button for shortcodes as no longer necessary with gutenberg.
* Deprecated wpmem_inc_login_args filter, use wpmem_login_form_defaults instead.
* Deprecated wpmem_inc_{$form}_inputs and wpmem_inc_{$form}_args filters, use wpmem_{$form}_form_defaults instead. (changepassword|resetpassword|forgotusername)
* Deprecated wpmem_sb_login_args filter, use wpmem_login_widget_args instead.
* Deprecated wpmem_msg_args and wpmem_msg_dialog_arr filters, use wpmem_msg_defaults instead.
* The following functions are deprecated, replacements should no longer be considered "pluggable":
  - wpmem_inc_registration() Use wpmem_register_form() instead ($heading argument obsolete).
  - wpmem_inc_changepassword()
  - wpmem_inc_resetpassword()
  - wpmem_inc_forgotusername()
  - wpmem_inc_recaptcha()
  - wpmem_build_rs_captcha()
* The following functions and filters are obsolete and have been removed:
  - wpmem_shortcode() (deprecated 3.1.2)
  - wpmem_do_sc_pages() (deprecated 3.1.8)
  - wpmem_admin_fields() (deprecated 3.1.9)
  - wpmem_admin_update() (deprecated 3.1.9)
  - wpmem_user_profile() (deprecated 3.1.9)
  - wpmem_profile_update() (deprecated 3.1.9)
  - wpmem_dashboard_enqueue_scripts() (deprecated 3.2.0 Use $wpmem->admin->dashboard_enqueue_script() instead.)
  - wpmem_sc_forms() (deprecated 3.2.0 Use $wpmem->shortcodes->forms() instead.)
  - wpmem_sc_logged_in() (deprecated 3.2.0 Use $wpmem->shortcodes->logged_in() instead.)
  - wpmem_sc_logged_out() (deprecated 3.2.0 Use $wpmem->shortcodes->logged_out() instead.)
  - wpmem_sc_user_profile (deprecated 3.2.0 Use $wpmem->shortcodes->profile() instead.)
  - wpmem_sc_user_count() (3.2.0 Use $wpmem->shortcodes->user_count() instead.)
  - wpmem_sc_loginout 3.2.0() (deprecated Use $wpmem->shortcodes->loginout() instead.)
  - wpmem_sc_fields() (deprecated 3.2.0 Use $wpmem->shortcodes->fields() instead.)
  - wpmem_sc_logout() (deprecated 3.2.0 Use $wpmem->shortcodes->logout() instead.)
  - wpmem_sc_tos() (deprecated 3.2.0 Use $wpmem->shortcodes->tos() instead.)
  - wpmem_sc_avatar() (deprecated 3.2.0 Use $wpmem->shortcodes->avatar() instead.)
  - wpmem_sc_link() (deprecated 3.2.0 Use $wpmem->shortcodes->login_link() instead.)
  - wpmem_register_fields_arr (obsolete 3.1.7, use wpmem_fields instead.)
  
IMPORTANT UPDATES/CHANGES

* Major filesystem changes. The directory structure has changed and several files
  moved/renamed/made obsolete. If you have ANY WP-Members customization that directly
  includes a file, that step is probably obsolete. The plugin has loaded most of the
  include files automatically since at least version 3.2, so this step has not been
  necessary for quite some time. However, this set of changes is more significant.
  (If you do not have code snippets using file includes from WP-Members, this most 
  likely will not affect you.)

* Updated registration function to hook to user_register, IMPORTANT: this 
  changes the order in which the user meta fields are saved, and also changes 
  when the email is sent. Email is now hooked to user_register, but can be 
  unloaded if necessary.
  
* Major overhaul of registration and login form, validation, and processing
  functions. Moved things into appropriate object classes (user, forms) and
  deprecated legacy functions and files (register.php, forms.php).
  
* Updated membership product meta and date format, IMPORTANT: this changes the 
  way the user product access information is stored (going from an array of 
  all memberships to individual meta for each) as well as the format (dates 
  are now unix timestamp). There is an update script that will run during 
  upgrade to handle this. For now, the legacy format is also maintained (so 
  consider this if customzizing any processing) so that rollback is possible.

* Updated wpmem_user_has_meta() to include a check by array when the field is 
  multiple checkbox or multiple select.

* Updated [wpmem_logged_in] shortcode to include an msg attribute to display a 
  message if the user does not have access to a specified product (product must
  be passed as attribute).
  
* Updated [wpmem_logged_in] shortcode to include a compare attribute. Possible
  values for "compare" are "=" and "!=" to restrict if the has a meta value or
  the meta value is "not equal to" respectively. Passing only meta_key/meta_value
  will still assume an "=" comparison.

* Updated register page shortcode [wpmem_form register] logged in state - if a 
  profile page is set, second link links to profile rather than "begin using 
  the site".

* Updated Users > All Users screen filters, removed "Not Activated" replaced
  with "Pending Activation". Filter now only shows users who have not been
  activated, no longer includes users who were deactivated.

* Major menus change - if you use the $wpmem->menus object directly, this is 
  now $wpmem->menus_clone (setting $wpmem->clone_menus remains the same).
  wpmem_menu_settings and wpmem_menus are now wpmem_clone_menu_settings and 
  wpmem_clone_menus. New menu handing has been introduced in the $wpmem->menus
  object and that will take the place of the cloned menu options.
  
* Updated the way stylesheets are handled. Added wpmem_get_suffix() API function to
  get the appropriate suffix for files (.min.css or .css) for both js and css. Also,
  minified all CSS files that were not previously minified. Note: you can no longer
  filter custom stylesheets into the plugin's dropdown selector (no one was using
  this feature as far as I am aware anyway). You *can* still filter the stylesheet
  being loaded as well as indicate the path of a custom stylesheet.

* Added reCAPTCHA v3 support.
* Added default membership product(s) at registration.
* Added membership product(s) for user export.
* Added support for selecting fields to display on the registration form or the profile form.
* Added wpmem_activate_user() and wpmem_deactivate_user() to user API.
* Added wpmem_user_sets_password() API function.
* Added wpmem_get_block_setting() API function.
* Added wpmem_set_user_status() API function.
* Added wpmem_export_users() as API function (function already existed, but the original has been moved to an object class, and the function has been included in the API).
* Added wpmem_sanitize_field() API function. This is a general utility that allows for different sanitization by type.
* Added wpmem_maybe_unserialize() API function. If result is serialized, it unserializes to an array, if an array, it sanitizes using wpmem_sanitize_array().
* Added wpmem_get_user_role() API function.
* Added wpmem_get_user_ip() API function.
* Added wpmem_get_user_meta() API function.
* Added wpmem_get_user_products() API function.
* Added wpmem_user_has_meta filter.
* Added wpmem_login_form_settings filter.
* Added wpmem_block_settings filter.
* Added wpmem_msg_settings filter.
* Added wpmem_sc_product_access_denied filter.
* Added wpmem_views_users filter.
* Added wpmem_dialogs filter.
* Added wpmem_query_where filter.
* Added wpmem_user_action.
* Added admin user class for handling Users > All users screen and user activation.
* Added user export class.
* Added "msg" attribute support for [wpmem_logged_in] when using the "membership" or "product" attributes.
* Replaced WPMEM_VERSION constant with $wpmem->version.
* Replaced WPMEM_PATH constant with $wpmem->path. WPMEM_PATH will still function for backward compatibility.
* Replaced WPMEM_URL constant with $wpmem->url.
* New folder structure being implemented
  - All admin js & css now load from /assets/ not /admin/ !!!

Other Improvements

* Changed load for WP-Members Admin API so that emails, dialogs, and tabs only load on the WP-Members settings screens (where they are used).
* Changed email "from" to only load if the WP-Members Email object is doing a send (user or admin). This saves an option load when not needed.
* Fixed an issue where a PHP notice was thrown if one of the User Pages (login/register/profile) was deleted but the setting not updated. Fixes the PHP notice issue, but also adds an admin notice to indicate the page was deleted, but the setting not updated. (This also adds a new admin notice function/process that can be expanded on later.)
* Fixed an issue with wpmem_user_has_access() that prevented proper results when used to check a specific user ID (other than the current user).

