<?php
/**
 * Adds a submenu page under a custom post type parent.
 */
function register_wpetp_settings_page() {
    add_submenu_page(
        'edit.php?post_type=testimonial',
        __( 'Settings', 'wpetp' ),
        __( 'Settings', 'wpetp' ),
        'manage_options',
        'wpetp-settings-page',
        'elements_wpetp_settings_page'
    );
}
add_action('admin_menu', 'register_wpetp_settings_page');
 
/**
 * Display callback for the submenu page.
 */
function elements_wpetp_settings_page() { 
    ?>

<div class="wrap wpetp-warp">
  <div class="wpetp-main-body">
    <h2>
      <?php echo esc_attr(__('Testimonial Settings')); ?>
    </h2>
    <form action="options.php" method="post">
      <div class="clsrFX"></div>
      <?php wp_nonce_field('update-options'); ?>
      <label name="color_theme" for="color_theme" > <?php echo esc_attr(__('Color Theme:')); ?> </label>
      <input type="text" name="color_theme" value=" <?php echo get_option( 'color_theme' ); ?>" class="color-picker"/>
      <div class="clsrFX"></div>
      <label name="hover_color" for="hover_color" > <?php echo esc_attr(__('Hover Color:')); ?> </label>
      <input type="text" name="hover_color" value=" <?php echo get_option( 'hover_color' ); ?> "class="color-picker" />
      <div class="clsrFX"></div>
      <label name="wpetp_display" for="wpetp_display" > <?php echo esc_attr(__('Display Post:')); ?> </label>
      <input type="text" name="wpetp_display" value=" <?php echo get_option( 'wpetp_display' ); ?> "class="color-picker" />
      <div class="clsrFX"></div>
      <label for="wpetp_auto"> <?php echo esc_attr(__('Auto Play:')); ?> </label>
      <select name="wpetp_auto" id="wpetp_auto">
      	<option value="true" <?php if( get_option('wpetp_auto') == 'true'){ echo 'selected="selected"'; } ?> >YES</option>
        <option value="false" <?php if( get_option('wpetp_auto') == 'false'){ echo 'selected="selected"'; } ?> >NO</option>
      </select>
      <div class="clsrFX"></div>
      <label for="wpetp_navigation"> <?php echo esc_attr(__('Display Navigation:')); ?> </label>
      <select name="wpetp_navigation" id="wpetp_navigation">
      	<option value="true" <?php if( get_option('wpetp_navigation') == 'true'){ echo 'selected="selected"'; } ?> >YES</option>
        <option value="false" <?php if( get_option('wpetp_navigation') == 'false'){ echo 'selected="selected"'; } ?> >NO</option>
      </select>
      <div class="clsrFX"></div>
      <input type="hidden" name="action" value="update" />
      <input type="hidden" name="page_options" value="color_theme, hover_color, wpetp_display, wpetp_auto, wpetp_navigation" />
      <input type="submit" name="submit" value=" <?php _e( 'Save Changes', 'wpetp' ); ?> " class="button" />
      <div class="clsrFX"></div>
    </form>
  </div>
  <div class="wpetp-sidebar">
    <h3><?php echo esc_attr(__('About the Author')); ?></h3>
    <p>My name is <strong><a href="http://sajuahmed.epizy.com/" target="_blank">Riyadh Ahmed<br></a></strong>Web Developer, Expert WordPress Developer<br/></p>
  </div>
</div>
<?php
}
?>
