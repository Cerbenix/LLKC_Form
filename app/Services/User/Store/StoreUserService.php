<?php declare(strict_types=1);

namespace App\Services\User\Store;

use App\Models\Profile;
use App\Models\User;
use App\Repositories\UserRepository;

class StoreUserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(StoreUserRequest $request): User
    {
        $password = password_hash($request->getPassword(), PASSWORD_DEFAULT);

        $profile = new Profile(
            $request->getName(),
            $request->getSurname(),
            $request->getEmail(),
            $password,
            $request->getAddress(),
            $request->getCity(),
            $request->getPostalCode(),
            $request->getPhone(),
            $request->getComments(),
            $request->getSmoking(),
            $request->getHobbies(),
            $request->getEmploymentDuration()['from'],
            $request->getEmploymentDuration()['to']
        );

        try {
            $this->userRepository->save($profile);
            return $profile;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}