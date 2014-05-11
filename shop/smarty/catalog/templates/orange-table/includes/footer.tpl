[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with css-buttons and tables for layout                                                                     
* filename   : footer.tpl
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
<br />
<table border="0" width="100%" cellspacing="4" cellpadding="0">
  <tr class="footer">
    <td align="center" class="footer">&nbsp;&nbsp;[@{$footer_counter_now}@] [@{#footer_text_requests_since#}@] [@{$footer_counter_startdate}@]&nbsp;&nbsp;</td>
  </tr>
</table>
<table border="0" width="100%" cellspacing="4" cellpadding="0">
  <tr>
    <td nowrap="nowrap" align="center" class="small-text">Copyright © 2012 <a href="http://www.xos-shop.com"  target="_blank">XOS-Shop</a><br />Powered by <a href="http://www.xos-shop.com"  target="_blank">XOS-Shop</a></td>
  </tr>
</table>
[@{if $footer_banner_footer}@]
<br />
<table border="0" width="100%" cellspacing="4" cellpadding="0">
  <tr>
    <td align="center">[@{$footer_banner_footer}@]</td>
  </tr>
</table>
[@{/if}@]
