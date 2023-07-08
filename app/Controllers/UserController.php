<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\ApiResponse;
use App\Services\User\IndexUserService;
use App\Services\User\StoreUserRequest;
use App\Services\User\StoreUserService;
use App\Validation\RegistryFormValidation;

class UserController
{
    private IndexUserService $indexUserService;
    private StoreUserService $storeUserService;
    private RegistryFormValidation $formValidation;

    public function __construct(
        IndexUserService $indexUserService,
        StoreUserService $storeUserService,
        RegistryFormValidation $formValidation
    )
    {
        $this->indexUserService = $indexUserService;
        $this->storeUserService = $storeUserService;
        $this->formValidation = $formValidation;
    }

    public function index(): ApiResponse
    {
       return new ApiResponse($this->indexUserService->execute());
    }

    public function store(): ApiResponse
    {
        $data = json_decode(file_get_contents('php://input'), true);

        try {
            if($this->formValidation->validateRegisterForm($data)) {
                return new ApiResponse($this->storeUserService->execute(new StoreUserRequest(
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
                )), 201);
            }
        }catch (\Exception $e) {
            return new ApiResponse([$e->getMessage()], 400);
        }
    }
}
