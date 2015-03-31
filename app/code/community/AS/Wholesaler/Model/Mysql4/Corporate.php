<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Wholesaler
 *
 * @author root
 */
class AS_Wholesaler_Model_Mysql4_Corporate  extends Mage_Core_Model_Mysql4_Abstract
{
    //put your code here
    protected $_idFieldName = "id";
    protected $_mainTable = "wholesaler/corporate";
    
    
    protected  function _construct() 
    {
        $this->_init($this->_mainTable, $this->_idFieldName);
    }
}

?>
