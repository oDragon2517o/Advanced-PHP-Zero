<?php

namespace Dragon2517\AdvancedPhpZero\Blog\Repositories\UsersRepository;

use Dragon2517\AdvancedPhpZero\Blog\User;
use Dragon2517\AdvancedPhpZero\Blog\UUID;

class InMemoryUsersRepository implements UsersRepositoryInterface
{
    private array $users = [];
    public function save(User $user): void
    {
        $this->users[] = $user;
    }
    // Заменили int на UUID
    public function get(UUID $uuid): User
    {
        foreach ($this->users as $user) {
            // Сравниваем строковые представления UUID
            if ((string)$user->uuid() === (string)$uuid) {
                return $user;
            }
        }
        throw new UserNotFoundException("User not found: $uuid");
    }
}
