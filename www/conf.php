<?php

# настройки
define ('DB_HOST', 'db');
define ('DB_LOGIN', 'root');
define ('DB_PASSWORD', 'test');
define ('DB_NAME', 'Preproduction');
$connection = new mysqli(DB_HOST, DB_LOGIN, DB_PASSWORD) or die ("MySQL Error: " . $connection->error);

$connection->query("set names utf8") or die ("<br>Invalid query: " . $connection->error);
$connection->select_db(DB_NAME) or die ("<br>Invalid query: " . $connection->error);



$error[0] = 'Я вас не знаю';
$error[1] = 'Включіть куки';
$error[2] = 'Вам сюди не можна';
?>