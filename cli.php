<?php


use Dragon2517\AdvancedPhpZero\Blog\Commands\CreateUserCommand;
use Dragon2517\AdvancedPhpZero\Blog\Repositories\UsersRepository\SqliteUsersRepository;
use Dragon2517\AdvancedPhpZero\Blog\Commands\Arguments;
use Dragon2517\AdvancedPhpZero\Blog\Exceptions\AppException;


// $username = 'ivan';
// $first_name = 'Ivan';
// $last_name = 'Nikitin';

require_once __DIR__ . '/vendor/autoload.php';
$usersRepository = new SqliteUsersRepository(
    new PDO('sqlite:' . __DIR__ . '/blog.sqlite')
);
$command = new CreateUserCommand($usersRepository);
try {
    // "Заворачиваем" $argv в объект типа Arguments
    $command->handle(Arguments::fromArgv($argv));
}
// Так как мы добавили исключение ArgumentsException
// имеет смысл обрабатывать все исключения приложения,
// а не только исключение CommandException
catch (AppException $e) {
    echo "{$e->getMessage()}\n";
}
