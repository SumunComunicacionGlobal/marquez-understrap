<?php
/**
 * Template Name: Máquina
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<?php get_template_part( 'sidebar-templates/sidebar', 'left' ); ?>

			<div class="<?php echo is_active_sidebar( 'left-sidebar' ) ? 'col-md-8' : 'col-md-12'; ?> content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<?php
					while ( have_posts() ) {
						the_post(); ?>

						<header class="entry-header">

						<?php the_title( '<div class="titulo-maq-nueva"><h1 class="entry-title">', ' '.get_logo_marca().'</h1></div>' ); ?>

						</header><!-- .entry-header -->

						<?php echo marquez_get_video_cabecera(); ?>

						<div class="galeria-maq-nueva">

							<?php echo get_galeria_ocasion(); ?>

							<?php 
							// if (has_post_thumbnail() ) {
							// 	the_post_thumbnail( 'large' );	
							// } else {
							// 	echo get_primera_imagen_galeria(); 
							// } 
							?>

							<?php // galeria(); ?>

							<div class="row">

								<div class="col-md-8">
		
									<?php echo get_videos_pagina(); ?>

								</div>

								<div class="col-md-4">
		
									<?php echo get_enlaces_maquina(); ?>

								</div>

							</div>

						<div class="entry-content">

							<div class="wrapper">

								<h4><?php echo __( 'Características', 'marquez' ); ?></h4>

								<?php
								the_content();

								echo apply_filters( 'the_content', $post->post_excerpt );

								understrap_link_pages();
								?>

							</div>

							<?php // echo get_enlaces_maquina(); ?>

							<?php // echo marquez_get_otras_maquinas(); ?>

							<?php echo marquez_get_paginas_hijas(); ?>

						</div><!-- .entry-content -->
						
						<footer class="entry-footer">

							<?php understrap_edit_post_link(); ?>

						</footer><!-- .entry-footer -->
		
					<?php } ?>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
