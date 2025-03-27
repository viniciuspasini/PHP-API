<?php

namespace Vinip\Api\Models;

class Database
{
    public static function getConnection()
    {
        return new \PDO("mysql:host=localhost;dbname=api", "root", "123456");
    }
}