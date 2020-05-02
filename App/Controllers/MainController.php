<?php

namespace App\Controllers;

use Philo\Blade\Blade;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $blade = new Blade($this->views, $this->cache);

        echo $blade->view()->make('home')->render();
    }
}