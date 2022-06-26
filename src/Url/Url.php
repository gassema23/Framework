<?php

namespace Phplite\Url;

use Phplite\Http\Request;
use Phplite\Http\Server;

class Url
{
    /**
     * URL constructor
     */
    private function __constructor()
    {
    }

    /**
     * Get path
     * @param string $path
     * @return string $path
     */
    public static function path($path)
    {
        return Request::baseUrl() . '/' . trim($path, '/');
    }

    /**
     * Previous URL
     * @return string
     */
    public static function previous()
    {
        return Server::get('HTTP_REFERER');
    }

    /**
     * Redirect to page
     * @param string $path
     * @return void
     */
    public static function redirect($path)
    {
        header('Location: ' . $path);
        exit();
    }


}