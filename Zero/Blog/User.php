<?php

namespace Dragon2517\AdvancedPhpZero\Blog;

use Dragon2517\AdvancedPhpZero\Person\Name;

class User
{
    // private int $id;
    // private Name $username;
    // private string $login;
    // private UUID $uuid;


    public function __construct(
        private UUID $uuid,
        private string $username,
        private Name $name
    ) {
    }
    public function username(): string
    {
        return $this->username;
    }


    // public function __toString(): string
    // {
    //     return "Юзер $this->id с именем $this->username и логином $this->login." . PHP_EOL;
    // }


    public function uuid(): UUID
    {
        return $this->uuid;
    }


    /**
     * @return int
     */
    // public function id(): int
    // {
    //     return $this->id;
    // }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        // $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param Name $username
     */
    public function setUsername(Name $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    // public function getLogin(): string
    // {
    //     return $this->login;
    // }

    /**
     * @param string $login
     */
    // public function setLogin(string $login): void
    // {
    //     $this->login = $login;
    // }

    /**
     * @return Name
     */
    public function name(): Name
    {
        return $this->name;
    }


    public function __toString()
    {
        return $this->uuid();
    }
}
