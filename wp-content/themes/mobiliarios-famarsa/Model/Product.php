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
                [
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $category,
                ]
            ];
        }
        $args = [
            'post_type' => 'product',
            'posts_per_page' => $posts_per_page,
            'order' => 'ASC',
            'orderby' => 'title',
            'tax_query' => !empty($argsForCategory) ? $argsForCategory : [],
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
        $type = $attr['type'] ?? null; // Verifica si 'type' está definido, de lo contrario asigna null
        $elements = match ($type) {
            'categories' => $this->getCategoriesPublicData(),
            default => $this->getProductPublicData(),
        };
        $items = json_encode($elements);
        $contents = file_get_contents(get_template_directory() . '/elements/html/carousel-products.html'); // Cambia a ruta del sistema de archivos
        return str_replace("[elements]", $items, $contents);
    }

    public function getProductListByCategory($category): string
    {
        $type = $attr['type'] ?? null; // Verifica si 'type' está definido, de lo contrario asigna null
        $elements = match ($type) {
            'categories' => $this->getCategoriesPublicData(),
            default => $this->getProductPublicData(),
        };
        $items = json_encode($elements);
        $contents = file_get_contents(get_template_directory() . '/elements/html/product-list.html');
        $nonce = wp_create_nonce('mf_ajax_nonce');
        $ajax_url = admin_url('admin-ajax.php');
        $contents = str_replace("ajax_url", $ajax_url, $contents);
        $contents = str_replace("nonce", $nonce, $contents);
        return str_replace("[elements]", $items, $contents);
    }

    public function getCategoriesPublicData(): array
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
                'image' => !empty($custom_fields['category_image']) ? $custom_fields['category_image'] : './wp-content/uploads/2024/07/drawer-units-10711.avif',
                'link' => $category->slug,
                'position' => !empty($custom_fields['position']) ? (int)$custom_fields['position'] : PHP_INT_MAX, // Asigna un valor alto si no está definido
            ];
        }

        // Ordenar por el campo 'position'
        usort($categories, function ($a, $b) {
            return $a['position'] <=> $b['position'];
        });

        return $categories;
    }
}