<?php

namespace Dragon2517\AdvancedPhpZero\Blog\Http\Actions\Posts;

use Dragon2517\AdvancedPhpZero\Blog\Exceptions\InvalidArgumentException;
use Dragon2517\AdvancedPhpZero\Blog\Http\Actions\ActionInterface;
use Dragon2517\AdvancedPhpZero\Blog\Http\ErrorResponse;
use Dragon2517\AdvancedPhpZero\Blog\Http\HttpException;
use Dragon2517\AdvancedPhpZero\Blog\Http\Request;
use Dragon2517\AdvancedPhpZero\Blog\Http\Response;
use Dragon2517\AdvancedPhpZero\Blog\Http\SuccessfulResponse;
use Dragon2517\AdvancedPhpZero\Blog\Post;
use Dragon2517\AdvancedPhpZero\Blog\Repositories\PostsRepository\PostsRepositoryInterface;
use Dragon2517\AdvancedPhpZero\Blog\Exceptions\UserNotFoundException;
use Dragon2517\AdvancedPhpZero\Blog\Repositories\UsersRepository\UsersRepositoryInterface;
use Dragon2517\AdvancedPhpZero\Blog\UUID;

class CreatePost implements ActionInterface
{
    // Внедряем репозитории статей и пользователей
    public function __construct(
        private PostsRepositoryInterface $postsRepository,
        private UsersRepositoryInterface $usersRepository,
    ) {
    }
    public function handle(Request $request): Response
    {
        // Пытаемся создать UUID пользователя из данных запроса
        try {
            $authorUuid = new UUID($request->jsonBodyField('author_uuid'));
        } catch (HttpException | InvalidArgumentException $e) {
            return new ErrorResponse($e->getMessage());
        }
        // Пытаемся найти пользователя в репозитории
        try {
            $this->usersRepository->get($authorUuid);
        } catch (UserNotFoundException $e) {
            return new ErrorResponse($e->getMessage());
        }
        // Генерируем UUID для новой статьи
        $newPostUuid = UUID::random();
        try {
            // Пытаемся создать объект статьи
            // из данных запроса
            $post = new Post(
                $newPostUuid,
                $authorUuid,
                $request->jsonBodyField('title'),
                $request->jsonBodyField('text'),
            );
        } catch (HttpException $e) {
            return new ErrorResponse($e->getMessage());
        }
        // Сохраняем новую статью в репозитории
        $this->postsRepository->save($post);
        // Возвращаем успешный ответ,
        // содержащий UUID новой статьи
        return new SuccessfulResponse([
            'uuid' => (string)$newPostUuid,
        ]);
    }
}
