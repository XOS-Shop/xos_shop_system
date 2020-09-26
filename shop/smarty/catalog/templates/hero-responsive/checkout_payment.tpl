[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : hero-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.9
* descrip    : xos-shop template built with Bootstrap3 and theme superhero                                                                    
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
          <h1 class="text-orange">[@{#heading_title#}@]</h1> 
          <div class="row">                                          
            <div class="col-sm-3 col-xs-6 checkout-bar-from text-center"><span class="lead">1</span><br /><a href="[@{$link_filename_checkout_shipping}@]" class="checkout-bar-from">[@{#checkout_bar_delivery#}@]</a></div>
            <div class="col-sm-3 col-xs-6 checkout-bar-current text-center"><span class="lead"><b>2</b></span><br /><b>[@{#checkout_bar_payment#}@]</b></div>
            <div class="clearfix visible-xs-block"></div>
            <div class="visible-xs-block div-spacer-h10"></div>
            <div class="col-sm-3 col-xs-6 checkout-bar-to text-center"><span class="lead">3</span><br />[@{#checkout_bar_confirmation#}@]</div>
            <div class="col-sm-3 col-xs-6 checkout-bar-to text-center"><span class="lead">4</span><br />[@{#checkout_bar_finished#}@]</div>
          </div>
          <div class="div-spacer-h20"></div>                                                        
      [@{if $payment_error}@]
          <div><b>[@{$payment_error_title}@]</b></div>
          <div class="alert alert-danger" role="alert">
            [@{$payment_error_sting}@]
          </div>           
      [@{/if}@]
          <div><b>[@{#table_heading_billing_address#}@]</b></div>          
          <div class="panel panel-default clearfix">           
            <div class="panel-body">                      
              <div class="row">              
                <div class="col-md-6">[@{#text_selected_billing_destination#}@]<br />&nbsp;<br /><a href="[@{$link_filename_checkout_payment_address}@]" class="btn btn-primary" title=" [@{#button_title_change_address#}@] ">[@{#button_text_change_address#}@]</a></div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-xs-12 div-spacer-h20 visible-xs-block visible-sm-block"></div>
                    <div class="col-xs-12 visible-sm-block visible-xs-block"><b>[@{#title_billing_address#}@]</b><br /></div>  
                    <div class="col-xs-5 text-center hidden-sm hidden-xs"><b>[@{#title_billing_address#}@]</b><br /><img src="[@{$images_path}@]arrow_south_east.gif" alt="" /></div>              
                    <div class="col-xs-7 text-nowrap">[@{$address_label}@]</div> 
                  </div>             
                </div>       
              </div>
            </div>               
          </div>       
      [@{if $payment_modules}@]
          <div><b>[@{#table_heading_payment_method#}@]</b></div>
          <div class="panel panel-default clearfix">           
            <div class="panel-body">
              [@{if $several_payment_modules}@]             
              <div class="clearfix">
                <div class="pull-left">[@{#text_select_payment_method#}@]<br /><br /></div>
                <div class="pull-right text-right"><b>[@{#title_please_select#}@]</b><br /><img src="[@{$images_path}@]arrow_east_south.gif" alt="" /></div>
              </div>
              [@{else}@]
              <div>[@{#text_enter_payment_information#}@]</div>                     
              [@{/if}@]                                            
              [@{foreach name=outer item=payment_module from=$payment_modules}@]
              <div class="div-spacer-h10"></div>
              <div class="row">
                [@{if $payment_module.actual_payment_method}@]
                <div id="default-selected" class="module-row-selected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, [@{$payment_module.radio_select}@])"> 
                [@{else}@]                  
                <div class="module-row" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, [@{$payment_module.radio_select}@])">
                [@{/if}@]  
                  <div class="col-xs-9"><b>[@{$payment_module.loaded_modules}@]</b></div>
                  <div class="col-xs-3 text-right">[@{$payment_module.radio_field}@]&nbsp;&nbsp;&nbsp;&nbsp;</div>                  
                  [@{if $payment_module.module_error}@]                
                  <div class="col-xs-9">
                    <div class="col-xs-12">[@{$module_error_text}@]</div>
                  </div>                
                  [@{elseif $payment_module.fields}@]
                  <div class="col-xs-9">             
                    [@{foreach name=inner item=selection_field from=$payment_module.selection_fields}@]   
                    <div class="col-xs-12">[@{$selection_field.title}@]</div>
                    <div class="col-xs-12">[@{$selection_field.field}@]</div>
                    <div class="col-xs-12 div-spacer-h10"></div>                                                   
                    [@{/foreach}@]
                  </div>
                  [@{/if}@]                                    
                  <div class="clearfix invisible"></div>
                </div>                
              </div>              
              [@{/foreach}@]
            </div>               
          </div>       
      [@{/if}@]
          <div><b>[@{#table_heading_comments#}@]</b></div>          
          <div class="panel panel-default clearfix">           
            <div class="panel-body">                      
              <div><b>[@{#sub_title_no_html#}@]</b>&nbsp;[@{#text_no_html#}@]</div>                     
              <div>[@{$textarea}@]</div>  
            </div>               
          </div>                  
     [@{if $checkbox_accept_conditions}@]         
          <div><b>[@{#table_heading_conditions#}@]</b></div>          
          <div class="panel panel-default clearfix">           
            <div class="panel-body">
              [@{if $link_filename_popup_content_8}@]                      
              <div><a href="[@{$link_filename_popup_content_8}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_conditions_show#}@]</span></a></div>                     
              [@{/if}@]
              [@{if $checkbox_accept_conditions}@]
              <div class="form-group">
                <div class="checkbox">
                  <label>
                    [@{$checkbox_accept_conditions}@]
                    [@{#text_accept_conditions#}@]
                 </label>
                </div>
              </div>                          
              [@{/if}@]   
            </div>               
          </div>                     
     [@{/if}@]
          <div class="well well-sm clearfix">          
            <div class="pull-left">
              <b>[@{#title_continue_checkout_procedure#}@]</b><br />[@{#text_continue_checkout_procedure#}@]
            </div>
            <div class="pull-right">
              <input type="submit" class="btn btn-success pull-right" value="[@{#button_text_continue#}@]" /> 
            </div>
          </div>      
    [@{$form_end}@]
<!-- checkout_payment_eof -->
