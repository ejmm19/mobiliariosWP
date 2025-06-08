<?php
declare(strict_types=1);

require_once get_template_directory() . '/Model/Category.php';

use Model\Product;
use Model\Category;

/** Shortcodes **/
function productsList($attr = ['limit' => -1]): string
{
    $products = new Product();
    return $products->getProductList(!empty($attr) ? $attr['limit'] : '');
}

add_shortcode('products_list', 'productsList');

function carouselProductsList($attr): string
{
    $products = new Product();
    return $products->getCarousel($attr);
}

add_shortcode('carousel_products_list', 'carouselProductsList');

function categoryList(): string
{
    $category = new Category();
    return $category->getCategoryListHtml();
}

add_shortcode('category_list', 'categoryList');

function productListByCategory($category = ''): string
{
    $category = sanitize_text_field($category);
    $products = new Product();
    return $products->getProductListByCategory($category);
}

add_shortcode('product_list_by_category', 'productListByCategory');

function showPreloader(): string
{
    ob_start();
    ?>
    <div id="preloader" class="align-content-center opacity-75 d-flex h-100 justify-content-center w-100 position-absolute z-1">
        <img src="<?= get_template_directory_uri(); ?>/assets/img/spinner.svg" width="50px" alt="">
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('show_preloader', 'showPreloader');

function featuredProductsList($attr = ['limit' => -1]): string
{
    $products = new Product();
    return $products->getFeaturedProducts(!empty($attr) ? $attr['limit'] : '');
}
add_shortcode('featured_products_list', 'featuredProductsList');

/** Shortcodes **/