<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : popup_image.php
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
//              filename: popup_image.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_POPUP_IMAGE) == 'overwrite_all')) :
  reset($_GET);
  while (list($key, ) = each($_GET)) {
    switch ($key) {
      case 'banner':
        $banners_id = xos_db_prepare_input($_GET['banner']);
        $language_id= xos_db_prepare_input($_GET['lang']);
        $banner_query = xos_db_query("select banners_title, banners_image from " . TABLE_BANNERS_CONTENT . " where banners_id = '" . (int)$banners_id . "' and language_id = '" . (int)$language_id . "'");
        $banner = xos_db_fetch_array($banner_query);
        $banner_title = $banner['banners_title'];
        $image_source = xos_image(DIR_WS_CATALOG_IMAGES . 'banners/' . $banner['banners_image'], $banner_title);
        break;
    }
  }

  $javascript = '<script type="text/javascript">' . "\n" .
                '/* <![CDATA[ */' . "\n" .
                'function resize() {' . "\n" .
                '  window.resizeTo(document.images[0].width + 30, document.images[0].height + 115);' . "\n" .
                '  window.moveTo((screen.availWidth - document.images[0].width - 30) / 2, (screen.availHeight - document.images[0].height - 115) / 2);' . "\n" .
                '}' . "\n" .
                '/* ]]> */' . "\n" .
                '</script>' . "\n"; 

  $smarty->assign('add_title', ' ' . $banner_title);  
  require(DIR_WS_INCLUDES . 'html_header.php');
  $smarty->assign('image_source', $image_source);
  
  $smarty->display(ADMIN_TPL . '/popup_image.tpl');
endif;       
?>
