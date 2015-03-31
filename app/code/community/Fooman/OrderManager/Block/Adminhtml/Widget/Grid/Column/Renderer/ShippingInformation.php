<?php

class Fooman_OrderManager_Block_Adminhtml_Widget_Grid_Column_Renderer_ShippingInformation
    extends Fooman_OrderManager_Block_Adminhtml_Widget_Grid_Column_Renderer_Abstract
{
    public function _getValue(Varien_Object $row)
    {
        $order = Mage::getModel('sales/order')->load($row->getId());
        if (!$order->getId()) {
            return '';
        }
        /*
         * We do this check to prevent fatal error on virtual products or any other without shipping address
         */
        if ($order->getShippingAddress()) {

            $infoBlock = Mage::app()->getLayout()->createBlock('adminhtml/sales_order_view_info');
            $infoBlock->setOrder($order);

            $returnHtml = '';

            if ($order->getTracksCollection()->count()) {
                $returnHtml = '<a href="#" id="linkId" onclick="popWin(\'' .
                    $this->helper('shipping')->getTrackingPopupUrlBySalesModel($order) . '\',\'trackorder\',\'width=800,height=600,resizable=yes,scrollbars=yes\')" title="' . $this->__('Track Order') . '">' . $this->__(
                        'Track Order'
                    ) . '</a>'
                    . '<br/>';
            }
            if ($order->getShippingDescription()) {
                $returnHtml .= '<strong>' . $this->escapeHtml($order->getShippingDescription()) . '</strong><br/>';
            }
            if ($this->helper('tax')->displayShippingPriceIncludingTax()) {
                $_excl = $infoBlock->displayShippingPriceInclTax($order);
            } else {
                $_excl = $infoBlock->displayPriceAttribute('shipping_amount', false, ' ');
            }
            $_incl = $infoBlock->displayShippingPriceInclTax($order);
            $returnHtml .= $_excl;
            if ($this->helper('tax')->displayShippingBothPrices() && $_incl != $_excl) {
                $returnHtml .= '(' . $this->__('Incl. Tax') . $_incl . ')';
            }
            /*
             * End
             */
            return $returnHtml;
        } else {
            return Mage::helper('sales')->__('No shipping information available');
        }
    }
}
