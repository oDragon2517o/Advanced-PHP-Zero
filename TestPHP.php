<?php





class PersonInvalidAgeException extends Exception
{
    function __construct($age)
    {
        $this -> message = "Недействительный возраст: $age. Возраст должен быть в диапазоне от 0 до 120";
    }
}
class Person
{
    private $name, $age;
    function __construct($name, $age)
    {
        $this->name = $name;
        if($age < 0)
        {
            throw new PersonInvalidAgeException($age);
        }
        $this->age = $age;
    }
    function printInfo()
    {
        echo "Name: $this->name<br>Age: $this->age";
    }
}
 
try
{
    $tom = new Person("Tom", -105);
    $tom->printInfo();
}
catch(PersonInvalidAgeException $ex2)
{
    echo $ex2 -> getMessage();
}