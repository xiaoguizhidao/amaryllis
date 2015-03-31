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
class AS_Banner_Block_Adminhtml_Banner_Grid  extends Mage_Adminhtml_Block_Widget_Grid
{
    //put your code here
    
    public function __construct()
    {
        parent::__construct();
        $this->setId('bannerGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        $this->setVarNameFilter('banner_filter');

    }

    

    protected function _prepareCollection()
    {
        
        $collection = Mage::getModel('banner/banner')->getCollection();

        $collection->setFirstStoreFlag(true);

        $this->setCollection($collection);

        parent::_prepareCollection();
        return $this;
    }

    

    protected function _prepareColumns()
    {
        $this->addColumn('id',
            array(
                'header'=> Mage::helper('banner')->__('ID'),
                'width' => '50px',
                'type'  => 'number',
                'index' => 'id',
        ));
        $this->addColumn('title',
            array(
                'header'=> Mage::helper('banner')->__('Title'),
                'index' => 'title',
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_id', array(
                'header'        => Mage::helper('banner')->__('Store View'),
                'index'         => 'store_id',
                'type'          => 'store',
                'store_all'     => true,
                'store_view'    => true,
                'sortable'      => false,
                'filter_condition_callback'
                                => array($this, '_filterStoreCondition'),
              //  'renderer'  => 'photogallery/adminhtml_template_grid_renderer_store'
            ));
        }

        $this->addColumn('image', array(
            'header'    => Mage::helper('banner')->__('Image'),
            'width'     => '150px',
            'filter'    => false,
            'sortable'  => false,
            'align'     =>'left',
            'renderer' => 'banner/adminhtml_template_grid_renderer_image'
        ));
        
        

        $this->addColumn('status', array(
            'header'    => Mage::helper('banner')->__('Status'),
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'status',
            'type'      => 'options',
            'options'   => array(
                1 => 'Enabled',
                0 => 'Disabled',
            )
        ));

        
        

        return parent::_prepareColumns();
    }
    protected function _afterLoadCollection()
    {
       
        $this->getCollection()->walk('afterLoad');
        parent::_afterLoadCollection();
    }

    protected function _filterStoreCondition($collection, $column)
    {
        
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }

        $this->getCollection()->addStoreFilter($value);
    }
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('banner');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'=> Mage::helper('banner')->__('Delete'),
             'url'  => $this->getUrl('*/*/massDelete'),
             'confirm' => Mage::helper('catalog')->__('Are you sure?')
        ));


        
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('catalog')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('catalog')->__('Status'),
                         'values' => array(
                                                1 => 'Enabled',
                                                0 => 'Disabled',
                                            )
                     )
             )
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
