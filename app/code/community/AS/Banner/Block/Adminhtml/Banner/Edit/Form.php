<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form
 *
 * @author root
 */
class AS_Banner_Block_Adminhtml_Banner_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    //put your code here
    
        /**
     * Init form
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('banner_form');
        $this->setTitle(Mage::helper('banner')->__('Banner Information'));
    }

    

    protected function _prepareForm()
    {
        $model = Mage::registry('banner');

        $form = new Varien_Data_Form(
            array('id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post','enctype' => 'multipart/form-data')
        );

        $form->setHtmlIdPrefix('banner_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>Mage::helper('banner')->__('Banner Information'), 'class' => 'fieldset-wide'));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }

        $fieldset->addField('title', 'text', array(
            'name'      => 'title',
            'label'     => Mage::helper('banner')->__('Banner Title'),
            'title'     => Mage::helper('banner')->__('Banner Title'),
            'required'  => true,
        ));
/**
          * Check is single store mode
         */
        if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_id', 'multiselect', array(
                'name'      => 'stores[]',
                'label'     => Mage::helper('cms')->__('Store View'),
                'title'     => Mage::helper('cms')->__('Store View'),
                'required'  => true,
                'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
                
            ));
            
        }
        else {
            $fieldset->addField('store_id', 'hidden', array(
                'name'      => 'stores[]',
                'value'     => Mage::app()->getStore(true)->getId()
            ));
            $model->setStoreId(Mage::app()->getStore(true)->getId());
        }
        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('banner')->__('Status'),
            'title'     => Mage::helper('banner')->__('Status'),
            'name'      => 'status',
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('banner')->__('Enabled'),
                '0' => Mage::helper('banner')->__('Disabled'),
            ),
        ));
        
        $fieldset->addField('link', 'text', array(
            'name'      => 'link',
            'label'     => Mage::helper('banner')->__('Banner Link'),
            'title'     => Mage::helper('banner')->__('Banner Link'),
            'required'  => false,
            'note'      => Mage::helper("banner")->__("Use link with <b>http://</b> like : <b>http://www.google.com</b>")
        ));
        
        
        if($model->getImage() == "")
        {
            $fieldset->addField('image', 'file', array(
                'name'      => 'image',
                'label'     => Mage::helper('banner')->__('Image'),
                'title'     => Mage::helper('banner')->__('Image'),
                'required'  => true
            ));
        }
        else
        {
            $path = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA)."AS_Banner/".$model->getImage();
            $note = 'Browse new image to replace old one.Allowed image type [ "jpg","jpeg","gif","png"]<br/> <a href="'.$path.'" rel="lightbox" onclick="func_loadLightBox(this);return false;" title="'.$model->getTitle().'">
                    <img src="'.$path.'" style="width:120px;height:120px;"/></a>';
            
            $fieldset->addField('image', 'file', array(
                'name'      => 'image',
                'label'     => Mage::helper('banner')->__('Image'),
                'title'     => Mage::helper('banner')->__('Image'),
                'required'  => false,
                'note'      => $note
            ));
            
        }

        
        
        if (!$model->getId()) {
            $model->setData('status', '1');
        }
        
        

        $fieldset->addField('content', 'textarea', array(
            'name'      => 'content',
            'label'     => Mage::helper('banner')->__('Content'),
            'title'     => Mage::helper('banner')->__('Content'),
            'required'  => false
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
    
}

?>
