<?php

namespace App\Controllers;

use Philo\Blade\Blade;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Display login page.
     *
     */
    public function index()
    {
        $blade = new Blade($this->views, $this->cache);

        echo $blade->view()->make('login')->render();
    }

    /**
     * Get auth method
     */
    public function login()
    {
        User::auth();

        $errors = [
            'username_err' => User::$username_err,
            'password_err' => User::$password_err,
            'invalid_username_err' => User::$invalid_username_err,
            'invalid_password_err' => User::$invalid_password_err,
        ];

        $blade = new Blade($this->views, $this->cache);

        echo $blade->view()->make('login', ['errors' => $errors])->render();
    }

    /**
     * Logout from account
     */
    public function logout()
    {
        session_unset();

        header('Location: /');
    }
}
