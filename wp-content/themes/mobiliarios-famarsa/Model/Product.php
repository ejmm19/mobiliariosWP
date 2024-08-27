<?php

namespace Model;

use WP_Query;

class Product
{
    /**
     * @param int $posts_per_page
     * @param $category
     * @return WP_Query
     */
    public function getProducts(int $posts_per_page = -1, $category = null): WP_Query
    {
        $argsForCategory = [];
        if (!empty($category)) {
            $argsForCategory = [
                        'taxonomy' => 'category',
                        'field' => 'slug',
                        'terms' => 'credenzas'
            ];
        }
        $args = [
            'post_type' => 'product',
            'posts_per_page' => $posts_per_page,
            'order' => 'ASC',
            'orderby' => 'title',
            'tax_query' => $argsForCategory
        ];
        return new WP_Query($args);
    }

    protected function getProductPublicData(): array
    {
        $products = $this->getProducts();
        $publicData = [];
        if ($products->have_posts()) {
            while ($products->have_posts()) {
                $products->the_post();
                $publicData[] = [
                    'name' => get_the_title(),
                    'image' => get_the_post_thumbnail_url(),
                    'link' => get_the_permalink(),
                ];
            }
        }
        wp_reset_postdata();
        return $publicData;
    }

    public function getProductList($limit = -1): string
    {
        $products = $this->getProducts($limit);
        ob_start();
        echo '<div id="product-list" class="my-5">'.
                '<h2 class="text-center">' . __('Products') . '</h2>'.
                '<div class="row">';
                    if ($products->have_posts()) {
                        while ($products->have_posts()) {
                            $products->the_post(); ?>
                            <div class="col-lg-4 col-sm-6 col-12 product-item">
                                <a href="<?php the_permalink(); ?>">
                                    <figure class="px-1">
                                        <?php the_post_thumbnail("large", ['class' => 'image-hover']); ?>
                                        <div class="middle">
                                            <div class="text"><?= __('View product') ?></div>
                                        </div>
                                    </figure>
                                    <h4 class="my-3 text-center">
                                        <?php the_title(); ?>
                                    </h4>
                                </a>
                            </div>
                            <?php
                        }
                    }
        echo '</div>';
                if ($limit > -1) {
                    echo '<div class="text-center">'.
                            '<a href="'.home_url().'/productos">'.__('View more').'</a>'.
                        '</div>';
                }
        echo '</div>';

        wp_reset_postdata();

        return ob_get_clean();
    }

    /**
     * @param $attr
     * @return string
     */
    public function getCarousel($attr): string
    {
        $elements = match ($attr['type']) {
            'categories' => $this->getCategoriesPublicData(),
            default => $this->getProductPublicData(),
        };
        $items = json_encode($elements);
        $contents = file_get_contents(get_template_directory_uri().'/elements/html/carousel-products.html');
        return str_replace("[elements]", $items, $contents);
    }

    private function getCategoriesPublicData(): array
    {
        $args = array(
            'taxonomy' => 'category',
            'exclude' => array(1),
            'orderby' => 'name',
            'order' => 'ASC',
            "hide_empty" => 1,
        );
        $query = get_categories($args);
        $categories = [];
        foreach ($query as $category) {
            $custom_fields = get_fields($category);
            $categories[] = [
                'name' => $category->name,
                'image' => /*!empty($custom_fields['imagen']) ? $custom_fields['imagen'] :*/ 'https://mobiliarios-wp.test/wp-content/uploads/2024/07/drawer-units-10711.avif',
                'link' => $category->slug,
            ];
        }
        return $categories;
    }
}