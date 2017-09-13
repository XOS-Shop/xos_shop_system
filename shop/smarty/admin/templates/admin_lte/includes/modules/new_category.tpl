[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.6
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : new_category.tpl
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
<!-- new_category -->
      <div class="content-wrapper">
        <section class="content-header">
          <h1>[@{$text_new_category}@]</h1>
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
            [@{$form_begin}@][@{$hidden_fields}@]            
              <div class="box">
                <div class="box-body">          
                  <div class="form-horizontal">
                    [@{if $category_image}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_edit_categories_image#}@]</b></div>
                      <div class="col-sm-6 col-xs-9">
                        [@{$category_image}@]<br><b>[@{$image_file_name}@]</b>
                        <div class="checkbox">
                          <label>
                            [@{$selection_delete_image}@] [@{#text_delete#}@]
                          </label>
                        </div>                            
                       </div>      
                    </div>                                                                         
                    <div class="form-group clearfix">
                      <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12">
                        [@{$input_upload_image}@]
                      </div>
                    </div>
                    [@{else}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_edit_categories_image#}@]</b></div>
                      <div class="col-lg-7 col-sm-8 col-xs-12">
                        [@{$input_upload_image}@]
                      </div>
                    </div>                                       
                    [@{/if}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_template_for_product_list#}@]</b></div>
                      <div class="col-sm-6 col-xs-12 radio">
                        <span class="radio-wrapper-in-form-horizontal-first">[@{$radio_product_list_b_0}@]</span>[@{#text_default_template#}@]<span class="radio-wrapper-in-form-horizontal-not-first">[@{$radio_product_list_b_1}@]</span>[@{#text_alternate_template#}@]
                      </div>
                    </div>                                        
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_edit_sort_order#}@]</b></div>
                      <div class="col-md-2 col-sm-3 col-xs-4">
                        [@{$input_sort_order|replace:'<input':'<input class="form-control"'}@]
                      </div>
                    </div>                                                            
                    [@{if $update}@]                    
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_edit_status#}@]</b></div> 
                      <div class="col-sm-6 col-xs-12 radio">                
                        <span class="radio-wrapper-in-form-horizontal-first">[@{$radio_status_1}@]</span>[@{#text_status_active#}@]<span class="radio-wrapper-in-form-horizontal-not-first">[@{$radio_status_0}@]</span>[@{#text_status_inactive#}@]
                      </div>
                    </div>  
                    [@{/if}@]                    
                    [@{foreach name=name item=category_data from=$categories_data}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap">[@{if $smarty.foreach.name.first}@]<b>[@{#text_edit_categories_name#}@]</b>[@{/if}@]</div>
                      <div class="col-sm-6 col-xs-9 text-nowrap">
                        <div class="input-group">
                          <span class="input-group-addon">[@{$category_data.languages_image}@]</span>[@{$category_data.input_name|replace:'<input':'<input class="form-control"'}@]
                        </div>    
                      </div>      
                    </div>        
                    [@{/foreach}@]                                                        
                    [@{foreach name=heading_title item=category_data from=$categories_data}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap">[@{if $smarty.foreach.heading_title.first}@]<b>[@{#text_edit_categories_heading_title#}@]</b>[@{/if}@]</div>
                      <div class="col-lg-7 col-sm-8 col-xs-12 text-nowrap">
                        <div class="input-group">
                          <span class="input-group-addon">[@{$category_data.languages_image}@]</span>[@{$category_data.input_heading_title|replace:'<input':'<input class="form-control"'}@]
                        </div>    
                      </div>      
                    </div>        
                    [@{/foreach}@] 
                    [@{if $wysiwyg}@]
                    [@{foreach name=category item=category_data from=$categories_data}@]
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{if $smarty.foreach.category.first}@][@{#text_edit_categories_description#}@][@{/if}@]</b><br>[@{$category_data.languages_image|replace:'<img':'<img class="form-lng-flag"'}@]</div>
                      <div class="col-sm-8 col-md-9 col-xs-12">
                        [@{$category_data.category_textarea|replace:'<textarea':'<textarea class="form-control"'}@]
                      </div>
<script>
  CKEDITOR.replace( '[@{$category_data.category_description}@]',
    {
      baseHref: '[@{$category_base_href}@]',
      filebrowserBrowseUrl: '[@{$link_filename_popup_file_manager_link_selection}@]',
      filebrowserImageBrowseUrl: '[@{$link_filename_popup_file_manager_image}@]',
      filebrowserFlashBrowseUrl: '[@{$link_filename_popup_file_manager_flash}@]',
      customConfig: '[@{$category_config}@]',
      language: '[@{$lang_code}@]',
      templates_files: [ '[@{$category_data.category_template_file}@]' ],
      templates: '[@{$category_data.category_template_lang}@]'     
    });
</script>                       
                    </div>               
                    [@{/foreach}@]
                    [@{else}@] 
                    [@{foreach name=category item=category_data from=$categories_data}@]              
                    <div class="form-group clearfix">
                      <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{if $smarty.foreach.category.first}@][@{#text_edit_categories_description#}@][@{/if}@]</b><br>[@{$category_data.languages_image|replace:'<img':'<img class="form-lng-flag"'}@]</div>
                      <div class="col-sm-8 col-md-9 col-xs-12">
                        [@{$category_data.category_textarea|replace:'<textarea':'<textarea class="form-control"'}@]
                      </div>
                    </div>                                       
                    [@{/foreach}@]                             
                    [@{/if}@]                                                                                       
                  </div> 
                </div>
              </div>            
              <a href="[@{$link_filename_categories}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a> 
              [@{if $update}@]
              <a href="" onclick="if(update_category.onsubmit())update_category.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_update#}@] ">[@{#button_text_update#}@]</a>
              [@{else}@]
              <a href="" onclick="if(insert_category.onsubmit())insert_category.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_insert#}@] ">[@{#button_text_insert#}@]</a>
              [@{/if}@]      
            [@{$form_end}@]        
            </div>            
          </div>
        </section>
      </div>
[@{*      
    <td width="100%" valign="top">
    [@{$form_begin}@][@{$hidden_fields}@]    
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{$text_new_category}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>                            
        </table></td>
      </tr>
      <tr>
        <td> 
        <table border="0" width="100%" cellspacing="0" cellpadding="2">                 
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left">&nbsp;</td> 
          </tr>                        
          <tr class="dataTableRow">
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
          </tr>
          <tr class="dataTableRow">
            <td><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" valign="top">[@{#text_edit_categories_image#}@]<br />[@{if $category_image}@][@{#text_delete#}@][@{$selection_delete_image}@][@{/if}@]</td>
                <td class="main">[@{if $category_image}@][@{$category_image}@]<br /><b>[@{$image_file_name}@]</b><br /><br />[@{/if}@][@{$input_upload_image}@]</td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">[@{#text_template_for_product_list#}@]</td>
                <td class="main">&nbsp;[@{$radio_product_list_b_0}@][@{#text_default_template#}@]&nbsp;&nbsp;&nbsp;[@{$radio_product_list_b_1}@][@{#text_alternate_template#}@]</td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>                 
              <tr>
                <td class="main">[@{#text_edit_sort_order#}@]</td>
                <td class="main">[@{$input_sort_order}@]</td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>         
              [@{if $update}@]                    
              <tr>
                <td class="main">[@{#text_edit_status#}@]</td>
                <td class="main">&nbsp;[@{$radio_status_1}@][@{#text_status_active#}@]&nbsp;&nbsp;&nbsp;[@{$radio_status_0}@][@{#text_status_inactive#}@]</td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              [@{/if}@]          
              [@{foreach name=name item=category_data from=$categories_data}@]
              <tr>
                <td class="main">[@{if $smarty.foreach.name.first}@][@{#text_edit_categories_name#}@][@{/if}@]</td>
                <td class="main">[@{$category_data.languages_image}@]&nbsp;[@{$category_data.input_name}@]</td>
              </tr>
              [@{/foreach}@]
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              [@{foreach name=heading_title item=category_data from=$categories_data}@]
              <tr>
                <td class="main">[@{if $smarty.foreach.heading_title.first}@][@{#text_edit_categories_heading_title#}@][@{/if}@]</td>
                <td class="main">[@{$category_data.languages_image}@]&nbsp;[@{$category_data.input_heading_title}@]</td>
              </tr>
              [@{/foreach}@]
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              [@{if $wysiwyg}@]
              [@{foreach name=category item=category_data from=$categories_data}@]
              <tr>              
                <td class="main" valign="top">[@{if $smarty.foreach.category.first}@][@{#text_edit_categories_description#}@][@{/if}@]</td>
                <td><table border="0" cellspacing="0" cellpadding="0">         
                  <tr>
                    <td class="main" valign="top">[@{$category_data.languages_image}@]&nbsp;</td>
                    <td class="main">[@{$category_data.category_textarea}@]
<script type="text/javascript">
/* <![CDATA[ */
  CKEDITOR.replace( '[@{$category_data.category_description}@]',
    {
      baseHref: '[@{$category_base_href}@]',
      filebrowserBrowseUrl: '[@{$link_filename_popup_file_manager_link_selection}@]',
      filebrowserImageBrowseUrl: '[@{$link_filename_popup_file_manager_image}@]',
      filebrowserFlashBrowseUrl: '[@{$link_filename_popup_file_manager_flash}@]',
      customConfig: '[@{$category_config}@]',
      language: '[@{$lang_code}@]',
      templates_files: [ '[@{$category_data.category_template_file}@]' ],
      templates: '[@{$category_data.category_template_lang}@]'     
    });
/* ]]> */
</script>                      
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
                  </tr>               
                </table></td>             
              </tr>
              [@{/foreach}@]
              [@{else}@] 
              [@{foreach name=category item=category_data from=$categories_data}@]
              <tr>              
                <td class="main" valign="top">[@{if $smarty.foreach.category.first}@][@{#text_edit_categories_description#}@][@{/if}@]</td>
                <td><table border="0" cellspacing="0" cellpadding="0">         
                  <tr>
                    <td class="main" valign="top">[@{$category_data.languages_image}@]&nbsp;</td>
                    <td class="main">[@{$category_data.category_textarea}@]</td>
                  </tr>
                  <tr>
                    <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
                  </tr>               
                </table></td>             
              </tr>
              [@{/foreach}@]                             
              [@{/if}@]         
            </table></td>
          </tr>                     
        </table></td>
      </tr>               
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
      </tr>
      <tr>
        <td nowrap="nowrap" class="main" align="right">
        <a href="[@{$link_filename_categories}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a> 
        [@{if $update}@]
        <a href="" onclick="if(update_category.onsubmit())update_category.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_update#}@] "><span>[@{#button_text_update#}@]</span></a>
        [@{else}@]
        <a href="" onclick="if(insert_category.onsubmit())insert_category.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_insert#}@] "><span>[@{#button_text_insert#}@]</span></a>
        [@{/if}@]      
        </td> 
      </tr>
    </table>[@{$form_end}@]  
    </td>
*}@]    
<!-- new_category_eof -->