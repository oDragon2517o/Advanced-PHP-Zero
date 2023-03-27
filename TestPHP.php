<?php

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


$Xmen = new men('Logan');
print_r($Xmen->username());
