<?php declare(strict_types=1);

namespace App\Core;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Query\QueryBuilder;

class DatabaseConnector
{
    private array $connectionParams;
    public function __construct()
    {
        $this->connectionParams = [
            'dbname' => $_ENV['PDO_DB_NAME'],
            'user' => $_ENV['PDO_USER'],
            'password' => $_ENV['PDO_PASSWORD'],
            'host' => $_ENV['PDO_HOST'],
            'driver' => 'pdo_mysql',
        ];
    }

    public function getConnection(): ?Connection
    {
        try {
            return DriverManager::getConnection($this->connectionParams);
        } catch (Exception $exception) {
            echo $exception->getMessage();
            return null;
        }
    }

    public function getQueryBuilder(): QueryBuilder
    {
        return $this->getConnection()->createQueryBuilder();
    }
}
