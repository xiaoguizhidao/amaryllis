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


/**
 * Product Name renderer
 */
class AW_Deliverydate_Block_Adminhtml_Sales_Order_Grid_Renderer_Deliverydate extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Datetime {

    /**
     * Renders grid column
     *
     * @param   Varien_Object $row
     * @return  string
     */
    public function render(Varien_Object $row) {

        if (is_empty_date($row->getData($this->getColumn()->getIndex()))) {
            return Mage::helper('deliverydate')->__("--");
        } else {

            $date = new Zend_Date($row->getData($this->getColumn()->getIndex()), Zend_Date::ISO_8601, Mage::app()->getLocale()->getLocaleCode());
            $date->setTimezone('UTC');

            return $date->toString(Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM));
        }
    }

}

