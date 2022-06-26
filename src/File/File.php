<?php

namespace Phplite\File;

class File
{
    /**
     * File Constructor
     */
    private function __construct()
    {
    }

    /**
     * Rooot path
     * @return string
     */
    public static function root()
    {
        return ROOT;
    }

    /**
     * Directory separator
     * @return  string
     */
    public static function ds()
    {
        return DS;
    }

    /**
     *Get file full path
     * @param string $path
     * @return string $path
     */
    public static function path(string $path)
    {
        $path = static::root() . static::ds() . trim($path, '/');
        $path = str_replace(['/', '\\'], static::ds(), $path);
        return $path;
    }

    /**
     * Check that file exists
     * @param string $path
     * @return bool
     */
    public static function exist(string $path)
    {
        return file_exists(static::path($path));
    }

    /**
     * Require file
     * @return mixed
     * @var string $path
     */
    public static function require_file(string $path)
    {
        if (static::exist($path)) {
            return require_once static::path($path);
        }
    }

    /**
     * Include file
     * @return mixed
     * @var string $path
     */
    public static function include_file(string $path)
    {
        if (static::exist($path)) {
            return include static::path($path);
        }
    }

    /**
     * Require directory
     * @param string $path
     * @return mixed
     */
    public static function require_directory(string $path)
    {
        $files = array_diff(scandir(static::path($path)), ['.', '..']);
        foreach ($files as $file) {
            $file_path = $path . static::ds() . $file;
            if (static::exist($file_path)) {
                static::require_file($file_path);
            }
        }
    }

}