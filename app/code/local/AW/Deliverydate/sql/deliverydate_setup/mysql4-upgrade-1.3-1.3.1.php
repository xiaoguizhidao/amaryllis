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


$installer = $this;
$installer->startSetup();


$newConditionsIds = Mage::getModel('deliverydate/holiday')
        ->getCollection()
        ->addStoreFilter(0)
        ->getAllIds();

$newConditionsIds = implode(',', $newConditionsIds);

$config = new Mage_Core_Model_Config();

$path = AW_Deliverydate_Helper_Config::DELIVERY_HOLYDAYS;

$config->saveConfig($path, $newConditionsIds, 'default', 0);

Mage::getConfig()->reinit();

$installer->endSetup();
