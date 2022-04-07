<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\UserService;
use RedBeanPHP\RedException\SQL;

class UserController
{
    /**
     * @param string   $email
     * @param string   $password
     * @param int|null $accountNumber
     *
     * @return int
     * @throws SQL
     */
    public function register(string $email, string $password, ?int $accountNumber): int
    {
        $userService = new UserService();

        return $userService->create(
            $email,
            md5(md5($password)),
            $accountNumber
        );
    }

    /**
     * @param string $login
     * @param string $password
     *
     * @return array
     * @throws SQL
     */
    public function auth(string $login, string $password): array
    {
        $isEmail = strstr($login, '@');
        $isEmail ? $email = $login : $accountNumber = $login;

        $userService = new UserService();

        $user = $userService->getUserForAuth([
            UserService::FIELD_ACCOUNT_NUMBER => $accountNumber ?? null,
            UserService::FIELD_EMAIL          => $email ?? null,
            UserService::FIELD_PASSWORD       => $password,
        ]);

        if (!empty($user) && $password === $user[UserService::FIELD_PASSWORD]) {
            $authService = new AuthService();

            $token = $authService->getTokenByUserId($user[UserService::FIELD_ID]);

            if (empty($token))
            {
                // todo: Подключить генератор строк
                $generatedToken = 'testToken715';
                $newTokenId = $authService->createToken($user[UserService::FIELD_ID], $generatedToken);
                if (!empty($newTokenId)) {
                    return ['response' => ['token' => $newTokenId]];
                } else {
                    return ['error' => "Token doesn't record"];
                }
            }
        }

        return ['error' => 'Access denied'];
    }
}
