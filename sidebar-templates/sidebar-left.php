<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'left-sidebar' ) ) {
	return;
}

// when both sidebars turned on reduce col size to 3 from 4.
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );

?>

<?php if ( 'both' === $sidebar_pos ) : ?>
	<div class="col-md-3 widget-area" id="left-sidebar">
<?php else : ?>
	<div class="col-md-4 col-lg-3 widget-area" id="left-sidebar">
<?php endif; ?>

<?php

if( es_blog() ) {

	if ( is_active_sidebar( 'noticias' ) ) {
		echo '<div class="sticky-top">';
			dynamic_sidebar( 'noticias' ); 
		echo '</div>';
	}

} else {
	
	if ( es_ocasion() || is_search() /*|| es_latinoamerica()*/ ) {

		menu_categorias_ocasion();

	} else {

		echo crear_menu_lateral_botones();

	}

	if ( is_active_sidebar( 'left-sidebar' ) ) {
		echo '<div class="sticky-top">';
			dynamic_sidebar( 'left-sidebar' ); 
		echo '</div>';
	}

}


?>

</div><!-- #left-sidebar -->
