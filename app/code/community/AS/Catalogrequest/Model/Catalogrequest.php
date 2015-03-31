<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Catalogrequest
 *
 * @author root
 */
class AS_Catalogrequest_Model_Catalogrequest extends Mage_Core_Model_Abstract
{
    //put your code here
    
    protected $_resourceModel = "catalogrequest/catalogrequest";
    
    protected function _construct() {
        $this->_init($this->_resourceModel);
    }
    public static function getStore()
    {
        $storeArray = array();
        
        foreach(Mage::app()->getWebsites() as $_website)
        {
            foreach($_website->getGroups() as $_group)
            {
                foreach($_group->getStores() as $_store)
                {
                    $tempId = $_store->getId();
                    if(!in_array($tempId, $storeArray))
                    {
                        $storeArray[$tempId] = Mage::getModel('core/store')->load($tempId)->getName();
                         
                    }
                }
            }
        }
        return $storeArray;
    }
}

?>
