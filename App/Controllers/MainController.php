<?php

namespace App\Controllers;

use Philo\Blade\Blade;
use App\Models\Task;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
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

    /**
     * Store task
     *
     * @param null $id
     */
    public function store()
    {
        Task::create();

        $errors = Task::$errors;
        $blade = new Blade($this->views, $this->cache);

        echo $blade->view()->make('create', ['errors' => $errors])->render();
    }

    /**
     * Edit task
     *
     * @param $id
     */
    public function edit($id)
    {
        $task = Task::edit($id);

        $blade = new Blade($this->views, $this->cache);

        echo $blade->view()->make('create', ['task' => $task])->render();
    }

    /**
     * Update task
     *
     * @param $id
     */
    public function update($id)
    {
        Task::create($id);

        $errors = Task::$errors;
        $blade = new Blade($this->views, $this->cache);

        echo $blade->view()->make('create', ['errors' => $errors])->render();
    }
}