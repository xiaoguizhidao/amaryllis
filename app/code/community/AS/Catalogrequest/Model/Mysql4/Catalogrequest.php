<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Catalogrequest
 *
 * @author root
 */
class AS_Catalogrequest_Model_Mysql4_Catalogrequest  extends Mage_Core_Model_Mysql4_Abstract
{
    //put your code here
    protected $_idFieldName = "id";
    protected $_mainTable = "catalogrequest/catalogrequest";
    
    
    protected  function _construct() 
    {
        $this->_init($this->_mainTable, $this->_idFieldName);
    }
}

?>
