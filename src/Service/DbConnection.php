<?php

namespace App\Service;

class DbConnection
{
    public function connect(string $dbname, string $dbuser, ?string $dbpaswword = null): \PDO
    {
        return new \PDO('mysql:host=mysql;dbname='.$dbname, $dbuser, $dbpaswword);
    }
}
