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
class AS_Banner_Block_Adminhtml_Banner_Edit extends Mage_Adminhtml_Block_Widget_Form_Container 
{
    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'banner';
        $this->_controller = 'adminhtml_banner';

        

        $this->_updateButton('save', 'label', Mage::helper('banner')->__('Save Banner'));
        $this->_updateButton('delete', 'label', Mage::helper('banner')->__('Delete Banner'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

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
        if (Mage::registry('banner')->getId()) {
            return Mage::helper('banner')->__("Edit Banner '%s'", $this->htmlEscape(Mage::registry('banner')->getTitle()));
        }
        else {
            return Mage::helper('banner')->__('New Banner');
        }
    }
    
    
    
    
    
}

?>
