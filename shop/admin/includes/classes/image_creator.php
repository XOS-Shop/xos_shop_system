<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : image_creator.php
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

class image_create {
    var $error	       = false;
    var $format	       = "";
    var $mark_format   = "";
    var $percent       = 0;
    var $mark          = "none";
    var $mark_offset_x = 0;
    var $mark_offset_y = 0;
    var $opacity       = 45;
    var $jpeg_quality  = 75;     

    function image_create($file, $new_file, $max_width = 0, $max_height = 0, $jpeg_quality = 75, $water_mark = "") {
    
        if ($water_mark != "") {
    
          list( $mark, $mark_offset_x, $mark_offset_y, $opacity ) = explode(',', $water_mark);
        
          if (is_file(DIR_FS_CATALOG_IMAGES . 'overlay/' . $mark) || is_file(DIR_FS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $mark)) {
                            
            if (is_file(DIR_FS_CATALOG_IMAGES . 'overlay/' . $mark)) {
                $this->mark = DIR_FS_CATALOG_IMAGES . 'overlay/' . $mark; 
            }
            else {
                $this->mark = DIR_FS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $mark;
            }                          
      
            if (strtolower(substr($mark, -4)) == ".gif") {
                $this->mark_format = "GIF";          
            }        
            else if (strtolower(substr($mark, -4)) == ".jpg") {
                $this->mark_format = "JPEG";          
            } 
            else if (strtolower(substr($mark, -5)) == ".jpeg") {
                $this->mark_format = "JPEG";          
            }                   
            else if (strtolower(substr($mark, -4)) == ".png") {
                $this->mark_format = "PNG";          
            }
	    else {
                $this->mark = "none";
	    }                         
       
            if ($mark_offset_x != "") {
                $this->mark_offset_x = $mark_offset_x;
            }
        
            if ($mark_offset_y != "") {
                $this->mark_offset_y = $mark_offset_y;
            }        
        
            if ($opacity >= 10 && $opacity <= 100) {
                $this->opacity = $opacity;
            } 
          }
        }  
        
	if (strtolower(substr($file, -4)) == ".gif") {
	    $this->format = "GIF";
	}
	else if (strtolower(substr($file, -4)) == ".jpg") {
	    $this->format = "JPEG";
	}
	else if (strtolower(substr($file, -5)) == ".jpeg") {
	    $this->format = "JPEG";
	}	
	else if (strtolower(substr($file, -4)) == ".png") {
	    $this->format = "PNG";
	}
	else {
	    $this->error  = true;
	}

	if ($max_width == 0 && $max_height == 0) {
	    $this->percent = 100;
	}
	
        if ($jpeg_quality >= 10 && $jpeg_quality <= 100) {
          $this->jpeg_quality  = $jpeg_quality;
        }	
        
	$this->file	     = $file;
	$this->new_file	     = $new_file;		
	$this->max_width     = $max_width;
	$this->max_height    = $max_height;
	
		
        if (!empty($this->new_file)) {
            $this->save($this->new_file);
        }
    }

    function calc_width($width, $height) {
	$new_width  = $this->max_width;
	$new_wp     = (100 * $new_width) / $width;
	$new_height = ($height * $new_wp) / 100;
	return array($new_width, $new_height);
    }

    function calc_height($width, $height) {
	$new_height = $this->max_height;
	$new_hp     = (100 * $new_height) / $height;
	$new_width  = ($width * $new_hp) / 100;
	return array($new_width, $new_height);
    }

    function calc_percent($width, $height) {
	$new_width  = ($width * $this->percent) / 100;
	$new_height = ($height * $this->percent) / 100;
	return array($new_width, $new_height);
    }

    function return_value($array) {
	$array[0] = intval($array[0]);
	$array[1] = intval($array[1]);
	return $array;
    }

    function calc_image_size($width, $height) {
	$new_size = array($width, $height);

	if ($this->max_width > 0) {
	    $new_size = $this->calc_width($width, $height);

	    if ($this->max_height > 0) {
		if ($new_size[1] > $this->max_height)
		    $new_size = $this->calc_height($new_size[0], $new_size[1]);
	    }

	    return $this->return_value($new_size);
	}

	if ($this->max_height > 0) {
	    $new_size = $this->calc_height($width, $height);
	    return $this->return_value($new_size);
	}

	if ($this->percent > 0) {
	    $new_size = $this->calc_percent($width, $height);
	    return $this->return_value($new_size);
	}
		
	return $this->return_value($new_size);
    }

    function save($name = "") {
	if ($this->error) {	
	return;
	}

	$size      = GetImageSize($this->file);
	$new_size  = $this->calc_image_size($size[0], $size[1]);
	
	// Requires GD 2.0.1 (PHP >= 4.0.6)	
	if (function_exists("ImageCreateTrueColor")) {
	    $new_image = ImageCreateTrueColor($new_size[0], $new_size[1]);
	}
	else {
	    $new_image = ImageCreate($new_size[0], $new_size[1]);
	}

	switch ($this->format) {
	    case "GIF":
		$old_image = ImageCreateFromGif($this->file);                
                $trnprt_indx = imagecolortransparent($old_image);
                               
                if ($trnprt_indx >= 0) {
//                  $new_image = ImageCreate($new_size[0], $new_size[1]); // Transparenz wenn auskommentiert aber schlechte Bildqualitaet
                  $trnprt_color = imagecolorsforindex($old_image, $trnprt_indx);
                  $trnprt_indx = imagecolorallocate($new_image, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']); 
                  imagefill($new_image, 0, 0, $trnprt_indx);
                  imagecolortransparent($new_image, $trnprt_indx); 
                }
                                                
		break;
	    case "JPEG":
		$old_image = ImageCreateFromJpeg($this->file);
		break;
	    case "PNG":
		$old_image = ImageCreateFromPng($this->file);
                $colorTransparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
                imagefill($new_image, 0, 0, $colorTransparent);
                imagesavealpha($new_image, true);
		break;
	}

	// Requires GD 2.0.1 (PHP >= 4.0.6)
	if (function_exists("ImageCopyResampled")) {
	    ImageCopyResampled($new_image, $old_image, 0, 0, 0, 0, $new_size[0], $new_size[1], $size[0], $size[1]);          	    
	}
	else {
	    ImageCopyResized($new_image, $old_image, 0, 0, 0, 0, $new_size[0], $new_size[1], $size[0], $size[1]);
	} 
	
        if ($this->mark != "none") {
        
            list( $markwidth, $markheight ) = getimagesize($this->mark);
            
	    switch ($this->mark_format) {
	      case "GIF":
		$watermark = ImageCreateFromGif( $this->mark ); 
		break;
	      case "JPEG":
		$watermark = ImageCreateFromJpeg( $this->mark ); 
		break;
	      case "PNG": 
		$watermark = ImageCreateFromPng( $this->mark ); 
		break;
	    }            
            
            imagecopymerge( $new_image, $watermark, $this->mark_offset_x, $new_size[1]-$markheight-$this->mark_offset_y, 0, 0, $markwidth, $markheight, $this->opacity );
            ImageDestroy($watermark);
        }  	

	switch ($this->format) {
	    case "GIF":
		ImageGif($new_image, $name);
		break;
	    case "JPEG":
		ImageJpeg($new_image, $name, $this->jpeg_quality);
		break;
	    case "PNG":
		ImagePng($new_image, $name);
		break;
	}

	ImageDestroy($new_image);
	ImageDestroy($old_image);
	return;
    }
}
?>