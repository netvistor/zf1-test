<?php

class IndexController extends Zend_Controller_Action
{
    public $elastic;

    public function init()
    {
        $this->view->title = "Startujemy...";
    }

    public function indexAction()
    {
        $products = new Application_Model_DbTable_Products();
        $this->view->products_count = $products->countProduct();
    }

}