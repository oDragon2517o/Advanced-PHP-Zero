<?php

namespace Dragon2517\AdvancedPhpZero\Blog;

use Dragon2517\AdvancedPhpZero\Person\Person;


class Post
{
    public function __construct(
        private Person $author,
        private string $text
    ) {
    }
    public function __toString()
    {
        return $this->author . ' пишет: ' . $this->text;
    }
}
