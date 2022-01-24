<?php
/*
Plugin Name:Easy Testimonials Slider Plugin
Plugin URI: https://wordpress.org/plugins/epizy-easy-testimonials/
Description: This plugin is very helpfull to add interesting testimonials of your client’s. Make your customer recommendations, your ladder to success with this WP plugin.
Version:     2.0
Requires at least: 5.2
Author:      Riyadh Ahmed
Author URI:  http://sajuahmed.epizy.com/
License:     GPL v2 or Later
License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
Text Domain: wpetp
*/

/**
 * wpetp enqueue styles
 */
function wpetp_enqueue_style() {
    wp_enqueue_style( 'owl.carousel', plugins_url( 'css/owl.carousel.min.css', __FILE__ ) );
	wp_enqueue_style( 'owl.theme', plugins_url( 'css/owl.theme.min.css', __FILE__ ) );
	wp_enqueue_style( 'wpetp-style', plugins_url( 'css/wpetp-style.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'wpetp_enqueue_style' );


/**
 * wpetp enqueue scripts
 */
function wpetp_enqueue_scripts() {
	wp_enqueue_script( 'owl.carousel', plugins_url( 'js/owl.carousel.min.js', __FILE__ ), array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'wpetp_enqueue_scripts' );


/**
 * Enqueue a custom stylesheet in the WordPress admin.
 */
function wpetp_enqueue_admin_style() {
    wp_enqueue_style( 'wpetp-admin-style', plugins_url( 'css/wpetp-admin-style.css', __FILE__ ), false, '1.0.0' );
	wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'iris', admin_url( 'js/iris.min.js' ), array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), false, 1 );
	wp_enqueue_script( 'cp-active', plugins_url('/js/cp-active.js', __FILE__), array('jquery'), '', true );
}
add_action( 'admin_enqueue_scripts', 'wpetp_enqueue_admin_style' );


/**
 * wpetp custom post
 */
if ( ! function_exists('wpetp_custom_post_type') ) {
// Register Custom Post Type
function wpetp_custom_post_type() {
	$labels = array(
		'name'                  => _x( 'Testimonials', 'Post Type General Name', 'wpetp' ),
		'singular_name'         => _x( 'Testimonial Type', 'Post Type Singular Name', 'wpetp' ),
		'menu_name'             => __( 'Testimonials', 'wpetp' ),
		'name_admin_bar'        => __( 'Post Type', 'wpetp' ),
		'archives'              => __( 'Item Archives', 'wpetp' ),
		'attributes'            => __( 'Item Attributes', 'wpetp' ),
		'parent_item_colon'     => __( 'Parent Item:', 'wpetp' ),
		'all_items'             => __( 'All Items', 'wpetp' ),
		'add_new_item'          => __( 'Add New Item', 'wpetp' ),
		'add_new'               => __( 'Add New', 'wpetp' ),
		'new_item'              => __( 'New Item', 'wpetp' ),
		'edit_item'             => __( 'Edit Item', 'wpetp' ),
		'update_item'           => __( 'Update Item', 'wpetp' ),
		'view_item'             => __( 'View Item', 'wpetp' ),
		'view_items'            => __( 'View Items', 'wpetp' ),
		'search_items'          => __( 'Search Item', 'wpetp' ),
		'not_found'             => __( 'Not found', 'wpetp' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'wpetp' ),
		'featured_image'        => __( 'Featured Image', 'wpetp' ),
		'set_featured_image'    => __( 'Set featured image', 'wpetp' ),
		'remove_featured_image' => __( 'Remove featured image', 'wpetp' ),
		'use_featured_image'    => __( 'Use as featured image', 'wpetp' ),
		'insert_into_item'      => __( 'Insert into item', 'wpetp' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'wpetp' ),
		'items_list'            => __( 'Items list', 'wpetp' ),
		'items_list_navigation' => __( 'Items list navigation', 'wpetp' ),
		'filter_items_list'     => __( 'Filter items list', 'wpetp' ),
	);
	$args = array(
		'label'                 => __( 'Testimonial Type', 'wpetp' ),
		'description'           => __( 'Testimonial Description', 'wpetp' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'testimonial', $args );
}
add_action( 'init', 'wpetp_custom_post_type', 0 );
}

/**
 * wpetp post loop
 */

function wpetp_testimonial_loop(){ 
ob_start(); ?>
<div id="testimonial-slider" class="owl-carousel">
  <?php 
	// WP_Query arguments
	$args = array(
		'post_type'              => array( 'testimonial' ),
		'post_status'            => array( 'publish' ),
	);
	
	// The Query
	$wpetp_query = new WP_Query( $args );
	
	// The Loop
	if ( $wpetp_query->have_posts() ) {
		while ( $wpetp_query->have_posts() ) {
			$wpetp_query->the_post();
			// do something
			?>
  <div class="testimonial">
    <div class="pic"> <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>" alt="<?php the_title(); ?>"> </div>
    <h3 class="title">
      <?php the_title(); ?>
    </h3>
    <p class="description">
      <?php the_excerpt();  ?>
    </p>
    <div class="testimonial-content">
      <div class="testimonial-profile">
        <h3 class="name"><?php echo get_post_meta( get_the_ID(), 'testi_name', true ); ?></h3>
        <span class="post"><?php echo get_post_meta( get_the_ID(), 'testi_desig', true ); ?></span> </div>
      <ul class="rating">
        <?php
                          $wpetp_client_review = get_post_meta( get_the_ID(), 'testi_rating', true );
						  if($wpetp_client_review ==1){
							  echo "<li class='fa fa-star'></li>";
						  }elseif($wpetp_client_review ==2){
							  echo "<li class='fa fa-star'></li><li class='fa fa-star'></li>";
						  }elseif($wpetp_client_review ==3){
							  echo "<li class='fa fa-star'></li><li class='fa fa-star'></li><li class='fa fa-star'></li>";
						  }elseif($wpetp_client_review ==4){
							  echo "<li class='fa fa-star'></li><li class='fa fa-star'></li><li class='fa fa-star'></li><li class='fa fa-star'></li>";
						  }elseif($wpetp_client_review ==5){
							  echo "<li class='fa fa-star'></li><li class='fa fa-star'></li><li class='fa fa-star'></li><li class='fa fa-star'></li><li class='fa fa-star'></li>";
						  }elseif($wpetp_client_review =="1.5"){
							  echo "<li class='fa fa-star'></li><li class='fas fa-star-half'></li>";
						  }elseif($wpetp_client_review =="2.5"){
							  echo "<li class='fa fa-star'></li><li class='fa fa-star'></li><li class='fas fa-star-half'></li>";
						  }elseif($wpetp_client_review =="3.5"){
							  echo "<li class='fa fa-star'></li><li class='fa fa-star'></li><li class='fa fa-star'></li><li class='fas fa-star-half'></li>";
						  }elseif($wpetp_client_review =="4.5"){
							  echo "<li class='fa fa-star'></li><li class='fa fa-star'></li><li class='fa fa-star'></li><li class='fa fa-star'></li><li class='fas fa-star-half'></li>";
						  }else{
							  echo "no rating";
						  }
                          ?>
      </ul>
    </div>
  </div>

  <?php }
	} else {
		// no posts found
	}
	// Restore original Post Data
	wp_reset_postdata();
	?>
</div>

<?php }

/**
 * Remove auto paragraph
 */	

remove_filter('the_excerpt', 'wpautop');

/**
	jQuary Settings.
**/

function wpetp_testimonial_script(){?>
<script>
$(document).ready(function(){
    $("#testimonial-slider").owlCarousel({
        items:<?php $wpetp_display = get_option('wpetp_display'); if(!empty($wpetp_display)) {echo $wpetp_display;} else {echo "2";}?>,
        itemsDesktop:[1000,2],
        itemsDesktopSmall:[979,2],
        itemsTablet:[768,2],
        itemsMobile:[650,1],
        navigationText:["",""],
		pagination:false,
        autoPlay:<?php $wpetp_auto = get_option('wpetp_auto'); if(!empty($wpetp_auto)) {echo $wpetp_auto;} else {echo "false";}?>,
		navigation:<?php $wpetp_navigation = get_option('wpetp_navigation'); if(!empty($wpetp_navigation)) {echo $wpetp_navigation;} else {echo "true";}?>
    });
});
</script>
<?php }
add_action('wp_footer', 'wpetp_testimonial_script', 100);

/**
 * wpetp shortcode
 */	
function wpetp_testimonial_shortcode() {
    add_shortcode( 'WPETPTESTIMONIAL', 'wpetp_testimonial_loop' );
}
add_action( 'init', 'wpetp_testimonial_shortcode' );

/**
	Get all php file.
**/
foreach ( glob( plugin_dir_path( __FILE__ )."inc/*.php" ) as $php_file )
    include_once $php_file;
	
/**
	wpetp redirect to plugin settings page.
**/
register_activation_hook(__FILE__, 'wpetp_plugin_activate');
add_action('admin_init', 'wpetp_plugin_redirect');

function wpetp_plugin_activate() {
    add_option('wpetp_plugin_do_activation_redirect', true);
}

function wpetp_plugin_redirect() {
    if (get_option('wpetp_plugin_do_activation_redirect', false)) {
        delete_option('wpetp_plugin_do_activation_redirect');
        if(!isset($_GET['activate-multi']))
        {
            wp_redirect("edit.php?post_type=testimonial&page=wpetp-settings-page");
        }
    }
}
?>
