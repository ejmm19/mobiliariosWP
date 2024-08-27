<?php
/**
 * @return void
 */
function assets(): void
{
    wp_register_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
        '',
        '5.3.3',
        'all'
    );
    wp_register_style(
        'ubuntu',
        'https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap',
        '',
        '1.0',
        'all'
    );
    wp_register_style(
        'NotoSans',
        'https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap',
        '',
        '1.0',
        'all'
    );
    wp_enqueue_style('stylesheet', get_stylesheet_uri(), ['bootstrap', 'ubuntu', 'NotoSans'], '1.0', 'all');

    wp_register_script(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
        '',
        '5.3.3',
        true
    );

    wp_enqueue_script( 'vue', 'https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.js', ['jquery'], '2.5.16', true );
    wp_enqueue_script( 'vue-carousel', 'https://cdn.jsdelivr.net/npm/vue-carousel@0.18.0/dist/vue-carousel.min.js', ['jquery', 'vue'], '2.5.16', true );
    wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/assets/js/custom-script.js', ['vue-carousel'], '1.0', true);
    wp_localize_script('custom-script', 'mf_ajax_object', array('ajax_url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('mf_ajax_nonce')));

}

add_action('wp_enqueue_scripts', 'assets');