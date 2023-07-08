<?php declare(strict_types=1);

namespace App\Models;

class User
{
    private string $name;
    private string $surname;
    private string $email;
    private string $password;
    private string $address;
    private string $city;
    private string $postalCode;
    private string $phone;
    private string $comments;
    private string $smoking;
    private array $hobbies;
    private string $startedEmployment;
    private string $finishedEmployment;


    public function __construct(
        string $name,
        string $surname,
        string $email,
        string $password,
        string $address,
        string $city,
        string $postalCode,
        string $phone,
        string $comments,
        string $smoking,
        array  $hobbies,
        string $startedEmployment,
        string $finishedEmployment
    )
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->address = $address;
        $this->city = $city;
        $this->postalCode = $postalCode;
        $this->phone = $phone;
        $this->comments = $comments;
        $this->smoking = $smoking;
        $this->hobbies = $hobbies;
        $this->startedEmployment = $startedEmployment;
        $this->finishedEmployment = $finishedEmployment;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getHobbies(): array
    {
        return $this->hobbies;
    }

    public function getComments(): string
    {
        return $this->comments;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFinishedEmployment(): string
    {
        return $this->finishedEmployment;
    }

    public function getSmoking(): string
    {
        return $this->smoking;
    }

    public function getStartedEmployment(): string
    {
        return $this->startedEmployment;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

}
