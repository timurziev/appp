<?php

namespace App\Models;

use PDO;
use Config\Database;

abstract class Model
{

    /**
     * Connect to the database
     *
     * @return mixed
     */
    protected static function DB()
    {
        $database = 'mysql:host=' . Database::DB_HOST . ';dbname=' . Database::DB_NAME . ';charset=utf8;port=' . Database::DB_PORT;
        $db = new PDO($database, Database::DB_USER, Database::DB_PASSWORD);

        // In case of error return an exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $db;
    }

    /**
     * Get items from database
     *
     * @var $param
     * @var $id
     *
     * @return mixed
     */
    public static function items($param, $id)
    {
        $db = static::DB();
        $sql = isset($id) ? "SELECT * FROM $param WHERE id = $id" : "SELECT * FROM $param";
        $result = $db->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
