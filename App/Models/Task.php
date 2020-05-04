<?php

namespace App\Models;

use mysql_xdevapi\Result;
use PDO;

class Task extends Model
{
    public static $total_pages, $errors = [];

    /**
     * @param $id
     * @return mixed
     */
    public static function tasks()
    {
        $db = static::DB();

        $columns = array('username', 'email', 'status');
        $column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
        $sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

        $sql = $db->prepare("SELECT * FROM tasks ORDER BY " .  $column . ' ' . $sort_order);
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

        $stmt = $db->prepare("SELECT * FROM tasks ORDER BY " . $column  . ' ' . $sort_order . " LIMIT $start, $limit");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_OBJ);

        return $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $id
     * @return int|void
     */
    public function create($id = null)
    {
        $data = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            foreach($_POST as $key => $value) {
                if (!empty($value)) {
                    $data[] = self::validate($_POST[$key]);

                    if ($_POST[$key] == $_POST['email'] && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                        self::$errors[] = "Please enter valid email";
                    }
                } else {
                    self::$errors[] = "Please enter $key";
                }
            }

            if (count($data) < count($_POST)) {
                return 1;
            }
        }

        $pdo = static::DB();

        $data = [
            'name' => $data[0],
            'email' => $data[1],
            'text' => $data[2]
        ];

        if ($id) {
            if (!isset($_SESSION["is_admin"])) {
                return header("Location: /auth");
            }

            $task = $pdo->prepare("SELECT text FROM tasks WHERE id = $id");
            $task->execute();
            $row = $task->fetch();

            $status = $_POST['status'];
            $edited = $row['text'] !== $data['text'] ? 1 : 0;

            $sql = "UPDATE tasks SET username = ?, email = ?, text = ?, status = ?, edited = ? WHERE id = ?";

            $stmt= $pdo->prepare($sql);
            $stmt->execute([$data['name'], $data['email'], $data['text'], $status, $edited, $id]);

            return header("Location: /main/edit/$id?message=success");
        } else {
            $sql = "INSERT INTO tasks (username, email, text, created_at) VALUES (:name, :email, :text, NOW())";

            $stmt= $pdo->prepare($sql);
            $stmt->execute($data);
        }

        return header("Location: /main/create?message=success");
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $db = static::DB();
        $sql = "SELECT * FROM tasks WHERE id = $id";
        $result = $db->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $data
     * @return int
     */
    public function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }
}