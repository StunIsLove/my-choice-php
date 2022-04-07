<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\UserModel;
use App\Modules\MainActiveRecord;
use R as ORM;
use RedBeanPHP\OODBBean;
use RedBeanPHP\RedException\SQL;

class UserService extends MainActiveRecord
{
    public const TABLE_NAME = 'users';

    public const FIELD_ID             = 'id';
    public const FIELD_EMAIL          = 'email';
    public const FIELD_PASSWORD       = 'password';
    public const FIELD_ACCOUNT_NUMBER = 'accountNumber';

    /**
     * @param string   $email
     * @param string   $password
     * @param int|null $accountNumber
     *
     * @return int|null
     * @throws SQL
     */
    public function create(string $email, string $password, ?int $accountNumber): ?int
    {
        /* @var UserModel $user */
        $user = ORM::dispense(self::TABLE_NAME);

        $user->email         = $email;
        $user->password      = $password;
        $user->accountNumber = $accountNumber;

        return (int)ORM::store($user);
    }

    /**
     * @param array $fields
     *
     * @return OODBBean|null
     */
    public function getUserForAuth(array $fields): ?OODBBean
    {
        $user = null;

        if ($fields[self::FIELD_ACCOUNT_NUMBER]) {
            $user = ORM::findOne(
                self::TABLE_NAME,
                ' WHERE account_number = ?',
                [$fields[self::FIELD_ACCOUNT_NUMBER]]
            );
        } elseif ($fields[self::FIELD_EMAIL]) {
            $user = ORM::findOne(
                self::TABLE_NAME,
                ' WHERE email = ?',
                [$fields[self::FIELD_EMAIL]]);
        }

        return $user;
    }
}
