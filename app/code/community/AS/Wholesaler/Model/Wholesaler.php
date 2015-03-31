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
class AS_Wholesaler_Model_Wholesaler extends Mage_Core_Model_Abstract
{
    //put your code here
    
    protected $_resourceModel = "wholesaler/wholesaler";
    
    protected function _construct() {
        $this->_init($this->_resourceModel);
    }
}

?>
