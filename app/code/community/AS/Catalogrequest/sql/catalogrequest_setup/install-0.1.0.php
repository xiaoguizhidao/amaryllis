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
    ->newTable($installer->getTable('catalogrequest/catalogrequest'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Catalogrequest Id')
    ->addColumn('fname', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'unsigned'  => true,
        'nullable'  => false,
        ), 'First Name')
     ->addColumn('lname', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'unsigned'  => true,
        'nullable'  => false,
        ), 'Last Name')   
    ->addColumn('address', Varien_Db_Ddl_Table::TYPE_VARCHAR,1000, array(
        'nullable'  => true,
        'default'   => null,
        ), 'Mailing Address')
     ->addColumn('city', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'unsigned'  => true,
        'nullable'  => false,
        ), 'City')
     ->addColumn('state', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'unsigned'  => true,
        'nullable'  => false,
        ), 'State')
     ->addColumn('zip', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'unsigned'  => true,
        'nullable'  => false,
        ), 'Zip')
      ->addColumn('zip', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'unsigned'  => true,
        'nullable'  => false,
        ), 'Zip')
      ->addColumn('email', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'unsigned'  => true,
        'nullable'  => false,
        ), 'Email')
        ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_VARCHAR,200, array(
        'unsigned'  => true,
        'nullable'  => false,
        ), 'Store Id')
    ->setComment('AS Catalogrequest table store the information about the catalogrequest.');
$installer->getConnection()->createTable($table);


$installer->endSetup();
?>