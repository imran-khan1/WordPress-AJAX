<?php
/*
Plugin Name: Ajax Form
Plugin URI: http://www.imran1.com
Description: AJAX WordPress Form Plugin
Version: 1.0
Author: Imran Khan
Author URI: http://www.imran1.com
License: Plugin comes under GPL Licence.
*/
//Include Javascript library
wp_enqueue_script('imran1', plugins_url( '/js/demo.js' , __FILE__ ) , array( 'jquery' ));
// including ajax script in the plugin Myajax.ajaxurl
wp_localize_script( 'imran1', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php')));

function post_word_count(){
$name = $_POST['dname'];
global $wpdb;
$wpdb->insert( 
	'wp_ajax_demo', 
	array( 
		'name' => $name
	), 
	array( 
		'%s'
	) 
);

$thepost = $wpdb->get_row( "SELECT * FROM wp_ajax_demo order by id desc" );
/* Add Data Jquery code starts */
echo "  <div id='show' align='left'><b>Successfully Added:</b> $thepost->name</div>";	



die();
return true;
}


// wp_ajax_function_name –> it allow function calling from admin dashborad only
add_action('wp_ajax_post_word_count', 'post_word_count');  // Call when user logged in

// wp_ajax_nopriv_function_name –> it allow function calling from admin as well as all pages 
add_action('wp_ajax_nopriv_post_word_count', 'post_word_count'); // Call when user in not logged in



function show_form(){
global $wpdb;
$thepost = $wpdb->get_row( "SELECT * FROM wp_ajax_demo order by id desc" );
/* Add Data Jquery code starts */
echo "<div id='show' align='left'>
<div>$thepost->name</div>
</div>";	
	
	
echo "<form>";
echo "<label>Name</label>";
echo "<input type='text' id='dname' name='dname' value=''/><br/>";
echo "<input type='button' id='submit' name='submit' value='Submit'/>";
echo "</form>";
}

//add_action('the_content', 'show_form');
add_shortcode( 'ajax_form', 'show_form' );

?>