<?php
/** Translate */

/**
 * @param $translation
 * @return array|string
 */
function substitution_predefined_texts($translation): array|string
{
    $words = [
        'View more' => 'Ver más',
        'Products' => 'Productos',
        'View product' => 'Ver producto'
    ];
    return str_ireplace(array_keys($words), $words, $translation);
}
add_filter('gettext', 'substitution_predefined_texts');
add_filter('ngettext', 'substitution_predefined_texts');
