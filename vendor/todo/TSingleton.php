<?php

namespace Todo;

trait TSingleton
{
    private static ?self $instance = NULL;

    public static function instance()
    {
        if(self::$instance === NULL) {
            self::$instance = new static();
        }
        return self::$instance;
    }
}