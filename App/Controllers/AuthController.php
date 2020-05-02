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
