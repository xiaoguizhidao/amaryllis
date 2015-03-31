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
class AS_Catalogrequest_Block_Adminhtml_Catalogrequest_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    //put your code here
    
        /**
     * Init form
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('catalogrequest_form');
        $this->setTitle(Mage::helper('catalogrequest')->__('Catalogrequest Information'));
    }

    

    protected function _prepareForm()
    {
        $model = Mage::registry('catalogrequest');

        $form = new Varien_Data_Form(
            array('id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post','enctype' => 'multipart/form-data')
        );

        $form->setHtmlIdPrefix('catalogrequest_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>Mage::helper('catalogrequest')->__('Catalogrequest Information'), 'class' => 'fieldset-wide'));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }

        $fieldset->addField('fname', 'text', array(
            'name'      => 'fname',
            'label'     => Mage::helper('catalogrequest')->__('First Name'),
            'title'     => Mage::helper('catalogrequest')->__('First Name'),
           
            'readonly'  => 'readonly',
            'style'     => 'border:none; background-color:#FAFAFA',
        ));
        $fieldset->addField('lname', 'text', array(
            'name'      => 'lname',
            'label'     => Mage::helper('catalogrequest')->__('Last Name'),
            'title'     => Mage::helper('catalogrequest')->__('Last Name'),
           
            'readonly'  => 'readonly',
            'style'     => 'border:none; background-color:#FAFAFA',
        ));
        $fieldset->addField('address', 'text', array(
            'name'      => 'address',
            'label'     => Mage::helper('catalogrequest')->__('Mailing Address'),
            'title'     => Mage::helper('catalogrequest')->__('Mailing Address'),
            
            'style'     => 'border:none; background-color:#FAFAFA',
            'readonly'  => 'readonly'
        ));
       $fieldset->addField('city', 'text', array(
            'name'      => 'city',
            'label'     => Mage::helper('catalogrequest')->__('City'),
            'title'     => Mage::helper('catalogrequest')->__('City'),
            
           'style'     => 'border:none; background-color:#FAFAFA',
            'readonly'  => 'readonly'
        ));
        $fieldset->addField('state', 'text', array(
            'name'      => 'state',
            'label'     => Mage::helper('catalogrequest')->__('State'),
            'title'     => Mage::helper('catalogrequest')->__('State'),
            
            'style'     => 'border:none; background-color:#FAFAFA',
            'readonly'  => 'readonly'
        ));
        $fieldset->addField('email', 'text', array(
            'name'      => 'email',
            'label'     => Mage::helper('catalogrequest')->__('Email'),
            'title'     => Mage::helper('catalogrequest')->__('Email'),
            
            'style'     => 'border:none; background-color:#FAFAFA',
            'readonly'  => 'readonly'
        ));
        $fieldset->addField('zip', 'text', array(
            'name'      => 'zip',
            'label'     => Mage::helper('catalogrequest')->__('Zip'),
            'title'     => Mage::helper('catalogrequest')->__('Zip'),
            
            'style'     => 'border:none; background-color:#FAFAFA',
            'readonly'  => 'readonly'
        ));    
       $fieldset->addField('store_id', 'text', array(
            'name'      => 'store_id',
            'label'     => Mage::helper('catalogrequest')->__('Store Id'),
            'title'     => Mage::helper('catalogrequest')->__('Store Id'),
            
           'style'     => 'border:none; background-color:#FAFAFA',
           'readonly'  => 'readonly'
        ));
        
       
        $model->setStoreId(Mage::getModel('core/store')->load($model->getStoreId())->getName());
        $form->setValues($model->getData());
        
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
    
}

?>
