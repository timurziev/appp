<?php

namespace App\Models;

use PDO;

class User extends Model
{
    /**
     * Authorize user
     */
    public static function auth()
    {
        if(empty(trim($_POST["name"]))) {
            echo $username_err = "Please enter your name.</br>";
        } else {
            $name = trim($_POST["name"]);
        }

        if(empty(trim($_POST["password"]))) {
            echo $password_err = "Please enter your password.";
        } else {
            $password = trim($_POST["password"]);
        }

        if(empty($username_err) && empty($password_err)){
            $pdo = static::DB();

            $sql = "SELECT id, name, password FROM users WHERE name = :name";

            if($stmt = $pdo->prepare($sql)){
                $param_username = $name;

                $stmt->bindParam(":name", $param_username, PDO::PARAM_STR);

                if($stmt->execute()){
                    if($stmt->rowCount() == 1){
                        if($row = $stmt->fetch()){
                            $id = $row["id"];
                            $username = $row["name"];
                            $hashed_password = $row["password"];

                            if(md5($password) == $hashed_password){

                                session_start();

                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["name"] = $username;

                                header('Location: /');
                            } else {
                                echo $password_err = "The password you entered was not valid.";
                            }
                        }
                    } else {
                        echo $username_err = "No account found with that username.";
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                unset($stmt);
            }
        }

        unset($pdo);
    }
}