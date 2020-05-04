<?php

namespace App\Models;

use PDO;

class Task extends Model
{
    public static $total_pages;

    /**
     * @param $id
     * @return mixed
     */
    public static function tasks()
    {
        $db = static::DB();
        $sql = $db->prepare("SELECT * FROM tasks");
        $sql->execute();

        $limit = 3;
        $total_results = $sql->rowCount();
        self::$total_pages = ceil($total_results/$limit);

        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }


        $start = ($page-1) * $limit;

        $stmt = $db->prepare("SELECT * FROM tasks ORDER BY id DESC LIMIT $start, $limit");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_OBJ);

        return $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                echo $valid_email_err = "Please enter valid email.</br>";
            }
        }

        if (empty($text)) {
            echo $text_err = "Please enter text.</br>";
        }

        if (empty($name_err) || empty($email_err) || empty($valid_email_err) || empty($text_err)) {
            return 1;
        }
    }
}