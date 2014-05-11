<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : banner_column_2.php
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

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/boxes/banner_column_2.php') == 'overwrite_all')) : 
  if ($banner_column_2 = xos_banner_exists('dynamic', 'column_2')) {
    
    $smarty->assign('box_banner_column_2_banner_column_2', xos_display_banner('static', $banner_column_2));   
    $output_banner_column_2 = $smarty->fetch(SELECTED_TPL . '/includes/boxes/banner_column_2.tpl');
                                          
    $smarty->assign('box_banner_column_2', $output_banner_column_2);    
  }
endif;
?>
