<?php

namespace UsersRepository;

use PHPUnit\Framework\TestCase;
use Dragon2517\AdvancedPhpZero\Blog\Repositories\UsersRepository\SqliteUsersRepository;
use Dragon2517\AdvancedPhpZero\Blog\User;
use Dragon2517\AdvancedPhpZero\Blog\UUID;
use Dragon2517\AdvancedPhpZero\Person\Name;
use PDO;
use PDOStatement;
use PDOException;

class SqliteUsersRepositoryTest extends TestCase
{
    // Тест, проверяющий, что SQLite-репозиторий бросает исключение,
    // когда запрашиваемый пользователь не найден
    public function testItThrowsAnExceptionWhenUserNotFound(): void
    {
        // Сначала нам нужно подготовить все стабы
        // 2. Создаём стаб подключения
        $connectionStub = $this->createStub(PDO::class);
        // 4. Стаб запроса
        $statementStub = $this->createStub(PDOStatement::class);
        // 5. Стаб запроса будет возвращать false
        // при вызове метода fetch
        $statementStub->method('fetch')->willReturn(false);
        // 3. Стаб подключения будет возвращать другой стаб -
        // стаб запроса - при вызове метода prepare
        $connectionStub->method('prepare')->willReturn($statementMock);
        // 1. Передаём в репозиторий стаб подключения
        $repository = new SqliteUsersRepository($connectionStub);
        // Ожидаем, что будет брошено исключение
        $this->expectException(UserNotFoundException::class);
        $this->expectExceptionMessage('Cannot find user: Ivan');
        // Вызываем метод получения пользователя
        $repository->getByUsername('Ivan');
    }


    // Тест, проверяющий, что репозиторий сохраняет данные в БД
    public function testItSavesUserToDatabase(): void
    {
        // 2. Создаём стаб подключения
        $connectionStub = $this->createStub(PDO::class);
        // 4. Создаём мок запроса, возвращаемый стабом подключения
        $statementMock = $this->createMock(PDOStatement::class);
        // 5. Описываем ожидаемое взаимодействие
        // нашего репозитория с моком запроса
        $statementMock
            ->expects($this->once()) // Ожидаем, что будет вызван один раз
            ->method('execute') // метод execute
            ->with([ // с единственным аргументом - массивом
                ':uuid' => '123e4567-e89b-12d3-a456-426614174000',
                ':username' => 'ivan123',
                ':first_name' => 'Ivan',
                ':last_name' => 'Nikitin',
            ]);
        // 3. При вызове метода prepare стаб подключения
        // возвращает мок запроса
        $connectionStub->method('prepare')->willReturn($statementMock);
        // 1. Передаём в репозиторий стаб подключения
        $repository = new SqliteUsersRepository($connectionStub);
        // Вызываем метод сохранения пользователя
        $repository->save(
            new User( // Свойства пользователя точно такие,
                // как и в описании мока
                new UUID('123e4567-e89b-12d3-a456-426614174000'),
                'ivan123',
                new Name('Ivan', 'Nikitin')
            )
        );
    }
}
