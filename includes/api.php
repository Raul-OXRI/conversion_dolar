<?php

// URL para obtener el tipo de cambio
$url = "https://www.exchange-rates.org/es/conversor/usd-gtq";

// Opciones para la solicitud cURL
$options = array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.5359.95 Safari/537.36",
);

function get_conversion_Dolar(){
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
    $title = $dom->getElementsByTagName('span')->item(9);
    $titleText = $title->textContent;  
    return $titleText;
}