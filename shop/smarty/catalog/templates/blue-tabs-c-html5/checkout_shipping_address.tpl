[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : blue-tabs-c-html5
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : checkout_shipping_address.tpl
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

<!-- checkout_shipping_address -->
    [@{$form_begin}@]
          <div class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title#}@]</div>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div> 
          [@{if $message_stack}@]
          [@{$message_stack}@]          
          <div style="height: 10px; font-size: 0;">&nbsp;</div>              
          [@{/if}@]
     [@{if !$process}@]                                                     
          <div class="main"><b>[@{#table_heading_shipping_address#}@]</b></div>
          <div class="info-box-central-contents">
            <div class="main" style="width: 50%; padding: 4px 0 4px 16px; float: left;">[@{#text_selected_shipping_destination#}@]</div>
            <div class="main" style="padding: 2px; float: right;">
              <div class="main" style="padding: 2px 14px 2px 2px; text-align: center; float: left;"><b>[@{#title_shipping_address#}@]</b><br /><img src="[@{$images_path}@]arrow_south_east.gif" alt="" /></div>
              <div class="main" style="padding: 2px 16px 2px 2px; float: left;">[@{$address_label}@]</div>
              <div class="clear">&nbsp;</div>                
            </div>
            <div class="clear">&nbsp;</div>
          </div>
          <div style="height: 10px; font-size: 0;">&nbsp;</div>           
       [@{if $several_addresses}@]
          <div class="main"><b>[@{#table_heading_address_book_entries#}@]</b></div>           
          <div class="info-box-central-contents">
            <div>
              <div class="main" style="width: 50%; padding: 4px 0 4px 16px; float: left;">[@{#text_select_other_shipping_destination#}@]</div>
              <div class="main" style="padding: 2px 19px 2px 2px; text-align: right; float: right;"><b>[@{#title_please_select#}@]</b><br /><img src="[@{$images_path}@]arrow_east_south.gif" alt="" /></div>
              <div class="clear">&nbsp;</div>
            </div>
            [@{foreach item=address from=$addresses}@]            
            <div style="width: 95%; padding: 2px 2px 2px 16px;"> 
              [@{if $address.actual_address}@]
              <div id="default-selected" class="module-row-selected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, [@{$address.radio_select}@])">
              [@{else}@]                  
              <div class="module-row" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, [@{$address.radio_select}@])">
              [@{/if}@]           
                <div class="main" style="width: 91%; padding: 2px; float: left;"><b>[@{$address.address_name}@]</b></div>
                <div class="main" style="width: 5%; padding: 2px; text-align: right; float: left;">[@{$address.radio_field}@]</div>
                <div class="clear">&nbsp;</div>
              </div>
              <div class="main" style="padding: 0 50px 2px 16px;">[@{$address.full_address}@]</div>
            </div>                   
            [@{/foreach}@]                            
          </div>
          <div style="height: 10px; font-size: 0;">&nbsp;</div>          
       [@{/if}@]            
     [@{/if}@]      
     [@{if $not_max_address_book_entries}@]
          <div class="main" style="float: left; white-space: nowrap;"><b>[@{#table_heading_new_shipping_address#}@]</b></div>
          <div class="input-requirement" style="text-align: right; float: right; white-space: nowrap;">[@{#form_required_information#}@]</div>
          <div class="clear">&nbsp;</div>
          <div class="info-box-central-contents">
            <div class="main" style="padding: 4px 0 4px 16px;">[@{#text_create_new_shipping_address#}@]</div>
            <div class="main" style="padding: 4px 0 4px 32px;">[@{$checkout_new_address}@]</div>
          </div>         
     [@{/if}@]
          <div style="height: 10px; font-size: 0;">&nbsp;</div> 
          <div class="info-box-central-contents">                             
            <div class="main" style="margin: 4px 15px 4px 15px;">
              <div style="float: left;">
                <b>[@{#title_continue_checkout_procedure#}@]</b><br />[@{#text_continue_checkout_procedure#}@]
              </div>
              <div style="padding: 8px 0 0 0; float: right;">[@{$hidden_field_submit}@]
                <script type="text/javascript">
                /* <![CDATA[ */
                  document.write('<a href="" onclick="if(checkout_address.onsubmit())checkout_address.submit(); return false" class="button-continue" style="float: left" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
                /* ]]> */  
                </script>
                <noscript>
                  <input type="submit" value="[@{#button_text_continue#}@]" />
                </noscript> 
              </div>                                                                                                                                 
              <div class="clear">&nbsp;</div>                    
            </div>             
          </div>      
     [@{if $process}@]
          <div style="height: 10px; font-size: 0;">&nbsp;</div>
          <div><a href="[@{$link_filename_checkout_shipping_address}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></div>
          <div class="clear">&nbsp;</div>
     [@{/if}@]
          <div style="padding: 0 84px 0 84px">
            <div style="height: 10px; font-size: 0;">&nbsp;</div>                    
            <div class="checkout-bar-delivery-gif">&nbsp;</div>      
            <div class="checkout-bar-current" style="width: 25%; text-align: center; float: left;">[@{#checkout_bar_delivery#}@]</div>
            <div class="checkout-bar-to" style="width: 25%; text-align: center; float: left;">[@{#checkout_bar_payment#}@]</div>
            <div class="checkout-bar-to" style="width: 25%; text-align: center; float: left;">[@{#checkout_bar_confirmation#}@]</div>
            <div class="checkout-bar-to" style="width: 25%; text-align: center; float: left;">[@{#checkout_bar_finished#}@]</div>
            <div class="clear">&nbsp;</div>
          </div>
    [@{$form_end}@]
<!-- checkout_shipping_address_eof -->
