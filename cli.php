<?php

use Dragon2517\AdvancedPhpZero\Blog\Commands;

use Dragon2517\AdvancedPhpZero\Blog\Commands\CreateUserCommand;
use Dragon2517\AdvancedPhpZero\Blog\Exceptions\InvalidArgumentException;
use Dragon2517\AdvancedPhpZero\Person\Name;
use Dragon2517\AdvancedPhpZero\Blog\Repositories\UsersRepository\InMemoryUsersRepository;
use Dragon2517\AdvancedPhpZero\Blog\Repositories\UsersRepository\UserNotFoundException;
use Dragon2517\AdvancedPhpZero\Blog\Repositories\UsersRepository\SqliteUsersRepository;
use Dragon2517\AdvancedPhpZero\Blog\User;
use Dragon2517\AdvancedPhpZero\Blog\UUID;



require_once __DIR__ . '/vendor/autoload.php';
// Создаём объект SQLite-репозитория
$usersRepository = new SqliteUsersRepository(
    new PDO('sqlite:' . __DIR__ . '/blog.sqlite')
);
// In-memory-репозиторий тоже подойдёт
// $usersRepository = new InMemoryUsersRepository();
// Команда зависит от контракта репозитория пользователей,
// так что мы передаём объект класса,
// реализующего этот контракт
$command = new CreateUserCommand($usersRepository);
try {
    // Запускаем команду
    $command->handle($argv);
} catch (Exception $e) {
    // Выводим сообщения об ошибках
    echo "{$e->getMessage()}\n";
}
