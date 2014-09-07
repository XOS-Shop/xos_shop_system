<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : html_header_with_special_stylesheet.php
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

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/html_header.php') == 'overwrite_all')) :
  $smarty->assign(array('base_href' => ENABLE_SSL == 'true' ? ($_SESSION['disable_ssl'] ? HTTP_SERVER : HTTPS_SERVER) : HTTP_SERVER,
                        'html_params' => HTML_PARAMS,
                        'xhtml_lang' => XHTML_LANG,
                        'charset' => CHARSET,
                        'style' => $style,                        
                        'javascript' => $javascript));
  
  $output_html_header_with_special_stylesheet = $smarty->fetch(ADMIN_TPL . '/includes/html_header_with_special_stylesheet.tpl');
  $smarty->clearAssign(array('base_href',
                             'html_params',
                             'xhtml_lang',
                             'charset',
                             'style',                              
                             'javascript'));
                          
  $smarty->assign('html_header', $output_html_header_with_special_stylesheet);
endif;   
?>
