<?php get_header(); ?>
    <main class="container view-<?= $post->post_name ?>">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post(); ?>
                <h1 id="title-page" class="text-center text-white"><?php the_title(); ?></h1>
                <div class="container-fluid panoramic-image" style="background-image: url('<?= get_field('imagen_background_1') ?>')"></div>
                <?php the_content(); ?>
            <?php   }
        } ?>
    </main>
<?php get_footer(); ?>
