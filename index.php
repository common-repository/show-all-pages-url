<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php
/*
Plugin Name: YYDevelopment - Show Pages URL List
Plugin URI:  https://www.yydevelopment.com/yydevelopment-wordpress-plugins/
Description: Simple plugin that allow you view all the pages on your wordpress site
Version:     2.4.0
Author:      YYDevelopment
Author URI:  https://www.yydevelopment.com/
*/

// -----------------------------------------------
// Adding plugin menu
// -----------------------------------------------

// function that will output the code to the page
function yydev_show_all_pages_url_output() {
    include('script.php');
    include('style.php');
    include('include/admin-output.php');
} // function yydev_show_all_pages_url_output() {

// function that will output the code to the page
function yydev_show_custom_pages_url_output() {
    include('script.php');
    include('style.php');
    include('include/custom-pages-type.php');
} // function yydev_show_custom_pages_url_output() {

// function that will output the code for the YYDevelopment-basic theme custom blog page
function yydev_show_all_pages_basic_theme_custom_blog() {
    include('script.php');
    include('style.php');
    include('include/yydev-custom-blog-output.php');
} // function yydev_show_all_pages_basic_theme_custom_blog() {


if( intval(get_option('yydev_show_all_pages_url_main_menu')) == 1 ) {

    add_action('admin_menu', function() {
        add_management_page( 'Show All Pages URL', 'Show All Pages URL', 'manage_options', 'yydev-show-pages', 'yydev_show_all_pages_url_output'); // main page

        add_management_page( 'Custom Pages Type', 'Custom Pages Type', 'manage_options', 'yydev-custom-pages-type', 'yydev_show_custom_pages_url_output');  

        // YYDevelopment-basic theme custom blog theme
        if( function_exists('yydev_theme_languages') ) {
            add_management_page( 'Custom Blog Pages', 'Custom Blog Pages', 'manage_options', 'yydev-show-custom-blog-pages', 'yydev_show_all_pages_basic_theme_custom_blog');  
        } // if( function_exists('yydev_theme_languages') ) {

    }, 9999);

} else { // if( intval(get_option('yydev_show_all_pages_url_main_menu')) == 1 ) {

    // in case of main menu loading
    function yydev_show_all_pages_url_output_main() {

        $wordpress_icon_path = plugins_url( 'images/favicon.png', __FILE__ );
        
        // add the main menu into the page
        add_menu_page( 'Show All Pages URL', 'Show All Pages', 'manage_options', 'yydev-show-pages', 'yydev_show_all_pages_url_output',  $wordpress_icon_path, 10);

        // add submenu for pages with custom post type
        add_submenu_page('yydev-show-pages', 'Custom Pages Type', 'Custom Pages Type', 'manage_options', 'yydev-custom-pages-type', 'yydev_show_custom_pages_url_output');

        // add the custom blog menu for YYDevelopment-basic theme 
        if( function_exists('yydev_theme_languages') ) {
            add_submenu_page('yydev-show-pages', 'Custom Blog Pages', 'Custom Blog Pages', 'manage_options', 'yydev-show-custom-blog-pages', 'yydev_show_all_pages_basic_theme_custom_blog');
        } // if( function_exists('yydev_theme_languages') ) {

    } // function yydev_show_all_pages_url_output_main() {

    add_action('admin_menu', 'yydev_show_all_pages_url_output_main');

} // } else { // if( intval(get_option('yydev_show_all_pages_url_main_menu')) == 1 ) {

// ================================================
// Add settings page to the plugin menu info
// ================================================

function yydev_show_all_pages_url_add_settings_link( $actions, $plugin_file ) {

	static $plugin;

    if (!isset($plugin)) { $plugin = plugin_basename(__FILE__); }
	if ($plugin == $plugin_file) {
            $admin_page_url = esc_url( menu_page_url( 'yydev-show-pages', false ) );
			$settings = array('settings' => '<a href="' . $admin_page_url . '">Settings</a>');
            $actions = array_merge($settings, $actions);
    } // if ($plugin == $plugin_file) {
    return $actions;

} //function yydev_show_all_pages_url_add_settings_link( $actions, $plugin_file ) {

add_filter( 'plugin_action_links', 'yydev_show_all_pages_url_add_settings_link', 10, 5 );

// ================================================
// Add donate page to the plugin menu info
// ================================================

add_filter( 'plugin_action_links', function($actions, $plugin_file) {

	static $plugin;

    if (!isset($plugin)) { $plugin = plugin_basename(__FILE__); }
    
	if ($plugin == $plugin_file) {

            $admin_page_url = esc_url( menu_page_url( 'show-all-pages-url', false ) );
            $donate = array('donate' => '<a target="_blank" href="https://www.yydevelopment.com/coffee-break/?plugin=show-all-pages-url">Donate</a>');
		
            $actions = array_merge($donate, $actions);
        
    } // if ($plugin == $plugin_file) {
		
    return $actions;

}, 10, 5 );

// ================================================
// including admin notices flie
// ================================================

if( is_admin() ) {
	include_once('notices.php');
} // if( is_admin() ) {
