<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

	<?php if ( is_singular( 'landing' ) ) :

		get_template_part( 'global-templates/header', 'landing' );

	else : ?>

		<!-- ******************* The Navbar Area ******************* -->
		<div id="wrapper-navbar">

			<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

			<nav id="main-nav" class="navbar navbar-expand-lg navbar-light" aria-labelledby="main-nav-label">

				<p id="main-nav-label" class="sr-only">
					<?php esc_html_e( 'Main Navigation', 'understrap' ); ?>
				</p>

			<?php if ( 'container' === $container ) : ?>
				<div class="container">
			<?php endif; ?>

						<!-- Your site title as branding in the menu -->
						<?php if ( ! has_custom_logo() ) { ?>

							<?php if ( is_front_page() && is_home() ) : ?>

								<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

							<?php else : ?>

								<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

							<?php endif; ?>

							<?php
						} else {

							if ( es_ocasion() ) {

								echo '<a href="'. esc_url( get_home_url( '/' ) ) . '" class="navbar-brand custom-logo-link" rel="home">
										<img width="179" height="104" src="'.get_stylesheet_directory_uri().'/images/logo-marquez-ocasion.png" class="attachment-full size-full" alt="'.__( 'Logo Maquinaria Márquez', 'marquez' ).'" loading="lazy"></a>';

							} else {

								the_custom_logo();

							}
						}
						?>
						<!-- end custom logo -->

					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
						<span class="navbar-toggler-label"><?php _e( 'Menú', 'marquez' ); ?></span><span class="navbar-toggler-icon"></span>
					</button>

					<!-- The WordPress Menu goes here -->

					<div class="collapse navbar-collapse" id="navbarNavDropdown">

					<?php

					if ( function_exists( 'es_latinoamerica' ) && es_latinoamerica() ) {

						menu_latinoamerica();

					} else { 
						
						$theme_location = 'primary';
						if ( wp_is_mobile() ) {
							$theme_location = 'movil';
						}
						
						?>

						<?php wp_nav_menu(
							array(
								'theme_location'  => $theme_location,
								'container'		  => false,
								// 'container_class' => 'collapse navbar-collapse',
								// 'container_id'    => 'navbarNavDropdown',
								'menu_class'      => 'navbar-nav ml-auto',
								'fallback_cb'     => '',
								'menu_id'         => 'main-menu',
								'depth'           => 5,
								'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
								// 'walker'		  => new wp_bootstrap_navwalker(),
							)
						); ?>

						<div class="my-2 d-sm-none">

							<?php dynamic_sidebar( 'top-bar-left' ); ?>

						</div>

					<?php }	?>

				</div>

				<?php if ( 'container' === $container ) : ?>
				</div><!-- .container -->
				<?php endif; ?>

			</nav><!-- .site-navigation -->

		</div><!-- #wrapper-navbar end -->

		<?php if ( function_exists( 'es_latinoamerica' ) && es_latinoamerica() ) {

			if ( is_active_sidebar( 'cabecera-latinoamerica' ) ) {

				echo '<div class="container">';

					dynamic_sidebar( 'cabecera-latinoamerica' );

				echo '</div>';

			}

		} ?>


		<?php if ( is_front_page() ) {

			echo '<section id="wrapper-slider">';

				echo '<div class="container">';

					echo marcas_slider();

				echo '</div>';

			echo '</section>';

		} ?>

		<?php if ( !is_front_page() && !is_page_template( 'template_page_ofertas.php' ) && !is_singular( 'landing' ) ) {

			marquez_breadcrumbs();

		} ?>

	<?php endif; ?>
