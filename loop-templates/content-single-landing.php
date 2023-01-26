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

	<div class="row mb-0">

		<div class="col-md-5 col-lg-5">

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

				<?php understrap_entry_footer(); ?>

			</footer><!-- .entry-footer -->

		</div>

		<aside class="col-md-7 col-lg-5 offset-lg-2">

			<?php
			$titulo_del_formulario = get_post_meta( get_the_ID(), 'titulo_del_formulario', true );
			echo '<div class="wrapper-form">';
				echo '<h2>'.$titulo_del_formulario.'</h2>';
				echo do_shortcode( __( '[contact-form-7 id="7429" title="Formulario landing"]', 'marquez' ) ); 
			echo '</div>';
			?>

		</aside>

	</div>

</article><!-- #post-## -->

<?php if ( has_post_thumbnail() ) {

	echo '<div class="foto-principal-landing-wrapper">';
		echo get_the_post_thumbnail( $post->ID, 'large' );
	echo '</div>';

}
