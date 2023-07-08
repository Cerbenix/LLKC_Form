<?php declare(strict_types=1);

namespace App\Core;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Query\QueryBuilder;

class DatabaseConnector
{
    public function getConnection(): ?Connection
    {
        try {
            return DriverManager::getConnection(self::getConnectionParams());
        } catch (Exception $exception) {
            echo $exception->getMessage();
            return null;
        }
    }

    public function getQueryBuilder(): QueryBuilder
    {
        return self::getConnection()->createQueryBuilder();
    }

    private function getConnectionParams(): array
    {
        return [
            'dbname' => $_ENV['PDO_DB_NAME'],
            'user' => $_ENV['PDO_USER'],
            'password' => $_ENV['PDO_PASSWORD'],
            'host' => $_ENV['PDO_HOST'],
            'driver' => 'pdo_mysql',
        ];
    }
}
