<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of wholesaler
 *
 * @author root
 */
class AS_Wholesaler_Block_Wholesaler extends Mage_Core_Block_Template
{
    //put your code here
    
    public function getWholesalerConfigStatus()
    {
        $path = "wholesaler/wholesaler/status";
        return Mage::getStoreConfig($path);
    }
    
    
    protected function getWholesalers($id)
    {
            $wholesaler = Mage::getModel("wholesaler/wholesaler")->load($id);
            $data = array();
            if($wholesaler->getId())
            {
                $data = $wholesaler->getData();
            }
            else
            {
                $data = Mage::app()->getRequest()->getParams();
            }
            return $data;
    }
    protected function getCorporates($id)
    {
            $corporate = Mage::getModel("wholesaler/corporate")->load($id);
            $data = array();
            if($corporate->getId())
            {
                $data = $corporate->getData();
            }
            else
            {
                $data = Mage::app()->getRequest()->getParams();
            }
            return $data;
    }
    
    
    public function fetchWholesellerData()
    {
        $id = Mage::registry("wholeseller_id");
        return $this->getWholesalers($id);
    }
    public function fetchCorporateData()
    {
        $id = Mage::registry("corporate_id");
        return $this->getCorporates($id);
    }
}

?>
