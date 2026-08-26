<?php
/**
 * Sidebar setup for footer full
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );

?>


<!-- ******************* The Footer Full-width Widget Area ******************* -->

<div class="wrapper" id="wrapper-footer-full">

	<div class="<?php echo esc_attr( $container ); ?>" id="footer-full-content" tabindex="-1">

		<div class="row">

			<?php if ( function_exists( 'es_latinoamerica' ) && es_latinoamerica() ) :

				if ( es_chile() && is_active_sidebar( 'footerfull-chile' ) ) :

					dynamic_sidebar( 'footerfull-chile' );

				elseif ( is_active_sidebar( 'footerfull-latinoamerica' ) ) :

					dynamic_sidebar( 'footerfull-latinoamerica' );

				else :	

					dynamic_sidebar( 'footerfull' );

				endif;

			else :

				if ( is_active_sidebar( 'footerfull' ) ) :

					dynamic_sidebar( 'footerfull' );

				endif;

			endif; ?>

		</div>

	</div>

</div><!-- #wrapper-footer-full -->

