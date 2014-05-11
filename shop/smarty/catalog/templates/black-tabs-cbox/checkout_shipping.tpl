[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : black-tabs-cbox
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : checkout_shipping.tpl
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

<!-- checkout_shipping -->
    [@{$form_begin}@][@{$hidden_field}@]
          <div class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title#}@]</div>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div>                              
          <div class="main"><b>[@{#table_heading_shipping_address#}@]</b></div>
          <div class="info-box-central-contents">
            <div class="main" style="width: 40%; padding: 4px 0 4px 16px; float: left;">[@{#text_choose_shipping_destination#}@]<br />&nbsp;<br /><a href="[@{$link_filename_checkout_shipping_address}@]" class="button-change-address" style="float: left" title=" [@{#button_title_change_address#}@] "><span>[@{#button_text_change_address#}@]</span></a></div>
            <div class="main" style="padding: 2px; float: right;">
              <div class="main" style="padding: 2px 6px 2px 2px; text-align: center; float: left;"><b>[@{#title_shipping_address#}@]</b><br /><img src="[@{$images_path}@]arrow_south_east.gif" alt="" /></div>
              <div class="main" style="padding: 2px 16px 2px 2px; float: left;">[@{$address_label}@]</div>
              <div class="clear">&nbsp;</div>                
            </div>
            <div class="clear">&nbsp;</div>
          </div>
          <div style="height: 10px; font-size: 0;">&nbsp;</div>           
     [@{if $shipping_modules}@]
          <div class="main"><b>[@{#table_heading_shipping_method#}@]</b></div>       
          <div class="info-box-central-contents">          
            [@{if $several_shipping_modules and !$free_shipping}@]
            <div>
              <div class="main" style="width: 50%; padding: 4px 0 4px 16px; float: left;">[@{#text_choose_shipping_method#}@]</div>
              <div class="main" style="padding: 2px 19px 2px 2px; text-align: right; float: right;"><b>[@{#title_please_select#}@]</b><br /><img src="[@{$images_path}@]arrow_east_south.gif" alt="" /></div>
              <div class="clear">&nbsp;</div>
            </div>                                     
            [@{elseif !$free_shipping}@]
            <div class="main" style="padding: 4px 16px 4px 16px;">[@{#text_enter_shipping_information#}@]</div>                     
            [@{/if}@]   
            [@{if $free_shipping}@]            
            <div style="width: 95%; padding: 2px 2px 2px 16px;"> 
              <div class="main" style="padding: 0 150px 2px 16px;"><b>[@{#free_shipping_title#}@]</b>&nbsp;<span style="vertical-align: middle;">[@{$shipping_icon}@]</span></div>
              <div id="default-selected" style="padding-left: 14px;" class="module-row-selected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, [@{$method.radio_select}@])">
                <div class="main" style="padding: 2px;">[@{eval var=#free_shipping_description#}@][@{$hidden_field_shipping}@]</div>
              </div>
            </div>                                                      
            [@{else}@]
            [@{foreach name=outer item=shipping_module from=$shipping_modules_array}@]              
            <div style="width: 95%; padding: 2px 2px 2px 16px;"> 
              <div class="main" style="padding: 0 150px 2px 16px;"><b>[@{$shipping_module.name}@]</b>&nbsp;<span style="vertical-align: middle;">[@{$shipping_module.icon}@]</span></div>            
              [@{if $shipping_module.error}@]              
              <div class="main" style="padding: 0 150px 2px 16px;">[@{$shipping_module.error}@]</div> 
              [@{else}@]
              [@{foreach name=inner item=method from=$shipping_module.methods}@]      
              [@{if $method.actual_method}@]                      
              <div id="default-selected" style="padding-left: 14px;" class="module-row-selected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, [@{$method.radio_select}@])">                  
              [@{else}@]        
              <div class="module-row" style="padding-left: 14px;" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, [@{$method.radio_select}@])">        
              [@{/if}@]                   
                <div class="main" style="width: 74%; padding: 2px; float: left;">[@{$method.title}@]</div>
                [@{if $method.several_methods}@]                                
                <div class="main" style="width: 22%; padding: 2px; text-align: right; float: left;">[@{$method.cost}@]&nbsp;<span style="vertical-align: middle;">[@{$method.radio_field}@]</span></div>                                        
                [@{else}@]        
                <div class="main" style="width: 22%; padding: 2px; text-align: right; float: left;">[@{$method.cost}@][@{$method.hidden_field}@]</div>       
                [@{/if}@]                
                <div class="clear">&nbsp;</div>
              </div>
              [@{/foreach}@]            
              [@{/if}@]                
            </div> 
            [@{/foreach}@]              
            [@{/if}@]                          
          </div>            
          <div style="height: 10px; font-size: 0;">&nbsp;</div>               
     [@{/if}@]
          <div class="main"><b>[@{#table_heading_comments#}@]</b></div>       
          <div class="info-box-central-contents">                             
            <div class="main" style="padding: 4px;"> 
              <div class="small-text" style="padding: 0 0 3px 0;"><b>[@{#sub_title_no_html#}@]</b>&nbsp;[@{#text_no_html#}@]</div>                     
              <div class="main">[@{$textarea}@]</div>               
            </div>             
          </div>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div> 
          <div class="info-box-central-contents">                             
            <div class="main" style="margin: 4px 15px 4px 15px;">
              <div style="float: left;">
                <b>[@{#title_continue_checkout_procedure#}@]</b><br />[@{#text_continue_checkout_procedure#}@]
              </div>
              <div style="padding: 8px 0 0 0; float: right;">
                <script type="text/javascript">
                /* <![CDATA[ */
                  document.write('<a href="" onclick="checkout_address.submit(); return false" class="button-continue" style="float: left" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
                /* ]]> */  
                </script>
                <noscript>
                  <input type="submit" value="[@{#button_text_continue#}@]" />
                </noscript> 
              </div>                                                                                                                                 
              <div class="clear">&nbsp;</div>                    
            </div>             
          </div>
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
<!-- checkout_shipping_eof -->
