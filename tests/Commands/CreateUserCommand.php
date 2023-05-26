<?php

namespace Dragon2517\Blog\UnitTests\Commands;

use Dragon2517\AdvancedPhpZero\Blog\Commands\Arguments;
use Dragon2517\AdvancedPhpZero\Blog\Commands\CommandException;
use Dragon2517\AdvancedPhpZero\Blog\Commands\CreateUserCommand;
use Dragon2517\AdvancedPhpZero\Blog\Repositories\UsersRepository\DummyUsersRepository;
use Dragon2517\AdvancedPhpZero\Blog\Repositories\UsersRepository\UsersRepositoryInterface;
use Dragon2517\AdvancedPhpZero\Blog\User;
use Dragon2517\AdvancedPhpZero\Blog\UUID;
use Dragon2517\AdvancedPhpZero\Blog\Exceptions\UserNotFoundException;
use PHPUnit\Framework\TestCase;

class CreateUserCommandTest extends TestCase
{
    // Проверяем, что команда создания пользователя бросает исключение,
    // если пользователь с таким именем уже существует

    public function testItThrowsAnExceptionWhenUserAlreadyExists(): void
    {
        $command = new CreateUserCommand(
            // Передаём наш стаб в качестве реализации UsersRepositoryInterface
            new DummyUsersRepository()
        );
        $this->expectException(CommandException::class);
        $this->expectExceptionMessage('User already exists: Ivan');
        $command->handle(new Arguments(['username' => 'Ivan']));
    }


    // // Тест проверяет, что команда действительно требует имя пользователя
    // public function testItRequiresFirstName(): void
    // {
    //     // $usersRepository - это объект анонимного класса,
    //     // реализующего контракт UsersRepositoryInterface
    //     $usersRepository = new class implements UsersRepositoryInterface
    //     {
    //         public function save(User $user): void
    //         {
    //             // Ничего не делаем
    //         }
    //         public function get(UUID $uuid): User
    //         {
    //             // И здесь ничего не делаем
    //             throw new UserNotFoundException("Not found");
    //         }
    //         public function getByUsername(string $username): User
    //         {
    //             // И здесь ничего не делаем
    //             throw new UserNotFoundException("Not found");
    //         }
    //     };
    //     // Передаём объект анонимного класса
    //     // в качестве реализации UsersRepositoryInterface
    //     $command = new CreateUserCommand($usersRepository);
    //     // Ожидаем, что будет брошено исключение
    //     $this->expectException(ArgumentsException::class);
    //     $this->expectExceptionMessage('No such argument: first_name');
    //     // Запускаем команду
    //     $command->handle(new Arguments(['username' => 'Ivan']));
    // }





    // Функция возвращает объект типа UsersRepositoryInterface
    private function makeUsersRepository(): UsersRepositoryInterface
    {
        return new class implements UsersRepositoryInterface
        {
            public function save(User $user): void
            {
            }
            public function get(UUID $uuid): User
            {
                throw new UserNotFoundException("Not found");
            }
            public function getByUsername(string $username): User
            {
                throw new UserNotFoundException("Not found");
            }
        };
    }
    // Тест проверяет, что команда действительно требует фамилию пользователя
    public function testItRequiresLastName(): void
    {
        // Передаём в конструктор команды объект, возвращаемый нашей функцией
        $command = new CreateUserCommand($this->makeUsersRepository());
        $this->expectException(ArgumentsException::class);
        $this->expectExceptionMessage('No such argument: last_name');
        $command->handle(new Arguments([
            'username' => 'Ivan',
            // Нам нужно передать имя пользователя,
            // чтобы дойти до проверки наличия фамилии
            'first_name' => 'Ivan',
        ]));
    }
    // Тест проверяет, что команда действительно требует имя пользователя
    public function testItRequiresFirstName(): void
    {
        // Вызываем ту же функцию
        $command = new CreateUserCommand($this->makeUsersRepository());
        $this->expectException(ArgumentsException::class);
        $this->expectExceptionMessage('No such argument: first_name');
        $command->handle(new Arguments(['username' => 'Ivan']));
    }




    // Тест, проверяющий, что команда сохраняет пользователя в репозитории
    public function testItSavesUserToRepository(): void
    {
        // Создаём объект анонимного класса
        $usersRepository = new class implements UsersRepositoryInterface
        {
            // В этом свойстве мы храним информацию о том,
            // был ли вызван метод save
            private bool $called = false;
            public function save(User $user): void
            {
                // Запоминаем, что метод save был вызван
                $this->called = true;
            }
            public function get(UUID $uuid): User
            {
                throw new UserNotFoundException("Not found");
            }
            public function getByUsername(string $username): User
            {
                throw new UserNotFoundException("Not found");
            }
            // Этого метода нет в контракте UsersRepositoryInterface,
            // но ничто не мешает его добавить.
            // С помощью этого метода мы можем узнать,
            // был ли вызван метод save
            public function wasCalled(): bool
            {
                return $this->called;
            }
        };
        // Передаём наш мок в команду
        $command = new CreateUserCommand($usersRepository);
        // Запускаем команду
        $command->handle(new Arguments([
            'username' => 'Ivan',
            'first_name' => 'Ivan',
            'last_name' => 'Nikitin',
        ]));
        // Проверяем утверждение относительно мока,
        // а не утверждение относительно команды
        $this->assertTrue($usersRepository->wasCalled());
    }
}
