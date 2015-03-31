<?php

class AS_Wholesaler_Model_Observer
{

    public function validateAmountForWholesellerCustomer(Varien_Event_Observer $observer)
    {
        $enable = Mage::getStoreConfig("wholesaler/wholesalercustomer/status",Mage::app()->getStore());
        if($enable)
        {
            if(Mage::getSingleton('customer/session')->isLoggedIn())
            {
                $minValue = Mage::getStoreConfig("wholesaler/wholesalercustomer/checkoutlimit",Mage::app()->getStore());
                $cusid = Mage::getSingleton('customer/session')->getCustomer()->getId();
                
                $customerData = Mage::getModel('customer/customer')->load($cusid)->getData();
                $group_id = $customerData["group_id"];

                $total = Mage::helper('checkout/cart')->getQuote()->getGrandTotal();
                if(($group_id == "2") && ($total< $minValue))
                {
                  $currency_code = Mage::app()->getStore()->getCurrentCurrencyCode();
                  $currency_symbol = Mage::app()->getLocale()->currency( $currency_code )->getSymbol(); 
                  Mage::getSingleton('checkout/session')->addError(Mage::helper('wholesaler')->__('Your Grand Total must be above or equal to '.$currency_symbol.' '.$minValue.' to proceed further'));
                  $observer->getEvent()->getControllerAction()->setRedirectWithCookieCheck('checkout/cart'); 
                  return;
                }  
            }
        }
    }

}