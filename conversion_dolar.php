<?php
/**
 * Plugin Name: Conversión de Dólar a Quetzales
 * Plugin URI: https://github.com/Raul-OXRI/tipo_cambio 
 * Description: Este es un plugin que ayuda a visualizar a los clientes cómo está la conversión de dólar a quetzal.
 * Author: José Raúl Botzoc Mérida
 * Version: 0.0.5
 */

// Función para obtener el tipo de conversión de dólar
function get_conversion_Dolar() {
    // URL para obtener el tipo de cambio
    $url = "https://wise.com/es/currency-converter/usd-to-gtq-rate";

    // Opciones para la solicitud cURL
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.5359.95 Safari/537.36",
    );

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
    return $titleText;
}

// Incluye el archivo con la función para obtener el tipo de cambio
require_once(dirname(__FILE__) . '/includes/api.php');
?>

<div id="tipoConversion"></div>

<script>
// Función para obtener y mostrar el tipo de conversión de dólar
function display_conversion_dolar() {
    // Realiza una solicitud AJAX para obtener el tipo de cambio
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Actualiza el contenido del elemento con el nuevo valor
                document.getElementById("tipoConversion").innerHTML = xhr.responseText;
            }
        }
    };
    xhr.open('GET', '<?php echo admin_url('admin-ajax.php'); ?>?action=get_conversion_dolar', true);
    xhr.send();
}

// Ejecuta la función para mostrar el tipo de conversión de dólar al cargar la página
window.onload = function() {
    display_conversion_dolar();
    // Actualiza automáticamente cada 60 segundos
    setInterval(display_conversion_dolar, 60000);
};
</script>
