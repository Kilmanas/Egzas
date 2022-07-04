<?php

namespace Helper;

use const BASE_URL;

class Url
{
    public static function redirect(string $route) :void
    {
        header('Location: '.BASE_URL.$route);
        exit;
    }
    public static function link(string $path, ?string $param = null) :string
    {
        $link = BASE_URL.$path;
        if ($param !== null){
            $link .= '/'.$param;
        }
        return $link;
    }
}