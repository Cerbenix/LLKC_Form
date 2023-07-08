<?php declare(strict_types=1);

return [
    ['GET', '/api/products', [\App\UserController::class, 'index']],
    ['POST', '/api/products', [\App\UserController::class, 'store']],
];