<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : subscribe_newsletter.php
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
//              filename: tell_a_friend.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/boxes/subscribe_newsletter.php') == 'overwrite_all')) : 
  if (CACHE_LEVEL > 2 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
    $smarty->caching = 1;
    $cache_id = 'L2|box_subscribe_newsletter|' . $_SESSION['language'] . '-' . $_GET['language'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'];
  }

  if(!$smarty->isCached(SELECTED_TPL . '/includes/boxes/subscribe_newsletter.tpl', $cache_id)){
 
    $hidden_get_variables = '';
    if (!$session_started && xos_not_null($_GET['currency'])) {
      $hidden_get_variables .= xos_draw_hidden_field('currency', $_GET['currency']);
    }  

    if (!$session_started && xos_not_null($_GET['language'])) {
      $hidden_get_variables .= xos_draw_hidden_field('language', $_GET['language']);
    }
    
    if (!$session_started && xos_not_null($_GET['tpl'])) {
      $hidden_get_variables .= xos_draw_hidden_field('tpl', $_GET['tpl']);
    }       
                                
    $smarty->assign(array('box_subscribe_newsletter_input_field_subscriber_email_address' => xos_draw_input_field('subscriber_email_address', '', 'id="box_subscriber_email_address" size="10" maxlength="50" style="width: 80%"'),
                          'box_subscribe_newsletter_input_hide_session' => xos_hide_session_id(),
                          'box_subscribe_newsletter_link_filename_newsletter_subscribe' => xos_href_link(FILENAME_NEWSLETTER_SUBSCRIBE, '', 'SSL'),
                          'box_subscribe_newsletter_form_begin' => xos_draw_form('subscribe_newsletter', xos_href_link(FILENAME_NEWSLETTER_SUBSCRIBE, '', 'SSL', false), 'get') . $hidden_get_variables,
                          'box_subscribe_newsletter_form_end' => '</form>'));
  }
    
  $output_subscribe_newsletter = $smarty->fetch(SELECTED_TPL . '/includes/boxes/subscribe_newsletter.tpl', $cache_id);
                              
  $smarty->caching = 0;                            
                        
  $smarty->assign('box_subscribe_newsletter', $output_subscribe_newsletter);
endif;
?>
