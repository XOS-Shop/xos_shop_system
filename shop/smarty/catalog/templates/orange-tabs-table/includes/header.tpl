[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-tabs-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and css-buttons and tables for layout                                                                     
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
[@{if $header_message_stack_output}@]
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td>
      [@{$header_message_stack_output}@]
    </td>
  </tr>
</table>
[@{/if}@]
[@{if $header_banner_header}@]
<table border="0" width="100%" cellspacing="0" cellpadding="0" style="padding: 4px 4px 0 4px;">
  <tr>
    <td align="center">[@{$header_banner_header}@]</td>
  </tr>
</table>
[@{else}@]
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="4" /></td>
  </tr>
</table>
[@{/if}@]
[@{$box_tabs}@]
[@{if $is_shop}@]
<table border="0" width="100%" cellspacing="4" cellpadding="0"> 
  <tr>
    <td>    
      <table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td class="header" valign="middle"><a href="[@{$header_link_filename_default}@]"><img src="[@{$images_path}@]shop_logo.gif" alt="[@{$header_store_name}@]" title=" [@{$header_store_name}@] " /></a></td>
          <td class="header" align="right" valign="top"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="2" /><br />[@{if $header_link_filename_logoff}@]<a href="[@{$header_link_filename_logoff}@]" class="header">[@{#header_title_logoff#}@]</a> &nbsp;|&nbsp; [@{/if}@]<a href="[@{$header_link_filename_account}@]" class="header">[@{#header_title_my_account#}@]</a> &nbsp;|&nbsp; <a href="[@{$header_link_filename_shopping_cart}@]" class="header">[@{#header_title_cart_contents#}@]</a> &nbsp;|&nbsp; <a href="[@{$header_link_filename_checkout_shipping}@]" class="header">[@{#header_title_checkout#}@]</a> &nbsp;</td>
          <td width="1"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="4" height="16" /></td>
        </tr>
      </table>
      <table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td class="header-navi">&nbsp;[@{$header_breadcrumb}@]</td>
          <td align="right" class="header-navi">[@{$date_format_long}@]&nbsp;</td>
          <td width="1"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="4" height="16" /></td>
        </tr>
      </table>
    </td>
    <td width="156" valign="top"><table border="0" width="156" cellspacing="0" cellpadding="0">
     [@{$box_search}@]
    </table></td>
  </tr>    
</table>
[@{else}@]
<table border="0" width="100%" cellspacing="4" cellpadding="0"> 
  <tr>
    <td>    
      <table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td class="header" valign="middle"><a href="[@{$header_link_filename_default}@]"><img src="[@{$images_path}@]shop_logo.gif" alt="[@{$header_store_name}@]" title=" [@{$header_store_name}@] " /></a></td>
          <td class="header" align="right" valign="top"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="2" /><br /> &nbsp;</td>
        </tr>
      </table>
      <table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td class="header-navi">&nbsp;[@{$header_breadcrumb}@]</td>
          <td align="right" class="header-navi">[@{$date_format_long}@]&nbsp;</td>
          <td width="1"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="4" height="16" /></td>
        </tr>
      </table>
    </td>
  </tr>    
</table>
[@{/if}@]
[@{if $header_error_message}@]
<table border="0" width="100%" cellspacing="4" cellpadding="0">
  <tr class="header-error">
    <td class="header-error">[@{$header_error_message}@]</td>
  </tr>
</table>
[@{/if}@]
[@{if $header_info_message}@]
<table border="0" width="100%" cellspacing="4" cellpadding="0">
  <tr class="header-info">
    <td class="header-info">[@{$header_info_message}@]</td>
  </tr>
</table>
[@{/if}@]
