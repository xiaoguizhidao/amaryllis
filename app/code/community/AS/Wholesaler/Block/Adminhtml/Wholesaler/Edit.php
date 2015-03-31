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
class AS_Wholesaler_Block_Adminhtml_Wholesaler_Edit extends Mage_Adminhtml_Block_Widget_Form_Container 
{
    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'wholesaler';
        $this->_controller = 'adminhtml_wholesaler';

        

        //$this->_updateButton('save', 'label', Mage::helper('wholesaler')->__('Save Wholesaler'));
        $this->_updateButton('delete', 'label', Mage::helper('wholesaler')->__('Delete Wholesaler'));

        /*$this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);
*/
        
        $this->_removeButton("saveandcontinue");
        $this->_removeButton("save");
        $this->_removeButton("reset");
        
        $this->_formScripts[] = "
            document.observe('dom:loaded',function(){
                    $$('input.input-text').each(function(ele,index){
                        ele.replace(ele.value);
                    });
            });
        ";
    }

    /**
     * Get edit form container header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('wholesaler')->getId()) {
            return Mage::helper('wholesaler')->__("Edit Wholesaler '%s'", $this->htmlEscape(Mage::registry('wholesaler')->getFirstname()." ".Mage::registry('wholesaler')->getLastname()));
        }
        else {
            return Mage::helper('wholesaler')->__('New Wholesaler');
        }
    }
    
    
    
    
    
}

?>
