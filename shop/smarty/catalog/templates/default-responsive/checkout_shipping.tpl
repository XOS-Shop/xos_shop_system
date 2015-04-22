[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : default-responsive
* version    : 1.0.7 for XOS-Shop version 1.0 rc7y
* descrip    : xos-shop default template built with Bootstrap3                                                                    
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
          <h1 class="text-orange">[@{#heading_title#}@]</h1> 
          <div class="row">                                          
            <div class="col-sm-3 col-xs-6 checkout-bar-current text-center"><span class="lead"><b>1</b></span><br /><b>[@{#checkout_bar_delivery#}@]</b></div>
            <div class="col-sm-3 col-xs-6 checkout-bar-to text-center"><span class="lead">2</span><br />[@{#checkout_bar_payment#}@]</div>
            <div class="clearfix visible-xs-block"></div>
            <div class="visible-xs-block div-spacer-h10"></div>
            <div class="col-sm-3 col-xs-6 checkout-bar-to text-center"><span class="lead">3</span><br />[@{#checkout_bar_confirmation#}@]</div>
            <div class="col-sm-3 col-xs-6 checkout-bar-to text-center"><span class="lead">4</span><br />[@{#checkout_bar_finished#}@]</div>
          </div>
          <div class="div-spacer-h20"></div>                          
          <div><b>[@{#table_heading_shipping_address#}@]</b></div>          
          <div class="panel panel-default clearfix">           
            <div class="panel-body">                      
              <div class="row">              
                <div class="col-md-6">[@{#text_choose_shipping_destination#}@]<br />&nbsp;<br /><a href="[@{$link_filename_checkout_shipping_address}@]" class="btn btn-primary" title=" [@{#button_title_change_address#}@] ">[@{#button_text_change_address#}@]</a></div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-xs-12 div-spacer-h20 visible-xs-block visible-sm-block"></div>
                    <div class="col-xs-12 visible-sm-block visible-xs-block"><b>[@{#title_shipping_address#}@]</b><br /></div>  
                    <div class="col-xs-5 text-center hidden-sm hidden-xs"><b>[@{#title_shipping_address#}@]</b><br /><img src="[@{$images_path}@]arrow_south_east.gif" alt="" /></div>              
                    <div class="col-xs-7 text-nowrap">[@{$address_label}@]</div> 
                  </div>             
                </div>       
              </div>
            </div>               
          </div>          
     [@{if $shipping_modules}@]
          <div><b>[@{#table_heading_shipping_method#}@]</b></div>
          <div class="panel panel-default clearfix">           
            <div class="panel-body">            
              [@{if $several_shipping_modules and !$free_shipping}@]             
              <div class="clearfix">
                <div class="pull-left">[@{#text_choose_shipping_method#}@]<br /><br /></div>
                <div class="pull-right text-right"><b>[@{#title_please_select#}@]</b><br /><img src="[@{$images_path}@]arrow_east_south.gif" alt="" /></div>
              </div>
              [@{elseif !$free_shipping}@]
              <div>[@{#text_enter_shipping_information#}@]</div>                     
              [@{/if}@]                            
              [@{if $free_shipping}@]            
              <div><b>[@{#free_shipping_title#}@]</b>&nbsp;[@{$shipping_icon}@]</div>
              <div>[@{eval var=#free_shipping_description#}@][@{$hidden_field_shipping}@]</div>                                                    
              [@{else}@]              
              [@{foreach name=outer item=shipping_module from=$shipping_modules_array}@]
              <div class="div-spacer-h10"></div>             
              <div><b>[@{$shipping_module.name}@]</b>&nbsp;[@{$shipping_module.icon}@]</div>            
              [@{if $shipping_module.error}@]
              <div class="row">              
                <div class="col-xs-8">[@{$shipping_module.error}@]</div> 
              </div> 
              [@{else}@]
              <div class="row">
                [@{foreach name=inner item=method from=$shipping_module.methods}@]      
                [@{if $method.actual_method}@]                      
                <div id="default-selected"class="module-row-selected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, [@{$method.radio_select}@])">                  
                [@{else}@]        
                <div class="module-row" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, [@{$method.radio_select}@])">        
                [@{/if}@]                   
                  <div class="col-xs-6">[@{$method.title}@]</div>
                  [@{if $method.several_methods}@]                                
                  <div class="col-xs-6 text-right">[@{$method.cost}@]&nbsp;&nbsp;[@{$method.radio_field}@]&nbsp;&nbsp;&nbsp;&nbsp;</div>                                        
                  [@{else}@]        
                  <div class="col-xs-6 text-right">[@{$method.cost}@][@{$method.hidden_field}@]</div>       
                  [@{/if}@]                
                  <div class="clearfix invisible"></div>
                </div>
                [@{/foreach}@]
              </div>              
              [@{/if}@]                
              [@{/foreach}@]              
              [@{/if}@]              
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
          <div class="well well-sm clearfix">          
            <div class="pull-left">
              <b>[@{#title_continue_checkout_procedure#}@]</b><br />[@{#text_continue_checkout_procedure#}@]
            </div>
            <div class="pull-right">
              <input type="submit" class="btn btn-success pull-right" value="[@{#button_text_continue#}@]" /> 
            </div>
          </div>            
    [@{$form_end}@]
<!-- checkout_shipping_eof -->
