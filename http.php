<?php

use Dragon2517\AdvancedPhpZero\Blog\Http\Request;
use Dragon2517\AdvancedPhpZero\Blog\Http\SuccessfulResponse;

require_once __DIR__ . '/vendor/autoload.php';
// if (!in_array("Some-Header", $_SERVER)) {
//     $_SERVER["Some-Header"] = 0;
// }

// print_r($_SERVER);
// $headerName = mb_strtoupper("http_" . str_replace('-', '_', $_SERVER["Some-Header"]));
// print_r($headerName);

$request = new Request($_GET, $_SERVER);
$parameter = $request->query('some_parameter');
$header = $request->header('Some-Header');
$path = $request->path();
// Создаём объект ответа
$response = new SuccessfulResponse([
    'message' => 'Hello from PHP',
]);
// Отправляем ответ
$response->send();


$os = array("Mac", "NT", "Irix", "Linux");
if (in_array("Irix", $os)) {
    echo "Нашёл Irix";
}
if (in_array("mac", $os)) {
    echo "Нашёл mac";
}
