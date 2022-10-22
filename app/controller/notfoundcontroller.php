<?php
namespace DIAMOND\Controller;

class NotFoundController extends AbstractController
{
    public function notFoundAction()
    {
        $this->language->load('template.common');
        $this->language->load('notfound.default');
        $this->_view();
    }
}