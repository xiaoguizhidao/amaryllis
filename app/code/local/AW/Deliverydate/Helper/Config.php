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


class AW_Deliverydate_Helper_Config extends Mage_Core_Helper_Abstract {
    const XML_PATH_GENERAL_MAX_SAMEDAY_TIME = 'deliverydate/general/max_sameday_time';
    const XML_PATH_GENERAL_TIME_NOTICE_ENABLED = 'deliverydate/general/time_notice_enabled';
    const XML_PATH_GENERAL_MIN_DELIVERY_INTERVAL = 'deliverydate/general/min_delivery_interval';

    const XML_PATH_GENERAL_NOTICE_ENABLED = 'deliverydate/general/notice_enabled';
    const DELIVERY_HOLYDAYS = 'deliverydate/general/smax_sameday_time';


    /*
     * get store holydays ids
     * return @array
     * 
     */

    public function getHolydayIds($storeId=null) {
        $config = Mage::getStoreConfig(self::DELIVERY_HOLYDAYS, $storeId);
        $config = explode(',', $config);
        return $config;
    }

}