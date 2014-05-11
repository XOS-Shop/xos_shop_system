[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : black-tabs-cbox
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
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
<div>
  [@{$header_message_stack_output}@]
</div>
[@{/if}@]
[@{if $header_banner_header}@]
<div>
  [@{$header_banner_header}@]
</div>
<div class="clear">&nbsp;</div>
[@{/if}@] 
<!-- header_boxes -->
<div style="position:relative; left:0px; top:0px; z-index:1901">
  <div style="width:170px; position:absolute; left:400px; top:10px;"> 
    [@{$box_currencies}@]
  </div> 
  <div style="width:170px; position:absolute; [@{if $is_shop}@]left:600px[@{else}@]right:4px[@{/if}@]; top:13px;"> 
    [@{$box_languages}@]
  </div>
  <div style="width:170px; position:absolute; left:178px; top:10px;"> 
    [@{$box_search}@]
  </div>
  <div style="position:absolute; right:4px; top:13px;"> 
    [@{$box_login_my_account}@]
  </div>
</div>
<div style="position:relative; left:0px; top:0px; z-index:1900"> 
  [@{$box_shopping_cart}@]
</div>
<!-- header_boxes_eof -->
<div>  
<div style="width: 174px; height: 120px; padding: 4px 0 0 0; margin: 0 4px 0 0; overflow: hidden; float: left;">
<a href="[@{$header_link_filename_default}@]"><img src="[@{$images_path}@]shop_logo.gif" alt="[@{$header_store_name}@]" title=" [@{$header_store_name}@] " /></a>
</div>
<div style="width: 817px; float: left;">
<div style="padding: 2px 0 0 0;">
  <div>    
    <div style="width: 817px; float: left;">            
      <div class="header-outer" style="height: 72px;"><div style="padding: 29px 4px 0 0; white-space:nowrap; text-align: right; float: right;">[@{if $is_shop}@][@{if $header_link_filename_logoff}@]<a href="[@{$header_link_filename_logoff}@]" class="header">[@{#header_title_logoff#}@]</a>[@{/if}@][@{/if}@]</div><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="5" height="5" /></div>
      <div>
        [@{$box_tabs}@]
      </div>      
      <div class="header-navi"><div style="padding-left: 30px; text-align: right; float: right;">[@{$date_format_long}@]</div>[@{$header_breadcrumb}@]</div>    
    </div>   
  </div>
  <div class="clear">&nbsp;</div>
  [@{if $header_error_message}@]
  <div style="padding: 2px 0;"></div>
  <div class="header-error">[@{$header_error_message}@]</div>
  [@{/if}@]
  [@{if $header_info_message}@]
  <div style="padding: 2px 0;"></div>
  <div class="header-info">[@{$header_info_message}@]</div>
  [@{/if}@]
</div>
</div>
<div class="clear">&nbsp;</div> 
</div>
