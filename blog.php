<?php
// Файл для сощдание таблиц в БД

$pdo = new PDO('sqlite:blog.sqlite');


$pdo->exec(
    'CREATE TABLE users (
        first_name TEXT,
        last_name TEXT,
        uuid TEXT
    )'

);
