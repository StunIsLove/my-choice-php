<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\UserService;
use Exception;
use RedBeanPHP\RedException\SQL;
use Tokenly\TokenGenerator\TokenGenerator;

class UserController extends ResponseController
{
    /**
     * @param string   $email
     * @param string   $password
     * @param int|null $accountNumber
     *
     * @return string
     * @throws SQL
     */
    public function register(string $email, string $password, ?int $accountNumber): string
    {
        $userService = new UserService();

        $userId = $userService->create(
            $email,
            md5(md5($password)),
            $accountNumber
        );

        return parent::returnSuccess(['userId' => $userId]);
    }

    /**
     * @param string $login
     * @param string $password
     *
     * @return string
     * @throws SQL
     * @throws Exception
     */
    public function auth(string $login, string $password): string
    {
        $userService = new UserService();

        $isEmail = strstr($login, '@');
        $isEmail ? $email = $login : $accountNumber = (int)$login;

        $user = $userService->getUserForAuth([
            UserService::FIELD_ACCOUNT_NUMBER => $accountNumber ?? null,
            UserService::FIELD_EMAIL          => $email ?? null,
            UserService::FIELD_PASSWORD       => $password,
        ]);

        if (!empty($user) && md5(md5($password)) === $user[UserService::FIELD_PASSWORD]) {
            $userId = (int)$user[UserService::FIELD_ID];
            $authService = new AuthService();

            $token = $authService->getTokenByUserId($userId);

            if (empty($token)) {
                $tokenGenerator = new TokenGenerator();

                $generatedToken = $tokenGenerator->generateToken(20, 'KEY');
                $newTokenId = $authService->createToken($userId, $generatedToken);
                if (!empty($newTokenId)) {
                    return parent::returnSuccess(['user' => $user, 'token' => $generatedToken]);
                } else {
                    return parent::returnError(400, "Token doesn't record");
                }
            } else {
                return parent::returnSuccess(['user' => $user, 'token' => $token[AuthService::FIELD_TOKEN]]);
            }
        }

        return parent::returnError(400, 'Access denied');
    }
}
