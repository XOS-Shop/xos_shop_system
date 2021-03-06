<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : content.php
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
if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_CONTENT) == 'overwrite_all')) : 

  $content_id = (int)$_GET['co'];

  $content_query = $DB->prepare
  (
   "SELECT c.content_id,
           c.link_request_type,
           c.type,
           cd.name,
           cd.heading_title,
           cd.content,
           cd.php_source
      FROM " . TABLE_CONTENTS . " c,
           " . TABLE_CONTENTS_DATA . " cd
     WHERE c.status = '1'
       AND c.content_id = :co
       AND c.content_id = cd.content_id
       AND language_id = :languages_id"
  );
  
  $DB->perform($content_query, array(':co' => $content_id,
                                     ':languages_id' => (int)$_SESSION['languages_id']));
                                       
  $content = $content_query->fetch();
  eval(" ?>" . $content['php_source'] . "<?php ");
  if (in_array($content['type'], array('info', 'not_in_menu'))) $site_trail->add($content['name'], xos_href_link(FILENAME_CONTENT,'co=' . $content['content_id'], (!empty($content['link_request_type']) ? $content['link_request_type'] : 'NONSSL')));
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');

  $back = sizeof($_SESSION['navigation']->path)-2;
  if (!empty($_SESSION['navigation']->path[$back])) {
    $get_params_array = $_SESSION['navigation']->path[$back]['get'];
    $get_params_array['rmp'] = '0';        
    $back_link = xos_href_link($_SESSION['navigation']->path[$back]['page'], xos_array_to_query_string($get_params_array, array('action', xos_session_name())), $_SESSION['navigation']->path[$back]['mode']);
  } else {
    $back_link = 'javascript:history.go(-1)';
  }
  
  $smarty->assign(array('heading_title' => $content['heading_title'],
                        'content' => $content['content'],
                        'link_back' => $back_link));

  $output_content = $smarty->fetch(SELECTED_TPL . '/content.tpl');
                        
  $smarty->assign('central_contents', $output_content);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;
?>
