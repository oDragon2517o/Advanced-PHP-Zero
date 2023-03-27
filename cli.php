<?php

use Dragon2517\AdvancedPhpZero\Person\Name;
use Dragon2517\AdvancedPhpZero\Blog\Repositories\UsersRepository\InMemoryUsersRepository;
use Dragon2517\AdvancedPhpZero\Blog\Repositories\UsersRepository\UserNotFoundException;
use Dragon2517\AdvancedPhpZero\Blog\Repositories\UsersRepository\SqliteUsersRepository;
use Dragon2517\AdvancedPhpZero\Blog\User;
use Dragon2517\AdvancedPhpZero\Blog\UUID;



require_once __DIR__ . '/vendor/autoload.php';
//Создаём объект подключения к SQLite
$connection = new PDO('sqlite:' . __DIR__ . '/blog.sqlite');
//Создаём объект репозитория
$usersRepository = new SqliteUsersRepository($connection);
//Добавляем в репозиторий несколько пользователей
$usersRepository->save(new User(UUID::random(), new Name('Ivan', 'Nikitin')));
$usersRepository->save(new User(UUID::random(), new Name('Anna', 'Petrova')));
