<?php
namespace App\Controllers;

use Philo\Blade\Blade;

class Controller
{
    protected $views;
    protected $cache;

    /**
     * Define paths for directories
     *
     */
    public function __construct()
    {
        $this->views = dirname(__DIR__) . '../../views';
        $this->cache = dirname(__DIR__) . '../../cache';
    }

    /**
     * Render a view file
     *
     * @param string $view
     * @param array $array
     *
     */
    public function view($view, $array)
    {
        $blade = new Blade($this->views, $this->cache);

        return $blade->view()->make($view, [$view => $array])->render();
    }
}