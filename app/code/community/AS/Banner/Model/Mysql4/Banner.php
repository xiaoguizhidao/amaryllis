<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Banner
 *
 * @author root
 */
class AS_Banner_Model_Mysql4_Banner  extends Mage_Core_Model_Mysql4_Abstract
{
    //put your code here
    protected $_store  = null;
    protected $_idFieldName = "id";
    protected $_mainTable = "banner/banner";
    
    
    protected  function _construct() 
    {
        $this->_init($this->_mainTable, $this->_idFieldName);
    }
    protected function _afterSave(Mage_Core_Model_Abstract $object)
    {
        
        
        $oldStores = $this->lookupStoreIds($object->getId());
        $newStores = (array)$object->getStores();
        $oldStores = $this->lookupStoreIds($object->getId());
        $newStores = (array)$object->getStores();
        if (empty($newStores)) {
            $newStores = (array)$object->getStoreId();
        }
        $table  = $this->getTable('banner/banner_store');
        $insert = array_diff($newStores, $oldStores);
        $delete = array_diff($oldStores, $newStores);

        if ($delete) {
            $where = array(
                'banner_id = ?'     => (int) $object->getId(),
                'store_id IN (?)' => $delete
            );

            $this->_getWriteAdapter()->delete($table, $where);
        }

        if ($insert) {
            $data = array();

            foreach ($insert as $storeId) {
                $data[] = array(
                    'banner_id'  => (int) $object->getId(),
                    'store_id' => (int) $storeId
                );
            }

            $this->_getWriteAdapter()->insertMultiple($table, $data);
        }

        //Mark layout cache as invalidated
        Mage::app()->getCacheInstance()->invalidateType('layout');

        return parent::_afterSave($object);
    }
    
    
    
    public function lookupStoreIds($pageId)
    {
        $adapter = $this->_getReadAdapter();

        $select  = $adapter->select()
            ->from($this->getTable('banner/banner_store'), 'store_id')
            ->where('banner_id = ?',(int)$pageId);


        return $adapter->fetchCol($select);
    }
    
    
    protected function _afterLoad(Mage_Core_Model_Abstract $object)
    {
       
        if ($object->getId()) {
            $stores = $this->lookupStoreIds($object->getId());
            $object->setData('store_id', $stores);
        }
        return parent::_afterLoad($object);
    }
    
    
    
    
    public function setStore($store)
    {
        $this->_store = $store;
        return $this;
    }

    /**
     * Retrieve store model
     *
     * @return Mage_Core_Model_Store
     */
    public function getStore()
    {
        return Mage::app()->getStore($this->_store);
    }
}

?>
