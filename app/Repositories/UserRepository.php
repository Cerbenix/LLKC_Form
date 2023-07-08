<?php declare(strict_types=1);

namespace App\Repositories;

use App\Core\DatabaseConnector;
use App\Models\User;

class UserRepository
{
    private DatabaseConnector $databaseConnector;

    public function __construct(DatabaseConnector $databaseConnector)
    {
        $this->databaseConnector = $databaseConnector;
    }

    public function find(int $id): User
    {

    }
}
