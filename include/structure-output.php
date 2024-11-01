<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php

// -----------------------------------------------
// incase of a childrens search on the site
// -----------------------------------------------

if( isset($_POST['yydev_show_all_childrens_nonce_search']) ) {

    if( wp_verify_nonce($_POST['yydev_show_all_childrens_nonce_search'], 'yydev_show_all_childrens_action_search') ) {

        if( isset($_POST['childrens_search_term']) && !empty(intval($_POST['childrens_search_term']))  ) {
            $post_parent_id = intval($_POST['childrens_search_term']);
        } // if( isset($_POST['pages_search_term']) && !empty(isset($_POST['pages_search_term']))  ) {

    } else { // if( wp_verify_nonce($_POST['yydev_show_all_childrens_nonce_search'], 'yydev_show_all_childrens_action_search') ) {
        $submit_name_error = "Form nonce was incorrect";
    } // } else { // if( wp_verify_nonce($_POST['yydev_show_all_childrens_nonce_search'], 'yydev_show_all_childrens_action_search') ) {

} // if( isset($_POST['yydev_show_all_childrens_nonce_search']) ) {

// -----------------------------------------------
// incase of a serch on the site
// -----------------------------------------------

if( isset($_POST['yydev_show_all_pages_nonce_search']) ) {

    if( wp_verify_nonce($_POST['yydev_show_all_pages_nonce_search'], 'yydev_show_all_pages_action_search') ) {

        if( isset($_POST['pages_search_term']) && !empty($_POST['pages_search_term'])  ) {

            $yy_search_term = trim( strtolower($_POST['pages_search_term']) );
            $yy_search_by = trim( strtolower($_POST['pages_search_by']) );
            $active_search = 1;
            
        } // if( isset($_POST['pages_search_term']) && !empty(isset($_POST['pages_search_term']))  ) {

    } else { // if( wp_verify_nonce($_POST['yydev_show_all_pages_nonce_search'], 'yydev_show_all_pages_action_search') ) {
        $submit_name_error = "Form nonce was incorrect";
    } // } else { // if( wp_verify_nonce($_POST['yydev_show_all_pages_nonce_search'], 'yydev_show_all_pages_action_search') ) {

} // if( isset($_POST['yydev_show_all_pages_nonce_search']) ) {

// -----------------------------------------------
// update menu option
// -----------------------------------------------

if( isset($_POST['yydev_nonce_update_menu_option']) ) {

    if( wp_verify_nonce($_POST['yydev_nonce_update_menu_option'], 'yydev_action_update_menu_option') ) {

        $add_plugin_to_menu = 0;
        if( isset($_POST['add_plugin_to_menu']) ) {
            $add_plugin_to_menu = intval( $_POST['add_plugin_to_menu'] );
        } // if( isset($_POST['add_plugin_to_menu']) ) {

        update_option('yydev_show_all_pages_url_main_menu', $add_plugin_to_menu);

    } else { // if( wp_verify_nonce($_POST['yydev_nonce_update_menu_option'], 'yydev_action_update_menu_option') ) {
        $submit_name_error = "Form nonce was incorrect";
    } // } else { // if( wp_verify_nonce($_POST['yydev_nonce_update_menu_option'], 'yydev_action_update_menu_option') ) {

} // if( isset($_POST['yydev_nonce_update_menu_option']) ) {


// -----------------------------------------------
// output category table
// $cat_args = the database query to output the category
// $div_id = the id of the category
// $output_title = display the title above table
// $dont_output_custom_blog = define if to work on custom blog or not
// $serach_replace_url = search and replace the edit url to work well with yoast seo
// -----------------------------------------------


function yydev_show_all_categories_url_table($cat_args, $div_id, $output_category_title, $dont_output_custom_blog, $serach_replace_url = '') {

    if( $dont_output_custom_blog == 0 ) {

        $out_category_content = [];

        $categories = get_categories($cat_args);
        $categories_count = count($categories);

        if( $categories_count > 0 ) {

            $category_content .= "<div class='yy-table-section' id='" . $div_id . "'>";

                $pages_output = "page"; $is_or_are = "is";
                if( $categories_count > 1 ) { $pages_output = "pages"; $is_or_are = "are"; }

                $category_content .= "<h2>There " . $is_or_are . " " . $categories_count . " " . $output_category_title . " " . $pages_output . "</h2>";
                $category_content .= "<table>";
                
                    $category_content .= "<tr>";
                        $category_content .= "<th>#</th>";
                        $category_content .= "<th>Category ID</th>";
                        $category_content .= "<th>Title</th>";
                        $category_content .= "<th>Page URL</th>";
                        $category_content .= "<th>Edit Page</th>";
                    $category_content .= "</tr>";
                
                    $page_count = 1;

                    // changing the normal url as it doesn't work with yoast seo url
                    // the category page on wordpress return different url and we adjust it
                    if( !empty($serach_replace_url) ) {
                        $serach_replace_url_new = explode(',', $serach_replace_url);
                    } // if( !empty($serach_replace_url) ) {

                    foreach($categories as $category) { 

                        $category_url = esc_url( urldecode( get_category_link( $category->term_id ) ) );
                        $edit_category_url = get_edit_term_link($category->term_id);

                        if( !empty($serach_replace_url_new) ) {
                            $edit_category_url = str_replace($serach_replace_url_new[0], $serach_replace_url_new[1], $edit_category_url);
                        } // if( !empty($serach_replace_url_new) ) {

                        $category_content .= "<tr>";
                            $category_content .= "<td>" .$page_count . "</td>";
                            $category_content .= "<td><a target='_blank' href='". $category_url . "'>" . $category->term_id . "</a></td>";
                            $category_content .= "<td><a target='_blank' href='". $category_url . "'>" . $category->name . "</a></td>";
                            $category_content .= "<td><a class='yy-page-url' target='_blank' href='". $category_url . "'>" . $category_url . "</a></td>";
                            $category_content .= "<td class='edit-page'><a target='_blank' href='". $edit_category_url . "'>Edit Page</a></td>";

                        $category_content .= "</tr>";
                        $page_count++;
                        
                    } // foreach($categories as $category) { 

                $category_content .= "</table>";

            $category_content .= "</div>";

        } // if( $dont_output_custom_blog == 0 ) {

    } // if( $categories_count > 0 ) 

    $out_category_content['content'] = $category_content;
    $out_category_content['count'] = $categories_count;

    return $out_category_content;

} // function yydev_show_all_categories_url_table($cat_args, $div_id, $output_category_title, $dont_output_custom_blog) {

// -----------------------------------------------
// output pages as table
// -----------------------------------------------

function yydev_show_all_pages_url_table($query, $yy_search_term, $yy_search_by) {

    $pages_table = "";
    $pages_table .= "<table>";
                $pages_table .= "<thead class='fixed-thead'>";
                    $pages_table .= "<tr>";
                        $pages_table .= "<th style='width:30px;'>#</th>";
                        $pages_table .= "<th style='width:80px;'>Publish Date</th>";
                        $pages_table .= "<th style='width:50px;'>Page ID</th>";
                        $pages_table .= "<th style='width:200px;'>Title</th>";
                        $pages_table .= "<th style='width:500px;'>Page URL</th>";

                        // check if the notes exists on the page
                        if( function_exists('yoast_breadcrumb') ) {
                            $pages_table .= "<th style='width:70px;'>Yoast SEO</th>";
                        } // if( function_exists('yoast_breadcrumb') ) {

                        // check if the notes exists on the page
                        if( function_exists('yydev_output_wordpress_seo_plugin') ) {
                            $pages_table .= "<th style='width:30px;'>Keywords Notes</th>";
                        } // if( function_exists('yydev_output_wordpress_seo_plugin') ) {

                        // check if the notes exists on the page
                        if( function_exists('yydev_notes_output_plugin') ) {
                            $pages_table .= "<th style='width:30px;'>Page Notes</th>";
                        } // if( function_exists('yydev_notes_output_plugin') ) {

                        $pages_table .= "<th>Edit Page</th>";

                        // check if the site id build with elementor
                        if( function_exists('elementor_fail_php_version') ) {
                            $pages_table .= "<th>Elementor Edit</th>";
                        } // if( function_exists('elementor_fail_php_version') ) {

                    $pages_table .= "</tr>";
                $pages_table .= "</thead'>";
    
        $pages_count = 1;
    	while( $query->have_posts() ) { 

    		$query->the_post();

            $page_count = $pages_count;
            $page_date = get_the_date("d-m-Y");
            $page_url = esc_url( urldecode( get_the_permalink() ) );
            $page_title = esc_html( get_the_title() );
            $page_id = esc_html( get_the_ID() );
            $page_content = get_the_content();
            $edit_page = esc_url( get_edit_post_link() );

            $plugin_folder_path = plugins_url( '', dirname(__FILE__) ) . "/";

            // -----------------------------------------------
            // incase of a search
            // -----------------------------------------------

            if( !empty($yy_search_term) ) {

                // title search
                if($yy_search_by === 'title') {
                    if( !strstr( strtolower($page_title), $yy_search_term) ) {
                        continue;
                    } // if( !strstr( strtolower($page_title), $yy_search_term) ) {
                } // if($yy_search_by === 'title') {

                // content search
                if($yy_search_by === 'content') {
                    if( !strstr( strtolower($page_content), $yy_search_term) ) {
                        continue;
                    } // if( !strstr( strtolower($page_content), $yy_search_term) ) {
                } // if($yy_search_by === 'content') {

            } // if( !empty($yy_search_term) ) {

            $elementor_button = "<td class='edit-page'>-</td>";
            if( !empty( get_post_meta( get_the_ID(), '_elementor_edit_mode', true ) ) ) {
                $elementor_edit = esc_url( str_replace("action=edit", "action=elementor", $edit_page ) );
                $elementor_button = "<td class='edit-page'><a target='_blank' href='". $elementor_edit . "'>Elementor Edit</a></td>";
            }  // if( !empty( get_post_meta( get_the_ID(), '_elementor_edit_mode', true ) ) ) {

                $pages_table .= "<tr>";
                    $pages_table .= "<td>" .$page_count . "</td>"; // pages count
                    $pages_table .= "<td><a target='_blank' href='". $page_url . "'>" . $page_date . "</a></td>"; // created date
                    $pages_table .= "<td>" . $page_id . "</td>"; // page id
                    $pages_table .= "<td><a target='_blank' href='". $page_url . "'>" . $page_title . "</a></td>"; // page title
                    $pages_table .= "<td><a class='yy-page-url' target='_blank' href='". $page_url . "'>" . $page_url . "</a></td>"; // page url

                    // =================================================================================
                    // check if yoast seo exists on the page
                    // =================================================================================

                    if ( function_exists('yoast_breadcrumb') ) {

                        $yoast_title = get_post_meta($page_id, '_yoast_wpseo_title', true);
                        $yoast_description = get_post_meta($page_id, '_yoast_wpseo_metadesc', true);
                        $yoast_description = get_post_meta($page_id, '_yoast_wpseo_metadesc', true);

                        $yoast_noindex = get_post_meta($page_id, '_yoast_wpseo_meta-robots-noindex', true);
                        $yoast_nofollow = get_post_meta($page_id, '_yoast_wpseo_meta-robots-nofollow', true);


                        $title_exist = "<span class='yy-not-exists'>X</span>";
                        if( !empty($yoast_title) ) { 
                            $title_exist = "<span class='yy-exists'>&#10004;</span>";
                        } // if( !empty($yoast_title) ) { 

                        $description_exist = "<span class='yy-not-exists'>X</span>";
                        if( !empty($yoast_description) ) { 
                            $description_exist = "<span class='yy-exists'>&#10004;</span>";
                        } // if( !empty($yoast_description) ) { 

                        $pages_table .= "<td class='yoast-seo-td'>";

                            $pages_table .= "<div class='yy-marks-warp'>";
                                $pages_table .= "<p>T: {$title_exist}</p>";
                                $pages_table .= "<p>D: {$description_exist}</p>";

                            $pages_table .= "</div><!--yy-marks-warp-->";

                            if( !empty($yoast_description) || !empty($yoast_title) ) {

                                $yoast_data_output = '';

                                if( !empty($yoast_title) ) { 
                                        $yoast_data_output .= "<b>Title:</b><br />";
                                        $yoast_data_output .= $yoast_title . "<br /><br />";
                                } // if( !empty($yoast_title) ) { 

                                if( !empty($yoast_description) ) { 
                                    $yoast_data_output .= "<b>Description:</b><br />";
                                    $yoast_data_output .= $yoast_description . "";
                                } // if( !empty($yoast_description) ) { 

                                $pages_table .= "<div class='yy-data-warp'>";
                                    $pages_table .= "<img class='yy-view-data' src='" . $plugin_folder_path . "images/eye-icon.png" . "' alt='View Date' />";
                                    $pages_table .= "<div class='yy-data-window'>" . $yoast_data_output . "<span class='yy-data-close'>X</span></div>";
                                $pages_table .= "</div><!--yy-data-warp-->";

                                $pages_table .= $yoast_noindex;

                            } // if( !empty($yoast_description) || !empty($yoast_title) ) {

                            // checking if the pages are not indexed
                            if( ($yoast_noindex == 1) || ($yoast_nofollow == 1) ) {

                                $pages_table .= "<p class='yoast-noindex'>";
                                    if( $yoast_noindex == 1 ) {$pages_table .= " noindex ";}
                                    if( $yoast_nofollow == 1 ) {$pages_table .= " nofollow ";}
                                $pages_table .= "</p>";

                            } // if( ($yoast_noindex == 1) || ($yoast_nofollow == 1) ) {

                        $pages_table .= "</td>";

                    } // if ( function_exists('yoast_breadcrumb') ) {

                    // =================================================================================
                    // check if the yydevelopment keywords notes exists on the page
                    // =================================================================================

                    if( function_exists('yydev_output_wordpress_seo_plugin') ) {

                        global $wpdb;
                        $notes_data_base_name = $wpdb->prefix . 'yydevelopment_seo_data';
                        $check_for_page_notes = $wpdb->get_row("SELECT table_notes FROM " . $notes_data_base_name . " WHERE page_post_id = " . $page_id);
                        $check_for_page_notes_count = $wpdb->num_rows;

                        if( ($check_for_page_notes_count > 0) && !empty($check_for_page_notes->table_notes) ) {

                            $pages_table .= "<td><span class='yy-exists'>&#10004;</span>";

                                $pages_table .= "<div class='yy-data-warp seo-keywords'>";
                                    $pages_table .= "<img class='yy-view-data' src='" . $plugin_folder_path . "images/eye-icon.png" . "' alt='View Date' />";
                                    $pages_table .= "<div class='yy-data-window'>" . nl2br($check_for_page_notes->table_notes) . "<span class='yy-data-close'>X</span></div>";
                                $pages_table .= "</div><!--yy-data-warp-->";

                            $pages_table .= "</td>";

                        } else { // if( ($check_for_page_notes > 0) && !empty($check_for_page_notes->table_notes) ) {

                            $pages_table .= "<td><span class='yy-not-exists'>X</span>";
                            $pages_table .= "</td>";

                        } // } else { // if( ($check_for_page_notes > 0) && !empty($check_for_page_notes->table_notes) ) {

                    } // if( function_exists('yydev_output_wordpress_seo_plugin') ) {

                    // =================================================================================
                    // check if the notes exists on the page
                    // =================================================================================

                    if( function_exists('yydev_notes_output_plugin') ) {

                        global $wpdb;
                        $notes_data_base_name = $wpdb->prefix . 'yydev_notes';
                        $check_for_page_notes = $wpdb->get_row("SELECT * FROM " . $notes_data_base_name . " WHERE page_post_id = " . $page_id);
                        $check_for_page_notes_count = $wpdb->num_rows;

                        if($check_for_page_notes_count > 0) {

                            // ------------------------------------------
                            // getting the noews data from the database
                            // ------------------------------------------

                            if( strstr($check_for_page_notes->notes, '###') ) {
                                $yydevl_notes_data_output = explode('###', $check_for_page_notes->notes);       
                            } else { // if( strstr($check_for_page_notes->notes, '###') ) {
                                $yydevl_notes_data_output = array($check_for_page_notes->notes);
                            } // } else { // if( strstr($check_for_page_notes->notes, '###') ) { 

                            $notes_message = '';
                            $count = 1;
                            foreach($yydevl_notes_data_output as $yydevl_notes_data_array) {

                                $yydevl_notes_data = explode("^^", $yydevl_notes_data_array);
                                $notes_message_output = $yydevl_notes_data[0];

                                $notes_message .= htmlspecialchars($notes_message_output, ENT_QUOTES);
                                if( (count($yydevl_notes_data_output) > 1) && ($count != count($yydevl_notes_data_output)) ) {
                                        $notes_message .= "<br /><br /><br />";
                                } // if( count($yydevl_notes_data_output) > 1 ) {

                            $count++;
                            } // foreach($yydevl_notes_data_output as $yydevl_notes_data_array) {

                            $pages_table .= "<td><span class='yy-exists'>&#10004;</span>";

                                $pages_table .= "<div class='yy-data-warp page-notes'>";
                                    $pages_table .= "<img class='yy-view-data' src='" . $plugin_folder_path . "images/eye-icon.png" . "' alt='View Date' />";
                                    $pages_table .= "<div class='yy-data-window'>" . nl2br($notes_message) . "<span class='yy-data-close'>X</span></div>";
                                $pages_table .= "</div><!--yy-data-warp-->";

                            $pages_table .= "</td>";

                        } else { // if($check_for_page_notes > 0) {

                            $pages_table .= "<td><span class='yy-not-exists'>X</span>";
                            $pages_table .= "</td>";

                        } // } else { // if($check_for_page_notes > 0) {

                    } // if( function_exists('yydev_notes_output_plugin') ) {

                    // =================================================================================
                    // output edit buttons
                    // =================================================================================

                    $pages_table .= "<td class='edit-page'><a target='_blank' href='". $edit_page . "'>Edit Page</a></td>"; // edit page button

                    // elementor edit page button
                    if( function_exists('elementor_fail_php_version') ) {
                        $pages_table .= $elementor_button;
                    } // if( function_exists('elementor_fail_php_version') ) {

                $pages_table .= "</tr>";

            $pages_count++;
    	} // while( have_posts() ) { 

    $pages_table .= "</table>";

    $return_output['count'] = $pages_count - 1;
    $return_output['results'] = $pages_table;

    // return the data back
    return $return_output;

} // function yydev_show_all_pages_url_table() {


?>


<div class="wrap yydev-show-all-url <?php if( is_rtl() ) { echo "yydev-show-all-url-rtl"; } ?>">

    <h1 class="display-inline">Show All Pages URL</h1>
    <p class="main-plugin-description">Below you will be able to see the pages URL on your site</p>



    <br />

    <form class="insert-form" method="POST" action="">
        <label for="pages_search_term">Search Posts/Pages <small>(not working on categories and tags)</small>:</label>
        <input type="text" id="pages_search_term" class="pages_search_term input-long direction-ltr" name="pages_search_term" placeholder="Search Term" value="" />
        
        <label for="pages_search_by">Search Pages:</label>
        <select id="pages_search_by" name="pages_search_by">
            <option value='title'>Title</option>
            <option value='content'>Content</option>
        </select>

        <?php
            // creating nonce to make sure the form was submitted correctly from the right page
            wp_nonce_field( 'yydev_show_all_pages_action_search', 'yydev_show_all_pages_nonce_search' ); 
        ?>

        <input type="submit" name="submit_new_form" value="Search" />
    </form>


    <form class="insert-form" method="POST" action="" style="margin-top: 10px;">
        <label for="childrens_search_by">Search For All Page Childrens Using Page ID:</label>
        <input type="text" id="childrens_search_term" class="childrens_search_term input-long direction-ltr" name="childrens_search_term" placeholder="Parent Page ID" value="" />

        <?php
            // creating nonce to make sure the form was submitted correctly from the right page
            wp_nonce_field( 'yydev_show_all_childrens_action_search', 'yydev_show_all_childrens_nonce_search' ); 
        ?>

        <input type="submit" name="submit_new_form" value="Children's Search" />
    </form>

     <br />

    <?php

        $query_output = "";
        $pages_count = 0;
        $posts_count = 0;

        // -----------------------------------------------
        // output all published pages
        // -----------------------------------------------

        $pages_query = new WP_Query( array('post_type' => 'page', 'posts_per_page' => '-1', 'post_status' => 'publish', 'order' => 'desc', 'post_parent' => $post_parent_id, 'post__in' => $pages_array ) );
        $pages_results = yydev_show_all_pages_url_table($pages_query, $yy_search_term, $yy_search_by);
        $count = $pages_results['count'];
        $full_count = $count;
        $pages_count = $count + $pages_count;

        $published_pages_count = $count;

        if( $count > 0 ) {
            $query_output .= "<div class='yy-table-section' id='published_pages_count'>";

                $pages_output = "page"; $is_or_are = "is";
                if( $count > 1 ) { $pages_output = "pages"; $is_or_are = "are"; }
                $query_output .= "<h2>There " . $is_or_are . " " . $count . " published " . $pages_output . "</h2>";

                $query_output .= $pages_results['results'];
            $query_output .= "</div>"; 
        } // if( $count > 0 ) {

        // -----------------------------------------------
        // output all private pages
        // -----------------------------------------------

        $pages_query = new WP_Query( array('post_type' => 'page', 'posts_per_page' => '-1', 'post_status' => 'private', 'order' => 'desc', 'post_parent' => $post_parent_id, 'post__in' => $pages_array  ) );
        $pages_results = yydev_show_all_pages_url_table($pages_query, $yy_search_term, $yy_search_by);
        $count = $pages_results['count'];
        $full_count = $count + $full_count;
        $pages_count = $count + $pages_count;

        $private_pages_count = $count;

        if( $count > 0 ) {
            $query_output .= "<div class='yy-table-section' id='private_pages_count'>";

                $pages_output = "page"; $is_or_are = "is";
                if( $count > 1 ) { $pages_output = "pages"; $is_or_are = "are"; }
                $query_output .= "<h2>There " . $is_or_are . " " . $count . " private " . $pages_output . "</h2>";

                $query_output .= $pages_results['results'];
            $query_output .= "</div>"; 
        } // if( $count > 0 ) {

        // -----------------------------------------------
        // output all scheduled pages
        // -----------------------------------------------

        $pages_query = new WP_Query( array('post_type' => 'page', 'posts_per_page' => '-1', 'post_status' => 'future', 'order' => 'desc', 'post_parent' => $post_parent_id, 'post__in' => $pages_array  ) );
        $pages_results = yydev_show_all_pages_url_table($pages_query, $yy_search_term, $yy_search_by);
        $count = $pages_results['count'];
        $full_count = $count + $full_count;
        $pages_count = $count + $pages_count;

        $scheduled_pages_count = $count;

        if( $count > 0 ) {
            $query_output .= "<div class='yy-table-section' id='scheduled_pages_count'>";

                $pages_output = "page"; $is_or_are = "is";
                if( $count > 1 ) { $pages_output = "pages"; $is_or_are = "are"; }
                $query_output .= "<h2>There " . $is_or_are . " " . $count . " scheduled " . $pages_output . "</h2>";
                
                $query_output .= $pages_results['results'];
            $query_output .= "</div>"; 
        } // if( $count > 0 ) {

        // -----------------------------------------------
        // output all published posts
        // -----------------------------------------------

        $pages_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => '-1', 'post_status' => 'publish', 'order' => 'desc', 'post_parent' => $post_parent_id, 'post__in' => $pages_array  ) );
        $pages_results = yydev_show_all_pages_url_table($pages_query, $yy_search_term, $yy_search_by);
        $count = $pages_results['count'];
        $full_count = $count + $full_count;
        $posts_count = $count + $posts_count;

        $published_posts_count = $count;

        if( $count > 0 ) {            
            $query_output .= "<div class='yy-table-section' id='published_posts_count'>";

                $pages_output = "post"; $is_or_are = "is";
                if( $count > 1 ) { $pages_output = "posts"; $is_or_are = "are"; }
                $query_output .= "<h2>There " . $is_or_are . " " . $count . " published " . $pages_output . "</h2>";

                $query_output .= $pages_results['results'];
            $query_output .= "</div>"; 
        } // if( $count > 0 ) {

        // -----------------------------------------------
        // output all private posts
        // -----------------------------------------------

        $pages_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => '-1', 'post_status' => 'private', 'order' => 'desc', 'post_parent' => $post_parent_id, 'post__in' => $pages_array  ) );
        $pages_results = yydev_show_all_pages_url_table($pages_query, $yy_search_term, $yy_search_by);
        $count = $pages_results['count'];
        $full_count = $count + $full_count;
        $posts_count = $count + $posts_count;

        $private_posts_count = $count;

        if( $count > 0 ) {
            $query_output .= "<div class='yy-table-section' id='private_posts_count'>";

                $pages_output = "post"; $is_or_are = "is";
                if( $count > 1 ) { $pages_output = "posts"; $is_or_are = "are"; }
                $query_output .= "<h2>There " . $is_or_are . " " . $count . " private " . $pages_output . "</h2>";

                $query_output .= $pages_results['results'];
            $query_output .= "</div>"; 
        } // if( $count > 0 ) {

        // -----------------------------------------------
        // output all scheduled posts
        // -----------------------------------------------

        $pages_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => '-1', 'post_status' => 'future', 'order' => 'desc', 'post_parent' => $post_parent_id, 'post__in' => $pages_array  ) );
        $pages_results = yydev_show_all_pages_url_table($pages_query, $yy_search_term, $yy_search_by);
        $count = $pages_results['count'];
        $full_count = $count + $full_count;
        $posts_count = $count + $posts_count;

        $scheduled_posts_count = $count;

        if( $count > 0 ) {
            $query_output .= "<div class='yy-table-section' id='scheduled_posts_count'>";

                $pages_output = "post"; $is_or_are = "is";
                if( $count > 1 ) { $pages_output = "posts"; $is_or_are = "are"; }
                $query_output .= "<h2>There " . $is_or_are . " " . $count . " scheduled " . $pages_output . "</h2>";

                $query_output .= $pages_results['results'];
            $query_output .= "</div>"; 
        } // if( $count > 0 ) {

        // -----------------------------------------------
        // output all category pages
        // -----------------------------------------------

        // don't output category on search        
        $categories_count = 0;
        if( !isset($_POST['pages_search_term']) ) {

            $cat_args = array('order' => 'desc', 'parent'  => 0, 'hide_empty' => 0);
            $categories = yydev_show_all_categories_url_table($cat_args, 'categories_count', 'category', $dont_output_custom_blog_int, 'taxonomy&tag_ID,taxonomy=category&tag_ID');
            $categories_count = $categories['count'];
            $full_count = $categories_count + $full_count;

            $query_output .= $categories['content'];

        } // if( isset($_POST['pages_search_term']) ) {

        // -----------------------------------------------
        // output all tag pages
        // -----------------------------------------------

        // don't output category on search        
        $tags_count = 0;
        if( !isset($_POST['pages_search_term']) ) {

            $cat_args = array('order' => 'desc', 'parent'  => 0, 'hide_empty' => 0, 'taxonomy' => 'post_tag');
            $categories = yydev_show_all_categories_url_table($cat_args, 'tags_count', 'tag', $dont_output_custom_blog_int, 'taxonomy&tag_ID,taxonomy=post_tag&tag_ID');
            $tags_count = $categories['count'];
            $full_count = $tags_count + $full_count;

            $query_output .= $categories['content'];

        } // if( isset($_POST['pages_search_term']) ) {


        // ============================================================================================
        // woocommerce pages output 
        // ============================================================================================

        if( class_exists('woocommerce') ) {

            // -----------------------------------------------
            // output all product
            // -----------------------------------------------

            $woocommerce_product_query = new WP_Query( array('post_type' => 'product', 'posts_per_page' => '-1', 'post_status' => 'any', 'order' => 'desc', 'post_parent' => $post_parent_id, 'post__in' => $pages_array  ) );
            $pages_results = yydev_show_all_pages_url_table($woocommerce_product_query, $yy_search_term, $yy_search_by);
            $count = $pages_results['count'];
            $full_count = $count + $full_count;

            $woocommerce_products_count = $count;

            if( $count > 0 ) {            
                $query_output .= "<div class='yy-table-section' id='woocommerce_products_count'>";

                    $pages_output = "product"; $is_or_are = "is";
                    if( $count > 1 ) { $pages_output = "products"; $is_or_are = "are"; }
                    $query_output .= "<h2>There " . $is_or_are . " " . $count . " woocommerce " . $pages_output . "</h2>";

                    $query_output .= $pages_results['results'];
                $query_output .= "</div>"; 
            } // if( $count > 0 ) {

            // -----------------------------------------------
            // output all category pages
            // -----------------------------------------------

            // don't output category on search        
            $woocommerce_categories_count = 0;
            if( !isset($_POST['pages_search_term']) ) {

                $cat_args = array('order' => 'desc', 'parent'  => 0, 'hide_empty' => 0, 'taxonomy' => 'product_cat');
                $categories = yydev_show_all_categories_url_table($cat_args, 'woocommerce_categories_count', 'woocommerce category', $dont_output_custom_blog_int, 'taxonomy&tag_ID,taxonomy=product_cat&tag_ID');
                $woocommerce_categories_count = $categories['count'];
                $full_count = $woocommerce_categories_count + $full_count;

                $query_output .= $categories['content'];

            } // if( isset($_POST['pages_search_term']) ) {

            // -----------------------------------------------
            // output all category pages
            // -----------------------------------------------

            // don't output category on search        
            $woocommerce_tags_count = 0;
            if( !isset($_POST['pages_search_term']) ) {

                $cat_args = array('order' => 'desc', 'parent'  => 0, 'hide_empty' => 0, 'taxonomy' => 'product_tag');
                $categories = yydev_show_all_categories_url_table($cat_args, 'woocommerce_tags_count', 'woocommerce tag', $dont_output_custom_blog_int, 'taxonomy&tag_ID,taxonomy=product_tag&tag_ID');
                $woocommerce_tags_count = $categories['count'];
                $full_count = $woocommerce_tags_count + $full_count;

                $query_output .= $categories['content'];

            } // if( isset($_POST['pages_search_term']) ) {

        } // if( class_exists('woocommerce') ) {

        // -----------------------------------------------
        // echo the code to the page
        // -----------------------------------------------

        $search_output = "";
        if( isset($active_search) ) {
            $search_output = " for the search";
        } // if( isset($active_search) ) {

        echo "<div class='yy-darker-h2'>";

            echo "<h2>Total pages on site: <b>" . $full_count . " Pages</b></h2>";

            echo "<small><b>Wordpress:</b> " . $pages_count . " Pages + " . $posts_count . "  Posts + " . $categories_count . "  Categories + " . $tags_count . "  Tags" . $search_output . "</small>";

            if( class_exists('woocommerce') ) {
                echo "<small><b>Woocommerce: </b>" . $woocommerce_products_count . " Products + " . $woocommerce_categories_count . " Categories + " . $woocommerce_tags_count . " Tags" . $search_output . "</small>";
            } // if( class_exists('woocommerce') ) {

        echo "</div>";
        echo $query_output;

        // -----------------------------------------------
        // creating floating menu
        // -----------------------------------------------

        $menu_output = '';

        $menu_output .= "<div class='yy-float-menu-output'>";

            if($published_pages_count > 0) {
                $menu_output .= "<a href='#published_pages_count'>" . $published_pages_count . " Published Pages</a>";
            } // if($published_pages_count > 0) {

            if($private_pages_count > 0) {
                $menu_output .= "<a href='#private_pages_count'>" . $private_pages_count . " Private Pages</a>";
            } // if($private_pages_count > 0) {

            if($scheduled_pages_count > 0) {
                $menu_output .= "<a href='#scheduled_pages_count'>" . $scheduled_pages_count . " Scheduled Pages</a>";
            } // if($scheduled_pages_count > 0) {

            if($published_posts_count > 0) {
                $menu_output .= "<a href='#published_posts_count'>" . $published_posts_count . " Published Posts</a>";
            } // if($published_posts_count > 0) {

            if($private_posts_count > 0) {
                $menu_output .= "<a href='#private_posts_count'>" . $private_posts_count . " Private Posts</a>";
            } // if($private_posts_count > 0) {

            if($scheduled_posts_count > 0) {
                $menu_output .= "<a href='#scheduled_posts_count'>" . $scheduled_posts_count . " Scheduled Posts</a>";
            } // if($scheduled_posts_count > 0) {

            if($categories_count > 0) {
                $menu_output .= "<a href='#categories_count'>" . $categories_count . " Categories</a>";
            } // if($categories_count > 0) {

            if($tags_count > 0) {
                $menu_output .= "<a href='#tags_count'>" . $tags_count . " Tags</a>";
            } // if($tags_count > 0) {


            // woocommerce output
            if( class_exists('woocommerce') ) {

                if($woocommerce_products_count > 0) {
                    $menu_output .= "<a href='#woocommerce_products_count'>" . $woocommerce_products_count . " Products</a>";
                } // if($published_pages_count > 0) {

                if($woocommerce_categories_count > 0) {
                    $menu_output .= "<a href='#woocommerce_categories_count'>" . $woocommerce_categories_count . " Woocommerce Categories</a>";
                } // if($categories_count > 0) {

                if($woocommerce_tags_count > 0) {
                    $menu_output .= "<a href='#woocommerce_tags_count'>" . $woocommerce_tags_count . " Woocommerce Tags</a>";
                } // if($woocommerce_tags_count > 0) {

            } // if( class_exists('woocommerce') ) {

        $menu_output .= "</div><!--yy-float-menu-output-->";

        // echo menu to the page
        echo $menu_output;

    ?>


    <br />

    <form class="insert-form yy_change_menu_loader" method="POST" action="" style="margin-top: 10px;">

        <input type="checkbox" name="add_plugin_to_menu" class="change-menu-name" id="add_plugin_to_menu" value='1' <?php if( intval( get_option('yydev_show_all_pages_url_main_menu') ) == 1) { echo 'checked'; } ?>/> 
        <label for="add_plugin_to_menu">Check this box if you want the plugin to show up under the tools menu instead of the main menu:</label>
        
        <?php
            // creating nonce to make sure the form was submitted correctly from the right page
            wp_nonce_field( 'yydev_action_update_menu_option', 'yydev_nonce_update_menu_option' ); 
        ?>

    </form>

    <br />

    <span id="footer-thankyou-code">This plugin was created by <a target="_blank" href="https://www.yydevelopment.com">YYDevelopment</a>. 
    If you liked it please give it a <a target="_blank" href="https://wordpress.org/plugins/show-all-pages-url/#reviews">5 stars review</a>. 
    If you want to help support this FREE plugin <a target="_blank" href="https://www.yydevelopment.com/coffee-break/?plugin=show-all-pages-url">buy us a coffee</a>.</span>
    </span>

</div><!--wrap-->

