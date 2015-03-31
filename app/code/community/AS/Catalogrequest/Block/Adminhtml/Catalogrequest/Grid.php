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
class AS_Catalogrequest_Block_Adminhtml_Catalogrequest_Grid  extends Mage_Adminhtml_Block_Widget_Grid
{
    //put your code here
    
    public function __construct()
    {
        parent::__construct();
        $this->setId('catalogrequestGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        $this->setVarNameFilter('catalogrequest_filter');

    }

    

    protected function _prepareCollection()
    {
        
        $collection = Mage::getModel('catalogrequest/catalogrequest')->getCollection();

        

        $this->setCollection($collection);

        parent::_prepareCollection();
        return $this;
    }

    

    protected function _prepareColumns()
    {
        $this->addColumn('id',
            array(
                'header'=> Mage::helper('catalogrequest')->__('ID'),
                'width' => '50px',
                'type'  => 'number',
                'index' => 'id',
        ));
        $this->addColumn('fname',
            array(
                'header'=> Mage::helper('catalogrequest')->__('First Name'),
                'index' => 'fname',
        ));
        $this->addColumn('lname',
            array(
                'header'=> Mage::helper('catalogrequest')->__('Last Name'),
                'index' => 'lname',
        ));
        $this->addColumn('address',
            array(
                'header'=> Mage::helper('catalogrequest')->__('Mailing Address'),
                'index' => 'address',
        ));       
        $this->addColumn('city',
            array(
                'header'=> Mage::helper('catalogrequest')->__('City'),
                'index' => 'city',
        ));
        $this->addColumn('state',
            array(
                'header'=> Mage::helper('catalogrequest')->__('State'),
                'index' => 'state',
        ));
       $this->addColumn('zip',
            array(
                'header'=> Mage::helper('catalogrequest')->__('Zip'),
                'index' => 'zip',
        ));
        $this->addColumn('email',
            array(
                'header'=> Mage::helper('catalogrequest')->__('Email'),
                'index' => 'email',
        ));
        $this->addColumn('store_id',
            array(
                'header'=> Mage::helper('catalogrequest')->__('Store'),
                'index' => 'store_id',
                'type'  => 'options',
                'options' => Mage::getSingleton('catalogrequest/catalogrequest')->getStore(), 
               'renderer' => 'catalogrequest/adminhtml_template_grid_renderer_store',
        ));
        
       $this->addRssList('rss/order/new', Mage::helper('sales')->__('New Order RSS'));

        $this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV'));
        $this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel XML'));

        return parent::_prepareColumns();
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
