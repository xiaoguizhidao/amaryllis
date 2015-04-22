<?php
/**
* Copyright © Pulsestorm LLC: All rights reserved
*/
class Teninteractivellc_Commercebug_Model_Graphviz
{
    public function capture()
    {    
        $collector  = new Teninteractivellc_Commercebug_Model_Collectorgraphviz; 
        $o = new stdClass();
        $o->dot = Teninteractivellc_Commercebug_Model_Observer_Dot::renderGraph();
        $collector->collectInformation($o);
    }
    
    public function getShim()
    {
        $shim = Teninteractivellc_Commercebug_Model_Shim::getInstance();        
        return $shim;
    }    
}