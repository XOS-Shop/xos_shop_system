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

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_CAPTCHA) == 'overwrite_all')) :
  
  function RC4($str, $key) {
    $s = array();
    for ($i = 0; $i < 256; $i++) {
      $s[$i] = $i;
    }
    $j = 0;
    for ($i = 0; $i < 256; $i++) {
      $j = ($j + $s[$i] + ord($key[$i % strlen($key)])) % 256;
      $x = $s[$i];
      $s[$i] = $s[$j];
      $s[$j] = $x;
    }
    $i = 0;
    $j = 0;
    $res = '';
    for ($y = 0; $y < strlen($str); $y++) {
      $i = ($i + 1) % 256;
      $j = ($j + $s[$i]) % 256;
      $x = $s[$i];
      $s[$i] = $s[$j];
      $s[$j] = $x;
      $res .= chr(ord($str[$y]) ^ $s[($s[$i] + $s[$j]) % 256]);
    }
    return $res;
  }

  function str_encrypt($str) { 
    $str = RC4($str, KEY);
    $str = rawurlencode(base64_encode($str));
    return $str;
  }

  function str_decrypt($str) { 
    $str = base64_decode(rawurldecode($str));	
    $str = RC4($str, KEY);
    return $str;
  }

  function random_string($len = 1) { 
    $possible = '0123456789'; 
    $str = ''; 
    while(strlen($str) < $len) {
      $str .= $possible[mt_rand(0, strlen($possible) - 1)]; 
    }    
    return($str); 
  } 

  $captcha_text = random_string(5);
  
  $img = ImageCreateFromPNG(DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/includes/captcha/captcha' . rand(1,6) . '.png'); 
  $color = ImageColorAllocate($img, 0, 0, 0);
  $background = ImageColorAllocate ($img, 255, 255, 255);
  $possible_angle = array('-20', '-19', '-18', '-17', '-16', '-15', '20', '19', '18', '17', '16', '15');  
  $strlen = strlen($captcha_text);  
  $t_x = -16;

  if (function_exists('imagettftext')) { // This function requires both the GD library and the FreeType library.
    $ttfsize = 25;   
    $ttf = DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/includes/captcha/captcha.ttf';
          
    for ($i = 0; $i < $strlen; $i++) {  
      $angle = $possible_angle[rand(0, count($possible_angle) - 1)];  
      $t_x = $t_x + rand(24, 27);
      $t_y = rand(33, 28);                 
      $char = substr($captcha_text, $i, 1);
      imagettftext($img, $ttfsize, $angle, $t_x, $t_y, $color, $ttf, $char);
    }
        
  } elseif (function_exists('imagepstext')) { // This function is only available if PHP is compiled using --with-t1lib[=DIR].
    $pfbsize = 34;      
    $pfb = ImagePsLoadFont(DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/includes/captcha/captcha.pfb');
        
    for ($i = 0; $i < $strlen; $i++) {  
      $angle = $possible_angle[rand(0, count($possible_angle) - 1)];  
      $t_x = $t_x + rand(24, 27);
      $t_y = rand(33, 28);                 
      $char = substr($captcha_text, $i, 1);
      imagepstext ( $img, $char, $pfb, $pfbsize, $color, $background, $t_x, $t_y, 0, 0, $angle);
    } 
          
  } else { 
    imagedestroy($img);
    $img = imagecreate(140, 40);
    $color = ImageColorAllocate($img, 255, 0, 255);
    $background = ImageColorAllocate ($img, 0, 255, 0);    
    imagefill($img, 0, 0, $background);  
    for ($i = 0; $i < $strlen; $i++) {    
      $pfb = 5;
      $t_x = $t_x + (imagefontwidth($pfb) * 3);
      $t_y = 12;     
      $char = substr($captcha_text, $i, 1);
      imagestring($img, $pfb, $t_x, $t_y, $char, $color);
    }
    
  }  


  imagepng($img, DIR_FS_DOWNLOAD_PUBLIC . 'captcha_tmp.png');
  imagedestroy($img);  
  $img_data = base64_encode(file_get_contents(DIR_FS_DOWNLOAD_PUBLIC . 'captcha_tmp.png'));
  $src_captcha_base64 = 'data:image/png;base64,' . $img_data;   
  @unlink(DIR_FS_DOWNLOAD_PUBLIC . 'captcha_tmp.png');   
endif;
?>