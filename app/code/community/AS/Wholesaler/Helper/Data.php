<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Data
 *
 * @author root
 */
class AS_Wholesaler_Helper_Data  extends Mage_Core_Helper_Abstract
{
    //put your code here
    public function captcha()
    {
        $code=rand(1000,9999);
        Mage::getSingleton('core/session')->setCaptchaValue($code);
        $im = imagecreatetruecolor(50, 28);
        $bg = imagecolorallocate($im, 22, 86, 165); //background color blue
        $fg = imagecolorallocate($im, 255, 255, 255);//text color white
        imagefill($im, 0, 0, $bg);
        imagestring($im, 5, 5, 5,  $code, $fg);
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-type: image/png');
        return imagepng($im);
        //imagedestroy($im);
    }        
}

?>
