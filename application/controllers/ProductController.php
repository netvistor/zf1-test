<?php

class ProductController extends Zend_Controller_Action
{

    public function init()
    {
        $this->view->fake = [
            'status' => [
                0 => [
                    'value' => 'Zużyte',
                    'class' => 'badge badge-danger'
                ],
                1 => [
                    'value' => 'Na stanie',
                    'class' => 'badge badge-success'
                ],
            ],
            'category' => [
                0 => 'Myśiwce',
                1 => 'Bombowce',
            ]
        ];

        $this->elastic = new Elasticsearch_Elastic();
    }

    public function indexAction()
    {
        $products = new Application_Model_DbTable_Products();
        $this->view->products = $products->fetchAll();

        $this->view->title = "Stan arsenału";
    }

    public function editAction()
    {
        $this->view->title = "Edytuj pozycję";

        $form = new Application_Form_Product();
        $form->submit->setLabel('Zapisz');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = (int)$form->getValue('id');
                $name = $form->getValue('name');
                $description = $form->getValue('description');
                $price = $form->getValue('price');
                $tax = $form->getValue('tax');
                $status = $form->getValue('status');
                $products = new Application_Model_DbTable_Products();
                $products->updateProduct($id, $name, $description, $price, $tax, $status);

                $query = [
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'tax' => $tax,
                    'status' => $status
                ];
                $this->elastic->postProduct($query, $id);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $products = new Application_Model_DbTable_Products();
                $form->populate($products->getProduct($id));
            }
        }
    }

    public function addAction()
    {
        $this->view->title = "Dodaj pozycję";

        $form = new Application_Form_Product();
        $form->submit->setLabel('Dodaj');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $name = $form->getValue('name');
                $description = $form->getValue('description');
                $price = $form->getValue('price');
                $tax = $form->getValue('tax');
                $status = $form->getValue('status');
                $products = new Application_Model_DbTable_Products();
                $id = $products->addProduct($name, $description, $price, $tax, $status);

                $query = [
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'tax' => $tax,
                    'status' => $status
                ];
                $this->elastic->postProduct($query, $id);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function deleteAction()
    {
        $this->view->title = "Złomowanie";

        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Tak, to złom') {
                $id = $this->getRequest()->getPost('id');
                $product = new Application_Model_DbTable_Products();
                $product->deleteProduct($id);

                $this->elastic->deleteProduct($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $product = new Application_Model_DbTable_Products();
            $this->view->album = $product->getProduct($id);
        }
    }

    public function searchAction()
    {
        if ($this->getRequest()->isPost()) {
            $text = $this->getRequest()->getPost('text');

            $this->view->title = "Fraza: " . $text;
            $this->view->text = $text;
            $this->view->search = $this->elastic->searchProduct($text);
        } else {
            $this->view->text = 'dupa nie ma posta';
        }
    }
}