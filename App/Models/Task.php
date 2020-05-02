<?php

namespace App\Models;

use PDO;

class Task extends Model
{
    public static function tasks($id)
    {
        $db = static::DB();
        $sql = isset($id) ? "SELECT * FROM tasks WHERE id = $id" : "SELECT * FROM tasks";
        $result = $db->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}