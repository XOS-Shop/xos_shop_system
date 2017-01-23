<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : banner.php
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
//              filename: banner.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

////
// Sets the status of a banner
  function xos_set_banner_status($banners_id, $status) {

    $DB = Registry::get('DB');      
    if ($status == '1') {
      $update_customers_info_query = $DB->prepare
      (
       "UPDATE " . TABLE_BANNERS . "
        SET    status = '1',
               date_status_change = Now(),
               date_scheduled = NULL
        WHERE  banners_id = :banners_id"
      );
      
      $DB->perform($update_customers_info_query, array(':banners_id' => (int)$banners_id));
      
      return $update_customers_info_query->rowCount();            
                        
    } elseif ($status == '0') {
      $update_banners_query = $DB->prepare
      (
       "UPDATE " . TABLE_BANNERS . "
        SET    status = '0',
               date_status_change = Now()
        WHERE  banners_id = :banners_id"
      );
      
      $DB->perform($update_customers_info_query, array(':banners_id' => (int)$banners_id));
      
      return $update_customers_info_query->rowCount();            
                        
    } else {
      return -1;
    }
  }

////
// Auto activate banners
  function xos_activate_banners() {

    $DB = Registry::get('DB');          
    $banners_query = $DB->query
    (
     "SELECT banners_id,
             date_scheduled
      FROM   " . TABLE_BANNERS . "
      WHERE  date_scheduled != ''"
    );
    if ($banners_query->rowCount()) {
      while ($banners = $banners_query->fetch()) {
        if (date('Y-m-d H:i:s') >= $banners['date_scheduled']) {
          xos_set_banner_status($banners['banners_id'], '1');
        }
      }
    }
  }

////
// Auto expire banners
  function xos_expire_banners() {

    $DB = Registry::get('DB');    
    $banners_query = $DB->query
    (
     "SELECT    b.banners_id,
                b.expires_date,
                b.expires_impressions,
                Sum(bh.banners_shown) AS banners_shown
      FROM      " . TABLE_BANNERS . " b," . TABLE_BANNERS_HISTORY . " bh
      WHERE     b.status = '1'
      AND       b.banners_id = bh.banners_id
      GROUP  BY b.banners_id"
    );
    if ($banners_query->rowCount()) {
      while ($banners = $banners_query->fetch()) {
        if (xos_not_null($banners['expires_date'])) {
          if (date('Y-m-d H:i:s') >= $banners['expires_date']) {
            xos_set_banner_status($banners['banners_id'], '0');
          }
        } elseif (xos_not_null($banners['expires_impressions'])) {
          if ( ($banners['expires_impressions'] > 0) && ($banners['banners_shown'] >= $banners['expires_impressions']) ) {
            xos_set_banner_status($banners['banners_id'], '0');
          }
        }
      }
    }
  }

////
// Display a banner from the specified group or banner id ($identifier)
  function xos_display_banner($action, $identifier) {

    $DB = Registry::get('DB');
    if ($action == 'dynamic') {
        
      $banners_query = $DB->prepare
      (
       "SELECT Count(*) AS count
        FROM   " . TABLE_BANNERS . "
        WHERE  status = '1'
        AND    banners_group = :identifier"
      );
      
      $DB->perform($banners_query, array(':identifier' => $identifier));
                                                                    
      $banners = $banners_query->fetch();
            
      if ($banners['count'] > 0) {
      
        $random_banner_select = $DB->prepare
        (
         "SELECT   b.banners_id,
                   bc.banners_title,
                   bc.banners_url,
                   bc.banners_image,
                   bc.banners_html_text,
                   bc.banners_php_source
          FROM     " . TABLE_BANNERS . " b,
                   " . TABLE_BANNERS_CONTENT . " bc
          WHERE    b.banners_id = bc.banners_id
          AND      bc.language_id = :languages_id
          AND      b.status = '1'
          AND      b.banners_group = :identifier
          ORDER BY Rand()
          LIMIT    1"          
        );
        
        $DB->perform($random_banner_select, array(':languages_id' => (int)$_SESSION['languages_id'],
                                                  ':identifier' => $identifier));
                                                    
        $banner = $random_banner_select->fetch();                                             
                                                      
      } else {
        return '<b>XOS ERROR! (xos_display_banner(' . $action . ', ' . $identifier . ') -> No banners with group \'' . $identifier . '\' found!</b>';
      }
    } elseif ($action == 'static') {
      if (is_array($identifier)) {
        $banner = $identifier;
      } else {
        $banner_query = $DB->prepare
        (
         "SELECT b.banners_id,
                 bc.banners_title,
                 bc.banners_url,
                 bc.banners_image,
                 bc.banners_html_text,
                 bc.banners_php_source
          FROM   " . TABLE_BANNERS . " b,
                 " . TABLE_BANNERS_CONTENT . " bc
          WHERE  b.banners_id = bc.banners_id
          AND    bc.language_id = :languages_id
          AND    status = '1'
          AND    b.banners_id = :identifier"
        );
        
        $DB->perform($banner_query, array(':languages_id' => (int)$_SESSION['languages_id'],
                                          ':identifier' => $identifier));
                                                                          
        if ($banner_query->rowCount()) {
          $banner = $banner_query->fetch();
        } else {
          return '<b>XOS ERROR! (xos_display_banner(' . $action . ', ' . $identifier . ') -> Banner with ID \'' . $identifier . '\' not found, or status inactive</b>';
        }
      }
    } else {
      return '<b>XOS ERROR! (xos_display_banner(' . $action . ', ' . $identifier . ') -> Unknown $action parameter value - it must be either \'dynamic\' or \'static\'</b>';
    }
    
    $banner_array = array();
    $banner_array['banner_string'] = ($banner['banners_image'] ? $banner['banners_url'] != '' ? '<a href="' . xos_href_link(FILENAME_REDIRECT, 'action=banner&goto=' . $banner['banners_id']) . '" target="_blank">' . xos_image(DIR_WS_IMAGES . 'banners/' . rawurlencode($banner['banners_image']), $banner['banners_title'], '', '', 'class="img-responsive center-block"') . '</a>' : xos_image(DIR_WS_IMAGES . 'banners/' . rawurlencode($banner['banners_image']), $banner['banners_title'], '', '', 'class="img-responsive center-block"') : '') . $banner['banners_html_text'];
    $banner_array['banner_php_source'] = $banner['banners_php_source'];
    if (!empty($banner_array['banner_string']) || !empty($banner_array['banner_php_source'])) xos_update_banner_display_count($banner['banners_id']);

    return $banner_array;
  }

////
// Check to see if a banner exists
  function xos_banner_exists($action, $identifier) {

    $DB = Registry::get('DB');
    if ($action == 'dynamic') {
        
      $random_banner_select = $DB->prepare
      (
       "SELECT   b.banners_id,
                 bc.banners_title,
                 bc.banners_url,
                 bc.banners_image,
                 bc.banners_html_text,
                 bc.banners_php_source
        FROM     " . TABLE_BANNERS . " b,
                 " . TABLE_BANNERS_CONTENT . " bc
        WHERE    b.banners_id = bc.banners_id
        AND      bc.language_id = :languages_id
        AND      b.status = '1'
        AND      b.banners_group = :identifier
        ORDER BY Rand()
        LIMIT    1"          
      );
      
      $DB->perform($random_banner_select, array(':languages_id' => (int)$_SESSION['languages_id'],
                                                ':identifier' => $identifier));
                                                  
      return $random_banner_select->fetch(); 
                
    } elseif ($action == 'static') {
      $banner_query = $DB->prepare
      (
       "SELECT b.banners_id,
               bc.banners_title,
               bc.banners_url,
               bc.banners_image,
               bc.banners_html_text,
               bc.banners_php_source
        FROM   " . TABLE_BANNERS . " b,
               " . TABLE_BANNERS_CONTENT . " bc
        WHERE  b.banners_id = bc.banners_id
        AND    bc.language_id = :languages_id
        AND    status = '1'
        AND    b.banners_id = :identifier"
      );
      
      $DB->perform($banner_query, array(':languages_id' => (int)$_SESSION['languages_id'],
                                        ':identifier' => $identifier));
                                                      
      return $banner_query->fetch();
    } else {
      return false;
    }
  }

////
// Update the banner display statistics
  function xos_update_banner_display_count($banner_id) {

    $DB = Registry::get('DB');
    $banner_check_query = $DB->prepare
    (
     "SELECT Count(*) AS count
      FROM   " . TABLE_BANNERS_HISTORY . "
      WHERE  banners_id = :banner_id
      AND   Date_format(banners_history_date, '%Y%m%d') = Date_format(Now(), '%Y%m%d')"
    );
    
    $DB->perform($banner_check_query, array(':banner_id' => (int)$banner_id )); 
       
    $banner_check = $banner_check_query->fetch();

    if ($banner_check['count'] > 0) {
    
      $update_banners_history_query = $DB->prepare
      (
       "UPDATE " . TABLE_BANNERS_HISTORY . "
        SET    banners_shown = banners_shown + 1
        WHERE  banners_id = :banner_id
        AND    Date_format(banners_history_date, '%Y%m%d') = Date_format(Now(), '%Y%m%d')"
      );
      
      $DB->perform($update_banners_history_query, array(':banner_id' => (int)$banner_id ));
      
    } else { 
    
      $insert_banners_history_query = $DB->prepare
      (
       "INSERT INTO " . TABLE_BANNERS_HISTORY . "
                    (
                    banners_id,
                    banners_shown,
                    banners_history_date
                    )
                    VALUES      
                    (
                    :banner_id,
                    1,
                    Now()
                    )"
      );
      
      $DB->perform($insert_banners_history_query, array(':banner_id' => (int)$banner_id ));
      
    }
  }

////
// Update the banner click statistics
  function xos_update_banner_click_count($banner_id) {

    $DB = Registry::get('DB');
    $update_banners_history_query = $DB->prepare
    (
     "UPDATE " . TABLE_BANNERS_HISTORY . "
      SET    banners_clicked = banners_clicked + 1
      WHERE  banners_id = :banner_id
      AND    Date_format(banners_history_date, '%Y%m%d') = Date_format(Now(), '%Y%m%d')"
    );
    
    $DB->perform($update_banners_history_query, array(':banner_id' => (int)$banner_id ));
    
  }