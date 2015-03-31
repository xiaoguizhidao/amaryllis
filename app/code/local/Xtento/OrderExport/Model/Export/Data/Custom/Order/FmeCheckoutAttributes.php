<?php

/**
 * Product:       Xtento_OrderExport (1.6.7)
 * ID:            %!uniqueid!%
 * Packaged:      %!packaged!%
 * Last Modified: 2013-11-07T15:27:39+01:00
 * File:          app/code/local/Xtento/OrderExport/Model/Export/Data/Custom/Order/FmeCheckoutAttributes.php
 * Copyright:     Copyright (c) 2015 XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

class Xtento_OrderExport_Model_Export_Data_Custom_Order_FmeCheckoutAttributes extends Xtento_OrderExport_Model_Export_Data_Abstract
{
    public function getConfiguration()
    {
        return array(
            'name' => 'FME Additional Checkout Attributes Export',
            'category' => 'Order',
            'description' => 'Export custom order attributes of FME Additional Checkout Attributes extension',
            'enabled' => true,
            'apply_to' => array(Xtento_OrderExport_Model_Export::ENTITY_ORDER, Xtento_OrderExport_Model_Export::ENTITY_INVOICE, Xtento_OrderExport_Model_Export::ENTITY_SHIPMENT, Xtento_OrderExport_Model_Export::ENTITY_CREDITMEMO),
            'third_party' => true,
            'depends_module' => 'FME_Fieldsmanager',
        );
    }

    public function getExportData($entityType, $collectionItem)
    {
        // Set return array
        $returnArray = array();
        // Fetch fields to export
        $order = $collectionItem->getOrder();

        if (!$this->fieldLoadingRequired('fme_fieldsmanager')) {
            return $returnArray;
        }

        try {
            $this->_writeArray = & $returnArray['fme_fieldsmanager']; // Write on "fme_fieldsmanager" level
            $additionalData = Mage::getModel('fieldsmanager/fieldsmanager')->GetFMData($order->getEntityId(), 'orders', false);
            if ($additionalData && is_array($additionalData)) {
                foreach ($additionalData as $info) {
                    if (isset($info['code']) && isset($info['value'])) {
                        $this->writeValue($info['code'], $info['value']);
                    }
                }
            }
        } catch (Exception $e) {

        }

        // Done
        return $returnArray;
    }
}