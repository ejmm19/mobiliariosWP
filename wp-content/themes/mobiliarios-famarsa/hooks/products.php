<?php
function products_type(): void
{
    $labels = [
        'name' => 'Productos',
        'singular_name' => 'Producto',
        'menu_name' => 'Productos',
        'add_new_item' => __('Add new Producto', 'product'),
        'new_item' => __('New Producto', 'product'),
    ];

    $args = [
        'label' => 'Productos',
        'description' => 'Productos de mobiliarios famarsa',
        'labels' => $labels,
        'supports' => ['title', 'editor', 'thumbnail', 'revisions'],
        'public' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-store',
        'can_export' => true,
        'publicly_queryable' => true,
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'product'],
    ];
    register_post_type('product', $args);
}

add_action('init', 'products_type');

function reg_cat(): void
{
    register_taxonomy_for_object_type('category','product');
}
add_action('init', 'reg_cat');


function mf_ajax_handler(): void
{
    check_ajax_referer('mf_ajax_nonce', 'security');
    $category = $_POST['data'] ?? '';
    if (!empty($category)) {
        $productModel = new \Model\Product();
        $products = $productModel->getProducts(10, $category);
    }
    $response = [
        'message' => '¡Llamada AJAX exitosa!'
    ];

    wp_send_json_success($response);
}
add_action('wp_ajax_my_action', 'mf_ajax_handler');
add_action('wp_ajax_nopriv_my_action', 'mf_ajax_handler');