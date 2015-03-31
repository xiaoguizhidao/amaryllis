<?php
/**
 * Used in creating options for Yes|No config value selection
 *
 */
class AS_Catalogrequest_Model_System_Config_Source_Categories
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        if (strlen($code = Mage::getSingleton('adminhtml/config_data')->getStore())) // store level
        {
        $storeId = Mage::getModel('core/store')->load($code)->getId();
        }
        $root_cat = Mage::app()->getStore($storeId)->getRootCategoryId();
        $category_model = Mage::getModel('catalog/category');
        $categoryid = $root_cat;
        $_category = $category_model->load($categoryid);
        $all_child_categories = $category_model->getResource()->getAllChildren($_category);
        $categoryid = array();
        foreach($all_child_categories as $_category_id)
        {
            $_category = Mage::getModel("catalog/category")->load($_category_id);
            $categoryid[] = array('value' => $_category->getId(), 'label'=>$_category->getName());
        
            
        }
        return $categoryid;
        
        /*return array(
            array('value' => 1, 'label'=>Mage::helper('adminhtml')->__('Yes')),
            array('value' => 0, 'label'=>Mage::helper('adminhtml')->__('No')),
        );*/
    }

}
?>