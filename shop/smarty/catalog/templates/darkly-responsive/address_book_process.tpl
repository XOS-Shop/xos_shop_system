[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : darkly-responsive
* version    : 1.0.7 for XOS-Shop version 1.0 rc7w
* descrip    : xos-shop template built with Bootstrap3 and theme darkly                                                                    
* filename   : address_book_process.tpl
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

<!-- address_book_process -->
[@{if $delete_address}@]
          <h1 class="text-orange">[@{#heading_title_delete_entry#}@]</h1>                
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
          <div><b>[@{#delete_address_title#}@]</b></div>
          <div class="panel panel-default clearfix">           
            <div class="panel-body">                      
              <div class="row">              
                <div class="col-md-6">[@{#delete_address_description#}@]</div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-xs-12 div-spacer-h30 visible-xs-block visible-sm-block"></div>
                    <div class="col-xs-12 visible-sm-block visible-xs-block"><b>[@{#selected_address#}@]</b><br /></div>  
                    <div class="col-xs-5 text-center hidden-sm hidden-xs"><b>[@{#selected_address#}@]</b><br /><img src="[@{$images_path}@]arrow_south_east.gif" alt="" /></div>              
                    <div class="col-xs-7 text-nowrap">[@{$address_label}@]</div> 
                  </div>             
                </div>       
              </div>
            </div>               
          </div>           
          <div class="well well-sm clearfix">
            <a href="[@{$link_filename_address_book}@]" class="btn btn-primary pull-left" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>
            <a href="[@{$link_filename_address_book_process_delete}@]" class="btn btn-danger pull-right" title=" [@{#button_title_delete#}@] ">[@{#button_text_delete#}@]</a>                                                                                                                                                                             
          </div>                              
[@{elseif $edit_address}@]
    [@{$form_begin}@]
          <h1 class="text-orange">[@{#heading_title_modify_entry#}@]</h1>                
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
          <div>
          [@{$address_book_details}@]
          </div>
          <div class="div-spacer-h10"></div>           
          <div class="well well-sm clearfix"> 
            [@{$hidden_field_update}@][@{$hidden_field_edit}@]                              
            <a href="[@{$link_filename_address_book}@]" class="btn btn-primary pull-left" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>
            <input type="submit" class="btn btn-success pull-right" value="[@{#button_text_update#}@]" />                                                                                                                                                                                
          </div>               
    [@{$form_end}@]
[@{else}@]
    [@{$form_begin}@]
          <h1 class="text-orange">[@{#heading_title_add_entry#}@]</h1>                
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
          <div>
          [@{$address_book_details}@]
          </div>
          <div class="div-spacer-h10"></div>           
          <div class="well well-sm clearfix"> 
            [@{$hidden_field_process}@]                              
            <a href="[@{$link_back}@]" class="btn btn-primary pull-left" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>
            <input type="submit" class="btn btn-success pull-right" value="[@{#button_text_continue#}@]" />                                                                                                                                                                               
          </div>                  
    [@{$form_end}@]
[@{/if}@]
<!-- address_book_process_eof -->
    
