<?php declare(strict_types=1);

namespace App\Models;

class Profile extends User
{
    private string $address;
    private string $city;
    private string $postalCode;
    private string $phone;
    private string $comments;
    private string $smoking;
    private array $hobbies;
    private string $employedFrom;
    private string $employedTo;

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
        string $employedFrom,
        string $employedTo,
        int    $id = null
    )
    {
        parent::__construct($name, $surname, $email, $password, $id);
        $this->address = $address;
        $this->city = $city;
        $this->postalCode = $postalCode;
        $this->phone = $phone;
        $this->comments = $comments;
        $this->smoking = $smoking;
        $this->hobbies = $hobbies;
        $this->employedFrom = $employedFrom;
        $this->employedTo = $employedTo;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getComments(): string
    {
        return $this->comments;
    }

    public function getSmoking(): string
    {
        return $this->smoking;
    }

    public function getHobbies(): array
    {
        return $this->hobbies;
    }

    public function getEmployedTo(): string
    {
        return $this->employedTo;
    }

    public function getEmployedFrom(): string
    {
        return $this->employedFrom;
    }

    public function jsonSerialize(): array
    {
        return [
            'address' => $this->getAddress(),
            'city' => $this->getCity(),
            'postalCode' => $this->getPostalCode(),
            'phone' => $this->getPhone(),
            'comments' => $this->getComments(),
            'smoking' => $this->getSmoking(),
            'hobbies' => $this->getHobbies(),
            'employedFrom' => $this->getEmployedFrom(),
            'employedTo' => $this->getEmployedTo(),
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'id' => $this->getId(),
        ];
    }
}
