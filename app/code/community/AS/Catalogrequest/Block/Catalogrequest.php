<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of catalogrequest
 *
 * @author root
 */
class AS_Catalogrequest_Block_Catalogrequest extends Mage_Core_Block_Template
{
    //put your code here
    
    public function getCatalogrequestConfigStatus()
    {
        $path = "catalogrequest/catalogrequest/status";
        return Mage::getStoreConfig($path);
    }
    
    
    public function getCatalogrequests()
    {
        if($this->getCatalogrequestConfigStatus() == 1)
        {
            $return = array();
            $imageBasePath = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA)."AS_Catalogrequest". DS ;
            $catalogrequestCollection = Mage::getModel("catalogrequest/catalogrequest")->getCollection()->addFieldToFilter("status",1);
            
            $i = 0;
            foreach ($catalogrequestCollection as $key => $_catalogrequest) 
            {
                $return[$_catalogrequest->getTitle()]["title"] = $_catalogrequest->getTitle();
                $return[$_catalogrequest->getTitle()]["image"] = $imageBasePath.$_catalogrequest->getImage();
                $return[$_catalogrequest->getTitle()]["content"] = $_catalogrequest->getContent();
                $i++;
                if($i == Mage::getStoreConfig("catalogrequest/catalogrequest/limit"))
                {
                    break;
                }
            }
            
            return $return;
        }
        else
        {
            return $this->__("Catalogrequest disabled from configuration.");
        }
        
    }
    public function getStates()
    {
        $states = Mage::getModel('directory/country')->load('US')->getRegions();
      //state names
        $optHtml = "";
        foreach ($states as $state)
        {      
            $optHtml .= "<option value='".$state->getName()."'>".$state->getName()."</option>";
            
        }
        return $optHtml;
    }
}

?>
