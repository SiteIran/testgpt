<?php
/*
Plugin Name: Custom Dashboard Form
Description: A simple form in the WordPress dashboard.
Version: 1.0
Author: Your Name
*/

// Enqueue JavaScript file for Ajax
function custom_dashboard_form_scripts() {
    wp_enqueue_script('custom-dashboard-form', plugins_url('custom-dashboard-form.js', __FILE__), array('jquery'), '1.0', true);
    wp_localize_script('custom-dashboard-form', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('admin_enqueue_scripts', 'custom_dashboard_form_scripts');

// Ajax handler function
function custom_dashboard_form_handler() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'custom-dashboard-form-nonce')) {
        wp_send_json_error('Invalid nonce');
    }

    // Process form data
    // Example: Save data to database
    // $name = sanitize_text_field($_POST['name']);
    // $email = sanitize_email($_POST['email']);
    // $message = sanitize_textarea_field($_POST['message']);
    // Your processing code here

    // Return response
    wp_send_json_success('Form submitted successfully');
    wp_die();
}
add_action('admin_post_custom_dashboard_form', 'custom_dashboard_form_handler');
add_action('admin_post_nopriv_custom_dashboard_form', 'custom_dashboard_form_handler');

// Function to display the form in the dashboard
function custom_dashboard_form_page() {
    ?>
    <div class="wrap">
        <h2>Custom Dashboard Form</h2>
        <form id="custom-dashboard-form" method="post">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <textarea name="message" placeholder="Message" required></textarea>
            <input type="submit" value="Submit">
            <?php wp_nonce_field('custom-dashboard-form-nonce', 'nonce'); ?>

        </form>
        <div id="form-message"></div>
    </div>
    <?php
}
add_action('admin_menu', 'custom_dashboard_form_menu');

// Add menu in admin dashboard
function custom_dashboard_form_menu() {
    add_menu_page('Custom Dashboard Form', 'Custom Form', 'manage_options', 'custom-dashboard-form', 'custom_dashboard_form_page');
}