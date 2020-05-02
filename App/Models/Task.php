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

    public function create()
    {
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $text = trim($_POST["text"]);

        if (Task::validation($name, $email, $text)) {
            $pdo = static::DB();

            $data = [
                'name' => $name,
                'email' => $email,
                'text' => $text
            ];

            $sql = "INSERT INTO tasks (username, email, text, created_at) VALUES (:name, :email, :text, NOW())";
            $stmt= $pdo->prepare($sql);
            $stmt->execute($data);
        }
    }

    public function validation($name, $email, $text)
    {
        if (empty($name)) {
            echo $name_err = "Please enter your name.</br>";
        }

        if (empty($email)) {
            echo $email_err = "Please enter your email.</br>";
        } else {

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Please enter valid email.</br>";
            }
        }

        if (empty($text)) {
            echo $username_err = "Please enter text.</br>";
        }

        return 1;
    }
}