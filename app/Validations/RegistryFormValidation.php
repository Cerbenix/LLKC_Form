<?php declare(strict_types=1);

namespace App\Validations;

use App\Repositories\UserRepository;

class RegistryFormValidation
{
    private UserRepository $userRepository;
    private array $fields;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function validateRegisterForm(array $fields): bool
    {
        $this->fields = $fields;
        $isValid = true;
        foreach ($fields as $field => $value) {
            $methodName = 'validate' . ucfirst($field);
            if (method_exists($this, $methodName)) {
                $isValid = $this->$methodName();
            }

        }
        return $isValid;
    }

    public function validateName(): bool
    {
        if (empty($this->fields['name'])) {
            return false;
        }
        return true;
    }

    public function validateSurname(): bool
    {
        if (empty($this->fields['surname'])) {
            return false;
        }
        return true;
    }

    public function validateEmail(): bool
    {
        $email = $this->fields['email'];
        $pattern = '/^\S+@\S+\.\S+$/';

        if (empty($email)) {
            return false;
        }

        $userExists = $this->userRepository->findUserByEmail($email);

        if ($userExists != null) {
            return false;
        }

        if (preg_match($pattern, $email)) {
            return false;
        }

        return true;
    }


    public function validatePassword(): bool
    {
        if (empty($this->fields['password'])) {
            return false;
        }

        return true;
    }

    public function validateAddress(): bool
    {
        if (empty($this->fields['address'])) {
            return false;
        }
        return true;
    }

    public function validateCity(): bool
    {
        if (empty($this->fields['city'])) {
            return false;
        }
        return true;
    }

    public function validatePostalCode(): bool
    {
        if (empty($this->fields['postalCode'])) {
            return false;
        }
        return true;
    }

    public function validatePhone(): bool
    {
        $phoneNumber = $this->fields['phone'];
        if (empty($phoneNumber)) {
            return false;
        }

        if (is_numeric($phoneNumber)) {
            return false;
        }
        return true;
    }

    public function validateComments(): bool
    {
        if (empty($this->fields['comments'])) {
            return false;
        }
        return true;
    }

    public function validateSmoking(): bool
    {
        if (empty($this->fields['smoking'])) {
            return false;
        }
        return true;
    }

    public function validateHobbies(): bool
    {
        if (empty($this->fields['hobbies'])) {
            return false;
        }
        return true;
    }

    public function validateEmploymentDuration(): bool
    {
        if (empty($this->fields['employmentDuration'])) {
            return false;
        }
        return true;
    }
}
