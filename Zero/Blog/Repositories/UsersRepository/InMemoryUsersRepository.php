<?php

namespace Dragon2517\AdvancedPhpZero\Blog\Repositories\UsersRepository;

use Dragon2517\AdvancedPhpZero\Blog\User;
use Dragon2517\AdvancedPhpZero\Blog\UUID;
use Dragon2517\AdvancedPhpZero\Blog\Exceptions\UserNotFoundException;

class InMemoryUsersRepository implements UsersRepositoryInterface
{
    /**
     * @var User[]
     */
    private array $users = [];
    public function save(User $user): void
    {
        $this->users[] = $user;
    }
    public function get(UUID $uuid): User
    {
        foreach ($this->users as $user) {
            if ((string)$user->uuid() === (string)$uuid) {
                return $user;
            }
        }
        throw new UserNotFoundException("User not found: $uuid");
    }
    // Добавили метод получения пользователя по username
    public function getByUsername(string $username): User
    {
        foreach ($this->users as $user) {
            if ($user->username() === $username) {
                return $user;
            }
        }
        throw new UserNotFoundException("User not found: $username");
    }
}
