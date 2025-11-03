<?php
return [
//Класс аутентификации
    'auth' => \Src\Auth\Auth::class,
//Клас пользователя
    'identity' => \Model\User::class,
//Классы для middleware
    'routeMiddleware' => [
        'auth' => \Middlewares\AuthMiddleware::class,
        'role' => \Middlewares\RoleMiddleware::class,
    ],
    'validators' => [
        'required' => \Src\Validator\RequireValidator::class,
        'unique' => \Src\Validator\UniqueValidator::class
    ],
    'routeAppMiddleware' => [
        'csrf' => \Middlewares\CSRFMiddleware::class,
        'trim' => \Middlewares\TrimMiddleware::class,
        'specialChars' => \Middlewares\SpecialCharsMiddleware::class,
    ],
];