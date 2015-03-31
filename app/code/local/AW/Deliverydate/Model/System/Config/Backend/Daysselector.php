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


class AW_Deliverydate_Model_System_Config_Backend_Daysselector extends Mage_Core_Model_Config_Data {

    /**
     * Refresh category url rewrites if configuration was changed
     *
     * @return Mage_Adminhtml_Model_System_Config_Backend_Seo_Product
     */
    public function save() {

        Zend_Date::setOptions(array('extend_month' => true)); // Fix Zend_Date::addMonth unexpected result 

        $storeId = $this->getScopeId();

        $oldConditions = Mage::getModel('deliverydate/holiday')
                ->getCollection()
                ->addStoreFilter($storeId);

        foreach ($oldConditions as $m) {
            $m->delete();
        }
        foreach ($this->getValue() as $rule) {
            try {
                if ((@$rule['period_from'] || (@$rule['period_type'])) && !@$rule['delete']) {
                    if ((@$rule['recurrent_day'] && @$rule['period_type'] == 'recurrent_day')) {
                        $today = new Zend_Date;
                        $flag = true;
                        $i = 0;
                        while ($flag) {
                            $i++;
                            $arr = $today->toArray();
                            $weekday = $arr['weekday'];
                            if ($weekday == $rule['recurrent_day']) {
                                $flag = false;
                            } else {
                                $today = $today->addDayOfYear(1);
                            }
                            if ($i > 7) {
                                $flag = false;
                            }
                        }
                        $rule['period_from'] = $today;
                    } else {
                        $rule['period_from'] = AW_Deliverydate_Helper_Data::convertToDbFormat($rule['period_from'], true);  
                    }

                    if (@$rule['period_to']) {
                        $rule['period_to'] = AW_Deliverydate_Helper_Data::convertToDbFormat($rule['period_to'], true);  
                    } else {
                        $rule['period_to'] = $rule['period_from'];
                    }

                    if (($rule['period_to']->compare($rule['period_from'])) < 0) {
                        $a = $rule['period_from'];
                        $rule['period_from'] = $rule['period_to'];
                        $rule['period_to'] = $a;
                        unset($a);
                    }
                    $rule['period_to'] = $rule['period_to']->toString(AW_Core_Model_Abstract::DB_DATE_FORMAT);
                    $rule['period_from'] = $rule['period_from']->toString(AW_Core_Model_Abstract::DB_DATE_FORMAT);
                    Mage::getModel('deliverydate/holiday')
                            ->setData($rule)
                            ->setStoreId($storeId)
                            ->save();
                }
            } catch (Exception $exc) {
                
            }
        }

        $newConditionsIds = Mage::getModel('deliverydate/holiday')
                ->getCollection()
                ->addStoreFilter($storeId)
                ->getAllIds();
        
        $newConditionsIds = implode(',', $newConditionsIds);

        $this->setValue($newConditionsIds);
        parent::save();
    }

}
