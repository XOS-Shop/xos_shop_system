<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : captcha.php
// author     : Hanspeter Zeller <hpz@xos-shop.com>
// copyright  : Copyright (c) 2007 Hanspeter Zeller
// license    : This file is part of XOS-Shop.
//
//              XOS-Shop is free software: you can redistribute it and/or modify
//              it under the terms of the GNU General Public License as published
//              by the Free Software Foundation, either version 3 of the License,
//              or (at your option) any later version.
//
//              XOS-Shop is distributed in the hope that it will be useful,
//              but WITHOUT ANY WARRANTY; without even the implied warranty of
//              MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//              GNU General Public License for more details.
//
//              You should have received a copy of the GNU General Public License
//              along with XOS-Shop.  If not, see <http://www.gnu.org/licenses/>.   
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_CAPTCHA) == 'overwrite_all')) : 
  $_SESSION['navigation']->remove_current_page();
  
  unset($_SESSION['captcha_spam']); 

  function randomString($len) { 
    $possible="0123456789"; 
    $str=""; 
    while(strlen($str)<$len) { 
      $str.=substr($possible,(rand()%(strlen($possible))),1); 
    } 
    
    return($str); 
  } 

  $text = randomString(5);
  $_SESSION['captcha_spam'] = $text; 
          
  header_remove();
  header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
  header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); 
  header('Cache-Control: no-store, no-cache, must-revalidate');
  header('Cache-Control: post-check=0, pre-check=0', false);
  header('Pragma: no-cache');            
  header('Content-type: image/png');
  $img = ImageCreateFromPNG(DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/includes/captcha/captcha' . rand(1,6) . '.png'); 
  $color = ImageColorAllocate($img, 0, 0, 0);
  $background = ImageColorAllocate ($img, 255, 255, 255);
  $possible_angle = array('-20', '-19', '-18', '-17', '-16', '-15', '20', '19', '18', '17', '16', '15');  
  $strlen = strlen($text);  
  $t_x = -16;

  if (function_exists('imagettftext')) { // This function requires both the GD library and the FreeType library.
    $ttfsize = 25;   
    $ttf = DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/includes/captcha/captcha.ttf';
          
    for ($i = 0; $i < $strlen; $i++) {  
      $angle = $possible_angle[rand(0, count($possible_angle) - 1)];  
      $t_x = $t_x + rand(24, 27);
      $t_y = rand(33, 28);                 
      $char = substr($text, $i, 1);
      imagettftext($img, $ttfsize, $angle, $t_x, $t_y, $color, $ttf, $char);
    }
        
  } elseif (function_exists('imagepstext')) { // This function is only available if PHP is compiled using --with-t1lib[=DIR].
    $pfbsize = 34;      
    $pfb = ImagePsLoadFont(DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/includes/captcha/captcha.pfb');
        
    for ($i = 0; $i < $strlen; $i++) {  
      $angle = $possible_angle[rand(0, count($possible_angle) - 1)];  
      $t_x = $t_x + rand(24, 27);
      $t_y = rand(33, 28);                 
      $char = substr($text, $i, 1);
      imagepstext ( $img, $char, $pfb, $pfbsize, $color, $background, $t_x, $t_y, 0, 0, $angle);
    } 
          
  }  
  
  imagepng($img); 
  imagedestroy($img); 
endif;
?> 