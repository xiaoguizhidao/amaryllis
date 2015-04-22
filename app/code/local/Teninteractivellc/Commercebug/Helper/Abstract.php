<?php
/**
* Copyright © Pulsestorm LLC: All rights reserved
*/
abstract class Teninteractivellc_Commercebug_Helper_Abstract extends Mage_Core_Helper_Data
{
    protected $_moduleName='Teninteractivellc_Commercebug';
    public function isModuleOutputEnabled($moduleName = null)
    {        	
        $shim = $this->getShim();
        if(is_callable(array($shim->helper('core'),'isModuleOutputEnabled')))
        {
            return parent::isModuleOutputEnabled();
        }
                     
        if ($moduleName === null) {
            $moduleName = $this->_getModuleName();
        }
        if (Mage::getStoreConfigFlag('advanced/modules_disable_output/' . $moduleName)) {
            return false;
        }
        return true;
    }        	
    
    public function getShim()
    {
        $shim = Teninteractivellc_Commercebug_Model_Shim::getInstance();
        return $shim;	    
    }
    
    public function __()
    {
        $args = func_get_args();
        return call_user_func_array('__',$args);
    }
}