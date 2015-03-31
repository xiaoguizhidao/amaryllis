<?php
/**
* aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE-COMMUNITY.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This package designed for Magento COMMUNITY edition
 * aheadWorks does not guarantee correct work of this extension
 * on any other Magento edition except Magento COMMUNITY edition.
 * aheadWorks does not provide extension support in case of
 * incorrect edition usage.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Deliverydate
 * @version    1.3.2
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE-COMMUNITY.txt
 */


class AW_Deliverydate_Model_Observer extends Varien_Object {

    /**
     * Puts module data in session
     * @param object $observer
     * @return 
     */
    public function catchDeliveryData($observer) {

        $date = $observer->getRequest()->getPost('aw_deliverydate_date');
        $notice = $observer->getRequest()->getPost('aw_deliverydate_notice');
        if ($date) {
            $date = new Zend_Date($date, Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT), Mage::app()->getLocale()->getLocaleCode());
            // Test if date is available
            $min_allowed = Mage::getBlockSingleton('deliverydate/html_date')->getFirstAvailableDate();
            if (($date->compare($min_allowed, Zend_Date::DATE_SHORT) < 0)
                    ||
                    !Mage::getBlockSingleton('deliverydate/html_date')->isDateAvail($date)
            ) {

                $result = array('error' => 1,
                    'message' => Mage::helper('deliverydate')->__('Specified delivery date is invalid.')
                );
                echo (Zend_Json::encode($result));
                die();
            }
        } else {
            $date = Mage::getBlockSingleton('deliverydate/html_date')->getFirstAvailableDate();
        }

        Mage::getSingleton('customer/session')
                ->setAwDeliverydateDate($date)
                ->setAwDeliverydateNotice($notice);
    }

    /**
     * Save notice & date
     * @param object $observer
     * @return 
     */
    public function saveDeliveryData($observer) {

        $order = $observer->getEvent()->getOrder();

        $notice = $date = null;

        if (Mage::getStoreConfig(AW_Deliverydate_Helper_Config::XML_PATH_GENERAL_NOTICE_ENABLED)) {
            $notice = Mage::getSingleton('customer/session')->getAwDeliverydateNotice();
            $notice = htmlspecialchars($notice);
            $notice = nl2br($notice);
        }

        $fullDate = $mediumDate = $longDate = $date = null;

        if ($date = Mage::getSingleton('customer/session')->getAwDeliverydateDate()) {

            $date = new Zend_Date($date, Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT), Mage::app()->getLocale()->getLocaleCode());

            // Test if date is available
            $min_allowed = Mage::getBlockSingleton('deliverydate/html_date')->getFirstAvailableDate();
            if (($date->compare($min_allowed, Zend_Date::DATE_SHORT) < 0)
                    ||
                    !Mage::getBlockSingleton('deliverydate/html_date')->isDateAvail($date)
            ) {
                throw new Mage_Checkout_Exception(Mage::helper("deliverydate")->__("Selected delivery date is invalid"));
            }


            $date = $date->toString(AW_Core_Model_Abstract::DB_DATE_FORMAT);

            AW_Deliverydate_Helper_Data::attachDeliveryDateFormats($date, $order, Mage::app()->getStore()->getId());
        }

        Mage::getModel('deliverydate/delivery')
                ->setOrderId($order->getId())
                ->setDeliveryNotice($notice)
                ->setDeliveryDate($date)
                ->save();

        $order->setData('aw_deliverydate_date', $date);
        $order->setData('aw_deliverydate_notice', $notice);


        /* Ddan info for the next product */
        Mage::getSingleton('customer/session')->unsAwDeliverydateDate();
        Mage::getSingleton('customer/session')->unsAwDeliverydateNotice();
    }

    /**
     * Attaches notice & date to order
     * @param object $observer
     * @return
     */
    public function attachDeliveryData($observer) {

        $order = $observer->getEvent()->getOrder();

        $deliverydate = Mage::getModel('deliverydate/delivery')->load($order->getId(), 'order_id');

        if ($deliverydate->getDeliveryDate() && !is_empty_date($deliverydate->getDeliveryDate())) {
            $order->setData('aw_deliverydate_date', $deliverydate->getDeliveryDate());
            // Attach delivery date formats. Return array or writes to order directly
            AW_Deliverydate_Helper_Data::attachDeliveryDateFormats($deliverydate->getDeliveryDate(), $order, $order->getStoreId());
        }

        if ($deliverydate->getDeliveryNotice()) {
            $order->setData('aw_deliverydate_notice', $deliverydate->getDeliveryNotice());
        }

        if ($order->getAwDeliverydateDate() && !is_empty_date($order->getAwDeliverydateDate())) {
            if (Mage::app()->getLayout()->getArea() != 'adminhtml') {
                //$date = Mage::helper('core')->formatDate($order->getAwDeliverydateDate(), Mage_Core_Model_Locale::FORMAT_TYPE_SHORT, null);
                $date = $order->getAwDeliverydateDate();
                $description = '  ';
                $description .= Mage::helper('deliverydate')
                        ->__('(Delivery at %s, %s)', $date, $order->getAwDeliverydateNotice());
                $order->setShippingDescription($order->getShippingDescription() . $description);
            }
        }
    }

}
