<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Catalogrequest
 *
 * @author root
 */
class AS_Catalogrequest_Block_Adminhtml_Catalogrequest  extends Mage_Adminhtml_Block_Widget_Container
{
    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('catalogrequest/catalogrequest.phtml');
    }
    
    protected function _prepareLayout()
    {
         $this->_removeButton('add_new');
        $this->setChild('grid', $this->getLayout()->createBlock('catalogrequest/adminhtml_catalogrequest_grid', 'catalogrequest.grid'));
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
