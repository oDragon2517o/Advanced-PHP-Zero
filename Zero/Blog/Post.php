<?php

namespace Dragon2517\AdvancedPhpZero\Blog;

use Dragon2517\AdvancedPhpZero\Person\Person;


class Post
{
    public function __construct(
        private UUID $uuid,
        private User $userUuid,
        private string $title,
        private string $text,
    ) {
    }

    public function uuid(): UUID
    {
        return $this->uuid;
    }


    public function getUser(): User
    {
        return $this->userUuid;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }


    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }
    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    // public function __toString()
    // {
    //     return $this->uuid();
    // }
}
