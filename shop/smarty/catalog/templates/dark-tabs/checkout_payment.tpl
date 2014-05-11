[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : dark-tabs
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop extra template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : checkout_payment.tpl
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

<!-- checkout_payment -->
    [@{$form_begin}@]
          <h1 class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title#}@]</h1>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div>                                 
      [@{if $payment_error}@]
          <div class="main"><b>[@{$payment_error_title}@]</b></div> 
          <div class="info-box-notice-contents" style="padding: 2px 12px 2px 12px;">            
            <div class="main" style="padding: 4px;">[@{$payment_error_sting}@]</div>
          </div>                  
          <div style="height: 10px; font-size: 0;">&nbsp;</div>            
      [@{/if}@]
          <h3 class="main"><b>[@{#table_heading_billing_address#}@]</b></h3>           
          <div class="info-box-central-contents">
            <div class="main" style="width: 40%; padding: 4px 0 4px 16px; float: left;">[@{#text_selected_billing_destination#}@]<br />&nbsp;<br /><a href="[@{$link_filename_checkout_payment_address}@]" class="button-change-address" style="float: left" title=" [@{#button_title_change_address#}@] "><span>[@{#button_text_change_address#}@]</span></a></div>
            <div class="main" style="padding: 2px; float: right;">
              <div class="main" style="padding: 2px 6px 2px 2px; text-align: center; float: left;"><b>[@{#title_billing_address#}@]</b><br /><img src="[@{$images_path}@]arrow_south_east.gif" alt="" /></div>
              <div class="main" style="padding: 2px 16px 2px 2px; float: left;">[@{$address_label}@]</div>
              <div class="clear">&nbsp;</div>                
            </div>
            <div class="clear">&nbsp;</div>
          </div>
          <div style="height: 10px; font-size: 0;">&nbsp;</div>
      [@{if $payment_modules}@]           
          <h3 class="main"><b>[@{#table_heading_payment_method#}@]</b></h3>          
          <div class="info-box-central-contents">          
            [@{if $several_payment_modules}@]
            <div>
              <div class="main" style="width: 50%; padding: 4px 0 4px 16px; float: left;">[@{#text_select_payment_method#}@]</div>
              <div class="main" style="padding: 2px 19px 2px 2px; text-align: right; float: right;"><b>[@{#title_please_select#}@]</b><br /><img src="[@{$images_path}@]arrow_east_south.gif" alt="" /></div>
              <div class="clear">&nbsp;</div>
            </div>                                     
            [@{else}@]
            <div class="main" style="padding: 4px 16px 4px 16px;">[@{#text_enter_payment_information#}@]</div>                     
            [@{/if}@]   
            [@{foreach name=outer item=payment_module from=$payment_modules}@]              
            <div style="width: 95%; padding: 2px 2px 2px 16px;">             
              [@{if $payment_module.actual_payment_method}@]
              <div id="default-selected" style="padding-left: 14px;" class="module-row-selected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, [@{$payment_module.radio_select}@])">                  
              [@{else}@]
              <div class="module-row" style="padding-left: 14px;" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, [@{$payment_module.radio_select}@])">       
              [@{/if}@]                   
                <div class="main" style="width: 74%; padding: 2px; float: left;"><label for="payment_[@{$payment_module.radio_select}@]"><b>[@{$payment_module.loaded_modules}@]</b></label></div>                               
                <div class="main" style="width: 22%; padding: 2px; text-align: right; float: left;"><span style="vertical-align: middle;">[@{$payment_module.radio_field}@]</span></div>           
                <div class="clear">&nbsp;</div>               
              </div>                 
              [@{if $payment_module.module_error}@]                
              <div class="main" style="padding: 0 0 2px 16px;">[@{$module_error_text}@]</div>                
              [@{elseif $payment_module.fields}@]
              <div class="main" style="padding: 0 0 2px 16px;">
                <table border="0" cellspacing="0" cellpadding="2">                
                [@{foreach name=inner item=selection_field from=$payment_module.selection_fields}@]   
                  <tr>
                    <td class="main" style="padding: 0 10px 0 0;">[@{$selection_field.title}@]</td>
                    <td class="main">[@{$selection_field.field}@]</td>
                  </tr>                                                   
                [@{/foreach}@]
                </table>
              </div>
              [@{/if}@]               
            </div> 
            [@{/foreach}@]                                        
          </div>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div>
      [@{/if}@]                
          <h3 class="main"><label for="checkout_payment_comments"><b>[@{#table_heading_comments#}@]</b></label></h3>       
          <div class="info-box-central-contents">                             
            <div class="main" style="padding: 4px;"> 
              <div class="small-text" style="padding: 0 0 3px 0;"><b>[@{#sub_title_no_html#}@]</b>&nbsp;[@{#text_no_html#}@]</div>                     
              <div class="main" style="width: 600px;">[@{$textarea}@]</div>               
            </div>             
          </div>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div>             
     [@{if $checkbox_accept_conditions}@]
          <h3 class="main"><b>[@{#table_heading_conditions#}@]</b></h3>      
          <div class="info-box-central-contents" style="padding: 2px 11px 2px 11px;">
          [@{if $link_filename_popup_content_7}@]                        
            <div class="main" style="padding: 1px;">              
              <script type="text/javascript">
              /* <![CDATA[ */            
                document.write('<a href="[@{$link_filename_popup_content_7}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_conditions_show#}@]</span></a>');
              /* ]]> */   
              </script>             
              <noscript>
                &nbsp;<a href="[@{$link_filename_popup_content_7}@]" target="_blank"><span class="text-deco-underline">[@{#text_conditions_show#}@]</span></a>
              </noscript>   
            </div>
          [@{/if}@]
          [@{if $checkbox_accept_conditions}@]   
            <div class="main" style="padding: 1px;">[@{$checkbox_accept_conditions}@]&nbsp;<label for="accept_conditions">[@{#text_accept_conditions#}@]</label></div>             
          [@{/if}@]                          
          </div>        
          <div style="height: 10px; font-size: 0;">&nbsp;</div>                  
     [@{/if}@]
          <div class="info-box-central-contents">                             
            <div class="main" style="margin: 4px 15px 4px 15px;">
              <div style="float: left;">
                <b>[@{#title_continue_checkout_procedure#}@]</b><br />[@{#text_continue_checkout_procedure#}@]
              </div>
              <div style="padding: 8px 0 0 0; float: right;">
                <script type="text/javascript">
                /* <![CDATA[ */
                  document.write('<a href="" onclick="if(checkout_payment.onsubmit())checkout_payment.submit(); return false" class="button-continue" style="float: left" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
                /* ]]> */  
                </script>
                <noscript>
                  <input type="submit" value="[@{#button_text_continue#}@]" />
                </noscript> 
              </div>                                                                                                                                 
              <div class="clear">&nbsp;</div>                    
            </div>             
          </div>      
          <div style="height: 10px; font-size: 0;">&nbsp;</div>                    
          <div class="checkout-bar-payment-gif">&nbsp;</div>      
          <div class="checkout-bar-from" style="width: 25%; text-align: center; float: left;"><a href="[@{$link_filename_checkout_shipping}@]" class="checkout-bar-from">[@{#checkout_bar_delivery#}@]</a></div>
          <div class="checkout-bar-current" style="width: 25%; text-align: center; float: left;">[@{#checkout_bar_payment#}@]</div>
          <div class="checkout-bar-to" style="width: 25%; text-align: center; float: left;">[@{#checkout_bar_confirmation#}@]</div>
          <div class="checkout-bar-to" style="width: 25%; text-align: center; float: left;">[@{#checkout_bar_finished#}@]</div>
          <div class="clear">&nbsp;</div>    
    [@{$form_end}@]
<!-- checkout_payment_eof -->
