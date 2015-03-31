<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Banner
 *
 * @author root
 */
class AS_Banner_Block_Adminhtml_Banner  extends Mage_Adminhtml_Block_Widget_Container
{
    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('banner/banner.phtml');
    }
    
    protected function _prepareLayout()
    {
        $this->_addButton('add_new', array(
            'label'   => Mage::helper('banner')->__('Add Banner'),
            'onclick' => "setLocation('{$this->getUrl('*/*/new')}')",
            'class'   => 'add'
        ));

        $this->setChild('grid', $this->getLayout()->createBlock('banner/adminhtml_banner_grid', 'banner.grid'));
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
