<?php
/**
* Plugin Name: Conversion de Dólar a Quetzales
 * Plugin URI: https://github.com/Raul-OXRI/tipo_cambio 
 * Description: Este es un plugin que ayuda a visualizar a los clientes cómo está la conversión de dólar a quetzal.
 * Author: José Raúl Botzoc Mérida
 * Version: 0.0.5
 */

// URL para obtener el tipo de cambio
$url = "https://wise.com/es/currency-converter/usd-to-gtq-rate";

// Opciones para la solicitud cURL
$options = array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.5359.95 Safari/537.36",
);

// Función para obtener el tipo de conversión de dólar
function get_tipo_conversion_dolar() {
    global $options;

    // Inicia una solicitud cURL
    $ch = curl_init();
    curl_setopt_array($ch, $options);

    // Realiza la solicitud
    $response = curl_exec($ch);
    curl_close($ch);

    // Analiza el HTML para obtener el tipo de cambio
    $dom = new DOMDocument();
    @$dom->loadHTML($response); // La '@' suprime los errores de HTML si el documento no está bien formado

    // Busca el elemento que contiene el tipo de cambio
    $title = $dom->getElementsByTagName('span')->item(24);
    $titleText = $title->textContent;

    // Formatea la salida
    $output = "Conversion de USD a GTQ:<br>";
    $output .= $titleText . "<br>";

    return $output;
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
