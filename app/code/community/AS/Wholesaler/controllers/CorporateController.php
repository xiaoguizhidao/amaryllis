<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
class AS_Wholesaler_CorporateController  extends Mage_Core_Controller_Front_Action
{
    //put your code here
    public  function indexAction()
    {
        Mage::register("corporate_id",  $this->getRequest()->getParam("id"));
        $this->loadLayout();
        $this->renderLayout();
    }
    public function saveAction()
    {
        $data = $this->getRequest()->getPost();
        $captchapost = $data["captchatext"];
        $captchasession = Mage::getSingleton('core/session')->getCaptchaValue($code);;
        
        if($captchapost == "")
        {
           Mage::getSingleton('core/session')->addError($this->__('Please enter captcha'));
           $this->_redirect('wholesaler/corporate/index/',$data); 
        }    
        elseif(($captchapost != "") && ($captchapost != $captchasession))
        {
           Mage::getSingleton('core/session')->addError($this->__('Please correct captcha'));
           $this->_redirect('wholesaler/corporate/index/',$data); 
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
                        $model = Mage::getModel("wholesaler/corporate");

                        if(isset($data["id"]))
                        {
                            $model = $model->load($data["id"]);
                        }

                        $model->setData($data);


                        $model->save();


                        Mage::getSingleton('core/session')->addSuccess($this->__('Thank You for your interest. We received your inquiry and will be in touch with you shortly.'));

                        $this->_redirect('wholesaler/corporate/index/id/'.$model->getId());
                }
                catch (Exception $e) 
                {
                        Mage::getSingleton('core/session')->addError($this->__('There was a problem trying to save the corporate inquiry. Please try again.'));
                        $this->_redirect('wholesaler/corporate/index/',$data);
                }
        }
        
        
    }
    public function captchaAction()
    {
        echo Mage::helper("wholesaler")->captcha();
    }
}
?>