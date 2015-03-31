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
 class AS_Wholesaler_Block_Adminhtml_Template_Grid_Renderer_Type extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Action 
{
    public function render(Varien_Object $row)
    {
        return $this->_getValue($row);
    }
    
    public function _getValue(Varien_Object $row)
    {
        $wholesaler_id = $row->getId();
        $wholesalerModel = Mage::getModel("wholesaler/wholesaler")->load($wholesaler_id);
        $store_locale =  $wholesalerModel->getStorelocale();
        $store_id = $wholesalerModel->getStoreid();
        $store_code = $wholesalerModel->getStorecode();
        
        
        $connection = Mage::getSingleton('core/resource')->getConnection('core_read');
        $select = $connection->select()
        ->from('tablename', array('*')) // select * from tablename or use array('id','name') selected values
        ->where('id=?',1)               // where id =1
        ->group('name');         // group by name
        $rowsArray = $connection->fetchAll($select); // return all rows
        $rowArray =$connection->fetchRow($select); 
            
        return $translated."+".$store_locale;
        
        
    }
} 

?>
