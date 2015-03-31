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
    ->newTable($installer->getTable('wholesaler/wholesaler'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Wholesaler Id')
    ->addColumn('email', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'unsigned'  => true,
        'nullable'  => false,
        ), 'Email')
    ->addColumn('firstname', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'unsigned'  => true,
        'nullable'  => false,
        ), 'First Name')
    ->addColumn('lastname', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'nullable'  => true,
        'default'   => null,
        ), 'Last Name')
    ->addColumn('phone', Varien_Db_Ddl_Table::TYPE_INTEGER,10, array(
        'nullable'  => true,
        'default'   => null,
        ), 'Phone')
    ->addColumn('business', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'nullable'  => true,
        'default'   => null,
        ), 'Business')
    ->addColumn('address1', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'nullable'  => true,
        'default'   => null,
        ), 'Address1')    
    ->addColumn('address2', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'nullable'  => true,
        'default'   => null,
        ), 'Address2')
    ->addColumn('city', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'nullable'  => true,
        'default'   => null,
        ), 'City')
    ->addColumn('state', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'nullable'  => true,
        'default'   => null,
        ), 'State')
     ->addColumn('zip', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'nullable'  => true,
        'default'   => null,
        ), 'Zip')   
    ->addColumn('businesswebsite', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'nullable'  => true,
        'default'   => null,
        ), 'Business Web Site')    
     ->addColumn('howyoufoundbiggrass', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'nullable'  => true,
        'default'   => null,
        ), 'How You Found Big Grass')
    ->addColumn('productsofinterest', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'nullable'  => true,
        'default'   => null,
        ), 'Products Of Interest')
    ->addColumn('comments', Varien_Db_Ddl_Table::TYPE_VARCHAR,500, array(
        'nullable'  => true,
        'default'   => null,
        ), 'Comments')    
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
        ), 'Wholesaler Type')
    ->setComment('AS Wholesaler table store the information about the wholesaler.');
$installer->getConnection()->createTable($table);


$installer->endSetup();
?>