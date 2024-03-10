<?php
$title_atts = ( isset( $atts['title'] ) && $atts['title'] != '' ) ? $atts['title'] : '';
if( $title_atts == 'Login' ) {
  ?>
  <form id="imma_login" class="ajax-auth" action="login" method="post">
    <h1><?php esc_html_e( 'Login', IEPA_TEXT_DOMAIN ); ?></h1>
    <p class="status"></p>
    <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>

    <label for="username">
      <?php esc_html_e( 'Username', IEPA_TEXT_DOMAIN ); ?>
    </label>
    <input id="username" type="text" class="required" name="username" required>

    <label for="password">
      <?php esc_html_e( 'Password', IEPA_TEXT_DOMAIN ); ?>
    </label>
    <input id="password" type="password" class="required" name="password" required>

    <input class="submit_button" type="submit" value="<?php esc_attr_e( 'LOGIN', IEPA_TEXT_DOMAIN ); ?>">
    <button type="button" class="close">
      <i class="fa fa-close"></i>
    </button>
  </form>

<?php } else { ?>
<form id="imma_register" class="ajax-auth"  action="register" method="post">
  <h1><?php esc_html_e( 'Signup', IEPA_TEXT_DOMAIN ); ?></h1>
  <p class="status"></p>
  <?php wp_nonce_field( 'ajax-register-nonce', 'signonsecurity' ); ?>
  <label for="signonname">
    <?php esc_html_e( 'Username', IEPA_TEXT_DOMAIN ); ?>
  </label>
  <input id="signonname" type="text" name="signonname" class="required" required>
  <label for="email">
    <?php esc_html_e( 'Email', IEPA_TEXT_DOMAIN ); ?>
  </label>
  <input id="email" type="text" class="required email" name="email" required>
  <label for="signonpassword">
    <?php esc_html_e( 'Password', IEPA_TEXT_DOMAIN ); ?>
  </label>
  <input id="signonpassword" type="password" class="required" name="signonpassword" required>
  <label for="password2">
    <?php esc_html_e( 'Confirm Password', IEPA_TEXT_DOMAIN ); ?>
  </label>
  <input type="password" id="password2" class="required" name="password2">
  <input class="submit_button" type="submit" value="<?php esc_attr_e( 'SIGNUP', IEPA_TEXT_DOMAIN ); ?>">
  <button type="button" class="close">
    <i class="fa fa-close"></i>
  </button>
</form>
<?php }
