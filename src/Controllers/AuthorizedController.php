<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Services\AuthService;

class AuthorizedController extends ResponseController
{
    const AUTH_TYPE = 'Bearer';

    public ?int   $userId;
    public string $token;

    public function __construct()
    {
        $authorizationHeader = parent::getHeader('AUTHORIZATION');

        if (empty($authorizationHeader)) {
            parent::returnError(403, 'Not authorized');
        }

        if (strstr($authorizationHeader, self::AUTH_TYPE)) {
            $token = trim(explode(self::AUTH_TYPE, $authorizationHeader)[1]);

            $authService = new AuthService();
            $userId      = $authService->validateToken($token);

            if (empty($userId)) {
                parent::returnError(403, 'Not valid authorization token');
            }

            $this->userId = $userId;
            $this->token  = $token;

            var_dump($this);
        } else {
            parent::returnError(403, 'Not valid authorization header');
        }
    }
}
