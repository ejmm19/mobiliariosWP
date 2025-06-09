<?php

function registrar_config_telefono() {
    register_setting('general', 'telefono_principal');
    add_settings_field(
        'telefono_principal',
        'Teléfono Principal (para Whatsapp)',
        'mostrar_campo_telefono',
        'general'
    );
}
add_action('admin_init', 'registrar_config_telefono');

function mostrar_campo_telefono() {
    $value = get_option('telefono_principal', '');
    echo '<input type="text" id="telefono_principal" name="telefono_principal" value="' . esc_attr($value) . '" />';
}
