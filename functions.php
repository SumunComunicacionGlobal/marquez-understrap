<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$content_width = 1024;

// UnderStrap's includes directory.
$understrap_inc_dir = 'inc';

// Array of files to include.
$understrap_includes = array(
    '/wp-bootstrap-navwalker.php',
    '/qt-importer-redirects.php',
);

// Include files.
foreach ( $understrap_includes as $file ) {
    require_once get_theme_file_path( $understrap_inc_dir . $file );
}

function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'responsive-lightbox-tosrus' );
    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
    // echo '<link href="https://fonts.googleapis.com/css2?family=Gudea:wght@400;700&display=swap" rel="stylesheet">';
    echo '<link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@300;600&display=swap" rel="stylesheet">';

    wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/js/slick/slick.css' );
    wp_enqueue_style( 'slick-theme', get_stylesheet_directory_uri() . '/js/slick/slick-theme.css' );

    // Get the theme data
    $the_theme = wp_get_theme();
    wp_enqueue_style( 'marquez-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
    
    wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/js/slick/slick.min.js', array( 'jquery' ), '20130224', true );
    // wp_enqueue_script( 'sticky-sidebar', get_stylesheet_directory_uri() . '/js/sticky-sidebar/jquery.sticky-sidebar.min.js', array('jquery'), false, true );

    wp_enqueue_script('marquez-responsive-lightbox-tosrus', get_stylesheet_directory_uri() . '/js/jquery.tosrus.min.js', array('jquery'), $the_theme->get( 'Version' ), true );
    wp_enqueue_script( 'marquez-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );

add_filter( 'theme_mod_understrap_sidebar_position', 'cargar_sidebar');
function cargar_sidebar( $valor ) {
    global $wp_query;
    if ( 
        is_singular( 'post' ) || 
        is_singular( 'noticia' ) ||
        is_page_template( 'page-templates/page-ocasion.php' ) ||
        is_page_template( 'page-templates/template-page-maquina.php' )
    ) {
        $valor = 'left';
    } elseif( 
        is_page_template( 'page-templates/template_page_oferta.php') || 
        is_singular( 'landing' ) || 
        is_singular( 'maq-nueva' ) 
    ) {
        $valor = '';
    }

    return $valor;
}

add_action( 'wp_body_open', 'marquez_top_bar' );
function marquez_top_bar() {

    if ( is_singular( 'landing' ) ) return false;
    
    echo '<div class="top-bar bg-primary text-white" id="top-bar">';
    
        echo '<div class="container">';
        
            echo '<div class="row">';

                echo '<div class="col-12 col-sm-5 d-none d-sm-block">';

                    echo '<div class="top-bar-left">';

                        dynamic_sidebar( 'top-bar-left' );

                    echo '</div>';

                echo '</div>';

                echo '<div class="col-12 col-sm-7 text-right">';

                    echo '<div class="top-bar-right">';

                        do_action( 'wpml_language_switcher', 
                        array(
                            'type'          => 'custom',
                            'flags'         => 1,
                            'link_current'  => 1,
                            'native'        => 1,
                            'translated'    => 0,
                        ) );

                        dynamic_sidebar( 'top-bar-right' );

                    echo '</div>';

                echo '</div>';

            echo '</div>';

        echo '</div>';

    echo '</div>';

    // echo '<div class="top-bar" id="top-bar-secondary">';
    
    //     echo '<div class="container text-right">';
        
    //         do_action( 'wpml_language_switcher', 
    //             array(
    //                 'type'          => 'custom',
    //                 'flags'         => 1,
    //                 'link_current'  => 1,
    //                 'native'        => 1,
    //                 'translated'    => 0,
    //             ) );

    //     echo '</div>';

    // echo '</div>';
 
}

add_filter( 'post_class', 'marquez_post_class', 10, 3 );
function marquez_post_class( $classes, $class, $post_id ) {

    if ( 'maq-ocasion' == get_post_type( $post_id ) ) {
        $destacada = get_post_meta( $post_id, 'destacada', true );
        if ( $destacada ) $classes[] = 'destacada';

        $vendida = get_post_meta( $post_id, 'vendida', true );
        if ( $vendida ) $classes[] = 'vendida';

        $nueva = get_post_meta( $post_id, 'nueva', true );
        if ( $nueva ) $classes[] = 'nueva';
    }

    return $classes;

}

function understrap_entry_footer() {

    if ( 'maq-ocasion' === get_post_type() && !is_singular('maq-ocasion') ) {

        $nueva = get_post_meta( get_the_ID(), 'nueva', true );
        if ($nueva) {
            echo '<span class="sticker-maquina sticker-nueva">'.__( 'Nueva', 'marquez' ).'</span>';
        }

        $vendida = get_post_meta( get_the_ID(), 'vendida', true );
        if ($vendida) {
            echo '<span class="label-maquina label-vendida">'.__( 'Vendida', 'marquez' ).'</span>';
        }

    }

    // Hide category and tag text for pages.
    if ( 'post' === get_post_type() ) {
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list( esc_html__( ', ', 'understrap' ) );
        if ( $categories_list && understrap_categorized_blog() ) {
            /* translators: %s: Categories of current post */
            printf( '<span class="cat-links">' . esc_html__( 'Posted in %s', 'understrap' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '', esc_html__( ', ', 'understrap' ) );
        if ( $tags_list ) {
            /* translators: %s: Tags of current post */
            printf( '<span class="tags-links">' . esc_html__( 'Tagged %s', 'understrap' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }

    if ( 'noticia' === get_post_type() ) {
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_term_list( get_the_ID(), 'categoria-noticias', '', esc_html__( ', ', 'understrap' ), '' );
        if ( $categories_list ) {
            /* translators: %s: Categories of current post */
            printf( '<span class="cat-links">' . esc_html__( 'Posted in %s', 'understrap' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }

    }

    if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo '<span class="comments-link">';
        comments_popup_link( esc_html__( 'Leave a comment', 'understrap' ), esc_html__( '1 Comment', 'understrap' ), esc_html__( '% Comments', 'understrap' ) );
        echo '</span>';
    }

    understrap_edit_post_link();
}

function understrap_all_excerpts_get_more_link( $post_excerpt ) {

    if ( ! is_admin() ) {
        $post_excerpt = $post_excerpt . '<p><a class="btn btn-primary understrap-read-more-link" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . get_read_more() . '</a></p>';
    }
    return $post_excerpt;
}

function understrap_add_site_info() {

    wp_nav_menu(
        array(
            'menu' => 'Menú pie de página', 
            'theme_location'  => 'legal',
            'container_class' => 'navbar navbar-expand',
            // 'container_id'    => '',
            'menu_class'      => 'navbar-nav mx-auto flex-column flex-md-row',
            'fallback_cb'     => '',
            'menu_id'         => 'legal-menu',
            'depth'           => 1,
            'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
        )
    );

}

add_filter( 'understrap_posted_by', '__return_false' );
add_filter( 'understrap_posted_on', 'marquez_posted_on' );
function marquez_posted_on() {

    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s"> (%4$s %5$s) </time>';
    }
    $time_string = sprintf(
        $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( 'c' ) ),
        __( 'Actualizado el ', 'marquez' ),
        esc_html( get_the_modified_date() )
    );

    return  sprintf(
            '<span class="posted-on">%1$s %2$s</span>',
            esc_html_x( 'Posted on', 'post date', 'understrap' ),
            apply_filters( 'understrap_posted_on_time', $time_string )
       );

}

add_action( 'widgets_init', 'marquez_unregister_understrap_sidebars', 100 );
function marquez_unregister_understrap_sidebars() {
    unregister_sidebar( 'hero' );
    unregister_sidebar( 'herocanvas' );
    unregister_sidebar( 'statichero' );
}

function es_ocasion() {

    if ( is_page_template( 'page-templates/page-ocasion.php' ) || is_page_template( 'detallemaquinaTemplateWordpress.php' ) || is_page_template( 'listadomaquinasTemplateWordpress.php' ) || is_tax('cat-maquina') || is_singular( 'maq-ocasion' ) || is_post_type_archive( 'maq-ocasion' ) ) {
        return true;
    }
    return false;
}



function marquez_get_maquina_meta_data() {

    $r = '';

    if ( 'maq-ocasion' == get_post_type() ) {
        $referencia = get_post_meta( get_the_ID(), 'referencia', true );
        if ( $referencia ) $r .= '<p class="referencia">' . __( 'Ref:', 'marquez' ) . ' ' . $referencia . '</p>';
    }

    if ( $r ) {
        $r = '<div class="entry-meta">' . $r . '</div>';
    }

    return $r;
}

function marquez_maquina_meta_data() {
    echo marquez_get_maquina_meta_data();
}

function marquez_breadcrumbs() {

    echo '<div id="wrapper-breadcrumbs">';
    echo '<div class="breadcrumbs container" typeof="BreadcrumbList" vocab="https://schema.org/">';
    
    if( function_exists( 'bcn_display' ) ) {
        bcn_display();
    }

    echo '</div>';
    echo '</div>';

}

// add_filter( 'the_content', 'marquez_theme_mostrar_maquinas_despues_del_contenido' );
function marquez_theme_mostrar_maquinas_despues_del_contenido( $content ) {
    return $content . marquez_get_otras_maquinas();
}

function marquez_get_otras_maquinas() {

    $r = '';
    if (is_page() && !is_home() ) {

        // $maquinas = get_post_meta( get_the_ID(), 'maquinas_nuevas', true );
        $maquinas = get_post_meta( get_the_ID(), 'otras_maquinas', true );

        if ( $maquinas ) {

            $args = array(
                'post_type'         => 'any',
                'posts_per_page'    => -1,
                'post__in'          => $maquinas,
                'orderby'           => 'post__in',
                'order'             => 'ASC',
            );

            $q = new WP_Query( $args );
            
            if ( $q->have_posts() ) {

                $r .= '<div class="carrusel carrusel-maquinas">';

                    while ( $q->have_posts() ) { $q->the_post();
                        ob_start();
                        get_template_part( 'loop-templates/content', 'carousel' );
                        $r .= ob_get_clean();
                    }

                $r .= '</div>';
            }

            wp_reset_postdata();

        }

    }

    return $r;

}

// add_filter( 'the_content', 'marquez_theme_mostrar_paginas_hijas_despues_del_contenido' );
function marquez_theme_mostrar_paginas_hijas_despues_del_contenido( $content ) {

        return $content . marquez_get_paginas_hijas();

}

function marquez_get_paginas_hijas() {

    $r = '';
    if ( !is_page() || is_front_page() ) return false;

    global $post;

    if ( 0 == $post->post_parent ) return false;

    $otras_maquinas = get_post_meta( $post->ID, 'otras_maquinas', true );

    $args = array(
        'post_type'         => $post->post_type,
        'posts_per_page'    => -1,
        'orderby'           => 'menu_order',
        'order'             => 'ASC',
        'post_parent'       => $post->ID,
        'fields'            => 'ids',
    );

    $q = new WP_Query( $args );
    
    if ( $post->post_parent > 0 && !$q->have_posts() ) {
        $args['post_parent'] = $post->post_parent;
        $args['post__not_in'] = array( $post->ID );
        $q = new WP_Query( $args );
    }

    $posts_ids = $q->posts;
    if ( $otras_maquinas ) $posts_ids = array_merge( $posts_ids, $otras_maquinas );

    if ( empty($posts_ids) ) return false;

    $args_post__in = array(
        'post_type'         => 'any',
        'posts_per_page'    => -1,
        'post__in'          => $posts_ids,
        'orderby'           => 'post__in',
        'order'             => 'ASC',

    );
    
    $q_post__in = new WP_Query( $args_post__in );
    
    if ( $q_post__in->have_posts() ) {

        remove_filter( 'the_content', 'marquez_theme_mostrar_paginas_hijas_despues_del_contenido' );

        $r.= '<div class="wrapper">';

            $r.= '<div class="carrusel carrusel-maquinas">';

                while ( $q_post__in->have_posts() ) { $q_post__in->the_post();
                    ob_start();
                    get_template_part( 'loop-templates/content', 'carousel' );
                    $r .= ob_get_clean();
                }

            $r .= '</div>';

        $r .= '</div>';
    }

    wp_reset_postdata();


    return $r;

}

function maquinas_relacionadas_wp($post_id) {

    $r = '';

    $related_ids = get_post_meta( $post_id, 'related_ids', true );
    $terms = false;

    $args = array(
        'post_type'         => 'maq-ocasion',
        'posts_per_page'    => -1,
        'post__not_in'      => array($post_id),
    );

    if ( $related_ids ) {
        
        $args['post__in'] = $related_ids;
    
    } else {

        $term_ids = wp_get_post_terms( $post_id, 'cat-maquina', array('fields' => 'ids') );

        if ( $term_ids ) {

            $args['tax_query'][] = array(
                'taxonomy'      => 'cat-maquina',
                'field'         => 'term_id',
                'terms'         => $term_ids,
            );

        }

    }

    if ( $related_ids || $term_ids ) {

        $q = new WP_Query( $args );

        if ( $q->have_posts() ) {

            $r .= '<div class="wrapper print-no" id="maquinaria-relacionada" >';

                $r .= '<h3 id="info" class="titulo-solicitar-info">'. __( 'Maquinaria relacionada con', 'marquez' ) . ' ' . get_the_title() . '</h3>';


                $r .= '<div class="carrusel carrusel-maquinas">';

                    while ( $q->have_posts() ) { $q->the_post();

                        ob_start();
                        get_template_part( 'loop-templates/content', 'carousel' );
                        $r .= ob_get_clean();
                        
                    }

                $r .= '</div>';

            $r .= '</div>';


        }

        wp_reset_postdata();

    }

    return $r;
}

add_filter( 'get_the_archive_title', function ($title) {
    if ( is_tax() ) {
      $title = single_term_title( '', false );
    } elseif( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    }
    
    return $title; 
  });


add_filter( 'nav_menu_submenu_css_class', 'bootstrap_dropdown_submenu', 10, 3 );
function bootstrap_dropdown_submenu( $classes, $args, $depth ) {
    if ( $depth >= 1 ) {
        $classes = array( 'dropdown-submenu' );
    }

    return $classes;
}

function get_read_more() {
    global $post;

    $text = __( 'Read more...', 'understrap' );

    switch ($post->post_type) {
        case 'maq-ocasion':
        case 'maq-nueva':
            case 'maq-ocasion':
            $text = __( 'Ver detalles', 'marquez' );
            break;
        
        default:
            $text = __( 'Read more...', 'understrap' );
            break;
    }

    if ( 'page-templates/template-page-maquina.php' == get_page_template_slug() ) {
        $text = __( 'Ver detalles', 'marquez' );
    }

    return $text;
}

function read_more() {
    echo get_read_more();
}

function get_maquina_meta() {
    $meta = get_the_term_list( get_the_ID(), 'cat-maquina', '<span class="cat-maquina-term">', ' · ', '</span>' );
    $ref = get_post_meta( get_the_ID(), 'referencia', true );
    if ( $ref ) $meta .= '<span class="referencia">' . __( 'Ref', 'marquez' ) . ': <span class="num-referencia">' . $ref . '</span></span>';

    return $meta;
}

function sumun_get_all_attributes( $tag, $text )
{
    preg_match_all( '/' . get_shortcode_regex() . '/s', $text, $matches );
    $out = array();
    if( isset( $matches[2] ) )
    {
        foreach( (array) $matches[2] as $key => $value )
        {
            if( $tag === $value )
                $out = shortcode_parse_atts( $matches[3][$key] );  
        }
    }
    return $out;
}

function get_galeria_ocasion() {

    // return false;

    $galeria = '';

    // $image_ids = maybe_unserialize( get_field('galeria') );

    $image_ids = get_post_meta(get_the_ID(), 'galeria_nueva', true);
    
    if ( !$image_ids ) {

        $image_ids = get_post_meta(get_the_ID(), 'galeria', true);

        if ( !is_array( $image_ids ) && has_shortcode( $image_ids, 'gallery' ) ) {
            $atts = sumun_get_all_attributes( 'gallery', $image_ids );
            if ( isset( $atts['ids']) ) $image_ids = explode( ',', $atts['ids'] );
        }

    }
    
    // Añade la imagen destacada como primera imagen
    // if ( has_post_thumbnail() ) {
    //  $thumb_id = get_post_thumbnail_id( null );
    //  $titulo_thumb = get_the_title( $thumb_id );
    //  $galeria .= '<a class="imagen-principal-maquina" href="'.get_the_post_thumbnail_url( null, 'large' ).'" title="'.$titulo_thumb.'" data-rl_title="'.$titulo_thumb.'" class="rl-gallery-link" data-rl_caption data-rel="lightbox-gallery-1">';
    //      $galeria .= get_the_post_thumbnail( null, 'large' );
    //  $galeria .= '</a>';
    //  if ( $image_ids[0] == $thumb_id ) {
    //      array_shift($image_ids);
    //  }
    // }


    if( $image_ids ) {

        $titulo_thumb = get_the_title( $image_ids[0] );
        $galeria .= '<a class="imagen-principal-maquina" href=" ' .wp_get_attachment_image_url( $image_ids[0], 'large' ) . '" title="'.$titulo_thumb.'" data-rl_title="'.$titulo_thumb.'" class="rl-gallery-link" data-rl_caption data-rel="lightbox-gallery-1">';
            $galeria .= wp_get_attachment_image( $image_ids[0], 'large' );
        $galeria .= '</a>';

        if ( count( $image_ids ) > 1 ) {

            array_shift($image_ids);


            $images_string = implode( ',', $image_ids );
            $shortcode = sprintf( '[gallery ids="%s" size="thumbnail" columns="6"]', $images_string );
            $galeria .= do_shortcode( $shortcode );

        }
    }

    return '<div class="wrapper galeria-maquina">' . $galeria . '</div>';

}

// add_filter('the_content', 'get_contenido_maquinaria_usada');
function get_contenido_maquinaria_usada( $content = '' ) {
    if (!is_singular( 'maq-ocasion' )) return $content;

    $r = '';
    // $referencia = '';
    // $galeria = '';
    // $relacionadas = '';
    // $post_meta = get_post_meta( get_the_ID() );
    // $referencia .= get_the_term_list( get_the_ID(), 'cat-maquina', '<span class="cat-maquina-term">', ' · ', '</span>' );
    // $referencia .= ( isset($post_meta['referencia']) && '' != $post_meta['referencia'][0] ) ? '<span class="referencia">' . __( 'Ref', 'marquez' ) . ': <span class="num-referencia">' . $post_meta['referencia'][0] . '</span></span>' : '';

    // $vendida = get_post_meta( get_the_ID(), 'vendida', true );
    // $nueva = get_post_meta( get_the_ID(), 'nueva', true );
    // $destacada = get_post_meta( get_the_ID(), 'destacada', true );

    // $image_ids = maybe_unserialize( get_field('galeria') );
    // if (has_post_thumbnail()) {
    //  $thumb_id = get_post_thumbnail_id( null );
    //  $titulo_thumb = get_the_title( $thumb_id );
    //  $galeria .= '<a class="imagen-principal-maquina" href="'.get_the_post_thumbnail_url( null, 'large' ).'" title="'.$titulo_thumb.'" data-rl_title="'.$titulo_thumb.'" class="rl-gallery-link" data-rl_caption data-rel="lightbox-gallery-1">';
    //      $galeria .= get_the_post_thumbnail( null, 'large' );
    //  $galeria .= '</a>';
    //  if ( $image_ids[0] == $thumb_id ) {
    //      array_shift($image_ids);
    //  }
    // }

    // if( $image_ids ) {
    //     $images_string = implode( ',', $image_ids );
    //     $shortcode = sprintf( '[gallery ids="%s" size="thumbnail" columns="6"]', $images_string );
    //     $galeria .= do_shortcode( $shortcode );
    // }


    // $campos_tablas = array('caracteristicas', 'accesorios', 'observaciones');
    // foreach ($campos_tablas as $campo) {
    //  if (isset($post_meta[$campo])) {
    //      $field_object = get_field_object($campo);
    //      $r .= procesar_tabla($post_meta[$campo][0], $field_object['label']);
    //  }
    // }

    // $relacionadas .= maquinas_relacionadas_wp(get_the_ID());

    // $content = str_replace('<p>&nbsp;</p>', '', $content);

    $return = '';

    // $return .= '<div class="entry-meta">'.$referencia.'</div>';
            // $return .= '<div class="contenedor-sticker">';
            //  $return .= '<div class="contenedor-detalle-maquina-fotos">';
            //      $return .= $galeria;
                    
            //         if ($vendida) {
            //             $return .= '<span class="label-maquina label-vendida">'.__( 'Vendida', 'marquez' ).'</span>';
            //         }

            //  $return .= '</div>';

            // if ($nueva) {
            //     $return .= '<span class="sticker-maquina sticker-nueva">'.__( 'Nueva', 'marquez' ).'</span>';
            // }
            // $return .= '</div>';

            // $return .= '<div class="wrapper contenedor-detalle-maquina-datos">' . $content . $r . '</div>';
            // $return .= get_search_form( false );
            // $return .= $relacionadas;
            // $return .= '<div id="solicitar-info" class="wrapper print-no clearfix"> ';
            //  $return .= '<h3 id="info" class="titulo-solicitar-info text-center">Solicitar información sobre: '.get_the_title().'</h3>';
            //  $return .= do_shortcode( __( '[contact-form-7 id="4301" title="Solicitud info máquina"]', 'marquez' ) );
            //  $return .= '<input type="hidden" name="marca_maquina" value="'.get_the_title().'">';
            // $return .= '</div>';


    return $return;
}

add_filter( 'the_content', 'marquez_wpml_contenido_en_idioma_por_defecto' );
function marquez_wpml_contenido_en_idioma_por_defecto( $content ) {
    if ( $content ) return $content;

    $default_lang = apply_filters('wpml_default_language', NULL );
    $current_lang = apply_filters('wpml_current_language', NULL );

    if ( $current_lang == $default_lang ) return $content;

    $default_lang_post_id = apply_filters( 'wpml_object_id', get_the_ID(), 'page', false, $default_lang );
    $default_lang_post = get_post( $default_lang_post_id);

    return $default_lang_post->post_content;
}

// add_filter( 'nav_menu_css_class' , 'marquez_custom_nav_item_classes' , 1000, 3 );
// function marquez_custom_nav_item_classes( $classes, $item, $args ) {

//     if ( 'post_type' != $item->type ) return $classes;

//     $post_status = get_post_status( $item->object_id );
//     $classes[] = $post_status;

//     return $classes;
// }

function marquez_get_video_cabecera() {

    $file_id = get_post_meta( get_the_ID(), 'video_de_cabecera', true );

    if ( $file_id && is_numeric( $file_id ) ) {

        $url = wp_get_attachment_url( $file_id );

        $r = '';

        // $r .= '<div class="wp-block-cover">';
            // $r .= '<video class="wp-block-cover__video-background" autoplay muted loop playsinline src="'.$url.'" data-object-fit="cover"></video>';
        // $r .= '</div>';

        $r .= '<figure class="wp-block-video mb-3">';
            $r .= '<video class="video-principal" autoplay muted loop playsinline src="'.$url.'"></video>';
        $r .= '</figure>';

        return $r;
    }

    return false;
}

function has_children() {
    global $post;
    
    $pages = get_pages('child_of=' . $post->ID);
    
    if (count($pages) > 0):
      return true;
    else:
      return false;
    endif;
  }