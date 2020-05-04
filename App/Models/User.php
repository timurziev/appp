<?php

namespace App\Models;

use PDO;

class User extends Model
{
    public static $username_err, $password_err, $invalid_username_err, $invalid_password_err;

    /**
     * Authorize user
     */
    public static function auth()
    {
        if (empty(trim($_POST["name"]))) {
            self::$username_err = "Please enter your name";
        } else {
            $name = trim($_POST["name"]);
        }

        if (empty(trim($_POST["password"]))) {
            self::$password_err = "Please enter your password";
        } else {
            $password = trim($_POST["password"]);
        }

        if (!empty(self::$username_err) && !empty(self::$password_err)) {
            return 1;
        }

        $pdo = static::DB();

        $sql = "SELECT id, name, password FROM users WHERE name = :name";

        if ($stmt = $pdo->prepare($sql)) {
            $param_username = $name;

            $stmt->bindParam(":name", $param_username, PDO::PARAM_STR);

            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $id = $row["id"];
                        $username = $row["name"];
                        $hashed_password = $row["password"];

                        if (md5($password) == $hashed_password) {

                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["name"] = $username;
                            $_SESSION["is_admin"] = $row["is_admin"] ? true : false;

                            header('Location: /');
                        } else {
                            self::$invalid_password_err = "The password you entered was not valid";
                            return 1;
                        }
                    }
                } else {
                    self::$invalid_username_err = "No account found with that username";
                    return 1;
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            unset($stmt);
        }

        unset($pdo);
    }
}