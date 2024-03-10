<?php
/**
 * Custom Login Page
 *
 * @package WordPress
 * @subpackage Your_Theme
 * @since Your_Theme_Version
 */

get_header();
?>

<div class="custom-login">
    <h2><?php _e( 'Login', 'vw-healthcare' ); ?></h2>

    <form action="<?php echo site_url( '/wp-login.php' ); ?>" method="post">
        <?php do_action( 'login_form' ); ?>

        <label for="user_login">Username or Email:</label>
        <input type="text" name="log" id="user_login" />

        <label for="user_pass">Password:</label>
        <input type="password" name="pwd" id="user_pass" />

        <button type="submit" class="button" name="wp-submit">Login</button>
        <input type="hidden" name="redirect_to" value="<?php echo esc_url( set_url_scheme( 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ) ); ?>" />

        <?php do_action( 'login_extra' ); ?>
    </form>

    <?php if ( get_option( 'users_can_register' ) ) : ?>
        <p><?php _e( 'No account?', 'vw-healthcare' ); ?> <a href="<?php echo wp_registration_url(); ?>"><?php _e( 'Register', 'vw-healthcare' ); ?></a></p>
    <?php endif; ?>
</div>

<?php
get_footer();