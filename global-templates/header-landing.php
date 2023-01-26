<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="<?php echo $container; ?>">

    <div class="row pt-2">

        <div class="col-6">

            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-marquez-plano.png" width="179" height="104" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />

        </div>

        <div class="col-6">

            <?php $logo = get_post_meta( get_the_ID(), 'logo_del_fabricante', true );
            if ($logo) {
                echo wp_get_attachment_image( $logo, 'medium', false, array('class' => 'logo-fabricante-landing alignright') );
            } ?>

        </div>


    </div>

</div>
