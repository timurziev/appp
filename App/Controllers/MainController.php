<?php

namespace App\Controllers;

use Philo\Blade\Blade;
use App\Models\Task;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $id
     */
    public function index($id = null)
    {
        $tasks = Task::tasks($id);

        $blade = new Blade($this->views, $this->cache);

        echo $blade->view()->make('home', ['tasks' => $tasks])->render();
    }

    /**
     * Create task
     */
    public function create()
    {
        $blade = new Blade($this->views, $this->cache);

        echo $blade->view()->make('create')->render();
    }

    public function store()
    {
        Task::create();
    }
}