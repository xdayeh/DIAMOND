<?php
namespace DIAMOND\Controller;

class MineController extends AbstractController
{
    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('mine.default');
        $this->_view();
    }
}