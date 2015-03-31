<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 *
 * @author root
 */
class AS_Banner_IndexController  extends Mage_Core_Controller_Front_Action
{
    //put your code here
    public  function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
}

?>
