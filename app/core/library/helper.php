<?php
namespace DIAMOND\Core\Library;

trait Helper
{
    public function redirect($path = DS)
    {
        session_write_close();
        header('Location:'.$path);
        exit();
    }
}