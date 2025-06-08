<?php get_header(); ?>
<main id="product-view" class="container view-<?= $post->post_name ?>">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post(); ?>
                <?php if (has_post_thumbnail()) : ?>
                <div class="p-5" id="product-view-app">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <img id="img-preview" class="w-100" :src="mainImage" alt="Imagen principal">
                            <div class="col-12">
                                <div class="row mt-3">
                                    <div class="col-6 col-md-3 mb-2" v-for="image in images" :key="image">
                                        <img class="w-100" :src="image" alt="Imagen adicional" @click="updateMainImage(image)">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <h1 id="title-page" class="text-black"><?php the_title(); ?></h1>
                            <?php the_content(); ?>
                            <?php
                            $whatsapp = esc_html(get_option('telefono_principal'));
                            $enlace_actual = get_permalink();
                            $msj = "Hola, me gustaría cotizar el producto: " . get_the_title() . ". Aquí está el enlace: " . $enlace_actual;
                            $link = "https://api.whatsapp.com/send?phone={$whatsapp}&text={$msj}";
                            ?>
                            <a class="btn btn-success rounded-5 w-75 mt-5" href="<?= $link ?>" target="_blank">Cotizar producto</a>
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const vueApp = new Vue({
                            el: '#product-view-app',
                            data: {
                                mainImage: '<?= get_the_post_thumbnail_url() ?>',
                                images: [
                                    '<?= get_the_post_thumbnail_url() ?>',
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) {
                                        $image = get_field('img_' . $i);
                                        if ($image) {
                                            echo "'$image',";
                                        }
                                    }
                                    ?>
                                ]
                            },
                            methods: {
                                updateMainImage(image) {
                                    this.mainImage = image;
                                }
                            }
                        });
                    });
                </script>
                <?php endif;?>
        <?php   }
    } ?>
</main>
<?php get_footer(); ?>
