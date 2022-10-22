<?php
define('APP_PATH', realpath(dirname(__FILE__)) . DS . '..' . DS . '..');
const TEMPLATE_PATH         = APP_PATH . DS . 'core' . DS . 'template' . DS;
const VIEW_PATH             = APP_PATH . DS . 'view' . DS;
const LANGUAGES_PATH        = APP_PATH . DS . 'core' . DS . 'languages' . DS;

define('URL_XP', "http://" . $_SERVER["SERVER_NAME"] . substr($_SERVER["PHP_SELF"], 0, strrpos($_SERVER["PHP_SELF"], DS)) . DS);
define('URLNoIn', str_replace(DS.'index.php', '', URL_XP));

const CSS                   = URLNoIn . 'style' . DS . 'stylesheets' . DS;
const JS                    = URLNoIn . 'style' . DS . 'javascript' . DS;
const PHOTO                 = URLNoIn . 'style' . DS . 'photo' . DS;

// Session Configuration :
const SESSION_DOMAIN        = '.localhost';
const SESSION_NAME          = '_DIAMOND_SESSION';
const SESSION_LIFE_TIME     = 0;
const SESSION_SAVE_PATH     = APP_PATH . DS . '..' . DS . 'sessions';