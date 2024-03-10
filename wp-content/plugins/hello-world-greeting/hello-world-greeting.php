<?php
/*
Plugin Name: Hello World Greeting
Description: This is a custom plugin to display a "Hello World" greeting on the front-end of a WordPress website.
Author: Your Name
Version: 1.0.0
Text Domain: hello-world-greeting
*/
// Add a simple hello world message to the footer
add_action('wp_footer', 'display_hello_world_message');
function display_hello_world_message() {
    echo '<p>Hello World!</p>';
}