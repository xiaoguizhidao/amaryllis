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
class AS_Catalogrequest_IndexController  extends Mage_Core_Controller_Front_Action
{
    //put your code here
    public  function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
    public function saveAction()
    {
        try
        {
            $data = $this->getRequest()->getParams();
            $catalogRequestModel = Mage::getModel("catalogrequest/catalogrequest");
            $catalogRequestModel->setFname($data["fname"]);
            $catalogRequestModel->setLname($data["lname"]);
            $catalogRequestModel->setAddress($data["address"]);
            $catalogRequestModel->setCity($data["city"]);
            $catalogRequestModel->setState($data["state"]);
            $catalogRequestModel->setEmail($data["email"]);
            $catalogRequestModel->setZip($data["zip"]);
            $catalogRequestModel->setStoreId($data["storeid"]);
            $catalogRequestModel->save();
            Mage::getSingleton('core/session')->addSuccess($this->__('Your Request has been sent successfully'));
            $this->_redirect('*/*');
        }
        catch(Exception $e)
        {
            Mage::getSingleton('core/session')->addError($this->__('Error in Saving Data please try again .').$e->getMessage());
        }
        
    }
}

?>
