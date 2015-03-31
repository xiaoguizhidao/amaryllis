<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Collection
 *
 * @author root
 */
class AS_Wholesaler_Model_Mysql4_Corporate_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    //put your code here
    protected $_model = "wholesaler/corporate";
    
    protected function _construct() {
        $this->_init($this->_model);
    }
}

?>
