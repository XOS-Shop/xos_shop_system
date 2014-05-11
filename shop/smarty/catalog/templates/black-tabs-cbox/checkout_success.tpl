[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : black-tabs-cbox
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : checkout_success.tpl
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

<!-- checkout_success -->
    [@{$form_begin}@]
          <div style="float: left;"><img src="[@{$images_path}@]table_background.gif" alt="[@{#heading_title#}@]" title=" [@{#heading_title#}@] " /></div>
          <div style="padding-left: 200px;">
            <div class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title#}@]</div>
            <div style="height: 18px; font-size: 0;">&nbsp;</div>
            <div class="main" style="padding-right: 10px;">
            [@{#text_success#}@]<br /><br />
            [@{if $notify}@]            
            [@{#text_notify_products#}@]<br /><span class="products-notifications">
            [@{foreach item=product_notify from=$products_notify}@]
            [@{$product_notify.checkbox_field}@] [@{$product_notify.text}@]<br />
            [@{/foreach}@]
            </span><br /><br />
            [@{/if}@]
            [@{eval var=#text_see_orders#}@]<br /><br />[@{eval var=#text_contact_store_owner#}@]
            <h4>[@{#text_thanks_for_shopping#}@]</h4>            
            </div>
          </div>
          <div class="clear">&nbsp;</div>          
          <div style="height: 10px; font-size: 0;">&nbsp;</div> 
          <div class="main" style="float: right;">
            <script type="text/javascript">
            /* <![CDATA[ */
              document.write('<a href="" onclick="order.submit(); return false" class="button-continue" style="float: left; position: relative; right: 12px" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
            /* ]]> */  
            </script>
            <noscript>
              <input type="submit" value="[@{#button_text_continue#}@]" />
            </noscript>                         
          </div>
          <div class="clear">&nbsp;</div>
          <div style="padding: 0 84px 0 84px">           
            <div style="height: 20px; font-size: 0;">&nbsp;</div>                    
            <div class="checkout-bar-finished-gif">&nbsp;</div>      
            <div class="checkout-bar-finished-from" style="width: 25%; text-align: center; float: left;">[@{#checkout_bar_delivery#}@]</div>
            <div class="checkout-bar-finished-from" style="width: 25%; text-align: center; float: left;">[@{#checkout_bar_payment#}@]</div>
            <div class="checkout-bar-finished-from" style="width: 25%; text-align: center; float: left;">[@{#checkout_bar_confirmation#}@]</div>
            <div class="checkout-bar-current" style="width: 25%; text-align: center; float: left;">[@{#checkout_bar_finished#}@]</div>
            <div class="clear">&nbsp;</div>
          </div>     
    [@{$form_end}@]
    [@{$downloads}@]    
<!-- checkout_success_eof -->
