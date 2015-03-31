<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Edit
 *
 * @author root
 */
class AS_Catalogrequest_Block_Adminhtml_Catalogrequest_Edit extends Mage_Adminhtml_Block_Widget_Form_Container 
{
    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'catalogrequest';
        $this->_controller = 'adminhtml_catalogrequest';

         $this->_removeButton('saveandcontinue');
         $this->_removeButton('save');
         $this->_removeButton('delete');
         $this->_removeButton('reset');
        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * Get edit form container header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('catalogrequest')->getId()) {
            return Mage::helper('catalogrequest')->__("Catalogrequest", $this->htmlEscape(Mage::registry('catalogrequest')->getFname()));
        }
        else {
            return Mage::helper('catalogrequest')->__('New Catalogrequest');
        }
    }
    
    
    
    
    
}

?>
