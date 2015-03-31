<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Banner
 *
 * @author root
 */
class AS_Banner_Model_Observer
{
   
    public function changetitle(Varien_Event_Observer $observer)
    {
       /*$Product = $observer ->getProduct();
       //echo $product->getName();
       $_product = Mage::getModel('catalog/product')->load($Product->getId());
       $ids = $_product->getCategoryIds();
       //echo "<pre>";print_r($ids);
       if(count($ids)>1)
       {
           $catid = min($ids);
           $_category = Mage::getModel('catalog/category')->load($catid);
           $catname = $_category->getName();
       }
       else if(count($ids) == 1)
       {
           foreach($ids as $_id)
           {
              $catid = $_id;
              $_category = Mage::getModel('catalog/category')->load($catid);
              $catname = $_category->getName();
           }    
       }
       //echo $catname;die();
       $product = Mage::getModel('catalog/product')->load($Product->getId());
       $product->setName($catname."-".$_product->getName())->save();
       //die();*/
       
    }
    
   
}

?>
