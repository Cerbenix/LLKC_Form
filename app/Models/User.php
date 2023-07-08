<?php declare(strict_types=1);

namespace App\Models;

class User
{
    private string $name;
    private string $surname;
    private string $email;
    private string $password;
    private ?int $id;

    public function __construct(
        string $name,
        string $surname,
        string $email,
        string $password,
        int $id = null
    )
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }


    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }
}
