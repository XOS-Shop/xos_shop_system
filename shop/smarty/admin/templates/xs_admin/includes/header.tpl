[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : header.tpl
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
[@{$message_stack_output}@]
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td class="header"><img src="[@{$images_path}@][@{$project_logo}@]" alt="[@{$project_title}@]" title=" [@{$project_title}@] " /></td>
    <td class="header" align="right">
      <a href="http://www.xos-shop.com" target="_blank"><img src="[@{$images_path}@]header_support.gif" alt="[@{#header_title_support_site#}@]" title=" [@{#header_title_support_site#}@] " /></a>&nbsp;&nbsp;
      <a href="[@{$link_catalog}@]"><img src="[@{$images_path}@]header_checkout.gif" alt="[@{#header_title_online_catalog#}@]" title=" [@{#header_title_online_catalog#}@] " /></a>&nbsp;&nbsp;
      <a href="[@{$link_filename_default}@]"><img src="[@{$images_path}@]header_administration.gif" alt="[@{#header_title_administration#}@]" title=" [@{#header_title_administration#}@] " /></a>&nbsp;&nbsp;
    </td>
  </tr>
  <tr class="headerBar">
    <td class="headerBarContent">&nbsp;&nbsp;
    [@{if $link_filename_admin_account}@]    
      <a href="[@{$link_filename_admin_account}@]" class="headerLink">[@{#header_title_account#}@]</a> | <a href="[@{$link_filename_logoff}@]" class="headerLink">[@{#header_title_logoff#}@]</a>
    [@{else}@]
      <a href="[@{$link_filename_default}@]" class="headerLink">[@{#header_title_top#}@]</a>
    [@{/if}@]
    </td>
    <td class="headerBarContent" align="right"><a href="http://www.xos-shop.com" class="headerLink">[@{#header_title_support_site#}@]</a> &nbsp;|&nbsp; <a href="[@{$link_catalog}@]" class="headerLink">[@{#header_title_online_catalog#}@]</a> &nbsp;|&nbsp; <a href="[@{$link_filename_default}@]" class="headerLink">[@{#header_title_administration#}@]</a>&nbsp;&nbsp;</td>
  </tr>
</table>
