<?php

namespace Dragon2517\Blog\UnitTests\Commands;

use Dragon2517\AdvancedPhpZero\Blog\Commands\Arguments;
use PHPUnit\Framework\TestCase;

class ArgumentsTest extends TestCase
{
    public function testItReturnsArgumentsValueByName(): void
    {
        // Подготовка
        $arguments = new Arguments(['some_key' => 'some_value']);
        // Действие
        $value = $arguments->get('some_key');
        // Проверка
        $this->assertEquals('some_value', $value);
    }
    public function testItReturnsValuesAsStrings(): void
    {
        $arguments = new Arguments(['some_key' => 123]);
        $value = $arguments->get('some_key');
        // Проверяем значение и тип
        $this->assertSame('123', $value);
        // Можно также явно проверить,
        // что значение является строкой
        $this->assertIsString($value);
    }
}
