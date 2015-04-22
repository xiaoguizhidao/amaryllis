<?php
/**
* Copyright © Pulsestorm LLC: All rights reserved
*/
class Teninteractivellc_Commercebug_Model_Crossareaajax_Toggletranslation extends Teninteractivellc_Commercebug_Model_Crossareaajax
{
    public function handleRequest()
    {
        $session = $this->_getSessionObject();        
        //$c = $session->getData(Teninteractivellc_Commercebug_Model_Observer::INLINE_TRANSLATION_ON);        
        $c = Mage::getModel('core/cookie')->get('commercebug_inlinetranslate_toggle');
        $c = $c == 'on' ? 'off' : 'on';        
        // $session->setData(Teninteractivellc_Commercebug_Model_Observer::INLINE_TRANSLATION_ON, $c);        
        Mage::getModel('core/cookie')->set('commercebug_inlinetranslate_toggle',$c);
        // setcookie('commercebug_inlinetranslate_toggle',$c, 60 * 60 * 6);
        $this->endWithHtml('Inline Translation is ' . ucwords($c) .' -- Refresh Page to Access.');        
    }
}