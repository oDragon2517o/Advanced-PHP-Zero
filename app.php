<?php

require_once __DIR__ . '/vendor/autoload.php';

use Dragon2517\AdvancedPhpZero\Blog\Post;
use Dragon2517\AdvancedPhpZero\Person\Name;
use Dragon2517\AdvancedPhpZero\Person\Person;

$post = new Post(
    new Person(
        new Name('Иван', 'Никитин'),
        new DateTimeImmutable()
    ),
    'Всем привет!'
);

echo 'Zero';
print $post;
