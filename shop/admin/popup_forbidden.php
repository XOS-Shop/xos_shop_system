<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : popup_forbidden.php
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
//              Copyright (c) 2002 osCommerce
//              filename: forbidden.php                     
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_POPUP_FORBIDDEN) == 'overwrite_all')) :
  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n" .
                '<script type="text/javascript">' . "\n" .
                '/* <![CDATA[ */' . "\n\n" .
                
                'function adjustHeight() {' . "\n" . 
                '  var agent = navigator.userAgent.toLowerCase();' . "\n" .              
                '  if (window.innerHeight) {' . "\n" .
                '    document.getElementById("main-div").style.height = window.innerHeight + "px";' . "\n" .
                '  } else if (document.documentElement && document.documentElement.clientHeight) {' . "\n" .  
                '    document.getElementById("main-div").style.height = document.documentElement.clientHeight + "px";' . "\n" . 
                '    if (agent.indexOf("MSIE 5".toLowerCase())>-1 || agent.indexOf("MSIE 6".toLowerCase())>-1 || agent.indexOf("MSIE 7".toLowerCase())>-1) {' . "\n" .  
                '      document.getElementById("inner-div").style.width = document.documentElement.clientWidth-20 + "px";' . "\n" . 
                '    }' . "\n" .
                '  }' . "\n" .                
                '}' . "\n\n" .

                'window.onresize = function(){adjustHeight();}' . "\n\n" .
                   
                '/* ]]> */' . "\n" .
                '</script>' . "\n";      
  
  require(DIR_WS_INCLUDES . 'html_header.php');     
  require(DIR_WS_INCLUDES . 'footer.php');  
   

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'popup_forbidden');

  $smarty->display(ADMIN_TPL . '/popup_forbidden.tpl');
endif;  
?>
