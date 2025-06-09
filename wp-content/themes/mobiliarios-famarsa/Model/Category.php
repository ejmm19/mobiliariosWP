<?php

namespace Model;

use Model\Product;

class Category
{

    public function getCategoryListHtml(): string
    {
        $categories = $this->getCategoriesPublicData();
        $html = '<ul id="category-list" class="list-group">';
        foreach ($categories as $category) {
            $html .= '<li class="list-group-item py-3">' .
                    '<a href="' . get_home_url() . '/categoria/?category=' . $category['link'] . '" class="" data-action="'.$category['link'].'">' .
                        $category['name'].
                    '</a>' .
                '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    public function getCategoriesPublicData(): array
    {
        $args = array(
            'taxonomy' => 'category',
            'exclude' => array(1),
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