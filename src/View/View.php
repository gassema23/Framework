<?php

namespace Phplite\View;

use Jenssegers\Blade\Blade;
use Phplite\File\File;
use Phplite\Session\Session;

class View
{
    /**
     * View constructor
     */
    private function __construct()
    {
    }

    /**
     * Render view file
     * @param string $path
     * @param array $data
     * @return string
     * @throws \Exception
     */
    public static function render($path, $data = [])
    {
        $errors = Session::flash('errors');
        $old    = Session::flash('old');
        $data   = array_merge($data, ['errirs' => $errors, 'old' => $old]);
        return static::bladeRender($path, $data);
    }

    /**
     * Render the view file using blade engine
     * @param string $path
     * @param array $data
     * @return string
     */
    public static function bladeRender($path, $data = [])
    {
        $blade = new Blade(File::path('views'), File::path('storage/cache'));
        echo $blade->make($path, $data)->render();
    }


    /**
     * Render view file
     * @param string $path
     * @param array $data
     * @return stringW
     * @throws \Exception
     */
    public static function viewRender($path, $data = [])
    {
        $path = 'views' . File::ds() . str_replace(['/', '\\', '.'], File::ds(), $path) . '.php';
        if (!File::exist($path)) {
            throw new \Exception("The view file {$path} is not exist");
        }
        ob_start();
        extract($data);
        include File::path($path);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }


}