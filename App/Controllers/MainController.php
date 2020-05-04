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
    public function index()
    {
        $tasks = Task::tasks();
        $pages = Task::$total_pages;

        $blade = new Blade($this->views, $this->cache);

        echo $blade->view()->make('home', ['tasks' => $tasks, 'pages' => $pages])->render();
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

        header("Location: /main/create?message=success");
    }
}