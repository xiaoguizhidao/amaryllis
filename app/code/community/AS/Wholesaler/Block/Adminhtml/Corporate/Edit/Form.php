<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form
 *
 * @author root
 */

class AS_Wholesaler_Block_Adminhtml_Corporate_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    //put your code here
    
        /**
     * Init form
     */
    public function __construct()
    {
        
        parent::__construct();
        $this->setId('corporate_form');
        $this->setTitle(Mage::helper('wholesaler')->__('Corporate Information'));
    }

    

    protected function _prepareForm()
    {
        $model = Mage::registry('corporate');

        $form = new Varien_Data_Form(
            array('id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post','enctype' => 'multipart/form-data')
        );

        $form->setHtmlIdPrefix('corporate_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>Mage::helper('wholesaler')->__('Corporate Information'), 'class' => 'fieldset-wide'));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }

        
        $fieldset->addField('name', 'text', array(
            'name'      => 'name',
            'label'     => Mage::helper('wholesaler')->__('Corporater Name'),
            'title'     => Mage::helper('wholesaler')->__('Corporater Name'),
            'required'  => false,
        ));
        $fieldset->addField('email', 'text', array(
            'name'      => 'email',
            'label'     => Mage::helper('wholesaler')->__('Corporate Email'),
            'title'     => Mage::helper('wholesaler')->__('Corporate Email'),
            'required'  => false,
        ));
        
        $fieldset->addField('companyname', 'text', array(
            'name'      => 'companyname',
            'label'     => Mage::helper('wholesaler')->__('Company Name'),
            'title'     => Mage::helper('wholesaler')->__('Company Name'),
            'required'  => false,
        ));
        $fieldset->addField('companywebsite', 'text', array(
            'name'      => 'companywebsite',
            'label'     => Mage::helper('wholesaler')->__('Company Website'),
            'title'     => Mage::helper('wholesaler')->__('Company Website'),
            'required'  => false,
        ));
        $fieldset->addField('companyaddress', 'text', array(
            'name'      => 'companyaddress',
            'label'     => Mage::helper('wholesaler')->__('Company Address'),
            'title'     => Mage::helper('wholesaler')->__('Company Address'),
            'required'  => false,
        ));
        $fieldset->addField('notes', 'text', array(
            'name'      => 'notes',
            'label'     => Mage::helper('wholesaler')->__('Notes on corportate order'),
            'title'     => Mage::helper('wholesaler')->__('Notes on corportate order'),
            'required'  => false,
        ));
        /*
        $fieldset->addField('type', 'text', array(
            'name'      => 'type',
            'label'     => Mage::helper('wholesaler')->__('Type'),
            'title'     => Mage::helper('wholesaler')->__('Type'),
            'required'  => false,
        ));
        */
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
    
}

?>
