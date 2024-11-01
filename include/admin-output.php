<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php

// --------------------------------------------------------
// global page settings
// --------------------------------------------------------

$yy_search_term = '';
$yy_search_by = '';
$post_parent_id = '';
$pages_array = 0; // array with seleced pages id
$dont_output_custom_blog_int = 0;

// --------------------------------------------------------
// including the code the output the pages
// --------------------------------------------------------

include('structure-output.php');

?>