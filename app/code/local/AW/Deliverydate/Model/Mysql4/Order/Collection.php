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
class AW_Deliverydate_Model_Mysql4_Order_Collection extends Mage_Sales_Model_Mysql4_Order_Grid_Collection {    public function _beforeLoad() {        $tableName = Mage::getModel('deliverydate/delivery')->getCollection()->getTable('deliverydate/delivery');        $this->getSelect()->joinLeft(                array('del' => $tableName), '`main_table`.`entity_id`=`del`.`order_id`', array('aw_deliverydate_date' => 'del.delivery_date'));        return parent::_beforeLoad();    }}