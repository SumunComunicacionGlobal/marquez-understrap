<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="entry-content">

		<div class="row">

			<div class="col-md-6 col-lg-4">

				<div class="galeria-maq-nueva">

					<?php // echo get_primera_imagen_galeria(); ?>

					<?php echo get_videos_pagina(); ?>

				</div>

			</div>

			<div class="col-md-6 col-lg-8">

				<header class="entry-header">

					<?php the_title( '<div class="titulo-maq-nueva"><h1 class="entry-title">', ' '.get_logo_marca().'</h1></div>' ); ?>

				</header><!-- .entry-header -->

				<?php echo wpautop( $post->post_excerpt ); ?>

				<h4><?php echo __( 'Características', 'marquez' ); ?></h4>

				<?php the_content(); ?>

				<?php echo get_enlaces_maquina(); ?>

				<?php understrap_link_pages(); ?>

			</div>

		</div>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
