<?php

class UserController
{
    private $ModelUser;

    public function __construct()
    {
        $this->ModelUser = new ModelUser();
    }

    public function register($firstame, $lastname, $email, $password)
    {
        $result = $this->ModelUser->register($firstame, $lastname, $email, $password);
        return $result;
    }
    
}