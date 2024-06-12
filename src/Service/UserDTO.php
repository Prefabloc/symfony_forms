<?php

namespace App\Service;

class UserDTO
{
    public $username;

    public function __construct($username)
    {
        $this->username = $username;
    }
}