<?php
namespace DIAMOND\Controller;

class ProductsController extends AbstractController
{
    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('products.default');
        $this->_view();
    }
}