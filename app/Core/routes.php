<?php declare(strict_types=1);

return [
    ['GET', '/api/user', [\App\Controllers\UserController::class, 'index']],
    ['POST', '/api/user', [\App\Controllers\UserController::class, 'store']],

    ['POST', '/api/login', [\App\Controllers\AuthController::class, 'login']],
];