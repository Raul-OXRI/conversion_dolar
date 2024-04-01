<?php
/**
* Plugin Name: Conversion de Dólar a Quetzales
 * Plugin URI: https://github.com/Raul-OXRI/tipo_cambio 
 * Description: Este es un plugin que ayuda a visualizar a los clientes cómo está la conversión de dólar a quetzal.
 * Author: José Raúl Botzoc Mérida
 * Version: 0.0.5
 */

require_once(dirname(__FILE__) . '/includes/api.php' );


function get_tipo_conversion_dolar() {
    $tipo_texto = get_conversion_Dolar();
    // 19x px de largo
    //de ancho  1px
    echo '
    <div style="margin: 8px 0 0; padding: 20px; text-align: center;">
    <div style="align-items: center; justify-content: space-between; padding: 7px; width: 200px; background-color: #ffffff;">
        <h2 style="font-size: 16px; margin: 0; font-family: Montserrat, sans-serif; color: #052a60; margin-top:5px">Conversión USD a GTQ</h2>
        <span style="font-weight: bold; color: #052a60;">' . $tipo_texto . '</span>
    </div>
</div>

    ';
}

// Registra el shortcode para mostrar el tipo de conversión de dólar
add_shortcode('conversion_dolar', 'get_tipo_conversion_dolar');

// Función que se ejecuta al activar el plugin (puedes agregar alguna funcionalidad aquí)
register_activation_hook(__FILE__, 'activate_tipo_cambio_dolar');

// Función que se ejecuta al desactivar el plugin (puedes agregar alguna funcionalidad aquí)
register_deactivation_hook(__FILE__, 'deactivate_tipo_cambio_dolar');

// Estas funciones están vacías, puedes llenarlas con alguna lógica si es necesario
function activate_tipo_cambio_dolar() {}
function deactivate_tipo_cambio_dolar() {}
