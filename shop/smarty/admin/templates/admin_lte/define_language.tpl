[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.7
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : define_language.tpl
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
<!-- define_language -->    
      <div class="content-wrapper">    
        <section class="content-header clearfix">
          <h1 class="pull-left">[@{#heading_title#}@]</h1>
          <div class="pull-right" style="margin-left: 20px">[@{$form_begin_language}@][@{$pull_down_lngdir|replace:'<select':'<select class="form-control"'}@][@{$hidden_field_session}@][@{$form_end}@]</div>
        </section> 
        <section class="content">
          [@{if $message_stack_header_error}@]
          <div class="callout callout-danger" role="alert">
            [@{$message_stack_header_error}@]
          </div>                            
          [@{/if}@]
          [@{if $message_stack_header_warning}@]
          <div class="callout callout-warning" role="alert">
            [@{$message_stack_header_warning}@]
          </div>                            
          [@{/if}@]          
          [@{if $message_stack_header_success}@]
          <div class="callout callout-success" role="alert">
            [@{$message_stack_header_success}@]
          </div>                            
          [@{/if}@]       
          <div class="row">
            <div class="col-xs-12">                                                                                                                                               
            [@{if $file_edit}@]              
              [@{if $file_exists}@]           
              [@{$form_begin_save}@]
              <div class="box">
                <div class="box-body table-responsive">            
                  <div class="form-group">
                    <label for="textarea_id">[@{$filename}@]</label>
                    [@{$textarea_file_contents|replace:'<textarea':'<textarea class="form-control" id="textarea_id"'}@]
                  </div>        
                </div>
              </div>              
              [@{if $file_writeable}@]
              <a href="[@{$link_filename_define_language}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a><a href="" onclick="define_lng.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_save#}@] ">[@{#button_text_save#}@]</a>
              [@{else}@]
              [@{* [@{$file_not_writeable}@]&nbsp;<br />&nbsp;<br /> *}@]<a href="[@{$link_filename_define_language}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>
              [@{/if}@]                                           
              [@{$form_end}@]                                  
              [@{else}@]          
              <div class="box">
                <div class="box-body">                                          
                  <b>[@{#text_file_does_not_exist#}@]</b></td>
                </div>
              </div> 
              <a href="[@{$link_filename_define_language}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>
              [@{/if}@]                                                
            [@{else}@]        
              <div class="box">
                <div class="box-body table-responsive">                                
                  <table class="table-define-language">
                    <tr>
                      <td colspan="2"><a href="[@{$link_filename_define_language_filename_conf}@]"><b>[@{$filename_conf}@]</b></a></td>
                    </tr>            
                    <tr>
                      <td colspan="2"><a href="[@{$link_filename_define_language_filename_email_conf}@]"><b>[@{$filename_email_conf}@]</b></a></td>
                    </tr>            
                    <tr>
                      <td colspan="2"><a href="[@{$link_filename_define_language_filename}@]"><b>[@{$filename}@]</b></a></td>
                    </tr>             
                    <tr>
                      <td colspan="2"><img src="[@{$images_path}@]pixel_black.gif" alt="" style="width: 100%; height: 1px" /></td>
                    </tr>                          
                  [@{foreach name=loop item=file from=$files}@]
                    [@{if (($smarty.foreach.loop.iteration-1)%2) == 0}@]
                    <tr>
                    [@{/if}@]                      
                      <td><a href="[@{$file.link_filename_define_language_filename}@]">[@{$file.filename}@]</a></td>
                    [@{if ((($smarty.foreach.loop.iteration)%2) != 0) and $smarty.foreach.loop.last}@]  
                       <td></td>
                    [@{/if}@]  
                    [@{if ((($smarty.foreach.loop.iteration)%2) == 0) or $smarty.foreach.loop.last}@]
                    </tr>  
                    [@{/if}@]
                  [@{/foreach}@]           
                    <tr>
                      <td colspan="2"><img src="[@{$images_path}@]pixel_black.gif" alt="" style="width: 100%; height: 1px" /></td>
                    </tr>                         
                  [@{foreach name=loop item=file_order_total from=$files_order_total}@]
                    [@{if (($smarty.foreach.loop.iteration-1)%2) == 0}@]
                    <tr>
                    [@{/if}@]                      
                      <td><a href="[@{$file_order_total.link_filename_define_language_filename}@]">[@{$file_order_total.filename}@]</a></td>
                    [@{if ((($smarty.foreach.loop.iteration)%2) != 0) and $smarty.foreach.loop.last}@]  
                       <td></td>
                    [@{/if}@]                 
                    [@{if ((($smarty.foreach.loop.iteration)%2) == 0) or $smarty.foreach.loop.last}@]
                    </tr>  
                    [@{/if}@]
                  [@{/foreach}@]            
                    <tr>
                      <td colspan="2"><img src="[@{$images_path}@]pixel_black.gif" alt="" style="width: 100%; height: 1px" /></td>
                    </tr>                         
                  [@{foreach name=loop item=file_payment from=$files_payment}@]
                    [@{if (($smarty.foreach.loop.iteration-1)%2) == 0}@]
                    <tr>
                    [@{/if}@]                      
                      <td><a href="[@{$file_payment.link_filename_define_language_filename}@]">[@{$file_payment.filename}@]</a></td>
                    [@{if ((($smarty.foreach.loop.iteration)%2) != 0) and $smarty.foreach.loop.last}@]  
                       <td></td>
                    [@{/if}@]                 
                    [@{if ((($smarty.foreach.loop.iteration)%2) == 0) or $smarty.foreach.loop.last}@]
                    </tr>  
                    [@{/if}@]
                  [@{/foreach}@]             
                    <tr>
                      <td colspan="2"><img src="[@{$images_path}@]pixel_black.gif" alt="" style="width: 100%; height: 1px" /></td>
                    </tr>                         
                  [@{foreach name=loop item=file_shipping from=$files_shipping}@]
                    [@{if (($smarty.foreach.loop.iteration-1)%2) == 0}@]
                    <tr>
                    [@{/if}@]                      
                      <td><a href="[@{$file_shipping.link_filename_define_language_filename}@]">[@{$file_shipping.filename}@]</a></td>
                    [@{if ((($smarty.foreach.loop.iteration)%2) != 0) and $smarty.foreach.loop.last}@]  
                       <td></td>
                    [@{/if}@]                 
                    [@{if ((($smarty.foreach.loop.iteration)%2) == 0) or $smarty.foreach.loop.last}@]
                    </tr>  
                    [@{/if}@]
                  [@{/foreach}@]                         
                  </table>        
                </div>
              </div>        
              <a href="[@{$link_filename_file_manager}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_file_manager#}@] ">[@{#button_text_file_manager#}@]</a>                            
            [@{/if}@]                                              
            </div>            
          </div>
        </section>        
      </div>       
<!-- define_language_eof -->