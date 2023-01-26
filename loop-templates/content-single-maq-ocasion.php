<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$vendida = get_field('vendida');
$nueva = get_field('nueva');
// $destacada = get_field('destacada');
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php echo get_maquina_meta(); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">

	<div class="contenedor-sticker">

		<div class="contenedor-detalle-maquina-fotos">

			<?php echo get_galeria_ocasion(); ?>

			<?php if ($vendida) {
				echo '<span class="label-maquina label-vendida">'.__( 'Vendida', 'marquez' ).'</span>';
			} ?>

		</div>

		<?php if ($nueva) {
			echo '<span class="sticker-maquina sticker-nueva">'.__( 'Nueva', 'marquez' ).'</span>';
		} ?>

	</div>
	
		<?php the_content(); ?>

		<div class="wrapper">

			<?php get_search_form(); ?>

		</div>

		<?php echo maquinas_relacionadas_wp(get_the_ID()); ?>
		
		<?php understrap_link_pages();
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
