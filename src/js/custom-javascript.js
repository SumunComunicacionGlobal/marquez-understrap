jQuery(document).ready(function($){

    var lightboxDataRel = $('.contenedor-detalle-maquina-fotos .gallery a').attr('data-rel');
    $('.imagen-principal-maquina').attr('data-rel', lightboxDataRel);
    setTimeout(
      function() {
            $('#secondary li.cat-item.ocultar > a').each(function() {
                var href = $(this).attr('href');
                $('#secondary .sb-options a[rel="' + href + '"]').hide();
                // alert( href + ' --- ' + rel );
            });
      }, 1000);

    // $('.sticky-sidebar').stickySidebar({
    //     topSpacing: 60,
    //     bottomSpacing: 60,
    //     minWidth: 768,
    // });

    $('.slider-home').slick({
      dots: true
    });

    // $('.menu-lateral-botones-carrusel').slick({
    //     dots: false,
    //     infinite: true,
    //     arrows: true,
    //     autoplay: true,
    //     autoplaySpeed: 4500,
    //     responsive: [
    //         {
    //             breakpoint: 9999,
    //             settings: "unslick"
    //         },
    //         {
    //             breakpoint: 783,
    //             settings: {
    //                 slidesToShow: 4,
    //                 slidesToScroll: 4
    //             }
    //         },
    //         {
    //             breakpoint: 600,
    //             settings: {
    //                 slidesToShow: 3,
    //                 slidesToScroll: 3
    //             }
    //         },
    //         {
    //             breakpoint: 480,
    //             settings: {
    //                 slidesToShow: 2,
    //                 slidesToScroll: 2
    //             }
    //         }
    //     ]
    // });

    $('.carrusel-maquinas').slick({

          dots: true,
          arrows: true,
          infinite: true,
          speed: 300,
          slidesToShow: 4,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 3400,
          adaptiveHeight: true,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2
              }
            },
            {
              breakpoint: 400,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: 'unslick'
            // instead of a settings object
          ]
    });

    $('.carrusel-videos').slick({

      dots: true,
      arrows: true,
      infinite: true,
      speed: 300,
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3400,
      adaptiveHeight: true,
      responsive: [
        // {
        //   breakpoint: 1024,
        //   settings: {
        //     slidesToShow: 3,
        //     slidesToScroll: 1,
        //   }
        // },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 400,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: 'unslick'
        // instead of a settings object
      ]
  });

    // $('.galeria-maq-nueva .gallery').slick({
    // $('.gallery').slick({

    //   dots: false,
    //   arrows: true,
    //   infinite: false,
    //   speed: 300,
    //   slidesToShow: 3,
    //   slidesToScroll: 3,
    //   autoplay: false,
    //   autoplaySpeed: 3400
    // });

    $('.autoplay').slick({

      dots: false,
      arrows: false,
      infinite: true,
      speed: 300,
      slidesToShow: 3,
      slidesToScroll: 3,
      autoplay: true,
      autoplaySpeed: 3400
    });

});