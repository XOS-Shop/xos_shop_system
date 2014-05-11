<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : information.php
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
//              filename: information.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/boxes/information.php') == 'overwrite_all')) : 
  if (CACHE_LEVEL > 1 && ((isset($_COOKIE[session_name()]) && !isset($_GET[session_name()])) || SESSION_FORCE_COOKIE_USE == 'true')){
    $smarty->caching = 1;
    $cache_id = 'L2|box_information|' . $_SESSION['language'] . '-' . $_GET['language'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'];
  }
  
  if(!$smarty->isCached(SELECTED_TPL . '/includes/boxes/information.tpl', $cache_id)){

    $contents_query = xos_db_query("select c.content_id, cd.name from " . TABLE_CONTENTS . " c, " . TABLE_CONTENTS_DATA . " cd where c.type = 'info' and c.status = '1' and c.content_id = cd.content_id and cd.language_id = '" . (int)$_SESSION['languages_id'] . "' order by c.sort_order ");
    
    $contents_array = array();
    while ($contents = xos_db_fetch_array($contents_query)) {      
                                               
      $contents_array[]=array('link_filename_content_content_id' => xos_href_link(FILENAME_CONTENT,'content_id=' . $contents['content_id']),
                              'name' => $contents['name']);
    }
    
    $smarty->assign('box_information_contents', $contents_array);
  
    if (SEND_EMAILS == 'true') {
      $smarty->assign('box_information_link_filename_contact_us', xos_href_link(FILENAME_CONTACT_US, '', 'SSL'));
    } else {
      $smarty->assign('box_information_link_filename_contact_us', 'mailto:' . STORE_OWNER_EMAIL_ADDRESS);
    }
  }  
  
  $output_information = $smarty->fetch(SELECTED_TPL . '/includes/boxes/information.tpl', $cache_id);

  $smarty->caching = 0;                            
                        
  $smarty->assign('box_information', $output_information);
endif;
?>
