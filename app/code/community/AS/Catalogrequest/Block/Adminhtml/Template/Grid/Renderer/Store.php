<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Image
 *
 * @author root
 */
 class AS_Catalogrequest_Block_Adminhtml_Template_Grid_Renderer_Store extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Action 
{
    public function render(Varien_Object $row)
    {
        
        return $this->_getValue($row);
    }
    
    public function _getValue(Varien_Object $row)
    {
        $catalogrequest_id = $row->getId();
        $catalogrequestModel = Mage::getModel("catalogrequest/catalogrequest")->load($catalogrequest_id);
        $storeId =  $catalogrequestModel->getStoreId();
        return  Mage::getModel('core/store')->load($storeId)->getName();
        
    }
} 

?>
