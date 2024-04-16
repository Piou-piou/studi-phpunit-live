<?php

use App\Service\DbConnection;
use PHPUnit\Framework\TestCase;

class DbConnectionTest extends TestCase
{
    private ?PDO $pdo = null;

    public function testBadDbConnection()
    {
        $this->expectException(PDOException::class);

        $dbConnection = new DbConnection();
        $dbConnection->connect('unexisting_database', 'root');
    }

    public function testDbConnection()
    {
        $dbConnection = new DbConnection();
        $this->pdo = $dbConnection->connect('test', 'root');

        $this->assertSame(PDO::class, $this->pdo::class);
    }
}
