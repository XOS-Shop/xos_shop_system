<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : manufacturer_info.php
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
//------------------------------------------------------------------------------
// this file is based on: 
//              osCommerce, Open Source E-Commerce Solutions
//              http://www.oscommerce.com
//              Copyright (c) 2003 osCommerce
//              filename: manufacturer_info.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/boxes/manufacturer_info.php') == 'overwrite_all')) : 
  if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
    $smarty->caching = 1;
    $cache_id = 'L3|box_manufacturer_info|' . $_SESSION['language'] . '-' . $_GET['language'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'] . '-' . $_GET['products_id'];
  }
      
  if(!$smarty->isCached(SELECTED_TPL . '/includes/boxes/manufacturers_info.tpl', $cache_id)){

    $manufacturer_query = xos_db_query("select m.manufacturers_id, m.manufacturers_image, mi.manufacturers_name, mi.manufacturers_url from " . TABLE_MANUFACTURERS . " m left join " . TABLE_MANUFACTURERS_INFO . " mi on (m.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$_SESSION['languages_id'] . "'), " . TABLE_PRODUCTS . " p  where p.products_id = '" . (int)$_GET['products_id'] . "' and p.manufacturers_id = m.manufacturers_id");
    if (xos_db_num_rows($manufacturer_query)) {
          
      $manufacturer = xos_db_fetch_array($manufacturer_query);
      if (xos_not_null($manufacturer['manufacturers_image'])) {
        $smarty->assign('box_manufacturer_info_manufacturer_image', xos_image(DIR_WS_IMAGES . 'manufacturers/' . rawurlencode($manufacturer['manufacturers_image']), $manufacturer['manufacturers_name']));
      }
      
      if (xos_not_null($manufacturer['manufacturers_url'])) {
        $smarty->assign(array('box_manufacturer_info_link_to_the_manufacturer' => xos_href_link(FILENAME_REDIRECT, 'action=manufacturer&manufacturers_id=' . $manufacturer['manufacturers_id']),
                              'box_manufacturer_info_manufacturer_name' => $manufacturer['manufacturers_name']));
      }
      
      $smarty->assign(array('box_manufacturer_info_has_content' => true,
                            'box_manufacturer_info_link_filename_default' => xos_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $manufacturer['manufacturers_id'])));                     
    }       
  }       
            
  $output_manufacturer_info = $smarty->fetch(SELECTED_TPL . '/includes/boxes/manufacturers_info.tpl', $cache_id);
                              
  $smarty->caching = 0;                            
                            
  $smarty->assign('box_manufacturer_info', $output_manufacturer_info);
endif;
?>
