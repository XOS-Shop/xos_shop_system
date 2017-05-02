[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : paper-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.5
* descrip    : xos-shop template built with Bootstrap3 and theme paper                                                                    
* filename   : checkout_payment_address.tpl
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

<!-- checkout_payment_address -->
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
          [@{if $message_stack_error}@]
          <div class="alert alert-danger" role="alert">
            [@{$message_stack_error}@]
          </div>                            
          [@{/if}@]
          [@{if $message_stack_warning}@]
          <div class="alert alert-warning" role="alert">
            [@{$message_stack_warning}@]
          </div>                            
          [@{/if}@]          
          [@{if $message_stack_success}@]
          <div class="alert alert-success" role="alert">
            [@{$message_stack_success}@]
          </div>                            
          [@{/if}@]
     [@{if !$process}@]
          <div><b>[@{#table_heading_payment_address#}@]</b></div>          
          <div class="panel panel-default clearfix">           
            <div class="panel-body">                      
              <div class="row">              
                <div class="col-md-6">[@{#text_selected_payment_destination#}@]</div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-xs-12 div-spacer-h20 visible-xs-block visible-sm-block"></div>
                    <div class="col-xs-12 visible-sm-block visible-xs-block"><b>[@{#title_payment_address#}@]</b><br /></div>  
                    <div class="col-xs-5 text-center hidden-sm hidden-xs"><b>[@{#title_payment_address#}@]</b><br /><img src="[@{$images_path}@]arrow_south_east.gif" alt="" /></div>              
                    <div class="col-xs-7 text-nowrap">[@{$address_label}@]</div> 
                  </div>             
                </div>       
              </div>
            </div>               
          </div>                                                                     
       [@{if $several_addresses}@]
          <div><b>[@{#table_heading_address_book_entries#}@]</b></div>
          <div class="panel panel-default clearfix">           
            <div class="panel-body">             
              <div class="clearfix">
                <div class="pull-left">[@{#text_select_other_payment_destination#}@]<br /><br /></div>
                <div class="pull-right text-right"><b>[@{#title_please_select#}@]</b><br /><img src="[@{$images_path}@]arrow_east_south.gif" alt="" /></div>
              </div>                              
              [@{foreach item=address from=$addresses}@]
              <div class="div-spacer-h10"></div>
              <div class="row">
                [@{if $address.actual_address}@]
                <div id="default-selected" class="module-row-selected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, [@{$address.radio_select}@])">
                [@{else}@]                  
                <div class="module-row" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, [@{$address.radio_select}@])">
                [@{/if}@]  
                  <div class="col-xs-9"><b>[@{$address.address_name}@]</b></div>
                  <div class="col-xs-3 text-right">[@{$address.radio_field}@]&nbsp;&nbsp;&nbsp;&nbsp;</div>            
                  <div class="col-xs-9">[@{$address.full_address}@]</div>
                  <div class="clearfix invisible"></div>
                </div>
              </div>              
              [@{/foreach}@]
            </div>               
          </div>              
       [@{/if}@]            
     [@{/if}@]      
     [@{if $not_max_address_book_entries}@]
          <div class="pull-left"><b>[@{#table_heading_new_payment_address#}@]</b></div>
          <div class="input-requirement-moved pull-right">[@{#form_required_information#}@]</div>
          <div class="clearfix invisible"></div>          
          <div class="panel panel-default clearfix">           
            <div class="panel-body">                      
              <div>[@{#text_create_new_payment_address#}@]</div>
              <div>[@{$checkout_new_address}@]</div>          
            </div>                
          </div>                      
     [@{/if}@]
          <div class="well well-sm clearfix"> 
            <div class="pull-left" >
              <b>[@{#title_continue_checkout_procedure#}@]</b><br />[@{#text_continue_checkout_procedure#}@]
              [@{$hidden_field_submit}@]
            </div>                             
            <input type="submit" class="btn btn-success pull-right" value="[@{#button_text_continue#}@]" />                                                                                                                                                                               
          </div>                 
     [@{if $process}@] 
          <div class="well well-sm clearfix"> 
            <div><a href="[@{$link_filename_checkout_payment_address}@]" class="btn btn-primary pull-left" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a></div>                                                                                                                                                                 
          </div>           
     [@{/if}@]
    [@{$form_end}@]
<!-- checkout_payment_address_eof -->
