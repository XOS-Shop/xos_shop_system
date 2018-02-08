[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : osc-table
* version    : 1.0.7 for XOS-Shop version 1.0.8
* descrip    : oscommerce default template with css-buttons and tables for layout                                                                     
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
[@{$header_message_stack_output}@]
[@{if $header_banner_header}@]
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">[@{$header_banner_header}@]</td>
  </tr>
</table>
[@{/if}@]
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr class="header">
    <td valign="middle"><a href="[@{$header_link_filename_default}@]"><img src="[@{$images_path}@]shop_logo.gif" alt="[@{$header_store_name}@]" title=" [@{$header_store_name}@] " /></a></td>
    <td align="right" valign="bottom">[@{if $is_shop}@]<a href="[@{$header_link_filename_account}@]"><img src="[@{$images_path}@]header_account.gif" alt="[@{#header_title_my_account#}@]" title=" [@{#header_title_my_account#}@] " /></a>&nbsp;&nbsp;<a href="[@{$header_link_filename_shopping_cart}@]"><img src="[@{$images_path}@]header_cart.gif" alt="[@{#header_title_cart_contents#}@]" title=" [@{#header_title_cart_contents#}@] " /></a>&nbsp;&nbsp;<a href="[@{$header_link_filename_checkout_shipping}@]"><img src="[@{$images_path}@]header_checkout.gif" alt="[@{#header_title_checkout#}@]" title=" [@{#header_title_checkout#}@] " /></a>[@{/if}@]&nbsp;&nbsp;</td>
  </tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="1">
  <tr class="header-navi">
    <td class="header-navi">&nbsp;&nbsp;[@{$header_breadcrumb}@]</td>
    <td align="right" class="header-navi">[@{if $is_shop}@][@{if $header_link_filename_logoff}@]<a href="[@{$header_link_filename_logoff}@]" class="header-navi">[@{#header_title_logoff#}@]</a> &nbsp;|&nbsp; [@{/if}@]<a href="[@{$header_link_filename_account}@]" class="header-navi">[@{#header_title_my_account#}@]</a> &nbsp;|&nbsp; <a href="[@{$header_link_filename_shopping_cart}@]" class="header-navi">[@{#header_title_cart_contents#}@]</a> &nbsp;|&nbsp; <a href="[@{$header_link_filename_checkout_shipping}@]" class="header-navi">[@{#header_title_checkout#}@]</a>[@{/if}@] &nbsp;&nbsp;</td>
  </tr>
</table>
[@{if $header_error_message}@]
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr class="headerError">
    <td class="headerError">[@{$header_error_message}@]</td>
  </tr>
</table>
[@{/if}@]
[@{if $header_info_message}@]
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr class="headerInfo">
    <td class="headerInfo">[@{$header_info_message}@]</td>
  </tr>
</table>
[@{/if}@]
