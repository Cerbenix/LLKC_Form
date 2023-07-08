<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\ApiResponse;
use App\Services\Auth\Login\LoginService;
use Firebase\JWT\JWT;

class AuthController
{
    private LoginService $loginService;
    private JWT $JWT;

    public function __construct(LoginService $loginService, JWT $JWT)
    {
        $this->loginService = $loginService;
        $this->JWT = $JWT;
    }

    public function login(): ApiResponse
    {
        $data = json_decode(file_get_contents('php://input'), true);

        try {
            $user = $this->loginService->execute($data['email'], $data['password']);
            if (!$user) {
                return new ApiResponse(['message' => 'Invalid credentials'], 401);
            }

            $payload = array(
                "user_id" => $user->getId(),
                "exp" => time() + 3600,
            );
            $token = $this->JWT->encode($payload, $_ENV['JWT_SECRET_KEY'], 'HS256');

            return new ApiResponse(['token' => $token]);

        } catch (\Exception $e) {
            return new ApiResponse([$e->getMessage()], 401);
        }
    }
}
