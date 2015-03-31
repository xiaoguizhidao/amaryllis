<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CatalogrequestController
 *
 * @author root
 */
class AS_Catalogrequest_Adminhtml_CatalogrequestController extends Mage_Adminhtml_Controller_Action
{
    //put your code here
    
    public function indexAction()
    {
        $this->loadLayout();
        /*$block = $this->getLayout()->createBlock("adminhtml/template")->setTemplate("catalogrequest/head.phtml");
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
        $catalogrequest_id = $this->getRequest()->getParam("id");
        Mage::register("catalogrequest", Mage::getModel("catalogrequest/catalogrequest")->load($catalogrequest_id));
        $this->loadLayout();
        $this->renderLayout();
    }
    
    public function deleteAction()
    {
        
        try 
        {
            $catalogrequestId = $this->getRequest()->getParam('id');
            $catalogrequest = Mage::getSingleton('catalogrequest/catalogrequest')->load($catalogrequestId);
            Mage::dispatchEvent('catalogrequest_controller_nammer_delete', array('catalogrequest' => $catalogrequest));
            $catalogrequest->delete();
            
            $this->_getSession()->addSuccess($this->__('Catalogrequest deleted successfully.'));
        } catch (Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        }

        
        $this->_redirect('*/*/index');
    }
    
    
    public function massDeleteAction()
    {
        $catalogrequestIds = $this->getRequest()->getParam('catalogrequest');
        if (!is_array($catalogrequestIds)) {
            $this->_getSession()->addError($this->__('Please select catalogrequest(s).'));
        } else {
            if (!empty($catalogrequestIds)) {
                try {
                    foreach ($catalogrequestIds as $catalogrequestId) {
                        $catalogrequest = Mage::getSingleton('catalogrequest/catalogrequest')->load($catalogrequestId);
                        Mage::dispatchEvent('catalogrequest_controller_catalogrequest_delete', array('catalogrequest' => $catalogrequest));
                        $catalogrequest->delete();
                    }
                    $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) have been deleted.', count($catalogrequestIds))
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
        $catalogrequestIds = (array)$this->getRequest()->getParam('catalogrequest');
        $storeId    = (int)$this->getRequest()->getParam('store', 0);
        $status     = (int)$this->getRequest()->getParam('status');

        try {
                foreach ($catalogrequestIds as $catalogrequestId) 
                {
                        $catalogrequest = Mage::getSingleton('catalogrequest/catalogrequest')->load($catalogrequestId);
                        Mage::dispatchEvent('catalogrequest_controller_catalogrequest_status_change', array('catalogrequest' => $catalogrequest));
                        $catalogrequest->setStatus($status);
                        $catalogrequest->save();
                }
            $this->_getSession()->addSuccess(
                $this->__('Total of %d record(s) have been updated.', count($catalogrequestIds))
            );
        }
        catch (Mage_Core_Model_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        } catch (Mage_Core_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        } catch (Exception $e) {
            $this->_getSession()
                ->addException($e, $this->__('An error occurred while updating the catalogrequest(s) status.'));
        }

        $this->_redirect('*/*/', array('store'=> $storeId));
    }
    
    
    
    public function saveAction()
    {
        try
        {
            $data = $this->getRequest()->getPost();
            $catalogrequest = Mage::getModel("catalogrequest/catalogrequest");
            if(key_exists("id", $data))
            {
                $catalogrequest = $catalogrequest->load($data["id"]);
            }

            $catalogrequest->setTitle($data["title"]);
            $catalogrequest->setStatus($data["status"]);
            $catalogrequest->setContent($data["content"]);
            
            
            
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
                    $path = Mage::getBaseDir("media") . DS . "AS_Catalogrequest" . DS ;
                    $uploader->save($path, $_FILES['image']['name'] );
                    $catalogrequest->setImage($_FILES['image']['name']);

                } 
                catch (Exception $e) 
                {
                    Mage::getSingleton("core/session")->addError($this->__("Image could not be uploaded , please try to save catalogrequest again :").$e->getMessage());
                    $this->_redirect("*/*/*");
                }
            }


            
            
            $catalogrequest->save();
            Mage::getSingleton("core/session")->addSuccess($this->__("Catalogrequest saved successfully."));
            
            
            // clear previously saved data from session
            Mage::getSingleton('adminhtml/session')->setFormData(false);

            // check if 'Save and Continue'
            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('id' => $catalogrequest->getId()));
                return;
            }
            
            
            $this->_redirect("*/*/index");

        } 
        catch (Exception $e) 
        {
            Mage::getSingleton("core/session")->addSuccess($this->__("Catalogrequest could not be saved , please try again :").$e->getMessage());
            $this->_redirect("*/*/*");
        }
    }
    public function exportCsvAction()
    {
        $fileName   = 'catalogrequest.csv';
        $grid       = $this->getLayout()->createBlock('catalogrequest/adminhtml_catalogrequest_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
    }

    /**
     *  Export order grid to Excel XML format
     */
    public function exportExcelAction()
    {
        $fileName   = 'orders.xml';
        $grid       = $this->getLayout()->createBlock('catalogrequest/adminhtml_catalogrequest_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }
    
}

?>
