<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php

$yy_search_term = '';
$yy_search_by = '';
$post_parent_id = '';
$pages_array = 0; // array with seleced pages id
$dont_output_custom_blog_int = 1;

// --------------------------------------------------------
// get the custom blog pages id
// $yydev_theme_db_name - the yydevelopment page id
// --------------------------------------------------------

global $wpdb;
global $yydev_theme_db_name;
$get_pages_ids = $wpdb->get_results( "SELECT page_id FROM $yydev_theme_db_name WHERE page_display = 'blog_page'" );

$pages_array = array(0);;
foreach($get_pages_ids as $page_id) {
	if( intval($page_id->page_id) > 0 ) {
		$pages_array[] = $page_id->page_id;
	} // if( intval($page_id->page_id) > 0 ) {

} // foreach($get_pages_ids as $page_id) {

// --------------------------------------------------------
// including the code the output the pages
// --------------------------------------------------------

include('structure-output.php');

?>