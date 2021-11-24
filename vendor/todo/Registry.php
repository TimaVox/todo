<?php

namespace Todo;

class Registry
{
    use TSingleton;

    public static array $properties = [];

    public function setProperties($key, $value) : void
    {
        self::$properties[$key] = $value;
    }

    public function getProperty($key) : ?string
    {
        if(array_key_exists($key, self::$properties))
            return self::$properties[$key];

        return NULL;
    }

    public function getProperties() : array
    {
        return self::$properties;
    }
}