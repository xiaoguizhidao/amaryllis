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


class AW_Deliverydate_Helper_Data extends Mage_Core_Helper_Abstract {
    const FORMATS_IDENTITY = 'aw_delivery_date';

    /**
     * converts short date in DB format into all available formats
     * locale aware. No timezone convertion to gmt and back as in the database
     * short format 
     *
     * @param string $dateShort
     * @param Varien_Object $container
     * @param int $storeId 
     */
    public static function attachDeliveryDateFormats($dateShort, $container = null, $storeId = 0) {

        $locale = Mage::getModel('core/locale')->setLocale(Mage::getStoreConfig('general/locale/code', $storeId));

        $date = new Zend_Date($dateShort, Zend_Date::ISO_8601, $locale->getLocaleCode());
        $date->setTimezone('UTC');

        $formats = array(
            'short' => $date->toString($locale->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)),
            'full' => $date->toString($locale->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_FULL)),
            'medium' => $date->toString($locale->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM)),
            'long' => $date->toString($locale->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_LONG))
        );

        if ($container && $container instanceof Varien_Object) {

            $container->setData(self::FORMATS_IDENTITY, $formats);
        }

        return $formats;
    }
    
    public static function convertToDbFormat($dateShort, $object = false) {
        
        $date = new Zend_Date($dateShort, Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT), Mage::app()->getLocale()->getLocaleCode());
        
        $date->setTimezone('UTC'); 
        
        if($object) {
            
            return $date;
        }
        
        return $date->toString(AW_Core_Model_Abstract::DB_DATE_FORMAT);
       
    }
    
    public static function formatDeliveryDate($dateShort, $object = false) {
        
        $locale = Mage::app()->getLocale();
        
        if($dateShort instanceof Zend_Date) {  
            
            return $dateShort->toString($locale->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT));   
            
        }
        
        $date = new Zend_Date($dateShort, Zend_Date::ISO_8601, $locale->getLocaleCode());
        
        $date->setTimezone('UTC'); 
        
        if($object === true) {
            return $date;
        }
        
        return $date->toString($locale->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT));
      
    }

}