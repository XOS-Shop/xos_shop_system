[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.7
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : newsletters.tpl
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
[@{if $send_now}@]
<br />
[@{$message_stack_output}@]
<br />
<a href="[@{$link_filename_newsletters_back}@]" class="btn btn-primary" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>
[@{else}@]
<!-- newsletters -->   
      <div class="content-wrapper">
        <section class="content-header">
          <h1>[@{#heading_title#}@]</h1>
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
      [@{if $action == 'new'}@] 
          <div class="row">
            <div class="col-xs-12">           
            [@{$form_begin_new}@][@{$hidden_newsletter_id}@][@{$hidden_field_language_id}@]                       
              <div class="box">
                <div class="box-body">          
                  <div class="form-horizontal">                                  
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_newsletter_module#}@]</b></div>
                      <div class="col-lg-3 col-sm-5 col-xs-9">
                        [@{$pull_down_module|replace:'<select':'<select class="form-control"'}@]
                      </div>
                    </div>
                    [@{if $languages}@]                    
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_newsletter_language#}@]</b></div>
                      <div class="col-lg-3 col-sm-5 col-xs-9">
                        [@{$pull_down_languages|replace:'<select':'<select class="form-control"'}@]
                      </div>
                    </div>
                    [@{/if}@]                    
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_newsletter_title#}@]</b></div>
                      <div class="col-lg-4 col-sm-6 col-xs-10 text-nowrap">
                        [@{$input_title|replace:'<input':'<input class="form-control form-element-required"'}@]
                      </div>
                    </div>
                    [@{if $wysiwyg}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_newsletter_content#}@]</b></div>
                      <div class="col-sm-8 col-md-9 col-xs-12">
                        [@{#text_text#}@]
                        [@{$textarea_content_text_plain|replace:'<textarea':'<textarea class="form-control"'}@]
                      </div>
                    </div>
                    <div class="form-group clearfix">                    
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"></div>
                      <div class="col-sm-8 col-md-9 col-xs-12">
                        [@{#text_html#}@]
                        [@{$textarea_content_text_htlm|replace:'<textarea':'<textarea class="form-control"'}@]
                      </div> 
<script>
  CKEDITOR.replace( 'content_text_htlm',
    {
      baseHref: '[@{$newsletter_base_href}@]',
      filebrowserBrowseUrl: '[@{$link_filename_popup_file_manager_link_selection}@]',
      filebrowserImageBrowseUrl: '[@{$link_filename_popup_file_manager_image}@]',
      filebrowserFlashBrowseUrl: '[@{$link_filename_popup_file_manager_flash}@]',
      customConfig: '[@{$newsletter_config}@]',
      language: '[@{$lang_code}@]',
      templates_files: [ '[@{$newsletter_template_file}@]' ],
      templates: '[@{$newsletter_template_lang}@]'             
    });
</script>                       
                    </div>
                    [@{elseif $use_html}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_newsletter_content#}@]</b></div>
                      <div class="col-sm-8 col-md-9 col-xs-12">
                        [@{#text_text#}@]
                        [@{$textarea_content_text_plain|replace:'<textarea':'<textarea class="form-control"'}@]
                      </div>
                    </div>
                    <div class="form-group clearfix">                    
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"></div>
                      <div class="col-sm-8 col-md-9 col-xs-12">
                        [@{#text_html#}@]
                        [@{$textarea_content_text_htlm|replace:'<textarea':'<textarea class="form-control"'}@]
                      </div>                      
                    </div>                                                                 
                    [@{else}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_newsletter_content#}@]</b></div>
                      <div class="col-sm-8 col-md-9 col-xs-12">
                        [@{#text_text#}@]
                        [@{$textarea_content_text_plain|replace:'<textarea':'<textarea class="form-control"'}@]
                      </div>
                    </div>                    
                    [@{/if}@]                                                                                       
                  </div>                      
                </div>
              </div> 
              <a href="[@{$link_filename_newsletters_cancel}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a>
              [@{if $update}@]
              <a href="" onclick="if(newsletter.onsubmit())newsletter.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_update#}@] ">[@{#button_text_update#}@]</a>
              [@{else}@]
              <a href="" onclick="if(newsletter.onsubmit())newsletter.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_save#}@] ">[@{#button_text_save#}@]</a>
              [@{/if}@]                
            [@{$form_end}@]        
            </div>            
          </div> 
        </section>       
      [@{elseif $action == 'preview'}@]
          <div class="row">
            <div class="col-xs-12">                               
              <div class="clearfix">                                                  
                <a href="[@{$link_filename_newsletters_back}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>
              </div>
              [@{if $content_text_plain}@]                                                                                              
              [@{#text_text#}@]                                                     
              <pre>[@{$content_text_plain}@]</pre>
              [@{/if}@]  
              [@{if $content_text_htlm}@]
              [@{#text_html#}@]       
              <div class="box">
                <div class="box-body">                                                 
                 [@{$content_text_htlm}@]                             
                </div>                                                               
              </div>
              [@{/if}@]                                                                                                         
              <a href="[@{$link_filename_newsletters_back}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                          
            </div>            
          </div>
        </section>        
      [@{elseif $action == 'send'}@]          
          <div class="row">
            <div class="col-xs-12">                                    
              <div class="box">
                <div class="box-body table-responsive old-select-in-it">                                                 
                  [@{$module}@]                            
                </div>                                                               
              </div>                       
            </div>            
          </div>
        </section>              
      [@{elseif $action == 'confirm'}@]  
          <div class="row">
            <div class="col-xs-12">                                    
              <div class="box">
                <div class="box-body table-responsive old-select-in-it">                                                 
                  [@{$module}@]                            
                </div>                                                               
              </div>                       
            </div>            
          </div>
        </section>    
      [@{elseif $action == 'confirm_send'}@]        
          <div class="row">
            <div class="col-xs-12">                                    
              <div class="box">
                <div class="box-body table-responsive">                                                 
                  <div id="infoSend">
                    <img src="[@{$images_path}@]ani_send_email.gif" alt="[@{#image_ani_send_email#}@]" title=" [@{#image_ani_send_email#}@] " />
                    <br /><br /><b>[@{#text_please_wait#}@]</b>
                  </div>                        
                </div>                                                               
              </div>                       
            </div>            
          </div>
        </section>                          
      [@{else}@] 
          <div class="row">
            <div class="col-xs-8 col-md-9 data-table-wrapper">
              <div class="box">
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr class="data-table-heading-row">
                      <th>[@{#table_heading_newsletters#}@]</th>
                      <th>[@{#table_heading_languages#}@]</th>
                      <th class="text-right">[@{#table_heading_size#}@]</th>
                      <th class="text-right">[@{#table_heading_module#}@]</th>                      
                      <th class="text-center">[@{#table_heading_sent#}@]</th>
                      <th class="text-center">[@{#table_heading_status#}@]</th>
                      <th class="text-right">[@{#table_heading_action#}@]</th>
                    </tr>
                    [@{foreach item=newsletter from=$newsletters}@]
                    [@{if $newsletter.selected}@]                             
                    <tr class="data-table-rows-elected" onclick="document.location.href='[@{$newsletter.link_filename_newsletters}@]'">
                      <td><a href="[@{$newsletter.link_filename_newsletters_preview}@]"><i class="fa fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a>&nbsp;&nbsp;[@{$newsletter.title}@]</td>
                      <td>[@{$newsletter.langauge_name}@]</td>
                      <td class="text-right">[@{$newsletter.content_length}@]&nbsp;bytes</td>
                      <td class="text-right">[@{$newsletter.module_name}@]</td>
                      <td class="text-center">[@{if $newsletter.status}@]<img src="[@{$images_path}@]icons/tick.gif" alt="[@{#icon_title_tick#}@]" title=" [@{#icon_title_tick#}@] " />[@{else}@]<img src="[@{$images_path}@]icons/cross.gif" alt="[@{#icon_title_cross#}@]" title=" [@{#icon_title_cross#}@] " />[@{/if}@]</td>
                      <td class="text-center">[@{if $newsletter.locked}@]<img src="[@{$images_path}@]icons/locked.gif" alt="[@{#icon_title_locked#}@]" title=" [@{#icon_title_locked#}@] " />[@{else}@]<img src="[@{$images_path}@]icons/unlocked.gif" alt="[@{#icon_title_unlocked#}@]" title=" [@{#icon_title_unlocked#}@] " />[@{/if}@]</td>
                      <td class="text-right"><i class="fa fa-fw fa-arrow-right"></i></td>
                    </tr> 
                    [@{else}@]
                    <tr class="data-table-row" onclick="document.location.href='[@{$newsletter.link_filename_newsletters}@]'">
                      <td><a href="[@{$newsletter.link_filename_newsletters_preview}@]"><i class="fa fa-file-text-o" title=" [@{#icon_title_preview#}@] "></i></a>&nbsp;&nbsp;[@{$newsletter.title}@]</td>
                      <td>[@{$newsletter.langauge_name}@]</td>
                      <td class="text-right">[@{$newsletter.content_length}@]&nbsp;bytes</td>
                      <td class="text-right">[@{$newsletter.module_name}@]</td>
                      <td class="text-center">[@{if $newsletter.status}@]<img src="[@{$images_path}@]icons/tick.gif" alt="[@{#icon_title_tick#}@]" title=" [@{#icon_title_tick#}@] " />[@{else}@]<img src="[@{$images_path}@]icons/cross.gif" alt="[@{#icon_title_cross#}@]" title=" [@{#icon_title_cross#}@] " />[@{/if}@]</td>
                      <td class="text-center">[@{if $newsletter.locked}@]<img src="[@{$images_path}@]icons/locked.gif" alt="[@{#icon_title_locked#}@]" title=" [@{#icon_title_locked#}@] " />[@{else}@]<img src="[@{$images_path}@]icons/unlocked.gif" alt="[@{#icon_title_unlocked#}@]" title=" [@{#icon_title_unlocked#}@] " />[@{/if}@]</td>
                      <td class="text-right"><a href="[@{$newsletter.link_filename_newsletters}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
                    </tr>              
                    [@{/if}@]            
                    [@{/foreach}@]
                  </table>
                </div>
              </div>
              <div class="clearfix pagination-wrapper">
                <div class="pull-left">[@{$nav_bar_number}@]</div>
                <div class="pull-right">[@{$nav_bar_result}@]</div>
              </div>
              <a href="[@{$link_filename_newsletters_new}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_new_newsletter#}@] ">[@{#button_text_new_newsletter#}@]</a>             
            </div> 
            <div class="col-xs-4 col-md-3 infobox-wrapper"> 
              [@{$infobox_newsletters}@]         
            </div>              
          </div>
        </section>     
      [@{/if}@]                  
      </div>     
<!-- newsletters_eof -->
[@{/if}@]    