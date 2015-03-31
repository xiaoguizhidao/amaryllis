<?php
Class Fooman_OrderManager_Model_Selftester extends Fooman_Common_Model_Selftester {

    public function _getVersions ()
    {
        parent::_getVersions();
        $this->messages[] = "OrderManager Config version: " . (string) Mage::getConfig()->getModuleConfig('Fooman_OrderManager')->version;
    }

    public function _getFiles ()
    {
        //REPLACE
        return array(
            'app/code/community/Fooman/OrderManager/Block/Adminhtml/Widget/Grid/Column/Renderer/BillingAddress.php',
            'app/code/community/Fooman/OrderManager/Block/Adminhtml/Widget/Grid/Column/Renderer/TrackingNumberInput.php',
            'app/code/community/Fooman/OrderManager/Block/Adminhtml/Widget/Grid/Column/Renderer/ShippingAddress.php',
            'app/code/community/Fooman/OrderManager/Block/Adminhtml/Widget/Grid/Column/Renderer/TrackingCarrierInput.php',
            'app/code/community/Fooman/OrderManager/Block/Adminhtml/Widget/Grid/Massaction.php',
            'app/code/community/Fooman/OrderManager/Block/Adminhtml/Extensioninfo.php',
            'app/code/community/Fooman/OrderManager/controllers/Sales/OrderManagerController.php',
            'app/code/community/Fooman/OrderManager/etc/adminhtml.xml',
            'app/code/community/Fooman/OrderManager/etc/config.xml',
            'app/code/community/Fooman/OrderManager/etc/system.xml',
            'app/code/community/Fooman/OrderManager/Helper/Data.php',
            'app/code/community/Fooman/OrderManager/Model/Observer.php',
            'app/code/community/Fooman/OrderManager/Model/System/CarrierOptions.php',
            'app/code/community/Fooman/OrderManager/Model/System/OrderStatusOptions.php',
            'app/code/community/Fooman/OrderManager/Model/Sales/Order/Shipment/Api.php',
            'app/code/community/Fooman/OrderManager/Model/Sales/Order/Invoice/Api.php',
            'app/code/community/Fooman/OrderManager/Model/Selftester.php',
            'app/etc/modules/Fooman_OrderManager.xml',
            'app/design/adminhtml/default/default/layout/fooman_ordermanager.xml',
            'app/locale/en_US/Fooman_OrderManager.csv',
            'app/locale/de_DE/Fooman_OrderManager.csv',
            'js/fooman/adminhtml/grid.js',
        );
        //REPLACE_END
    }
}
