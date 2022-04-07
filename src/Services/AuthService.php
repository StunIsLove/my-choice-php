<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\AuthModel;
use App\Modules\MainActiveRecord;
use R as ORM;
use RedBeanPHP\OODBBean;
use RedBeanPHP\RedException\SQL;

class AuthService extends MainActiveRecord
{
    public const TABLE_NAME = 'auth';

    public const FIELD_ID             = 'id';
    public const FIELD_EMAIL          = 'email';
    public const FIELD_PASSWORD       = 'password';
    public const FIELD_ACCOUNT_NUMBER = 'accountNumber';

    /**
     * @param int    $userId
     * @param string $generatedString
     *
     * @return int|null
     * @throws SQL
     */
    public function createToken(int $userId, string $generatedString): ?int
    {
        /* @var AuthModel $token */
        $token = ORM::dispense(self::TABLE_NAME);

        $token->userId = $userId;
        $token->token  = $generatedString;

        return (int)ORM::store($token);
    }

    /**
     * @param array $userId
     *
     * @return OODBBean|null
     */
    public function getTokenByUserId(array $userId): ?OODBBean
    {
        return ORM::findOne(self::TABLE_NAME, ' WHERE user_id = ?', [$userId]) ?? null;
    }
}
