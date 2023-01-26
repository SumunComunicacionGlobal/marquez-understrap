<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$titulo = get_the_title();
$alt_title = get_post_meta( $post->ID, 'titulo_carrusel', true );
if ( $alt_title ) $titulo = $alt_title;

$template_slug  = get_page_template_slug( get_the_ID() );
$post_type = get_post_type();
if ( $template_slug ) {

	$template_parts = explode( '/', $template_slug );

	foreach ( $template_parts as $part ) {
		$template_slug_class = "{$post_type}-template-" . sanitize_html_class( str_replace( array( '.', '/' ), '-', basename( $part, '.php' ) ) );
	}
	
} else {
	$template_slug_class = "{$post_type}-template-default";
}

	
?>

<div class="carrusel-item">
		
	<div <?php post_class( $template_slug_class ); ?> id="post-<?php the_ID(); ?>">

		<div class="card card-linked maquina-relacionada">

		<a class="block-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>

			<?php echo get_the_post_thumbnail( $post->ID, 'large', array( 'class' => 'card-img-top' ) ); ?>

			<div class="card-body">

				<h4 class="entry-title card-title">
					<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
						<?php echo $titulo; ?>
					</a>
				</h4>		

				<?php marquez_maquina_meta_data(); ?>

				<?php if ( 'post' === get_post_type() ) : ?>

					<div class="entry-meta">
						<?php understrap_posted_on(); ?>
					</div><!-- .entry-meta -->

				<?php endif; ?>

				<?php understrap_entry_footer(); ?>

			</div><!-- .card-body -->

			<div class="card-footer">

					<a href="" class="btn btn-primary d-block"><?php read_more(); ?></a>

			</div>

		</div>

	</div><!-- #post-## -->

</div>