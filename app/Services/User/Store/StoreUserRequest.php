<?php declare(strict_types=1);

namespace App\Services\User;

use stdClass;

class StoreUserRequest
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
    private stdClass $employmentDuration;

    public function __construct(
        string   $name,
        string   $surname,
        string   $email,
        string   $password,
        string   $address,
        string   $city,
        string   $postalCode,
        string   $phone,
        string   $comments,
        string   $smoking,
        array    $hobbies,
        StdClass $employmentDuration
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
        $this->employmentDuration = $employmentDuration;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getComments(): string
    {
        return $this->comments;
    }

    public function getEmploymentDuration(): stdClass
    {
        return $this->employmentDuration;
    }

    public function getHobbies(): array
    {
        return $this->hobbies;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getSmoking(): string
    {
        return $this->smoking;
    }
}