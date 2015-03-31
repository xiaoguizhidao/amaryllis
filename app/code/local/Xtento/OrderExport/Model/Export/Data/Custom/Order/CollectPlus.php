<?php

/**
 * Product:       Xtento_OrderExport (1.6.7)
 * ID:            %!uniqueid!%
 * Packaged:      %!packaged!%
 * Last Modified: 2014-10-31T16:36:04+01:00
 * File:          app/code/local/Xtento/OrderExport/Model/Export/Data/Custom/Order/CollectPlus.php
 * Copyright:     Copyright (c) 2015 XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

class Xtento_OrderExport_Model_Export_Data_Custom_Order_CollectPlus extends Xtento_OrderExport_Model_Export_Data_Abstract
{
    public function getConfiguration()
    {
        return array(
            'name' => 'CollectPlus Data Export',
            'category' => 'Order',
            'description' => 'Export CollectPlus data stored against the order',
            'enabled' => true,
            'apply_to' => array(Xtento_OrderExport_Model_Export::ENTITY_ORDER, Xtento_OrderExport_Model_Export::ENTITY_INVOICE, Xtento_OrderExport_Model_Export::ENTITY_SHIPMENT, Xtento_OrderExport_Model_Export::ENTITY_CREDITMEMO),
            'third_party' => true,
            'depends_module' => 'CollectPlus_Collect',
        );
    }

    public function getExportData($entityType, $collectionItem)
    {
        // Set return array
        $returnArray = array();
        // Fetch fields to export
        $order = $collectionItem->getOrder();

        if (!$this->fieldLoadingRequired('collectplus')) {
            return $returnArray;
        }

        try {
            $this->_writeArray = & $returnArray['collectplus']; // Write on "collectplus" level
            $collectPlusData = $order->getAgentData();
            if (!empty($collectPlusData)) {
                $collectPlusData = @unserialize($collectPlusData);
                if (is_array($collectPlusData)) {
                    foreach ($collectPlusData as $key => $value) {
                        $this->writeValue($key, $value);
                    }
                }
            }
        } catch (Exception $e) {

        }

        // Done
        return $returnArray;
    }
}