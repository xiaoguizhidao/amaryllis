<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of banner
 *
 * @author root
 */
class AS_Banner_Block_Banner extends Mage_Core_Block_Template
{
    //put your code here
    
    public function getBannerConfigStatus()
    {
        $path = "banner/banner/status";
        return Mage::getStoreConfig($path);
    }
    
    
    public function getBanners()
    {
        if($this->getBannerConfigStatus() == 1)
        {
            $return = array();
            $imageBasePath = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA)."AS_Banner". DS ;
            $bannerCollection = Mage::getModel("banner/banner")->getCollection()->addFieldToFilter("status",1)->addStoreFilter(Mage::app()->getStore());
//            echo "<pre>";
//            print_r($bannerCollection->getData());
//            die();
            $i = 0;
            foreach ($bannerCollection as $key => $_banner) 
            {
                $return[$_banner->getTitle()]["title"] = $_banner->getTitle();
                $return[$_banner->getTitle()]["image"] = $imageBasePath.$_banner->getImage();
                $return[$_banner->getTitle()]["content"] = $_banner->getContent();
                $return[$_banner->getTitle()]["link"] = $_banner->getLink();
                $i++;
                if($i == Mage::getStoreConfig("banner/banner/limit"))
                {
                    break;
                }
            }
//            echo '<pre>';
//            print_r($return);
//            die();
            return $return;
        }
        else
        {
            return $this->__("Banner disabled from configuration.");
        }
        
    }
}

?>
