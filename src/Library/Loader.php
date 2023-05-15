<?php

namespace App\Library;

class Loader
{

    public function init()
    {
        spl_autoload_register(array(__CLASS__, '_loadClasses'));
    }

    private function _loadClasses($Class)
    {
        $Class = str_replace(array(__NAMESPACE__, 'App', '\\'), '/', $Class);

        if (is_file(ROOT_PATH . $Class . '.php'))
            require_once ROOT_PATH . $Class . '.php';
    }
}