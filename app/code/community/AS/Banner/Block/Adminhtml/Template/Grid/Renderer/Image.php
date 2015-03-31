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
 class AS_Banner_Block_Adminhtml_Template_Grid_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Action 
{
    public function render(Varien_Object $row)
    {
        return $this->_getValue($row);
    }
    
    public function _getValue(Varien_Object $row)
    {
        $banner_id = $row->getId();
        $bannerModel = Mage::getModel("banner/banner")->load($banner_id);
        $image =  $bannerModel->getImage();
        $title = $bannerModel->getTitle();
        $path = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA)."AS_Banner/".$image;
        
        return  '<a href="'.$path.'" rel="lightbox" onclick="func_loadLightBox(this);return false;" title="'.$title.'"><img  style="vertical-align:middle;" src="'.$path.'" width="140" height="140" /></a>';
        
    }
} 

?>
