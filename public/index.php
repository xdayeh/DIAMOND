<?php
namespace DIAMOND;
use DIAMOND\Core\Library\SessionManager;
use DIAMOND\Core\Library\Registry;
use DIAMOND\Core\Library\FrontController;
use DIAMOND\Core\Library\Language;
use DIAMOND\Core\Library\Template;

define('DS', DIRECTORY_SEPARATOR);

require_once '..' . DS . 'app' . DS . 'core' . DS . 'config' . DS .'config.php';
require_once APP_PATH . DS .'core'. DS .'library' . DS . 'autoload.php';

$template_part      = require_once '..' . DS . 'app' . DS . 'core' . DS . 'config' . DS . 'template.config.php';

$session            = new SessionManager();
$template           = new template($template_part);
$language           = new Language();
$registry           = Registry::getInstance();
$frontController    = new FrontController($template, $registry);

$session->start();
$registry->session      = $session;
$registry->language     = $language;

$frontController->dispatch();