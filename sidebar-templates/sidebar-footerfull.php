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

			<?php if ( es_latinoamerica() && is_active_sidebar( 'footerfull-latinoamerica' ) ) :

					dynamic_sidebar( 'footerfull-latinoamerica' );

				else :

					dynamic_sidebar( 'footerfull' );

				endif; ?>

		</div>

	</div>

</div><!-- #wrapper-footer-full -->

