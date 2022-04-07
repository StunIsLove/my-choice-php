<?php
declare(strict_types=1);

namespace App\Modules;

use R as ORM;

class MainActiveRecord
{
    public function __construct()
    {
        ORM::setup('mysql:host=' . DATABASE_HOST . '; '
            . 'dbname=' . DATABASE_NAME, DATABASE_LOGIN, DATABASE_PASSWORD);
    }
}
