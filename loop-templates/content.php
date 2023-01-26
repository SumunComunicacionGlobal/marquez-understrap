<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class('card card-linked'); ?> id="post-<?php the_ID(); ?>">

	<?php if( !current_user_can( 'edit_posts' ) ) : ?>
		<a class="block-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
	<?php endif; ?>
	
	<?php echo get_the_post_thumbnail( $post->ID, 'large', array('class' => 'card-img') ); ?>

	<div class="card-body">

		<?php
		the_title(
			sprintf( '<h2 class="entry-title card-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
			'</a></h2>'
		);
		?>

		<?php marquez_maquina_meta_data(); ?>

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
