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

<?php if ( is_singular( 'landing' ) ) { ?>

	    <div class="wrapper py-5" id="wrapper-destacados-landing">

	        <div class="<?php echo esc_attr( $container ); ?>" id="destacados-landing-content" tabindex="-1">

	            <div class="row">

                    <?php dynamic_sidebar( 'destacados-landing' ); ?>

	            </div>

	        </div>

	    </div>

	<?php if ( is_active_sidebar( 'footer-landing' ) ) { ?>

	    <div class="wrapper py-5" id="wrapper-footer-landing">

	        <div class="<?php echo esc_attr( $container ); ?>" id="footer-landing-content" tabindex="-1">

	            <div class="row">

	                <div class="col-md-3 text-center">

	                    <img class="aligncenter" src="<?php echo get_stylesheet_directory_uri() . '/images/logo-marquez-plano.png'; ?>" alt="Maquinaria Márquez" />

	                </div>

	                <div class="col-md-9">

	                    <div class="row">

	                        <?php dynamic_sidebar( 'footer-landing' ); ?>

	                    </div>

	                </div>
	            
	            </div>

	        </div>

	    </div>

	<?php } ?>

<?php } ?>
