<?php
/*
 * @author     Kristof Ringleff
 * @package    Fooman_OrderManager
 * @copyright  Copyright (c) 2009 Fooman Limited (http://www.fooman.co.nz)
 * @copyright  Copyright (c) 2009 smARTstudiosUK Limited (http://smartebusiness.co.uk)
 */


class Fooman_OrderManager_Model_Observer {

    public function addmassbutton($observer) {

        if (
            $observer->getEvent()->getBlock() instanceof Mage_Adminhtml_Block_Widget_Grid_Massaction
            || $observer->getEvent()->getBlock() instanceof Enterprise_SalesArchive_Block_Adminhtml_Sales_Order_Grid_Massaction
            || $observer->getEvent()->getBlock() instanceof Enterprise_SalesArchive_Block_Adminhtml_sales_orderManager_Grid_Massaction
        ) {
            $secure = Mage::app()->getStore()->isCurrentlySecure() ? 'true' : 'false';
            if($observer->getEvent()->getBlock()->getRequest()->getControllerName() =='sales_order' ||
                    $observer->getEvent()->getBlock()->getRequest()->getControllerName() =='adminhtml_sales_order') {

                if (Mage::helper('ordermanager')->getStoreConfig('invoiceaction/enabled')) {
                    $observer->getEvent()->getBlock()->addItem(
                        'ordermanager_invoiceall',
                        array(
                             'label' => Mage::helper('ordermanager')->__('Invoice Selected'),
                             'url'   => Mage::helper('adminhtml')->getUrl(
                                 'adminhtml/sales_orderManager/invoiceall', $secure ? array('_secure' => 1) : array()
                             ),
                        )
                    );
                }

                if (Mage::helper('ordermanager')->getStoreConfig('shipaction/enabled')) {
                    $observer->getEvent()->getBlock()->addItem(
                        'ordermanager_shipall',
                        array(
                             'label' => Mage::helper('ordermanager')->__('Ship Selected'),
                             'url'   => Mage::helper('adminhtml')->getUrl(
                                 'adminhtml/sales_orderManager/shipall', $secure ? array('_secure' => 1) : array()
                             ),
                        )
                    );
                }

                if (Mage::helper('ordermanager')->getStoreConfig('captureaction/enabled')) {
                    $observer->getEvent()->getBlock()->addItem(
                        'ordermanager_captureall',
                        array(
                             'label' => Mage::helper('ordermanager')->__('Capture Selected'),
                             'url'   => Mage::helper('adminhtml')->getUrl(
                                 'adminhtml/sales_orderManager/captureall', $secure ? array('_secure' => 1) : array()
                             ),
                        )
                    );
                }

                if (Mage::helper('ordermanager')->getStoreConfig('invoicecaptureaction/enabled')) {
                    $observer->getEvent()->getBlock()->addItem(
                        'ordermanager_invoiceandcapture',
                        array(
                             'label' => Mage::helper('ordermanager')->__('Invoice + Capture Selected'),
                             'url'   => Mage::helper('adminhtml')->getUrl(
                                 'adminhtml/sales_orderManager/invoiceandcaptureall',
                                 $secure ? array('_secure' => 1) : array()
                             ),
                        )
                    );
                }

                if (Mage::helper('ordermanager')->getStoreConfig('invoiceshipaction/enabled')) {
                    $observer->getEvent()->getBlock()->addItem(
                        'ordermanager_invoiceandshipall',
                        array(
                             'label' => Mage::helper('ordermanager')->__('Invoice + Ship Selected'),
                             'url'   => Mage::helper('adminhtml')->getUrl(
                                 'adminhtml/sales_orderManager/invoiceandshipall',
                                 $secure ? array('_secure' => 1) : array()
                             ),
                        )
                    );
                }

                if (Mage::helper('ordermanager')->getStoreConfig('captureshipaction/enabled')) {
                    $observer->getEvent()->getBlock()->addItem(
                        'ordermanager_captureandshipall',
                        array(
                             'label' => Mage::helper('ordermanager')->__('Capture + Ship Selected'),
                             'url'   => Mage::helper('adminhtml')->getUrl(
                                 'adminhtml/sales_orderManager/captureandshipall',
                                 $secure ? array('_secure' => 1) : array()
                             ),
                        )
                    );
                }

                if (Mage::helper('ordermanager')->getStoreConfig('invoicecaptureshipaction/enabled')) {
                    $observer->getEvent()->getBlock()->addItem(
                        'ordermanager_invoicecaptureshipall',
                        array(
                             'label' => Mage::helper('ordermanager')->__('Invoice + Capture + Ship Selected'),
                             'url'   => Mage::helper('adminhtml')->getUrl(
                                 'adminhtml/sales_orderManager/invoicecaptureshipall',
                                 $secure ? array('_secure' => 1) : array()
                             ),
                        )
                    );
                }
                if (Mage::helper('ordermanager')->getStoreConfig('statusaction/enabled')) {
                    $observer->getEvent()->getBlock()->addItem(
                        'ordermanager_statusall',
                        array(
                             'label'      => Mage::helper('ordermanager')->__('Mass Status Update'),
                             'url'        => Mage::helper('adminhtml')->getUrl(
                                 'adminhtml/sales_orderManager/statusall', $secure ? array('_secure' => 1) : array()
                             ),
                             'additional' => array(
                                 'visibility' => array(
                                     'name'   => 'status',
                                     'type'   => 'select',
                                     'class'  => 'required-entry',
                                     'label'  => Mage::helper('catalog')->__('Status'),
                                     'values' => array_merge(
                                         array('' => ''),
                                         Mage::getSingleton('sales/order_status')->getCollection()->toOptionArray()
                                     )
                                 )
                             )
                        )
                    );
                }
            }
        }
    }

    public function changeGridJSObjects($observer)
    {
        $transport = $observer->getTransport();
        if ($observer->getEvent()->getBlock()->getRequest()->getControllerName() == 'sales_order'
            || $observer->getEvent()->getBlock()->getRequest()->getControllerName() == 'adminhtml_sales_order'
        ) {
            $html = $transport->getHtml();
            $html = str_replace(
                array(
                    'sales_order_grid_massactionJsObject = new varienGridMassaction',
                    'sales_order_gridJsObject = new varienGrid'
                ),
                array(
                    'sales_order_grid_massactionJsObject = new foomanGridMassaction',
                    'sales_order_gridJsObject = new foomanGrid'
                ),
                $html
            );
            $transport->setHtml($html);
        }
    }
}

