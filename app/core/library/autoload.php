<?php
namespace DIAMOND\Core\Library;

class AutoLoad
{
    public static function autoload($className)
    {
        $className = str_replace('DIAMOND', '', $className);
        $className = str_replace('\\', DS, $className);
        $className = strtolower($className . '.php');
        if (file_exists(APP_PATH . $className)){
            require APP_PATH . $className;
        }
    }
}
spl_autoload_register(__NAMESPACE__ . '\AutoLoad::autoload');