<?php
// Файл для сощдание/пересоздания БД


if (file_exists('blog.sqlite')) {
    unlink('blog.sqlite');
}


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

$pdo->exec(
    'CREATE TABLE posts (
    uuid TEXT NOT NULL
    CONSTRAINT uuid_primary_key PRIMARY KEY,
    author_uuid TEXT NOT NULL
    CONSTRAINT author_uuid UNIQUE,
    title TEXT NOT NULL,
    text TEXT NOT NULL

    )'
);

$pdo->exec(
    'CREATE TABLE comments (
    uuid TEXT NOT NULL
    CONSTRAINT uuid_primary_key PRIMARY KEY,
    post_uuid TEXT NOT NULL
    CONSTRAINT post_uuid UNIQUE,
    author_uuid TEXT NOT NULL
    CONSTRAINT author_uuid UNIQUE,
    last_name TEXT NOT NULL

    )'
);
