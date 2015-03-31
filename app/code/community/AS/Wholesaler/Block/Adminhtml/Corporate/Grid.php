<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Grid
 *
 * @author root
 */
class AS_Wholesaler_Block_Adminhtml_Corporate_Grid  extends Mage_Adminhtml_Block_Widget_Grid
{
    //put your code here
    
    public function __construct()
    {
        parent::__construct();
        $this->setId('corporateGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        $this->setVarNameFilter('corporate_filter');

    }

    

    protected function _prepareCollection()
    {
        
        $collection = Mage::getModel('wholesaler/corporate')->getCollection();

        

        $this->setCollection($collection);

        parent::_prepareCollection();
        return $this;
    }

    

    protected function _prepareColumns()
    {
        $this->addColumn('id',
            array(
                'header'=> Mage::helper('wholesaler')->__('ID'),
                'width' => '50px',
                'type'  => 'number',
                'index' => 'id',
        ));
        $this->addColumn('firstname',
            array(
                'header'=> Mage::helper('wholesaler')->__('Name'),
                'index' => 'firstname',
        ));

       $this->addColumn('email',
            array(
                'header'=> Mage::helper('wholesaler')->__('Email'),
                'index' => 'email',
        ));
        
        $this->addColumn('companyname',
            array(
                'header'=> Mage::helper('wholesaler')->__('Company Name'),
                'index' => 'companyname',
        ));
        $this->addColumn('companywebsite',
            array(
                'header'=> Mage::helper('wholesaler')->__('Company Website'),
                'index' => 'companywebsite',
        ));
        $this->addColumn('companyaddress',
            array(
                'header'=> Mage::helper('wholesaler')->__('Company Address'),
                'index' => 'companyaddress',
        ));
        $this->addColumn('notes',
            array(
                'header'=> Mage::helper('wholesaler')->__('Notes'),
                'index' => 'notes',
        ));
        /*

        $this->addColumn('image', array(
            'header'    => Mage::helper('wholesaler')->__('Image'),
            'width'     => '150px',
            'filter'    => false,
            'sortable'  => false,
            'align'     =>'left',
            'renderer' => 'wholesaler/adminhtml_template_grid_renderer_image'
        ));
        
        

        $this->addColumn('type',
            array(
                'header'=> Mage::helper('wholesaler')->__('Type'),
                'index' => 'type',
        ));

        */
        

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('corporate');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'=> Mage::helper('wholesaler')->__('Delete'),
             'url'  => $this->getUrl('*/*/massDelete'),
             'confirm' => Mage::helper('catalog')->__('Are you sure?')
        ));

        return $this;
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array(
            'store'=>$this->getRequest()->getParam('store'),
            'id'=>$row->getId())
        );
    }
}

?>
