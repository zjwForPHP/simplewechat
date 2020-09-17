<?php

namespace SimpleWechat;

class Factory
{
    protected function make($name, array $configArray)
    {
        $name = trim($name);

        $application = "\\SimpleWechat\\{$name}\\Application";

        return new $application($configArray);
    }


    public static function __callStatic($name, $arguments)
    {
        return self::make($name, $arguments);
    }
}