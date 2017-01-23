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
      $banner_query = $DB->prepare
      (
       "SELECT banners_url
        FROM   " . TABLE_BANNERS_CONTENT . "
        WHERE  banners_id = :goto
        AND    language_id = :languages_id"
      );
      
      $DB->perform($banner_query, array(':goto' => (int)$_GET['goto'],
                                        ':languages_id' => (int)$_SESSION['languages_id']));      
      
      if ($banner_query->rowCount()) {
        $banner = $banner_query->fetch();
        xos_update_banner_click_count((int)$_GET['goto']);

        xos_redirect($banner['banners_url']);
      }
      break;

    case 'url':
      if (isset($_GET['goto']) && xos_not_null($_GET['goto'])) {
        $check_query = $DB->prepare
        (
         "SELECT products_url
          FROM   " . TABLE_PRODUCTS_DESCRIPTION . "
          WHERE  products_url = :goto
          LIMIT  1"
        );
        
        $DB->perform($check_query, array(':goto' => $_GET['goto']));        
        
        if ($check_query->rowCount()) {
          $url = $check_query->fetch();
          xos_redirect(parse_url($url['products_url'], PHP_URL_SCHEME) ? $url['products_url'] : 'http://' . $url['products_url']);
        }
      }
      break;

    case 'manufacturer':
      if (isset($_GET['m']) && xos_not_null($_GET['m'])) {
        $manufacturer_query = $DB->prepare
        (
         "SELECT manufacturers_url
          FROM   " . TABLE_MANUFACTURERS_INFO . "
          WHERE  manufacturers_id = :m
          AND    languages_id = :languages_id"
        );
        
        $DB->perform($manufacturer_query, array(':m' => (int)$_GET['m'],
                                                ':languages_id' => (int)$_SESSION['languages_id']));         
        
        if ($manufacturer_query->rowCount()) {
// url exists in selected language
          $manufacturer = $manufacturer_query->fetch();

          if (xos_not_null($manufacturer['manufacturers_url'])) {
          
            $update_manufacturers_info_query = $DB->prepare
            (
             "UPDATE " . TABLE_MANUFACTURERS_INFO . "
              SET    url_clicked = url_clicked+1,
                     date_last_click = Now()
              WHERE  manufacturers_id = :m
              AND    languages_id = :languages_id"
            );
            
            $DB->perform($update_manufacturers_info_query, array(':m' => (int)$_GET['m'],
                                                                 ':languages_id' => (int)$_SESSION['languages_id']));            

            xos_redirect(parse_url($manufacturer['manufacturers_url'], PHP_URL_SCHEME) ? $manufacturer['manufacturers_url'] : 'http://' . $manufacturer['manufacturers_url']);
          }
        } else {
// no url exists for the selected language, lets use the default language then
          $manufacturer_query = $DB->prepare
          (
           "SELECT mi.languages_id,
                   mi.manufacturers_url
            FROM   " . TABLE_MANUFACTURERS_INFO . " mi,
                   " . TABLE_LANGUAGES . " l
            WHERE  mi.manufacturers_id = :m
            AND    mi.languages_id = l.languages_id
            AND    l.code = :languages_id"
          );
          
          $DB->perform($manufacturer_query, array(':m' => (int)$_GET['m'],
                                                  ':languages_id' => DEFAULT_LANGUAGE));          
          
          if ($manufacturer_query->rowCount()) {
            $manufacturer = $manufacturer_query->fetch();

            if (xos_not_null($manufacturer['manufacturers_url'])) {
              $update_manufacturers_info_query = $DB->prepare
              (
               "UPDATE " . TABLE_MANUFACTURERS_INFO . "
                SET    url_clicked = url_clicked+1,
                       date_last_click = Now()
                WHERE  manufacturers_id = :m
                AND    languages_id = :languages_id"
              );
              
              $DB->perform($update_manufacturers_info_query, array(':m' => (int)$_GET['m'],
                                                                   ':languages_id' => (int)$manufacturer['languages_id']));               

              xos_redirect(parse_url($manufacturer['manufacturers_url'], PHP_URL_SCHEME) ? $manufacturer['manufacturers_url'] : 'http://' . $manufacturer['manufacturers_url']);
            }
          }
        }
      }
      break;
  }

  xos_redirect(xos_href_link(FILENAME_DEFAULT));
endif;