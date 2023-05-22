<?php

goto a;

class name
{
    private string $Name;

    public function __construct(string $Name)
    {
        $this->Name = $Name;
    }
}

class men
{
    public function __construct(
        private name $username
    ) {
    }
    public function username(): name
    {
        return $this->username;
    }
}


$Xmen = new men(new name('Logan'));
print_r($Xmen->username());

exit;

print_r($argv);
$arguments = [];
foreach ($argv as $argument) {
    $parts = explode('=', $argument);
    if (count($parts) !== 2) {
        continue;
    }
    $arguments[$parts[0]] = $parts[1];
}
print_r($arguments);

a:

class koleso
{
    private int $a;
    private int $b;
    public function __construct($a, $b)
    {
        $this->a = $a;
        $this->b = $b;
    }

    public function radius()
    {
        echo $this->a . " \n";
    }

    static function diametr($c)
    {
        // echo "$c->b" . " \n";
        $c->b;
    }

    public function getB()
    {
        echo $this->b;
    }
}

class poezd extends koleso
{
}
$koleso = new koleso('20', '40');
$koleso->radius();


$koleso::diametr("100");

$poezd = new poezd('10', '20');
$poezd->radius();
$poezd::diametr("100");

$poezd2 = new poezd('10', '20');
$poezd2->radius();
// $poezd2::diametr("200");
$poezd2->getB();





class Person
{
    public $name, $age;
    static $retirenmentAge = 65;
    function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }
    function sayHello()
    {
        echo "Привет, меня зовут $this->name<br>";
    }
    static function printPerson($person)
    {
        echo "Имя: $person->name Возраст: $person->age<br>";
    }
}
