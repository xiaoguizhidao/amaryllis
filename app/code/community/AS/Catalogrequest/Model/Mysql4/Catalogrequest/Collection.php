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
class AS_Catalogrequest_Model_Mysql4_Catalogrequest_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    //put your code here
    protected $_model = "catalogrequest/catalogrequest";
    
    protected function _construct() {
        $this->_init($this->_model);
    }
}

?>
