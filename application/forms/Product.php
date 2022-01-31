<?php

class Application_Form_Product extends Zend_Form
{

    public function init()
    {
        $this->setName('product');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $status = new Zend_Form_Element_Select('status');
        $status->setLabel('Status')
            ->setRequired(true)
            ->addMultiOptions([0 => 'Zużyte', 1 => 'Na stanie'])
            ->setAttrib('class', 'form-control')
            ->addValidator('NotEmpty');

        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Nazwa')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('class', 'form-control')
            ->addValidators(array(
                array(
                    'validator'           => 'NotEmpty',
                    'breakChainOnFailure' => true
                ),
                array(
                    'validator' => 'stringLength',
                    'options'   => array(6, 255)
                ),
            ));

        $description = new Zend_Form_Element_Textarea('description');
        $description->setLabel('Opis')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('class', 'form-control')
            ->addValidator('NotEmpty')
            ->addDecorator(
                'HtmlTag',
                array('tag' => 'div', 'class' => 'element')
            );

        $price = new Zend_Form_Element_Text('price');
        $price->setLabel('Cena')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('class', 'form-control')
            ->addValidator('NotEmpty');

        $tax = new Zend_Form_Element_Select('tax');
        $tax->setLabel('Stawka VAT')
            ->setRequired(true)
            ->addMultiOptions([0, 5, 8, 12, 23])
            ->setAttrib('class', 'form-control')
            ->addValidator('NotEmpty');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton')
            ->setAttrib('class', 'btn btn-gradient-primary mr-2');

        $this->addElements(array($id, $name, $description, $price, $tax, $status, $submit));
    }
}
