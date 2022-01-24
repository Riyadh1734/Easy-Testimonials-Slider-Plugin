<?php
/**
 * Register meta box(es).
 */
function wpetp_register_meta_testi_boxes() {
    add_meta_box( 'testi-box-id', __( 'Testimonial Information', 'wpetp' ), 'wpetp_testi_display_callback', 'testimonial' );
}
add_action( 'add_meta_boxes', 'wpetp_register_meta_testi_boxes' );
 
/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function wpetp_testi_display_callback( $post ) {
    // Display code/markup goes here. Don't forget to include nonces!
	
	$testi_name = get_post_meta(get_the_ID(), 'testi_name', true);
	$testi_desig = get_post_meta(get_the_ID(), 'testi_desig', true);
	$testi_rating = get_post_meta(get_the_ID(), 'testi_rating', true);
	
	echo '<label for="testi_name" class="testi-data">Name:</label>';
	echo '<input type="text" id="testi_name" name="testi_name" value="'.esc_attr($testi_name).'" placeholder=" John Doe" size="25" />';
	
	echo '<div class="clsrFX"></div>';
	echo '<label for="testi_desig" class="testi-data">Company:</label>';
	echo '<input type="text" id="testi_desig" name="testi_desig" value="'.esc_attr($testi_desig).'" placeholder=" Google" size="25" />';
	
	echo '<div class="clsrFX"></div>';
	echo '<label for="testi_rating" class="testi-data">Rating:</label>';
	echo '<input type="text" id="testi_rating" name="testi_rating" value="'.esc_attr($testi_rating).'" placeholder=" 4" size="25" />';
}
 
/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function wpetp_testi_save_meta_box( $post_id ) {
    // Save logic goes here. Don't forget to include nonce checks!
	
	$sanitize_testi_name = sanitize_text_field( $_POST['testi_name']);
	$sanitize_testi_desig = sanitize_text_field( $_POST['testi_desig']);
	$sanitize_testi_rating = sanitize_text_field( $_POST['testi_rating']);
	
	update_post_meta( get_the_ID(), 'testi_name',  $sanitize_testi_name);
	update_post_meta( get_the_ID(), 'testi_desig',  $sanitize_testi_desig);	
	update_post_meta( get_the_ID(), 'testi_rating',  $sanitize_testi_rating);	
	
}
add_action( 'save_post', 'wpetp_testi_save_meta_box' );
?>