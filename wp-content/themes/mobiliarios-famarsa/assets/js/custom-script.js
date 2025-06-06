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
        if (slug) {
            window.location.href = window.location.origin + '/categoria?category=' + slug;
        }
    });
}