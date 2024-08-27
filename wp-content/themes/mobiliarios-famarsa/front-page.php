<?php

use Model\Product;

require_once 'Model/Product.php';
$productModel = new Product();
?>

<?php get_header(); ?>
    <main id="home-view" class="container">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : ?>
                <?php the_post(); ?>
                <div class="container-fluid panoramic-image" style="background-image: url('<?= get_field('imagen_background_1') ?>')"></div>
                <?php the_content(); ?>
            <?php endwhile; ?>
        <?php endif; ?>
        <!--products-->
    </main>
<?php get_footer(); ?>