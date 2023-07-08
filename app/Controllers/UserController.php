<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\ApiResponse;
use App\Services\User\Index\IndexUserService;
use App\Services\User\Store\StoreUserRequest;
use App\Services\User\Store\StoreUserService;
use App\Validations\RegistryFormValidation;
use Firebase\JWT\JWT;

class UserController
{
    private IndexUserService $indexUserService;
    private StoreUserService $storeUserService;
    private RegistryFormValidation $formValidation;
    private JWT $JWT;

    public function __construct(
        IndexUserService $indexUserService,
        StoreUserService $storeUserService,
        RegistryFormValidation $formValidation,
        JWT $JWT
    )
    {
        $this->indexUserService = $indexUserService;
        $this->storeUserService = $storeUserService;
        $this->formValidation = $formValidation;
        $this->JWT = $JWT;
    }

    public function index(): ApiResponse
    {
        $profiles = $this->indexUserService->execute();
        $data = [];

        foreach ($profiles as $profile) {
            $data[] = $profile->jsonSerialize();
        }

        return new ApiResponse($data);
    }

    public function store(): ApiResponse
    {
        $data = json_decode(file_get_contents('php://input'), true);

        try {
            if ($this->formValidation->validateRegisterForm($data)) {
                $profile = $this->storeUserService->execute(new StoreUserRequest(
                    $data['name'],
                    $data['surname'],
                    $data['email'],
                    $data['password'],
                    $data['address'],
                    $data['city'],
                    $data['postalCode'],
                    $data['phone'],
                    $data['comments'],
                    $data['smoking'],
                    $data['hobbies'],
                    $data['employmentDuration']
                ));

                $payload = array(
                    "user_id" => $profile->getId(),
                    "exp" => time() + 3600,
                );
                $token = $this->JWT->encode($payload, $_ENV['JWT_SECRET_KEY'], 'HS256');

                return new ApiResponse(['message' => 'Profile saved successfully', 'token' => $token], 201);
            } else {
                return new ApiResponse(['message' => 'Invalid form data'], 400);
            }
        } catch (\Exception $e) {
            return new ApiResponse([$e->getMessage()], $e->getCode() ?: 500);
        }
    }
}
