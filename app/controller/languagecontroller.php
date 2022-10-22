<?php
namespace DIAMOND\Controller;
use DIAMOND\Core\Library\Helper;

class LanguageController extends AbstractController
{
    use Helper;
    public function defaultAction()
    {
        if (isset($_SERVER['HTTP_REFERER']) && !empty($_COOKIE['lang'])) {
            $_COOKIE['lang'] = $_COOKIE['lang'] == 'en' ? 'ar' : 'en';
            setcookie('lang', $_COOKIE['lang'], time() + (86400 * 7), '/', FALSE, TRUE);
            $this->redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->redirect('/');
            exit();
        }
    }
}