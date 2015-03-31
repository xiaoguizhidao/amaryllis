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
class AS_Wholesaler_Adminhtml_WholesalerController extends Mage_Adminhtml_Controller_Action
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
        $wholesaler_id = $this->getRequest()->getParam("id");
        Mage::register("wholesaler", Mage::getModel("wholesaler/wholesaler")->load($wholesaler_id));
        $this->loadLayout();
        $this->renderLayout();
    }
    
    public function deleteAction()
    {
        
        try 
        {
            $wholesalerId = $this->getRequest()->getParam('id');
            $wholesaler = Mage::getSingleton('wholesaler/wholesaler')->load($wholesalerId);
            Mage::dispatchEvent('wholesaler_controller_nammer_delete', array('wholesaler' => $wholesaler));
            $wholesaler->delete();
            
            $this->_getSession()->addSuccess($this->__('Wholesaler deleted successfully.'));
        } catch (Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        }

        
        $this->_redirect('*/*/index');
    }
    
    
    public function massDeleteAction()
    {
        $wholesalerIds = $this->getRequest()->getParam('wholesaler');
        if (!is_array($wholesalerIds)) {
            $this->_getSession()->addError($this->__('Please select wholesaler(s).'));
        } else {
            if (!empty($wholesalerIds)) {
                try {
                    foreach ($wholesalerIds as $wholesalerId) {
                        $wholesaler = Mage::getSingleton('wholesaler/wholesaler')->load($wholesalerId);
                        Mage::dispatchEvent('wholesaler_controller_wholesaler_delete', array('wholesaler' => $wholesaler));
                        $wholesaler->delete();
                    }
                    $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) have been deleted.', count($wholesalerIds))
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
    public function massStatusAction()
    {
        $wholesalerIds = (array)$this->getRequest()->getParam('wholesaler');
        $storeId    = (int)$this->getRequest()->getParam('store', 0);
        $status     = (int)$this->getRequest()->getParam('status');

        try {
                foreach ($wholesalerIds as $wholesalerId) 
                {
                        $wholesaler = Mage::getSingleton('wholesaler/wholesaler')->load($wholesalerId);
                        Mage::dispatchEvent('wholesaler_controller_wholesaler_status_change', array('wholesaler' => $wholesaler));
                        $wholesaler->setStatus($status);
                        $wholesaler->save();
                }
            $this->_getSession()->addSuccess(
                $this->__('Total of %d record(s) have been updated.', count($wholesalerIds))
            );
        }
        catch (Mage_Core_Model_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        } catch (Mage_Core_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        } catch (Exception $e) {
            $this->_getSession()
                ->addException($e, $this->__('An error occurred while updating the wholesaler(s) status.'));
        }

        $this->_redirect('*/*/', array('store'=> $storeId));
    }
    
    
    
    public function saveAction()
    {
        try
        {
            $data = $this->getRequest()->getPost();
            $wholesaler = Mage::getModel("wholesaler/wholesaler");
            if(key_exists("id", $data))
            {
                $wholesaler = $wholesaler->load($data["id"]);
            }

            $wholesaler->setTitle($data["title"]);
            $wholesaler->setStatus($data["status"]);
            $wholesaler->setContent($data["content"]);
            
            
            
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
                    $wholesaler->setImage($_FILES['image']['name']);

                } 
                catch (Exception $e) 
                {
                    Mage::getSingleton("core/session")->addError($this->__("Image could not be uploaded , please try to save wholesaler again :").$e->getMessage());
                    $this->_redirect("*/*/*");
                }
            }


            
            
            $wholesaler->save();
            Mage::getSingleton("core/session")->addSuccess($this->__("Wholesaler saved successfully."));
            
            
            // clear previously saved data from session
            Mage::getSingleton('adminhtml/session')->setFormData(false);

            // check if 'Save and Continue'
            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('id' => $wholesaler->getId()));
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
