<?php

namespace Svit\Exads;

use PDO;

class Db
{
    protected static function getConnection()
    {
        static $pdo;

        if ($pdo === null) {
            $pdo = new PDO($_ENV['MYSQL_DSN'], $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD']);
        }

        return $pdo;
    }

    public static function fetchAll($sql)
    {
        $stm = self::getConnection()->query($sql);
//        $stm->setFetchMode(PDO::FETCH_INTO, $obj);

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
}
