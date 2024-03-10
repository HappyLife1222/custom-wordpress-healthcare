<?php
// Function to register a new user with a custom password
function custom_user_registration($username, $email, $password) {
    $user_id = wp_create_user($username, $password, $email);

    if (is_wp_error($user_id)) {
        // Handle error case
        return $user_id->get_error_message();
    }

    // Redirect to the login page or a custom success page
    wp_redirect(site_url('/registration-success'));
    exit;
}

// Create a custom registration form
function custom_registration_form() {
    ?>
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit" name="register">Register</button>
    </form>
    <?php
}

// Process the custom registration form
add_action('init', function () {
    if (isset($_POST['register'])) {
        $username = sanitize_user($_POST['username']);
        $email = sanitize_email($_POST['email']);
        $password = $_POST['password'];

        // Validate user input
        if (!empty($username) && !empty($email) && !empty($password)) {
            $result = custom_user_registration($username, $email, $password);

            if (is_wp_error($result)) {
                // Handle error case
                echo $result;
            }
        } else {
            // Handle empty fields case
            echo 'Please fill in all fields.';
        }
    }
});