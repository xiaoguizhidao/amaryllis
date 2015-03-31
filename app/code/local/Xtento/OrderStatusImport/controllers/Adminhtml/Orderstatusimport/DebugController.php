<?php

/**
 * Product:       Xtento_OrderStatusImport (1.3.3)
 * ID:            Local Deploy
 * Packaged:      2013-11-15T17:59:46+01:00
 * Last Modified: 2013-06-11T12:37:27+02:00
 * File:          app/code/local/Xtento/OrderStatusImport/controllers/Adminhtml/Orderstatusimport/DebugController.php
 * Copyright:     Copyright (c) 2013 XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

class Xtento_OrderStatusImport_Adminhtml_OrderStatusImport_DebugController extends Mage_Adminhtml_Controller_Action {

    public function manualAction() {
        Mage::getModel('orderstatusimport/observer')->importOrderStatusJob(false);
        Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Import job executed.'));
        $this->_redirectReferer();
    }

}