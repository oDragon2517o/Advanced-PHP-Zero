<?php
// Файл для сощдание таблиц в БД

$pdo = new PDO('sqlite:blog.sqlite');


$pdo->exec(
    'CREATE TABLE users (
    uuid TEXT NOT NULL
    CONSTRAINT uuid_primary_key PRIMARY KEY,
    username TEXT NOT NULL
    CONSTRAINT username_unique_key UNIQUE,
    first_name TEXT NOT NULL,
    last_name TEXT NOT NULL

    )'

);
