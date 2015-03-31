<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Wholesaler
 *
 * @author root
 */
class AS_Wholesaler_Block_Adminhtml_Corporate  extends Mage_Adminhtml_Block_Widget_Container
{
    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('wholesaler/corporate/corporate.phtml');
    }
    
    protected function _prepareLayout()
    {
        /*$this->_addButton('add_new', array(
            'label'   => Mage::helper('wholesaler')->__('Add Wholesaler'),
            'onclick' => "setLocation('{$this->getUrl('*\/*\/new')}')",
            'class'   => 'add'
        ));*/
            
        $this->_removeButton("add_new");

        $this->setChild('grid', $this->getLayout()->createBlock('wholesaler/adminhtml_corporate_grid', 'corporate.grid'));
        return parent::_prepareLayout();
    }
    
    public function getAddNewButtonHtml()
    {
        return $this->getChildHtml('add_new_button');
    }
    
    
    public function getGridHtml()
    {
        return $this->getChildHtml('grid');
    }
    
    
    public function isSingleStoreMode()
    {
        if (!Mage::app()->isSingleStoreMode()) {
               return false;
        }
        return true;
    }
    
}

?>
