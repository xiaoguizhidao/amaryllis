<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WholesalerController
 *
 * @author root
 */
class AS_Wholesaler_Adminhtml_CorporateController extends Mage_Adminhtml_Controller_Action
{
    //put your code here
    
    public function indexAction()
    {
        $this->loadLayout();
        /*$block = $this->getLayout()->createBlock("adminhtml/template")->setTemplate("wholesaler/head.phtml");
        $this->getLayout()->getBlock("content")->append($block);  */
        
        $this->renderLayout();
        
    }
    
    
    public function gridAction()
    {
        
        $this->loadLayout();
        
        $this->renderLayout();
        
    }
    
    
    
    public function newAction()
    {
        $this->_forward("edit");
    }
    
    
    public function editAction()
    {
        
        $corporate_id = $this->getRequest()->getParam("id");
        Mage::register("corporate", Mage::getModel("wholesaler/corporate")->load($corporate_id));
        $this->loadLayout();
        $this->renderLayout();
        
    }
    
    public function deleteAction()
    {
        
        try 
        {
            $corporateId = $this->getRequest()->getParam('id');
            $corporate = Mage::getSingleton('wholesaler/corporate')->load($corporateId);
            Mage::dispatchEvent('corporate_controller_nammer_delete', array('corporate' => $corporate));
            $corporate->delete();
            
            $this->_getSession()->addSuccess($this->__('Corporate deleted successfully.'));
        } catch (Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        }

        
        $this->_redirect('*/*/index');
    }
    
    
    public function massDeleteAction()
    {
        $corporateIds = $this->getRequest()->getParam('corporate');
        if (!is_array($corporateIds)) {
            $this->_getSession()->addError($this->__('Please select corporate(s).'));
        } else {
            if (!empty($corporateIds)) {
                try {
                    foreach ($corporateIds as $corporateId) {
                        $corporate = Mage::getSingleton('wholesaler/corporate')->load($corporateId);
                        Mage::dispatchEvent('wholesaler_controller_corporate_delete', array('corporate' => $corporate));
                        $corporate->delete();
                    }
                    $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) have been deleted.', count($corporateIds))
                    );
                } catch (Exception $e) {
                    $this->_getSession()->addError($e->getMessage());
                }
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * Update product(s) status action
     *
     */
    
    
    
    
    public function saveAction()
    {
        try
        {
            $data = $this->getRequest()->getPost();
            $corporate = Mage::getModel("wholesaler/corporate");
            if(key_exists("id", $data))
            {
                $corporate = $corporate->load($data["id"]);
            }

            $corporate->setTitle($data["title"]);
            $corporate->setStatus($data["status"]);
            $corporate->setContent($data["content"]);
            
            
            
            if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') 
            {
                try 
                {
                    /* Starting upload */
                    $uploader = new Varien_File_Uploader('image');

                    // Any extention would work
                    $uploader->setAllowedExtensions(array("jpg","jpeg","gif","png"));
                    $uploader->setAllowRenameFiles(false);

                    // Set the file upload mode
                    // false -> get the file directly in the specified folder
                    // true -> get the file in the product like folders
                    // (file.jpg will go in something like /media/f/i/file.jpg)
                    $uploader->setFilesDispersion(false);

                    // We set media as the upload dir
                    $path = Mage::getBaseDir("media") . DS . "AS_Wholesaler" . DS ;
                    $uploader->save($path, $_FILES['image']['name'] );
                    $corporate->setImage($_FILES['image']['name']);

                } 
                catch (Exception $e) 
                {
                    Mage::getSingleton("core/session")->addError($this->__("Image could not be uploaded , please try to save corporate again :").$e->getMessage());
                    $this->_redirect("*/*/*");
                }
            }


            
            
            $corporate->save();
            Mage::getSingleton("core/session")->addSuccess($this->__("Wholesaler saved successfully."));
            
            
            // clear previously saved data from session
            Mage::getSingleton('adminhtml/session')->setFormData(false);

            // check if 'Save and Continue'
            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('id' => $corporate->getId()));
                return;
            }
            
            
            $this->_redirect("*/*/index");

        } 
        catch (Exception $e) 
        {
            Mage::getSingleton("core/session")->addSuccess($this->__("Wholesaler could not be saved , please try again :").$e->getMessage());
            $this->_redirect("*/*/*");
        }
    }
    
}

?>
