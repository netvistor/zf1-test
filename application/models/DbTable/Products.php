<?php

class Application_Model_DbTable_Products extends Zend_Db_Table_Abstract
{

    protected $_name = 'products';

    public function getProduct($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addProduct($name, $description, $price, $tax, $status)
    {
        $data = array(
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'tax' => $tax,
            'status' => $status,
        );
        return $this->insert($data);
    }

    public function updateProduct($id, $name, $description, $price, $tax, $status)
    {
        $data = array(
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'tax' => $tax,
            'status' => $status,
        );
        $this->update($data, 'id = ' . (int)$id);
    }

    public function deleteProduct($id)
    {
        $this->delete('id =' . (int)$id);
    }

    public function countProduct()
    {
        $select = $this->fetchAll();
        return count($select);
    }
}
