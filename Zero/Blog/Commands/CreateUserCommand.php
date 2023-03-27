<?php

namespace Dragon2517\AdvancedPhpZero\Blog\Commands;

use Dragon2517\AdvancedPhpZero\Person\Name;
use Dragon2517\AdvancedPhpZero\Blog\Repositories\UsersRepository\UsersRepositoryInterface;
use Dragon2517\AdvancedPhpZero\Blog\User;
use Dragon2517\AdvancedPhpZero\Blog\UUID;
use Dragon2517\AdvancedPhpZero\Blog\Exceptions;
use Dragon2517\AdvancedPhpZero\Blog\Exceptions\CommandException;
use Dragon2517\AdvancedPhpZero\Blog\Exceptions\UserNotFoundException;
use PDOStatement;
use PDO;

class CreateUserCommand
{
    public function __construct(
        private UsersRepositoryInterface $usersRepository
    ) {
    }
    // Вместо массива принимаем объект типа Arguments
    public function handle(Arguments $arguments): void
    {
        $username = $arguments->get('username');
        if ($this->userExists($username)) {
            throw new CommandException("User already exists: $username");
        }
        $this->usersRepository->save(new User(
            UUID::random(),
            $username,
            new Name($arguments->get('first_name'), $arguments->get('last_name'))
        ));
    }
    private function userExists(string $username): bool
    {
        try {
            $this->usersRepository->getByUsername($username);
        } catch (UserNotFoundException) {
            return false;
        }
        return true;
    }
}
