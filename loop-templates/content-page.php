<?php
/**
 * Partial template for content in page.php
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$ocultar_titulo = get_post_meta( get_the_ID(), 'ocultar_titulo', true );
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php if ( !is_front_page() && !$ocultar_titulo ) : ?>

		<header class="entry-header">

			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		
		</header><!-- .entry-header -->

	<?php endif; ?>

	<?php echo marquez_get_video_cabecera(); ?>

	<?php if ( has_children() ) {
		echo marquez_get_paginas_hijas();
	} ?>
	
	<div class="entry-content">

		<div class="wrapper">

			<?php
			the_content();

			understrap_link_pages();
			?>

		</div>

		<?php echo get_videos_pagina(); ?>

		<?php echo get_enlaces_maquina(); ?>

		<?php // echo marquez_get_otras_maquinas(); ?>

		<?php if ( !has_children() ) {
			echo marquez_get_paginas_hijas(); 
		} ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_edit_post_link(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
