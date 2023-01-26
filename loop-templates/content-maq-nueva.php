<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$logo_marca = get_logo_marca();
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header>

		<?php
		the_title(
			sprintf( '<div class="titulo-maq-nueva"><h2 class="entry-title"><a href="%s" rel="bookmark" target="_blank">', esc_url( get_permalink() ) ),
			' '. $logo_marca .'</a></h2></div>'
		);
		?>

	</header><!-- .entry-header -->

	<div class="row">

		<div class="col-5">

			<div class="galeria-maq-nueva">

				<?php // echo get_primera_imagen_galeria($maq_id, get_field('galeria'), $logo_marca); ?>

			</div>

		</div>

		<div class="col-7">

			<div class="entry-content">

				<?php
				the_excerpt();
				understrap_link_pages();
				?>

			</div><!-- .entry-content -->

			<footer class="entry-footer">

				<?php understrap_entry_footer(); ?>

			</footer><!-- .entry-footer -->

		</div>

</article><!-- #post-## -->
