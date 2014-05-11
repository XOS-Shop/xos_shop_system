<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : redirect.php
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
//              filename: redirect.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_REDIRECT) == 'overwrite_all')) : 
  switch ($_GET['action']) {
    case 'banner':
      $banner_query = xos_db_query("select banners_url from " . TABLE_BANNERS_CONTENT . " where banners_id = '" . (int)$_GET['goto'] . "' and language_id = '" . (int)$_SESSION['languages_id'] . "'");
      if (xos_db_num_rows($banner_query)) {
        $banner = xos_db_fetch_array($banner_query);
        xos_update_banner_click_count($_GET['goto']);

        xos_redirect($banner['banners_url']);
      }
      break;

    case 'url':
      if (isset($_GET['goto']) && xos_not_null($_GET['goto'])) {
        $check_query = xos_db_query("select products_url from " . TABLE_PRODUCTS_DESCRIPTION . " where products_url = '" . xos_db_input(xos_db_prepare_input($_GET['goto'])) . "' limit 1");
        if (xos_db_num_rows($check_query)) {
          xos_redirect('http://' . $_GET['goto']);
        }
      }
      break;

    case 'manufacturer':
      if (isset($_GET['manufacturers_id']) && xos_not_null($_GET['manufacturers_id'])) {
        $manufacturer_query = xos_db_query("select manufacturers_url from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' and languages_id = '" . (int)$_SESSION['languages_id'] . "'");
        if (xos_db_num_rows($manufacturer_query)) {
// url exists in selected language
          $manufacturer = xos_db_fetch_array($manufacturer_query);

          if (xos_not_null($manufacturer['manufacturers_url'])) {
            xos_db_query("update " . TABLE_MANUFACTURERS_INFO . " set url_clicked = url_clicked+1, date_last_click = now() where manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' and languages_id = '" . (int)$_SESSION['languages_id'] . "'");

            xos_redirect($manufacturer['manufacturers_url']);
          }
        } else {
// no url exists for the selected language, lets use the default language then
          $manufacturer_query = xos_db_query("select mi.languages_id, mi.manufacturers_url from " . TABLE_MANUFACTURERS_INFO . " mi, " . TABLE_LANGUAGES . " l where mi.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' and mi.languages_id = l.languages_id and l.code = '" . DEFAULT_LANGUAGE . "'");
          if (xos_db_num_rows($manufacturer_query)) {
            $manufacturer = xos_db_fetch_array($manufacturer_query);

            if (xos_not_null($manufacturer['manufacturers_url'])) {
              xos_db_query("update " . TABLE_MANUFACTURERS_INFO . " set url_clicked = url_clicked+1, date_last_click = now() where manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' and languages_id = '" . (int)$manufacturer['languages_id'] . "'");

              xos_redirect($manufacturer['manufacturers_url']);
            }
          }
        }
      }
      break;
  }

  xos_redirect(xos_href_link(FILENAME_DEFAULT));
endif;
?>
