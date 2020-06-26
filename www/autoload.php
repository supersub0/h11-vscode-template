<?php
require_once __DIR__.'/../vendor/autoload.php';

spl_autoload_register(
    function ($class) {
        $classFile = __DIR__.'/../src/'.str_replace('\\', '/', $class).'.php';

        if (is_file($classFile)) {
            require_once $classFile;
        }
    }
);
