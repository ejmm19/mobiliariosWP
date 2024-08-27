let sliders = jQuery('#slider-elements').attr('data-json');
if (typeof sliders !== 'undefined') {
    const buildSlideMarkup = () => {
        sliders = JSON.parse(sliders);
        let slideMarkup = '';
        if (sliders.length > 0) {
            for (let i = 0; i < sliders.length; i++) {
                slideMarkup += `<slide class="carousel-item-slide">
                                <img src="${sliders[i].image}" style="width: 100px; height: 100px max-width: 100%;" data-action="${sliders[i].link}">
                                <p>${sliders[i].name}</p>
                            </slide>`;
            }
        }
        return slideMarkup;
    };

    /**
     * @var Vue https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.min.js
     */

    new Vue({
        el: '#slider-elements',
        components: {
            'carousel': VueCarousel.Carousel,
            'slide': VueCarousel.Slide
        },
        template: '<div id="elements-carousel"><carousel :paginationEnabled="false" :navigationEnabled="true" :scrollPerPage="false" :perPageCustom="[[480, 4], [768, 5]]">' + buildSlideMarkup() + '</carousel></div>'
    });

    jQuery(document).on('click', "#elements-carousel .carousel-item-slide img", function (e) {
        let slug = e.target.getAttribute('data-action');
        console.log(slug);
        ajaxRequest(slug, (response) => {
                AppItems.elements = response;
                console.log(response);
            }
        );
    })

    let AppItems = new Vue({
        el: "#elements-products-item",
        data: {
            elements: '',
            products: [
                {
                    name: 'nombre del producto', img: 'https://mobiliarios-wp.test/wp-content/uploads/2024/07/galant-cajonera-con-ruedas-chapa-fresno-con-tinte-negro__0613253_pe686183_s5.avif'
                },
                {
                    name: 'nombre del producto', img: 'https://mobiliarios-wp.test/wp-content/uploads/2024/07/galant-cajonera-con-ruedas-chapa-fresno-con-tinte-negro__0613253_pe686183_s5.avif'
                },
                {
                    name: 'nombre del producto', img: 'https://mobiliarios-wp.test/wp-content/uploads/2024/07/galant-cajonera-con-ruedas-chapa-fresno-con-tinte-negro__0613253_pe686183_s5.avif'
                },
                {
                    name: 'nombre del producto', img: 'https://mobiliarios-wp.test/wp-content/uploads/2024/07/galant-cajonera-con-ruedas-chapa-fresno-con-tinte-negro__0613253_pe686183_s5.avif'
                },
                {
                    name: 'nombre del producto', img: 'https://mobiliarios-wp.test/wp-content/uploads/2024/07/galant-cajonera-con-ruedas-chapa-fresno-con-tinte-negro__0613253_pe686183_s5.avif'
                },
                {
                    name: 'nombre del producto', img: 'https://mobiliarios-wp.test/wp-content/uploads/2024/07/galant-cajonera-con-ruedas-chapa-fresno-con-tinte-negro__0613253_pe686183_s5.avif'
                },
                {
                    name: 'nombre del producto', img: 'https://mobiliarios-wp.test/wp-content/uploads/2024/07/galant-cajonera-con-ruedas-chapa-fresno-con-tinte-negro__0613253_pe686183_s5.avif'
                },
                {
                    name: 'nombre del producto', img: 'https://mobiliarios-wp.test/wp-content/uploads/2024/07/galant-cajonera-con-ruedas-chapa-fresno-con-tinte-negro__0613253_pe686183_s5.avif'
                }
            ]
        }
    });

    /**
     *
     * @param data
     * @param callback
     * @constructor
     */
    const ajaxRequest = (data, callback) => {
        jQuery.ajax({
            type: 'POST',
            url: mf_ajax_object.ajax_url,
            data: {
                action: 'my_action',
                security: mf_ajax_object.nonce,
                data: data
            },
            success: function(response) {
                if (typeof callback === 'function') {
                    callback(response);
                }
            },
            error: function() {
                console.log('Hubo un error en la solicitud AJAX.');
            }
        });
    }
}