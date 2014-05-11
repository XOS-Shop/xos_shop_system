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
    if ($status == '1') {
      return xos_db_query("update " . TABLE_BANNERS . " set status = '1', date_status_change = now(), date_scheduled = NULL where banners_id = '" . (int)$banners_id . "'");
    } elseif ($status == '0') {
      return xos_db_query("update " . TABLE_BANNERS . " set status = '0', date_status_change = now() where banners_id = '" . (int)$banners_id . "'");
    } else {
      return -1;
    }
  }

////
// Auto activate banners
  function xos_activate_banners() {
    $banners_query = xos_db_query("select banners_id, date_scheduled from " . TABLE_BANNERS . " where date_scheduled != ''");
    if (xos_db_num_rows($banners_query)) {
      while ($banners = xos_db_fetch_array($banners_query)) {
        if (date('Y-m-d H:i:s') >= $banners['date_scheduled']) {
          xos_set_banner_status($banners['banners_id'], '1');
        }
      }
    }
  }

////
// Auto expire banners
  function xos_expire_banners() {
    $banners_query = xos_db_query("select b.banners_id, b.expires_date, b.expires_impressions, sum(bh.banners_shown) as banners_shown from " . TABLE_BANNERS . " b, " . TABLE_BANNERS_HISTORY . " bh where b.status = '1' and b.banners_id = bh.banners_id group by b.banners_id");
    if (xos_db_num_rows($banners_query)) {
      while ($banners = xos_db_fetch_array($banners_query)) {
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
    if ($action == 'dynamic') {
      $banners_query = xos_db_query("select count(*) as count from " . TABLE_BANNERS . " where status = '1' and banners_group = '" . $identifier . "'");
      $banners = xos_db_fetch_array($banners_query);
      if ($banners['count'] > 0) {
        $banner = xos_random_select("select b.banners_id, bc.banners_title, bc.banners_url, bc.banners_image, bc.banners_html_text from " . TABLE_BANNERS . " b, " . TABLE_BANNERS_CONTENT . " bc where b.banners_id = bc.banners_id and bc.language_id = '" . (int)$_SESSION['languages_id'] . "' and b.status = '1' and b.banners_group = '" . $identifier . "'");
      } else {
        return '<b>XOS ERROR! (xos_display_banner(' . $action . ', ' . $identifier . ') -> No banners with group \'' . $identifier . '\' found!</b>';
      }
    } elseif ($action == 'static') {
      if (is_array($identifier)) {
        $banner = $identifier;
      } else {
        $banner_query = xos_db_query("select b.banners_id, bc.banners_title, bc.banners_url, bc.banners_image, bc.banners_html_text from " . TABLE_BANNERS . " b, " . TABLE_BANNERS_CONTENT . " bc where b.banners_id = bc.banners_id and bc.language_id = '" . (int)$_SESSION['languages_id'] . "' and status = '1' and b.banners_id = '" . (int)$identifier . "'");
        if (xos_db_num_rows($banner_query)) {
          $banner = xos_db_fetch_array($banner_query);
        } else {
          return '<b>XOS ERROR! (xos_display_banner(' . $action . ', ' . $identifier . ') -> Banner with ID \'' . $identifier . '\' not found, or status inactive</b>';
        }
      }
    } else {
      return '<b>XOS ERROR! (xos_display_banner(' . $action . ', ' . $identifier . ') -> Unknown $action parameter value - it must be either \'dynamic\' or \'static\'</b>';
    }
    
    $banner_string = false;
    $banner_string = ($banner['banners_image'] ? $banner['banners_url'] != '' ? '<a href="' . xos_href_link(FILENAME_REDIRECT, 'action=banner&goto=' . $banner['banners_id']) . '" target="_blank">' . xos_image(DIR_WS_IMAGES . 'banners/' . rawurlencode($banner['banners_image']), $banner['banners_title']) . '</a>' : xos_image(DIR_WS_IMAGES . 'banners/' . rawurlencode($banner['banners_image']), $banner['banners_title']) : '') . $banner['banners_html_text'];
    $banner_string ? xos_update_banner_display_count($banner['banners_id']) : '';

    return $banner_string;
  }

////
// Check to see if a banner exists
  function xos_banner_exists($action, $identifier) {
    if ($action == 'dynamic') {
      return xos_random_select("select b.banners_id, bc.banners_title, bc.banners_url, bc.banners_image, bc.banners_html_text from " . TABLE_BANNERS . " b, " . TABLE_BANNERS_CONTENT . " bc where b.banners_id = bc.banners_id and bc.language_id = '" . (int)$_SESSION['languages_id'] . "' and status = '1' and b.banners_group = '" . $identifier . "'");
    } elseif ($action == 'static') {
      $banner_query = xos_db_query("select b.banners_id, bc.banners_title, bc.banners_url, bc.banners_image, bc.banners_html_text from " . TABLE_BANNERS . " b, " . TABLE_BANNERS_CONTENT . " bc where b.banners_id = bc.banners_id and bc.language_id = '" . (int)$_SESSION['languages_id'] . "' and status = '1' and b.banners_id = '" . (int)$identifier . "'");
      return xos_db_fetch_array($banner_query);
    } else {
      return false;
    }
  }

////
// Update the banner display statistics
  function xos_update_banner_display_count($banner_id) {
    $banner_check_query = xos_db_query("select count(*) as count from " . TABLE_BANNERS_HISTORY . " where banners_id = '" . (int)$banner_id . "' and date_format(banners_history_date, '%Y%m%d') = date_format(now(), '%Y%m%d')");
    $banner_check = xos_db_fetch_array($banner_check_query);

    if ($banner_check['count'] > 0) {
      xos_db_query("update " . TABLE_BANNERS_HISTORY . " set banners_shown = banners_shown + 1 where banners_id = '" . (int)$banner_id . "' and date_format(banners_history_date, '%Y%m%d') = date_format(now(), '%Y%m%d')");
    } else {
      xos_db_query("insert into " . TABLE_BANNERS_HISTORY . " (banners_id, banners_shown, banners_history_date) values ('" . (int)$banner_id . "', 1, now())");
    }
  }

////
// Update the banner click statistics
  function xos_update_banner_click_count($banner_id) {
    xos_db_query("update " . TABLE_BANNERS_HISTORY . " set banners_clicked = banners_clicked + 1 where banners_id = '" . (int)$banner_id . "' and date_format(banners_history_date, '%Y%m%d') = date_format(now(), '%Y%m%d')");
  }
?>
