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
class AS_Wholesaler_Block_Adminhtml_Wholesaler_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    //put your code here
    
        /**
     * Init form
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('wholesaler_form');
        $this->setTitle(Mage::helper('wholesaler')->__('Wholesaler Information'));
    }

    

    protected function _prepareForm()
    {
        $model = Mage::registry('wholesaler');

        $form = new Varien_Data_Form(
            array('id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post','enctype' => 'multipart/form-data')
        );

        $form->setHtmlIdPrefix('wholesaler_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>Mage::helper('wholesaler')->__('Wholesaler Information'), 'class' => 'fieldset-wide'));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }

        

        
        $fieldset->addField('firstname', 'text', array(
            'name'      => 'firstname',
            'label'     => Mage::helper('wholesaler')->__('Firstname'),
            'title'     => Mage::helper('wholesaler')->__('Firstname'),
            'required'  => false,
        ));
        
        $fieldset->addField('lastname', 'text', array(
            'name'      => 'lastname',
            'label'     => Mage::helper('wholesaler')->__('Lastname'),
            'title'     => Mage::helper('wholesaler')->__('Lastname'),
            'required'  => false,
        ));
        $fieldset->addField('email', 'text', array(
            'name'      => 'email',
            'label'     => Mage::helper('wholesaler')->__('Email'),
            'title'     => Mage::helper('wholesaler')->__('Email'),
            'required'  => false,
        ));
        $fieldset->addField('phone', 'text', array(
            'name'      => 'phone',
            'label'     => Mage::helper('wholesaler')->__('Phone'),
            'title'     => Mage::helper('wholesaler')->__('Phone'),
            'required'  => false,
        ));
        
        $fieldset->addField('address1', 'text', array(
            'name'      => 'address1',
            'label'     => Mage::helper('wholesaler')->__('Address1'),
            'title'     => Mage::helper('wholesaler')->__('Address1'),
            'required'  => false,
        ));
        $fieldset->addField('address2', 'text', array(
            'name'      => 'address2',
            'label'     => Mage::helper('wholesaler')->__('Address2'),
            'title'     => Mage::helper('wholesaler')->__('Address2'),
            'required'  => false,
        ));
        $fieldset->addField('city', 'text', array(
            'name'      => 'city',
            'label'     => Mage::helper('wholesaler')->__('City'),
            'title'     => Mage::helper('wholesaler')->__('City'),
            'required'  => false,
        ));
        $fieldset->addField('state', 'text', array(
            'name'      => 'state',
            'label'     => Mage::helper('wholesaler')->__('State'),
            'title'     => Mage::helper('wholesaler')->__('State'),
            'required'  => false,
        ));
        $fieldset->addField('zip', 'text', array(
            'name'      => 'zip',
            'label'     => Mage::helper('wholesaler')->__('Zip'),
            'title'     => Mage::helper('wholesaler')->__('Zip'),
            'required'  => false,
        ));
        $fieldset->addField('business', 'text', array(
            'name'      => 'business',
            'label'     => Mage::helper('wholesaler')->__('Company'),
            'title'     => Mage::helper('wholesaler')->__('Company'),
            'required'  => false,
        ));
        $fieldset->addField('businesswebsite', 'text', array(
            'name'      => 'businesswebsite',
            'label'     => Mage::helper('wholesaler')->__('Company Site'),
            'title'     => Mage::helper('wholesaler')->__('Company Site'),
            'required'  => false,
        ));
        $fieldset->addField('howyoufoundbiggrass', 'text', array(
            'name'      => 'howyoufoundbiggrass',
            'label'     => Mage::helper('wholesaler')->__('How did you find us?'),
            'title'     => Mage::helper('wholesaler')->__('How did you find us?'),
            'required'  => false,
        ));
        
        $fieldset->addField('productsofinterest', 'text', array(
            'name'      => 'productsofinterest',
            'label'     => Mage::helper('wholesaler')->__('Products Of Interest'),
            'title'     => Mage::helper('wholesaler')->__('Products Of Interest'),
            'required'  => false,
        ));
        $fieldset->addField('comments', 'text', array(
            'name'      => 'comments',
            'label'     => Mage::helper('wholesaler')->__('Comments'),
            'title'     => Mage::helper('wholesaler')->__('Comments'),
            'required'  => false,
        ));

        $fieldset->addField('type', 'text', array(
            'name'      => 'type',
            'label'     => Mage::helper('wholesaler')->__('Type'),
            'title'     => Mage::helper('wholesaler')->__('Type'),
            'required'  => false,
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
    
}

?>
