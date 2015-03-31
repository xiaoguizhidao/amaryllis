<?php


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BannerController
 *
 * @author root
 */
class AS_Banner_Adminhtml_BannerController extends Mage_Adminhtml_Controller_Action
{
    //put your code here
    
    public function indexAction()
    {
        $this->loadLayout();
        /*$block = $this->getLayout()->createBlock("adminhtml/template")->setTemplate("banner/head.phtml");
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
        $banner_id = $this->getRequest()->getParam("id");
        Mage::register("banner", Mage::getModel("banner/banner")->load($banner_id));
        $this->loadLayout();
        $this->renderLayout();
    }
    
    public function deleteAction()
    {
        
        try 
        {
            $bannerId = $this->getRequest()->getParam('id');
            $banner = Mage::getSingleton('banner/banner')->load($bannerId);
            Mage::dispatchEvent('banner_controller_nammer_delete', array('banner' => $banner));
            $banner->delete();
            
            $this->_getSession()->addSuccess($this->__('Banner deleted successfully.'));
        } catch (Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        }

        
        $this->_redirect('*/*/index');
    }
    
    
    public function massDeleteAction()
    {
        $bannerIds = $this->getRequest()->getParam('banner');
        if (!is_array($bannerIds)) {
            $this->_getSession()->addError($this->__('Please select banner(s).'));
        } else {
            if (!empty($bannerIds)) {
                try {
                    foreach ($bannerIds as $bannerId) {
                        $banner = Mage::getSingleton('banner/banner')->load($bannerId);
                        Mage::dispatchEvent('banner_controller_banner_delete', array('banner' => $banner));
                        $banner->delete();
                    }
                    $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) have been deleted.', count($bannerIds))
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
        $bannerIds = (array)$this->getRequest()->getParam('banner');
        $storeId    = (int)$this->getRequest()->getParam('store', 0);
        $status     = (int)$this->getRequest()->getParam('status');

        try {
                foreach ($bannerIds as $bannerId) 
                {
                        $banner = Mage::getSingleton('banner/banner')->load($bannerId);
                        Mage::dispatchEvent('banner_controller_banner_status_change', array('banner' => $banner));
                        $banner->setStatus($status);
                        $banner->save();
                }
            $this->_getSession()->addSuccess(
                $this->__('Total of %d record(s) have been updated.', count($bannerIds))
            );
        }
        catch (Mage_Core_Model_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        } catch (Mage_Core_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        } catch (Exception $e) {
            $this->_getSession()
                ->addException($e, $this->__('An error occurred while updating the banner(s) status.'));
        }

        $this->_redirect('*/*/', array('store'=> $storeId));
    }
    
    
    
    public function saveAction()
    {
        try
        {
            $data = $this->getRequest()->getPost();
            $banner = Mage::getModel("banner/banner");
            if(key_exists("id", $data))
            {
                $banner = $banner->load($data["id"]);
            }

            $banner->setTitle($data["title"]);
            $banner->setStatus($data["status"]);
            $banner->setContent($data["content"]);
            $banner->setStores($data["stores"]);
            $banner->setLink($data["link"]);
            
            
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
                    $path = Mage::getBaseDir("media") . DS . "AS_Banner" . DS ;
                    $uploader->save($path, $_FILES['image']['name'] );
                    $banner->setImage($_FILES['image']['name']);

                } 
                catch (Exception $e) 
                {
                    Mage::getSingleton("core/session")->addError($this->__("Image could not be uploaded , please try to save banner again :").$e->getMessage());
                    $this->_redirect("*/*/*");
                }
            }


            
            
            $banner->save();
            Mage::getSingleton("core/session")->addSuccess($this->__("Banner saved successfully."));
            
            
            // clear previously saved data from session
            Mage::getSingleton('adminhtml/session')->setFormData(false);

            // check if 'Save and Continue'
            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('id' => $banner->getId()));
                return;
            }
            
            
            $this->_redirect("*/*/index");

        } 
        catch (Exception $e) 
        {
            Mage::getSingleton("core/session")->addSuccess($this->__("Banner could not be saved , please try again :").$e->getMessage());
            $this->_redirect("*/*/*");
        }
    }
    
}

?>
