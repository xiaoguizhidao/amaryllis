<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Collection
 *
 * @author root
 */
class AS_Banner_Model_Mysql4_Banner_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    //put your code here
    protected $_model = "banner/banner";
    protected $_previewFlag;
    protected function _construct() {
        $this->_init($this->_model);
        $this->_map['fields']['banner_id'] = 'main_table.id';
        $this->_map['fields']['store']   = 'store_table.store_id';
    }
     public function setFirstStoreFlag($flag = false)
    {
        $this->_previewFlag = $flag;
        return $this;
    }
public function toOptionIdArray()
    {
        $res = array();
        $existingIdentifiers = array();
        foreach ($this as $item) {
            $identifier = $item->getData('identifier');

            $data['value'] = $identifier;
            $data['label'] = $item->getData('title');

            if (in_array($identifier, $existingIdentifiers)) {
                $data['value'] .= '|' . $item->getData('id');
            } else {
                $existingIdentifiers[] = $identifier;
            }

            $res[] = $data;
        }

        return $res;
    }
    /**
     * Perform operations after collection load
     *
     * @return Mage_Cms_Model_Resource_Page_Collection
     */
    protected function _afterLoad()
    {
        
        
        if ($this->_previewFlag) {
            $items = $this->getColumnValues('id');
            $connection = $this->getConnection();
            if (count($items)) 
            {
                $select = $connection->select()
                        ->from(array('cps'=>$this->getTable('banner/banner_store')))
                        ->where('cps.banner_id IN (?)', $items);
                
                if ($result = $connection->fetchPairs($select)) 
                {
                    foreach ($this as $item) {
                        
                        if (!isset($result[$item->getData('id')])) {
                            continue;
                        }
                        if ($result[$item->getData('id')] == 0) 
                        {
                            $stores = Mage::app()->getStores(false, true);
                            $storeId = current($stores)->getId();
                            $storeCode = key($stores);
                        } 
                        else 
                        {
                            $storeId = $result[$item->getData('id')];
                            $storeCode = Mage::app()->getStore($storeId)->getCode();
                        }
                        $item->setData('_first_store_id', $storeId);
                        $item->setData('store_code', $storeCode);
                        
                    }
                    
                }
            } 
        }
//        print_r($item->getData());
//        die();
        
        return parent::_afterLoad();
    }

    /**
     * Add filter by store
     *
     * @param int|Mage_Core_Model_Store $store
     * @param bool $withAdmin
     * @return Mage_Cms_Model_Resource_Page_Collection
     */
    public function addStoreFilter($store, $withAdmin = true)
    {
        
        if (!$this->getFlag('store_filter_added')) {
            if ($store instanceof Mage_Core_Model_Store) {
                $store = array($store->getId());
            }

            if (!is_array($store)) {
                $store = array($store);
            }

            if ($withAdmin) {
                $store[] = Mage_Core_Model_App::ADMIN_STORE_ID;
            }

            $this->addFilter('store', array('in' => $store), 'public');
        }
        return $this;
    }

    /**
     * Join store relation table if there is store filter
     */
    protected function _renderFiltersBefore()
    {
        if ($this->getFilter('store')) {
            $this->getSelect()->join(
                array('store_table' => $this->getTable('banner/banner_store')),
                'main_table.id = store_table.banner_id',
                array()
            )->group('main_table.id');

            /*
             * Allow analytic functions usage because of one field grouping
             */
            $this->_useAnalyticFunction = true;
        }
        return parent::_renderFiltersBefore();
    }
}

?>
