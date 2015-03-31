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
class AS_Banner_Model_Banner extends Mage_Core_Model_Abstract
{
    //put your code here
    
    protected $_resourceModel = "banner/banner";
    
    protected function _construct() {
        $this->_init($this->_resourceModel);
    }
}

?>
