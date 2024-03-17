<?php
// Este script é um proxy simples para encaminhar solicitações HTTP para a API do Last.fm usando HTTPS.

$apiKey = "9e06728c486bda235dbc686173e8b6c3"; // Sua chave de API do Last.fm
$apiUrl = "https://ws.audioscrobbler.com/2.0/";

// Verifica se foi fornecido um nome de artista na consulta.
if (isset($_GET['artist'])) {
    // Obtém o nome do artista da consulta.
    $artist = $_GET['artist'];

    // Monta a URL da API do Last.fm.
    $url = "$apiUrl?method=artist.gettoptracks&artist=" . urlencode($artist) . "&api_key=$apiKey&format=json";

    // Faz a solicitação à API do Last.fm usando cURL.
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Retorna a resposta da API do Last.fm.
    header('Content-Type: application/json');
    echo $response;
} else {
    // Se nenhum nome de artista foi fornecido, retorna um erro.
    http_response_code(400);
    echo json_encode(array("error" => "Nome do artista não fornecido."));
}
?>
