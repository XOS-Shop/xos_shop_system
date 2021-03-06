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
    $cache_id = 'L2|box_information|' . $_SESSION['language'] . '-' . $_GET['lnc'] . '-' . $_GET[session_name()] . '-' . $session_started . '-' . SELECTED_TPL . '-' . $_SESSION['currency'];
  }
  
  if(!$smarty->isCached(SELECTED_TPL . '/includes/boxes/information.tpl', $cache_id)){

    $contents_query = $DB->prepare
    (
     "SELECT   c.content_id,
               c.link_request_type,
               cd.name
      FROM     " . TABLE_CONTENTS . " c,
               " . TABLE_CONTENTS_DATA . " cd
      WHERE    c.type = 'info'
      AND      c.status = '1'
      AND      c.content_id = cd.content_id
      AND      cd.language_id = :languages_id
      ORDER BY c.sort_order"
    );
    
    $DB->perform($contents_query, array(':languages_id' => (int)$_SESSION['languages_id']));
    
    $contents_array = array();
    while ($contents = $contents_query->fetch()) {      
                                               
      $contents_array[]=array('link_filename_content_content_id' => xos_href_link(FILENAME_CONTENT, 'co=' . $contents['content_id'], (!empty($contents['link_request_type']) ? $contents['link_request_type'] : 'NONSSL')),
                              'name' => $contents['name']);
    }
    
    $smarty->assign(array('box_information_has_content' => !empty($contents_array),
                          'box_information_contents' => $contents_array));    
  }  
  
  $output_information = $smarty->fetch(SELECTED_TPL . '/includes/boxes/information.tpl', $cache_id);

  $smarty->caching = 0;                            
                        
  $smarty->assign('box_information', $output_information);
endif;
?>
