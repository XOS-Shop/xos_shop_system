[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : server_info.tpl
* author     : Hanspeter Zeller <hpz@xos-shop.com>
* copyright  : Copyright (c) 2007 Hanspeter Zeller
* license    : This file is part of XOS-Shop.
*
*              XOS-Shop is free software: you can redistribute it and/or modify
*              it under the terms of the GNU General Public License as published
*              by the Free Software Foundation, either version 3 of the License,
*              or (at your option) any later version.
*
*              XOS-Shop is distributed in the hope that it will be useful,
*              but WITHOUT ANY WARRANTY; without even the implied warranty of
*              MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*              GNU General Public License for more details.
*
*              You should have received a copy of the GNU General Public License
*              along with XOS-Shop.  If not, see <http://www.gnu.org/licenses/>. 
********************************************************************************
*}@]

<!-- server_info -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">         
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left">&nbsp;</td> 
          </tr>        
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="5" /></td>
          </tr>               
          <tr>
            <td><table border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td class="smallText"><b>[@{#title_server_host#}@]</b></td>
                <td class="smallText">[@{$system.host}@] ([@{$system.ip}@])</td>
                <td class="smallText">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[@{#title_database_host#}@]</b></td>
                <td class="smallText">[@{$system.db_server}@] ([@{$system.db_ip}@])</td>
              </tr>
              <tr>
                <td class="smallText"><b>[@{#title_server_os#}@]</b></td>
                <td class="smallText">[@{$system.system}@] [@{$system.kernel}@]</td>
                <td class="smallText">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[@{#title_database#}@]</b></td>
                <td class="smallText">[@{$system.db_version}@]</td>
              </tr>
              <tr>
                <td class="smallText"><b>[@{#title_server_date#}@]</b></td>
                <td class="smallText">[@{$system.date}@]</td>
                <td class="smallText">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>[@{#title_database_date#}@]</b></td>
                <td class="smallText">[@{$system.db_date}@]</td>
              </tr>
              <tr>
                <td class="smallText"><b>[@{#title_server_up_time#}@]</b></td>
                <td colspan="3" class="smallText">[@{$system.uptime}@]</td>
              </tr>
              <tr>
                <td colspan="4"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="5" /></td>
              </tr>
              <tr>
                <td class="smallText"><b>[@{#title_http_server#}@]</b></td>
                <td colspan="3" class="smallText">[@{$system.http_server}@]</td>
              </tr>
              <tr>
                <td class="smallText"><b>[@{#title_php_version#}@]</b></td>
                <td colspan="3" class="smallText">[@{$system.php}@] ([@{#title_zend_version#}@] [@{$system.zend}@])</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
      </tr>
      <tr>
        <td>
          <table border="0" cellspacing="0" cellpadding="3" width="600">
            <tr>            
              <td>
                <table cellpadding="3" width="100%" style="border-color: #ff7c2a; border-style: solid; border-width: 1px">
                  <tr>                                 
                    <td><a href="http://www.xos-shop.com"><img border="0" src="[@{$images_path}@][@{$project_logo}@]" alt="[@{$project_title}@]" title=" [@{$project_title}@] " /></a><h1 style="font-family: sans-serif;">[@{$project_version}@]</h1></td>
                  </tr>
                </table> 
              </td>          
            </tr>                       
            <tr>
              <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="6" /></td>
            </tr>                  
          </table>         
          [@{$phpinfo}@]            
        </td>
      </tr>
    </table></td>
<!-- server_info_eof -->
