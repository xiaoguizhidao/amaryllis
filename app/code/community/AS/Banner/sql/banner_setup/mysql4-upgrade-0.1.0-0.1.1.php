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


$installer->run("ALTER TABLE ".$installer->getTable('banner/banner')." ADD link  varchar(200) NULL");


$installer->endSetup();
?>