<?php

namespace Dragon2517\AdvancedPhpZero\Blog\Http\Actions;

use Dragon2517\AdvancedPhpZero\Blog\Http\Request;
use Dragon2517\AdvancedPhpZero\Blog\Http\Response;

interface ActionInterface
{
    public function handle(Request $request): Response;
}
