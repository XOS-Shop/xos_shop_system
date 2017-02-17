[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : sandstone-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.4
* descrip    : xos-shop default template built with Bootstrap3                                                                    
* filename   : address_book.tpl
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

<!-- address_book -->  
          <h1 class="text-orange">[@{#heading_title#}@]</h1>                
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
          <div><b>[@{#primary_address_title#}@]</b></div>          
          <div class="panel panel-default clearfix">           
            <div class="panel-body">                      
              <div class="row">              
                <div class="col-md-6">[@{#primary_address_description#}@]</div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-xs-12 div-spacer-h30 visible-xs-block visible-sm-block"></div>
                    <div class="col-xs-12 visible-sm-block visible-xs-block"><b>[@{#primary_address_title#}@]</b><br /></div>  
                    <div class="col-xs-5 text-center hidden-sm hidden-xs"><b>[@{#primary_address_title#}@]</b><br /><img src="[@{$images_path}@]arrow_south_east.gif" alt="" /></div>              
                    <div class="col-xs-7 text-nowrap">[@{$primary_address_label}@]</div> 
                  </div>             
                </div>       
              </div>
            </div>               
          </div>           
          <div><b>[@{#address_book_title#}@]</b></div>
          <div class="panel panel-default clearfix">           
            <div class="panel-body">                      
              [@{foreach item=address from=$addresses}@]
              <div class="row">
                <div class="module-row" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
                  <div class="col-sm-7" onclick="document.location.href='[@{$address.link_filename_address_book_process_edit}@]'"><b>[@{$address.name}@]</b>[@{if $address.primary_address}@]&nbsp;<small><i>[@{#primary_address#}@]</i></small>[@{/if}@]</div>
                  <div class="col-sm-3 col-xs-4"><a href="[@{$address.link_filename_address_book_process_edit}@]" class="btn btn-info btn-sm" title=" [@{#small_button_title_edit#}@] ">[@{#small_button_text_edit#}@]</a></div>
                  <div class="col-sm-2 col-xs-8"><a href="[@{$address.link_filename_address_book_process_delete}@]" class="btn btn-danger btn-sm" title=" [@{#small_button_title_delete#}@] ">[@{#small_button_text_delete#}@]</a></div>
                  <div class="col-xs-12">
                    [@{$address.format_address}@]
                    <div class="div-spacer-h10"></div>
                  </div>
                  <div class="clearfix invisible"></div>
                </div>
              </div>
              [@{/foreach}@]
            </div>               
          </div>                       
          <div class="well well-sm clearfix"> 
            <a href="[@{$link_filename_account}@]" class="btn btn-primary pull-left" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>
            [@{if $link_filename_address_book_process}@]                
            <a href="[@{$link_filename_address_book_process}@]" class="btn btn-success pull-right" title=" [@{#button_title_add_address#}@] ">[@{#button_text_add_address#}@]</a>              
            [@{/if}@]                                                                                                                                                                                        
          </div>                                                 
          <div><span class="red-mark"><b>[@{#text_maximum_entries_1#}@]</b></span> [@{eval var=#text_maximum_entries_2#}@]</div>
<!-- address_book_eof -->
