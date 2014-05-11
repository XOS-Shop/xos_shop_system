<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : html_header.php
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

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/html_header.php') == 'overwrite_all')) :   
  $page_title_trail = $site_trail->title_trail(PAGE_TITLE_TRAIL_SEPARATOR);

  $add_header .= "\n" .
                 '<script type="text/javascript">' . "\n" .
                 '/* <![CDATA[ */' . "\n" .                                 
                 '  $(document).ready(function() {$.ajax({url: "' . xos_href_link(FILENAME_TEST, '', $request_type) . '"});});' . "\n" .                 
                 '/* ]]> */' . "\n" .
                 '</script> ' . "\n";
                 
  $add_header .= $templateIntegration->getBlocks('header_tags');                

  $smarty->assign(array('html_header_html_params' => HTML_PARAMS,
                        'html_header_xhtml_lang' => XHTML_LANG,
                        'html_header_charset' => CHARSET,
                        'html_header_page_title' => STORE_NAME . ($page_title_trail != '' ? PAGE_TITLE_TRAIL_SEPARATOR . $page_title_trail : ''),
                        'add_headTag_elements' => $add_header,
                        'link_to_dynamic_css' => xos_href_link(FILENAME_CSS, '', $request_type),
                        'link_to_dynamic_js' => xos_href_link(FILENAME_JS, '', $request_type)));
  
  $output_html_header = $smarty->fetch(SELECTED_TPL . '/includes/html_header.tpl');
                          
  $smarty->assign('html_header', $output_html_header);
endif;   
?>
