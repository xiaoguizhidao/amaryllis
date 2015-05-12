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
class AS_Wholesaler_IndexController  extends Mage_Core_Controller_Front_Action
{
    //put your code here
    public  function indexAction()
    {
        Mage::register("wholeseller_id",  $this->getRequest()->getParam("id"));
        $this->loadLayout();
        $this->renderLayout();
    }
    
    
    
    public  function saveAction()
    {
        
        $data = $this->getRequest()->getPost();
        $captchapost = $data["captchatext"];
        $captchasession = Mage::getSingleton('core/session')->getCaptchaValue($code);
        
        if($captchapost == "")
        {
            Mage::getSingleton('core/session')->addError($this->__('Please enter captcha'));
            $this->_redirect('wholesaler/index/index/',$data); 
        }    
        elseif(($captchapost != "") && ($captchapost != $captchasession))
        {
           Mage::getSingleton('core/session')->addError($this->__('Please correct captcha'));
           $this->_redirect('wholesaler/index/index/',$data); 
        }
        else
        {
         
                unset($data["form_key"]);

                if($data["id"] == "")
                {
                    unset($data["id"]);
                }

                try 
                {
                        $model = Mage::getModel("wholesaler/wholesaler");

                        if(isset($data["id"]))
                        {
                            $model = $model->load($data["id"]);
                        }

                        $model->setData($data);


                        $model->save();


                        Mage::getSingleton('core/session')->addSuccess($this->__('Thank You for your interest in becoming a wholesaler. We will be in touch with you shortly.'));

                        //$this->_redirect('wholesaler/index/index/id/'.$model->getId());
                        $this->_redirectReferer();
                }
                catch (Exception $e) 
                {
                        Mage::getSingleton('core/session')->addError($this->__('There was a problem submitting the wholesaler inquiry. Please try again.'));
                        $this->_redirect('wholesaler/index/index/',$data);
                }
        }
        
        
    }
    
    
    public function captchaAction()
    {
        echo Mage::helper("wholesaler")->captcha();
    }
    
}

?>
