[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : dark-standard
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop extra template with popup windows as lightboxes 
*              and div/css layout                                                                     
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
<div style="margin:0 3px 0 3px;">
  [@{$header_banner_header}@]
</div>
<div class="clear">&nbsp;</div>
[@{/if}@]
<div style="padding: 2px 0 0 0;">
  [@{if $is_shop}@]
  <div>
    <div style="margin:0; width: 835px; float: left;">    
      <div class="r"> 
        <div class="rt-empty">
          <div class="l">
            <div class="lt-empty">
              <div class="rb">
                <div class="lb">
                  <div class="central-content"> 
                    <a style="padding: 2px 0 0 6px; float: left;" href="[@{$header_link_filename_default}@]"><img src="[@{$images_path}@]shop_logo.gif" alt="[@{$header_store_name}@]" title=" [@{$header_store_name}@] " /></a>
                    <div class="header" style="padding: 2px 5px 0 0; white-space:nowrap; text-align: right;">
                      [@{if $box_languages}@][@{$box_languages}@][@{else}@]<div style="padding: 0 0 18px 0;"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="15" /> <img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="15" /></div>[@{/if}@]
                      [@{if $header_link_filename_logoff}@]<a href="[@{$header_link_filename_logoff}@]" class="header">[@{#header_title_logoff#}@]</a> &nbsp;|&nbsp; [@{/if}@]<a href="[@{$header_link_filename_account}@]" class="header">[@{#header_title_my_account#}@]</a> &nbsp;|&nbsp; <a href="[@{$header_link_filename_shopping_cart}@]" class="header">[@{#header_title_cart_contents#}@]</a> &nbsp;|&nbsp; <a href="[@{$header_link_filename_checkout_shipping}@]" class="header">[@{#header_title_checkout#}@]</a>
                    </div>                              
                  </div>
                </div>                
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="clear">&nbsp;</div>   
      <div style="padding: 2px 4px 6px 8px;"><div class="header-navi"><div style="text-align: right; float: right;">[@{$date_format_long}@]&nbsp;</div>[@{$header_breadcrumb}@]</div></div>    
    </div>     
    <div style="width: 160px; float: left;">      
      [@{$box_search}@]                  
    </div>    
  </div>
  <div class="clear">&nbsp;</div>
  [@{else}@]
  <div>
    <div style="margin:0; width: 995px; float: left;">    
      <div class="r"> 
        <div class="rt-empty">
          <div class="l">
            <div class="lt-empty">
              <div class="rb">
                <div class="lb">
                  <div class="central-content"> 
                    <a style="padding: 2px 0 0 6px; float: left;" href="[@{$header_link_filename_default}@]"><img src="[@{$images_path}@]shop_logo.gif" alt="[@{$header_store_name}@]" title=" [@{$header_store_name}@] " /></a>
                    <div class="header" style="padding: 2px 5px 0 0; white-space:nowrap; text-align: right;">
                      [@{if $box_languages}@][@{$box_languages}@][@{else}@]<div style="padding: 0 0 18px 0;"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="15" /> <img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="15" /></div>[@{/if}@]
                      &nbsp;
                    </div>                              
                  </div>
                </div>                
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="clear">&nbsp;</div>   
      <div style="padding: 2px 4px 6px 8px;"><div class="header-navi"><div style="text-align: right; float: right;">[@{$date_format_long}@]&nbsp;</div>[@{$header_breadcrumb}@]</div></div>    
    </div>    
  </div>
  <div class="clear">&nbsp;</div>  
  [@{/if}@]
  [@{if $header_error_message}@]
  <div style="padding: 2px 0;"></div>
  <div class="header-error">[@{$header_error_message}@]</div>
  [@{/if}@]
  [@{if $header_info_message}@]
  <div style="padding: 2px 0;"></div>
  <div class="header-info">[@{$header_info_message}@]</div>
  [@{/if}@]
</div>
