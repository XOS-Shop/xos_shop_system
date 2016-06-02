[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : darkly-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.3
* descrip    : xos-shop template built with Bootstrap3 and theme darkly                                                                    
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
[@{if $footer_banner_footer}@]
<div style="padding: 4px; text-align: center;">[@{$footer_banner_footer}@]</div>
[@{/if}@]
<div class="clearfix invisible"></div>
[@{if $footer_banner_footer_bottom}@]
[@{$footer_banner_footer_bottom}@]
[@{else}@]
<div class="footer" style="white-space: nowrap; padding: 2px; text-align: left; float: left">[@{$footer_counter_now}@] [@{#footer_text_requests_since#}@] [@{$footer_counter_startdate}@]</div>
<div style="white-space: nowrap; padding: 2px; text-align: right; float: right;">Copyright © 2016 <a href="http://www.xos-shop.com"  target="_blank">XOS-Shop</a>&nbsp;&nbsp;Powered by <a href="http://www.xos-shop.com"  target="_blank">XOS-Shop</a></div>
<div class="clearfix invisible"></div>
[@{/if}@]