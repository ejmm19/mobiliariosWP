<?php

/** Shortcodes **/
function productsList($attr = ['limit' => -1]): string
{
    $products = new \Model\Product();
    return $products->getProductList(!empty($attr) ? $attr['limit'] : '');
}

add_shortcode('products_list', 'productsList');

function carouselProductsList($attr): string
{
    $products = new \Model\Product();
    return $products->getCarousel($attr);
}

add_shortcode('carousel_products_list', 'carouselProductsList');
/** Shortcodes **/