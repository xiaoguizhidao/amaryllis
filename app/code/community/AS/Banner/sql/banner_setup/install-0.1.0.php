<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
$installer = $this;


$installer->startSetup();


/**
 * Create table 'newsletter/subscriber'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('banner/banner'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Banner Id')
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'unsigned'  => true,
        'nullable'  => false,
        ), 'Banner Title')
    ->addColumn('image', Varien_Db_Ddl_Table::TYPE_VARCHAR,500, array(
        'unsigned'  => true,
        'nullable'  => false,
        ), 'Banner Image')
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_VARCHAR,1000, array(
        'nullable'  => true,
        'default'   => null,
        ), 'Banner Content')
    ->addColumn('status', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
        'default'   => '0',
        ), 'Banner Status')
    ->setComment('AS Banner table store the information about the banner.');
$installer->getConnection()->createTable($table);
$installer->run(" -- DROP TABLE IF EXISTS {$this->getTable('as_banner_store')};
CREATE TABLE {$this->getTable('as_banner_store')} (
     `banner_id` int(50) unsigned NOT NULL,
      `store_id` int(50) NOT NULL,
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;  
	");

$installer->endSetup();
?>