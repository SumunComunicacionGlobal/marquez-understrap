<?php
/*
Template Name: Página Ocasion principal
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php
				while ( have_posts() ) {
					the_post(); ?>

					<header class="entry-header">

						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

					</header><!-- .entry-header -->

					<div class="entry-content">

						<?php
						the_content();

						understrap_link_pages();
						?>

					</div><!-- .entry-content -->

					<footer class="entry-footer">

						<?php understrap_edit_post_link(); ?>

					</footer><!-- .entry-footer -->


				<?php }	?>

 				<?php get_search_form(); ?>

				<?php 
					categorias_ocasion();
					// maquinaria_ocasion(); 
				?>

			</main><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
