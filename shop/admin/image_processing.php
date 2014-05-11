<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : image_processing.php
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
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_IMAGE_PROCESSING) == 'overwrite_all')) :
  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  
  if ($action == 'recreate_product_images_now') {
  
    $smarty_cache_control->clearAllCache();
  
    require_once('includes/classes/image_creator.php');
    xos_set_time_limit(0);
    $files = array();
    $handle = opendir(DIR_FS_CATALOG_IMAGES . 'products/uploads/');
    while  ($files[] = readdir($handle)) {}  
    closedir($handle);
    
    $products_query = xos_db_query("select products_image from " . TABLE_PRODUCTS); 
    if (xos_db_num_rows($products_query)) { 
      while ($products = xos_db_fetch_array($products_query)) {
        $products_image = xos_get_product_images($products['products_image'], 'all');
        foreach($products_image as $key => $val) {            
          if (in_array($val['name'], $files)) {                                      
            new image_create(DIR_FS_CATALOG_IMAGES . 'products/uploads/' . $val['name'], DIR_FS_CATALOG_IMAGES . 'products/extra_small/' . $val['name'], EXTRA_SMALL_PRODUCT_IMAGE_MAX_WIDTH, EXTRA_SMALL_PRODUCT_IMAGE_MAX_HEIGHT, IMAGE_QUALITY, EXTRA_SMALL_PRODUCT_IMAGE_MERGE);
            new image_create(DIR_FS_CATALOG_IMAGES . 'products/uploads/' . $val['name'], DIR_FS_CATALOG_IMAGES . 'products/small/' . $val['name'], SMALL_PRODUCT_IMAGE_MAX_WIDTH, SMALL_PRODUCT_IMAGE_MAX_HEIGHT, IMAGE_QUALITY, SMALL_PRODUCT_IMAGE_MERGE);
            new image_create(DIR_FS_CATALOG_IMAGES . 'products/uploads/' . $val['name'], DIR_FS_CATALOG_IMAGES . 'products/medium/' . $val['name'], MEDIUM_PRODUCT_IMAGE_MAX_WIDTH, MEDIUM_PRODUCT_IMAGE_MAX_HEIGHT, IMAGE_QUALITY, MEDIUM_PRODUCT_IMAGE_MERGE);
            new image_create(DIR_FS_CATALOG_IMAGES . 'products/uploads/' . $val['name'], DIR_FS_CATALOG_IMAGES . 'products/large/' . $val['name'], ($val['large_image_max_width'] == 'default' ? LARGE_PRODUCT_IMAGE_MAX_WIDTH : $val['large_image_max_width']), ($val['large_image_max_height'] == 'default' ? LARGE_PRODUCT_IMAGE_MAX_HEIGHT : $val['large_image_max_height']), IMAGE_QUALITY, LARGE_PRODUCT_IMAGE_MERGE);               
          }          
        } 
      }
    }  

    $smarty->assign(array('recreate_product_images_now' => true,
                          'link_filename_image_processing_back' => xos_href_link(FILENAME_IMAGE_PROCESSING)));

    $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'image_processing');
    $output_image_processing_recreate = $smarty->fetch(ADMIN_TPL . '/image_processing.tpl');
    
    echo $output_image_processing_recreate; 
    die;        
  }
  
  if ($action == 'recreate_category_images_now') {
  
    $smarty_cache_control->clearAllCache();
  
    require_once('includes/classes/image_creator.php');
    xos_set_time_limit(0);
    $files = array();
    $handle = opendir(DIR_FS_CATALOG_IMAGES . 'categories/uploads/');
    while  ($files[] = readdir($handle)) {}  
    closedir($handle);
    foreach($files as $img_file) {
      new image_create(DIR_FS_CATALOG_IMAGES . 'categories/uploads/' . $img_file, DIR_FS_CATALOG_IMAGES . 'categories/small/' . $img_file, SMALL_CATEGORY_IMAGE_MAX_WIDTH, SMALL_CATEGORY_IMAGE_MAX_HEIGHT, IMAGE_QUALITY);
      new image_create(DIR_FS_CATALOG_IMAGES . 'categories/uploads/' . $img_file, DIR_FS_CATALOG_IMAGES . 'categories/medium/' . $img_file, MEDIUM_CATEGORY_IMAGE_MAX_WIDTH, MEDIUM_CATEGORY_IMAGE_MAX_HEIGHT, IMAGE_QUALITY);
    } 
    
    $smarty->assign(array('recreate_category_images_now' => true,
                          'link_filename_image_processing_back' => xos_href_link(FILENAME_IMAGE_PROCESSING)));    
    
    $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'image_processing');
    $output_image_processing_recreate = $smarty->fetch(ADMIN_TPL . '/image_processing.tpl'); 
    
    echo $output_image_processing_recreate; 
    die;        
  }

  $javascript = '';

  if ($action == 'confirm_recreate_product_images' || $action == 'confirm_recreate_category_images') {  
    $javascript .= '<script type="text/javascript">' . "\n\n" .
    
                   '/* <![CDATA[ */' . "\n" .
                   '    var http_request = false;' . "\n\n" .

                   '    function confirm_recreate(url) {' . "\n\n" .

                   '        http_request = false;' . "\n\n" .

                   '        if (window.XMLHttpRequest) { // Mozilla, Safari,...' . "\n" .
                   '            http_request = new XMLHttpRequest();' . "\n" .
                   '            if (http_request.overrideMimeType) {' . "\n" .
                   '                http_request.overrideMimeType("text/html");' . "\n" .
                   '            }' . "\n" .
                   '        } else if (window.ActiveXObject) { // IE' . "\n" .
                   '            try {' . "\n" .
                   '                http_request = new ActiveXObject("Msxml2.XMLHTTP");' . "\n" .
                   '            } catch (e) {' . "\n" .
                   '                try {' . "\n" .
                   '                    http_request = new ActiveXObject("Microsoft.XMLHTTP");' . "\n" .
                   '                } catch (e) {}' . "\n" .
                   '            }' . "\n" .
                   '        }' . "\n\n" .

                   '        if (!http_request) {' . "\n" .
                   '            alert("Ende : Kann keine XMLHTTP-Instanz erzeugen");' . "\n" .
                   '            return false;' . "\n" .
                   '        }' . "\n" .
                   '        http_request.onreadystatechange = response_processing;' . "\n" .
                   '        http_request.open("GET", url, true);' . "\n" .
                   '        http_request.send(null);' . "\n\n" .

                   '    }' . "\n\n" .

                   '    function response_processing() {' . "\n\n" .

                   '        if (http_request.readyState == 4) {' . "\n" .
                   '            if (http_request.status == 200) {' . "\n" .
//                   '                alert(http_request.responseText);' . "\n" .
                   '                document.getElementById("infoSend").innerHTML = http_request.responseText;' . "\n" .
                   '            } else {' . "\n" .
                   '                alert("Bei dem Request ist ein Problem aufgetreten.");' . "\n" .
                   '            }' . "\n" .
                   '        }' . "\n\n" .

                   '    }' . "\n" .
                   '/* ]]> */' . "\n" .
                   '</script>' . "\n";                
  }

  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');  

  if ($action == 'confirm_recreate_product_images' || $action == 'confirm_recreate_category_images') { 


    $smarty->assign(array('action' => 'confirm_recreate',
                          'BODY_TAG_PARAMS' => 'onload="confirm_recreate(\'image_processing.php?action=' . ($action == 'confirm_recreate_product_images' ? 'recreate_product_images_now' : 'recreate_category_images_now' ) . '&amp;' .session_name() . '=' .  session_id() . '\')"'));
    
  } else {
    
  $smarty->assign(array('form_begin_action_confirm_recreate_product_images' => xos_draw_form('processing_product_images', FILENAME_IMAGE_PROCESSING, 'action=confirm_recreate_product_images', 'post', 'onsubmit="return confirm(\'' . JS_ARE_YOU_SURE . '\n' . JS_THIS_PROCESS_MAY_TAKE_SOME_TIME . '\')"'),
                        'form_begin_action_confirm_recreate_category_images' => xos_draw_form('processing_category_images', FILENAME_IMAGE_PROCESSING, 'action=confirm_recreate_category_images', 'post', 'onsubmit="return confirm(\'' . JS_ARE_YOU_SURE . '\n' . JS_THIS_PROCESS_MAY_TAKE_SOME_TIME . '\')"'),
                        'form_end' => '</form>'));
                        
  }                          

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'image_processing');
  $output_image_processing = $smarty->fetch(ADMIN_TPL . '/image_processing.tpl');
  
  $smarty->assign('central_contents', $output_image_processing);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
