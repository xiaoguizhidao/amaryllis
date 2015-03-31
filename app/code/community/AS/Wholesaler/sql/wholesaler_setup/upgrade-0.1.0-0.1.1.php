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
    ->newTable($installer->getTable('wholesaler/corporate'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Corporate Id')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'unsigned'  => true,
        'nullable'  => false,
        ), 'Name')
    ->addColumn('email', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'unsigned'  => true,
        'nullable'  => false,
        ), 'Email')    
    ->addColumn('companyname', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'nullable'  => true,
        'default'   => null,
        ), 'Company Name')    
     ->addColumn('companywebsite', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'nullable'  => true,
        'default'   => null,
        ), 'Company Website')
    ->addColumn('companyaddress', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'nullable'  => true,
        'default'   => null,
        ), 'Company Address')
    ->addColumn('notes', Varien_Db_Ddl_Table::TYPE_VARCHAR,500, array(
        'nullable'  => true,
        'default'   => null,
        ), 'Notes on corportate order')    
   /* ->addColumn('storeid', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
        'default'   => '0',
        ), 'Wholesaler Status')
    ->addColumn('storecode', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'nullable'  => false,
        'default'   => '0',
        ), 'Wholesaler Status')*/
    ->addColumn('type', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'nullable'  => false,
        'default'   => '0',
        ), 'Corporate Type')
    ->setComment('AS Corporate table store the information about the corporaters.');
$installer->getConnection()->createTable($table);


$installer->endSetup();
?>