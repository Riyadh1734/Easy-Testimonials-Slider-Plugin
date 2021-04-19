<?php
/**
 * Add a dynamic CSS.
 */
?>
<style type="text/css" media="all">
.testimonial .title {
 color: <?php $color_theme = get_option('color_theme'); if(!empty($color_theme)) {echo $color_theme;} else {echo "#eabd44";}?>;
}
.testimonial .post {
 color: <?php $color_theme = get_option('color_theme'); if(!empty($color_theme)) {echo $color_theme;} else {echo "#eabd44";}?>;
}
.testimonial .rating {
 background: <?php $color_theme = get_option('color_theme'); if(!empty($color_theme)) {echo $color_theme;} else {echo "#eabd44";}?>;
}
.owl-theme .owl-controls .owl-buttons div:hover {
 background: <?php $color_theme = get_option('color_theme'); if(!empty($color_theme)) {echo $color_theme;} else {echo "#eabd44";}?>;
 border-color: <?php $color_theme = get_option('color_theme'); if(!empty($color_theme)) {echo $color_theme;} else {echo "#eabd44";}?>;
}
.testimonial:hover .testimonial-content {
border-color: <?php $hover_color = get_option('hover_color'); if(!empty($hover_color)) {echo $hover_color;} else {echo "#3d3d3d";}?>;
}
.testimonial .testimonial-content:after {
 background: <?php $hover_color = get_option('hover_color'); if(!empty($hover_color)) {echo $hover_color;} else {echo "#3d3d3d";}?>;
}
</style>