[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.4
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : banner_manager.tpl
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
<!-- banner_manager -->    
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
  [@{if $new_banner}@]         
          <div class="row">
            <div class="col-xs-12">           
            [@{$form_begin}@][@{$hidden_field_banners_id}@][@{$hidden_field_current_date_scheduled}@]                     
              <div class="box">
                <div class="box-body">          
                  <div class="form-horizontal">                                  
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_banners_group#}@]</b></div>
                      <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                        [@{$pull_down_banners_group|replace:'<select':'<select class="form-control"'}@]
                      </div>
                    </div> 
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b></b></div>
                      <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 text-nowrap">
                        [@{#text_banners_new_group#}@]
                        [@{$input_new_banners_group|replace:'<input':'<input class="form-control"'}@]
                        <br>
                      </div>
                    </div>                                        
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_banners_scheduled_at#}@]</b></div>
                      <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                        [@{$input_date_scheduled|replace:'<input':'<input class="form-control"'}@]
                      </div>
                    </div>
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 "></div>
                      <div class="col-lg-7 col-sm-8 col-xs-9">[@{#text_banners_schedule_note#}@]</div>        
                    </div>                                         
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_banners_expires_on#}@]</b></div>
                      <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                        [@{$input_expires_date|replace:'<input':'<input class="form-control"'}@]
                      </div>
                    </div>
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b></b></div>
                      <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 text-nowrap">
                        [@{#text_banners_or_at#}@]&nbsp;[@{#text_banners_impressions#}@]
                        [@{$input_expires_impressions|replace:'<input':'<input class="form-control"'}@]                                                                    
                      </div>
                    </div>
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 "></div>
                      <div class="col-lg-7 col-sm-8 col-xs-9">[@{#text_banners_expircy_note#}@]</div>        
                    </div>                                                                           
                    [@{foreach name=banners_title item=banner_content from=$banners_content}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap">[@{if $smarty.foreach.banners_title.first}@]<b>[@{#text_banners_title#}@]</b>[@{/if}@]</div>
                      <div class="col-sm-6 col-xs-9 text-nowrap">
                        <div class="input-group">
                          <span class="input-group-addon">[@{$banner_content.languages_image}@]</span>[@{$banner_content.input_banners_title|replace:'<input':'<input class="form-control"'}@]
                        </div>    
                      </div>      
                    </div>        
                    [@{/foreach}@]                                                        
                    [@{foreach name=banners_url item=banner_content from=$banners_content}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap">[@{if $smarty.foreach.banners_url.first}@]<b>[@{#text_banners_url#}@]</b>[@{/if}@]</div>
                      <div class="col-lg-7 col-sm-8 col-xs-12 text-nowrap">
                        <div class="input-group">
                          <span class="input-group-addon">[@{$banner_content.languages_image}@]</span>[@{$banner_content.input_banners_url|replace:'<input':'<input class="form-control"'}@]
                        </div>    
                      </div>      
                    </div>        
                    [@{/foreach}@]
                    [@{foreach name=banners_image item=banner_content from=$banners_content}@]
                    [@{if $smarty.foreach.banners_image.first}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_banners_image#}@]</b></div>
                      <div class="col-lg-7 col-sm-8 col-xs-12"></div>        
                    </div>                    
                    [@{/if}@]              
                    <div class="form-group clearfix">
                    [@{if $banner_content.current_banners_image}@]
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap">[@{$banner_content.languages_image|replace:'<img':'<img style="margin: -15px 0 0 12px"'}@]</div>
                      <div class="col-sm-6 col-xs-9 text-nowrap">
                        <a href="javascript:popupImageWindow('[@{$banner_content.link_popup_image}@]')" title=" [@{#icon_title_view_banner#}@] "><i class="fa fa-fw fa-external-link"></i>&nbsp;<b>[@{$banner_content.current_banners_image}@]</b></a>
                        <div class="checkbox">
                          <label>
                            [@{$banner_content.selection_field_delete_banners_image}@] [@{#text_banners_image_delete#}@]
                          </label>
                        </div>                            
                      </div>      
                      <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-10 col-md-9 col-sm-8 col-xs-12">
                        [@{#text_banners_image_new#}@]
                        [@{$banner_content.hidden_field_current_banners_image}@][@{$banner_content.input_banners_image}@]
                      </div>                           
                    </div>                                                                           
                      [@{else}@]
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap">[@{$banner_content.languages_image|replace:'<img':'<img style="margin: -12px 0 0 12px"'}@]</div>                      
                      <div class="col-sm-8 col-md-9 col-xs-12">
                        [@{$banner_content.hidden_field_current_banners_image}@][@{$banner_content.input_banners_image}@]
                      </div>                                            
                    </div>
                    [@{/if}@]                                       
                    [@{/foreach}@]                                                                                                  
                    [@{if $wysiwyg}@]
                    [@{foreach name=banners_html_text item=banner_content from=$banners_content}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{if $smarty.foreach.banners_html_text.first}@][@{#text_banners_html_text#}@][@{/if}@]</b><br>[@{$banner_content.languages_image|replace:'<img':'<img class="form-lng-flag"'}@]</div>
                      <div class="col-sm-8 col-md-9 col-xs-12">
                        [@{$banner_content.textarea_banners_html_text|replace:'<textarea':'<textarea class="form-control"'}@]
                      </div>
<script>
  CKEDITOR.replace( '[@{$banner_content.banners_html_text_name}@]',
    { 
      baseHref: '[@{$banner_manager_base_href}@]',
      filebrowserBrowseUrl: '[@{$link_filename_popup_file_manager_link_selection}@]',
      filebrowserImageBrowseUrl: '[@{$link_filename_popup_file_manager_image}@]',
      filebrowserFlashBrowseUrl: '[@{$link_filename_popup_file_manager_flash}@]',
      customConfig: '[@{$banner_manager_config}@]',
      language: '[@{$lang_code}@]',
      templates_files: [ '[@{$banner_content.banner_manager_template_file}@]' ],
      templates: '[@{$banner_content.banner_manager_template_lang}@]'     
    });
</script>                                              
                    </div>               
                    [@{/foreach}@]
                    [@{else}@] 
                    [@{foreach name=banners_html_text item=banner_content from=$banners_content}@]              
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{if $smarty.foreach.banners_html_text.first}@][@{#text_banners_html_text#}@][@{/if}@]</b><br>[@{$banner_content.languages_image|replace:'<img':'<img class="form-lng-flag"'}@]</div>
                      <div class="col-sm-8 col-md-9 col-xs-12">
                        [@{$banner_content.textarea_banners_html_text|replace:'<textarea':'<textarea class="form-control"'}@]
                      </div>
                    </div>                                       
                    [@{/foreach}@]                             
                    [@{/if}@]                                                                                                                  
                    [@{foreach name=php_source item=banner_content from=$banners_content}@]
                    [@{if $php_code_included}@] 
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap">[@{if $smarty.foreach.php_source.first}@]<a class="btn btn-danger textarea-unlock" title=" [@{#button_title_unlock#}@] ">[@{#button_text_unlock#}@]</a><a class="btn btn-success textarea-lock" style="display: none;" title=" [@{#button_title_lock#}@] ">[@{#button_text_lock#}@]</a><br><b>[@{#text_embedded_php_code#}@]</b>[@{/if}@]<br>[@{$banner_content.languages_image|replace:'<img':'<img class="form-lng-flag"'}@]</div>
                      <div class="col-sm-8 col-md-9 col-xs-12">
                        [@{$banner_content.textarea_banners_php_source|replace:'class="':'class="form-control '}@]
                      </div>
                    </div>                  
                    [@{else}@]               
                    [@{if $smarty.foreach.php_source.first}@]  
                      <div class="text-embed-php-code-wrapper"><b>[@{#text_embed_php_code#}@]</b>&nbsp;<img id="icon_arrow_down" class="icon-arrow-down" src="[@{$images_path}@]icon_arrow_down.gif" height="15" width="24" title=" [@{#text_embed_php_code#}@] " alt="[@{#text_embed_php_code#}@]" /></div>               
                    [@{/if}@]               
                    <div class="textareas_php_code form-group clearfix" style="display: none;">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap">[@{if $smarty.foreach.php_source.first}@]<a class="btn btn-danger textarea-unlock" title=" [@{#button_title_unlock#}@] ">[@{#button_text_unlock#}@]</a><a class="btn btn-success textarea-lock" style="display: none;" title=" [@{#button_title_lock#}@] ">[@{#button_text_lock#}@]</a><br><b>[@{#text_embedded_php_code#}@]</b>[@{/if}@]<br>[@{$banner_content.languages_image|replace:'<img':'<img class="form-lng-flag"'}@]</div>
                      <div class="col-sm-8 col-md-9 col-xs-12">
                        [@{$banner_content.textarea_banners_php_source|replace:'class="':'class="form-control '}@]
                      </div>
                    </div>                         
                    [@{/if}@]              
                    [@{/foreach}@]                  
                  </div>                                                   
<script>
$("#icon_arrow_down").click(function() {
  $(".textareas_php_code").toggle();
});
$(".textarea-unlock").click(function() {
  $(".textarea-php-code").attr("readonly", false);
  $(".textarea-unlock").css("display", "none");
  $(".textarea-lock").css("display", "");
});
$(".textarea-lock").click(function() {
  $(".textarea-php-code").attr("readonly", true);
  $(".textarea-unlock").css("display", "");
  $(".textarea-lock").css("display", "none");  
});
</script>                          
                </div>
              </div>         
              <a href="[@{$link_filename_banner_manager}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a>
              [@{if $form_action_insert}@]
              <a href="" onclick="if(new_banner.onsubmit())new_banner.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_save#}@] ">[@{#button_text_save#}@]</a>
              [@{else}@]
              <a href="" onclick="if(new_banner.onsubmit())new_banner.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_update#}@] ">[@{#button_text_update#}@]</a>
              [@{/if}@]                                
            [@{$form_end}@]        
            </div>            
          </div>                 
  [@{else}@]  
          <div class="row">
            <div class="col-xs-8 col-md-9 data-table-wrapper">
              <div class="box">
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">                 
                    <tr class="data-table-heading-row">
                      <th>[@{#table_heading_banners#}@]</th>
                      <th>[@{#table_heading_groups#}@]</th>
                      <th class="text-center">[@{#table_heading_statistics#}@]</th>
                      <th class="text-center">[@{#table_heading_status#}@]</th>
                      <th class="text-right">[@{#table_heading_action#}@]</th>
                    </tr>
                    [@{foreach item=banner from=$banners}@]
                    [@{if $banner.selected}@]                                                                                       
                    <tr class="data-table-rows-elected" onclick="document.location.href='[@{$banner.link_filename_banner_statistics}@]'">
                      <td>[@{$banner.title}@]</td>
                      <td>[@{$banner.group}@]</td>
                      <td class="text-center">[@{$banner.shown}@]&nbsp;/&nbsp;[@{$banner.clicked}@]</td>
                      <td class="text-center">
                      [@{if $banner.status}@]                
                        [@{$banner.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$banner.link_filename_banner_manager_action_setflag_0}@]">[@{$banner.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$banner.link_filename_banner_manager_action_setflag_1}@]">[@{$banner.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$banner.icon_status_red}@]
                      [@{/if}@]                      
                      </td>                      
                      <td class="text-right"><a href="[@{$banner.link_filename_banner_statistics_icon}@]"><i class="fa fa-fw fa-area-chart" title=" [@{#icon_title_statistics#}@] "></i></a>&nbsp;<i class="fa fa-fw fa-arrow-right"></i></td>                   
                    </tr> 
                    [@{else}@]
                    <tr class="data-table-row" onclick="document.location.href='[@{$banner.link_filename_banner_manager}@]'">
                      <td>[@{$banner.title}@]</td>
                      <td>[@{$banner.group}@]</td>
                      <td class="text-center">[@{$banner.shown}@]&nbsp;/&nbsp;[@{$banner.clicked}@]</td>
                      <td class="text-center">
                      [@{if $banner.status}@]                
                        [@{$banner.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$banner.link_filename_banner_manager_action_setflag_0}@]">[@{$banner.icon_status_red_light}@]</a>
                      [@{else}@]
                        <a href="[@{$banner.link_filename_banner_manager_action_setflag_1}@]">[@{$banner.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$banner.icon_status_red}@]
                      [@{/if}@]                   
                      </td> 
                      <td class="text-right"><a href="[@{$banner.link_filename_banner_statistics_icon}@]"><i class="fa fa-fw fa-area-chart" title=" [@{#icon_title_statistics#}@] "></i></a>&nbsp;<a href="[@{$banner.link_filename_banner_manager}@]"><i class="fa fa-fw fa-info-circle" title=" [@{#icon_title_info#}@] "></i></a></td>
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
              <a href="[@{$link_filename_banner_manager}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_new_banner#}@] ">[@{#button_text_new_banner#}@]</a>                           
            </div> 
            <div class="col-xs-4 col-md-3 infobox-wrapper"> 
              [@{$infobox_banner_manager}@]         
            </div>              
          </div>
  [@{/if}@]
        </section>        
      </div>    
<!-- banner_manager_eof -->