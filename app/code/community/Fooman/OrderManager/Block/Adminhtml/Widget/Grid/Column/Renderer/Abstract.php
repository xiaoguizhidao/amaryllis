<?php

abstract class Fooman_OrderManager_Block_Adminhtml_Widget_Grid_Column_Renderer_Abstract
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Text
{
    protected $_address = null;
    protected $_addressDescription = null;

    public function getAddressDescription()
    {
        return Mage::helper('sales')->__($this->_addressDescription);
    }

    public function getFilter()
    {
        return false;
    }

    public function _getValue(Varien_Object $row)
    {
        $order = Mage::getModel('sales/order')->load($row->getId());
        if (!$order->getId()) {
            return '';
        }
        /*
         * We do this check to prevent fatal error on orders without address (virtual products)
         */
        if ($order->getDataUsingMethod($this->_address)) {
            return $order->getDataUsingMethod($this->_address)->format('html');
        } else {
            return Mage::helper('ordermanager')->__('No %s available', $this->getAddressDescription());
        }
    }
}
