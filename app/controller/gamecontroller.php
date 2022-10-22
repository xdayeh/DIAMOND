<?php
namespace DIAMOND\Controller;

class gameController extends AbstractController
{
    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('index.default');
        $this->_view();
    }
}
