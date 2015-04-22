<?php
/**
* Copyright © Pulsestorm LLC: All rights reserved
*/
class Teninteractivellc_Commercebug_Model_Collectorgraphviz extends Teninteractivellc_Commercebug_Model_Observingcollector
{
    static protected $_graphviz;
    public function collectInformation($observer)
    {
        $collector = $this->getCollector();
        self::$_graphviz = $observer->dot;
    }
    
    public function addToObjectForJsonRender($json)
    {
        $json->graphviz = self::$_graphviz;     
        return $json;
    }    
    
    public function createKeyName()
    {
        return 'graphviz';
    }
}