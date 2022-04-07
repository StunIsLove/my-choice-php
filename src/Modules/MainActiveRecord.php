<?php
declare(strict_types=1);

namespace App\Modules;

use R as ORM;
use RedBeanPHP\OODBBean;

class MainActiveRecord
{
    public function __construct()
    {
        ORM::setup('mysql:host=' . DATABASE_HOST . '; '
            . 'dbname=' . DATABASE_NAME, DATABASE_LOGIN, DATABASE_PASSWORD);
    }

    /**
     * @param OODBBean $object
     *
     * @return array
     */
    public static function OODBToArray(OODBBean $object): array
    {
        $resultList = [];

        foreach ($object as $key => $item) {
            $resultList[$key] = $item;
        }

        return $resultList;
    }
}
