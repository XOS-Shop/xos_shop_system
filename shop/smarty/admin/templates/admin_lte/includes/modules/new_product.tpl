[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.9
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : new_product.tpl
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
<!-- new_product -->
      <div class="content-wrapper">
        <section class="content-header">
          <h1>[@{$text_new_product}@]</h1>
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
[@{$javascript}@]                  
          <div class="row">          
            <div class="col-xs-12">
            [@{$form_begin}@]
              <div class="box">
                <div class="box-body">                                            
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-horizontal">                      
                        <div class="form-group clearfix">
                          <div class="col-lg-4 col-md-6 col-sm-4 control-label"><b>[@{#text_products_status#}@]</b></div>
                          <div class="col-lg-8 col-md-6 col-sm-8 col-xs-12 radio">
                            <span class="radio-wrapper-in-form-horizontal-first">[@{$radio_products_status_1}@]</span>[@{#text_status_active#}@]<span class="radio-wrapper-in-form-horizontal-not-first">[@{$radio_products_status_0}@]</span>[@{#text_status_inactive#}@]
                          </div>
                        </div>                    
                        <div class="form-group clearfix">
                          <div class="col-lg-4 col-md-6 col-sm-4 control-label"><b>[@{#text_products_date_available#}@]</b></div>
                          <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                            [@{$input_products_date_available|replace:'<input':'<input class="form-control"'}@]
                          </div>
                        </div>                         
                        <div class="form-group clearfix">
                          <div class="col-lg-4 col-md-6 col-sm-4 control-label"><b>[@{#text_products_model#}@]</b></div>
                          <div class="col-lg-5 col-md-6 col-sm-5 col-xs-12">
                            [@{$input_products_model|replace:'<input':'<input class="form-control"'}@]
                          </div>
                        </div>                         
                        <div class="form-group clearfix">
                          <div class="col-lg-4 col-md-6 col-sm-4 control-label"><b>[@{#text_products_manufacturer#}@]</b></div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            [@{$pull_down_manufacturers|replace:'<select':'<select class="form-control"'}@]
                          </div>
                        </div>                                                
                        <div class="form-group clearfix">
                          <div class="col-lg-4 col-md-6 col-sm-4 control-label"><b>[@{#text_products_tax_class#}@]</b></div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            [@{$pull_down_products_tax_class|replace:'<select':'<select class="form-control"'}@]
                          </div>
                        </div>                                                                                                                                                                                                                             
                      </div>                                       
                    </div>
                    <div class="col-md-6">                                           
                      <div class="form-horizontal">                                          
                        <div class="form-group clearfix">
                          <div class="col-lg-4 col-md-5 col-sm-4 control-label"><b>[@{#text_products_delivery_time#}@]</b></div>
                          <div class="col-lg-5 col-md-7 col-sm-5 col-xs-12">
                            [@{$pull_down_delivery_times|replace:'<select':'<select class="form-control"'}@]
                          </div>
                        </div>                     
                        <div class="form-group clearfix">
                          <div class="col-lg-4 col-md-5 col-sm-4 control-label"><b>[@{#text_products_quantity#}@]</b></div>
                          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            [@{if $has_attributes_quantities}@]
                            <div style="width:1px; position:relative; left:60px; top:25px;">                   
                              <div id="loading_list" style="z-index: 999; display:none; position:absolute; right:0px; top:0px; background-color:#ffffcc; padding-left:35px; padding-top:15px; padding-right:35px; padding-bottom:15px; border: 1px solid #d2d6de;">                                              
                                <table> 
                                  <tr>
                                    <td class="text-nowrap"><b>[@{#text_loading#}@]</b></td>                         
                                  </tr>                                                                                                                      
                                </table>
                              </div>                                                   
                              <div id="box_id_attribute_qty" style="z-index: 999; display:none; position:absolute; right:0px; top:0px; background-color:#ffffcc; padding-left:12px; padding-top:12px; padding-right:12px; padding-bottom:12px; border: 1px solid #d2d6de;">
                              </div>                
                            </div>                
                            [@{/if}@]                                             
                            [@{$input_products_quantity|replace:'<input':'<input class="form-control"'}@]                         
                          </div>
                        </div>                         
                        <div class="form-group clearfix">
                          <div class="col-lg-4 col-md-5 col-sm-4 control-label"><b>[@{#text_products_weight#}@]</b></div>
                          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            [@{$input_products_weight|replace:'<input':'<input class="form-control"'}@]
                          </div>
                        </div>                         
                        <div class="form-group clearfix">
                          <div class="col-lg-4 col-md-5 col-sm-4 control-label"><b>[@{#text_products_sort_order#}@]</b></div>
                          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            [@{$input_products_sort_order|replace:'<input':'<input class="form-control"'}@]
                          </div>
                        </div>                                                                                                            
                      </div>                                                             
                    </div>
                  </div>                  
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="form-horizontal">                                     
                        <div class="form-group clearfix">
                          <div class="col-lg-2 col-md-3 col-sm-4 control-label"><b>[@{#text_products_prices#}@]</b></div>
                          <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12">                          
                            <div class="box" style="margin-bottom: 0; border: 1px solid #d2d6de; border-radius: 0; box-shadow: none;">
                              <div class="box-body table-responsive">                                                    
                                [@{$hidden_price_array}@]                  
                                <table>                              
                                  [@{foreach name=outer item=customer_group from=$customers_groups}@]
                                  [@{if $smarty.foreach.outer.first}@]                                                               
                                  <tr>
                                    <td>[@{#text_products_tax_rates#}@]<br>[@{$pull_down_tax_rates|replace:'<select':'<select class="form-control" style="width: 300px;"'}@]<br></td>
                                  </tr>
                                  <tr>
                                    <td><p><small><i>[@{#text_note#}@]</i></small></p></td>
                                  </tr>                                                 
                                  [@{if $message_price_error}@]              
                                  <tr>
                                    <td><p><b>[@{$message_price_error}@]</b></p></td>
                                  </tr>                                  
                                  [@{/if}@]                           
                                  <tr>
                                    <td><img src="[@{$images_path}@]pixel_black.gif" alt="" style="width: 100%; height: 1px" /></td>
                                  </tr>                        
                                  [@{/if}@]
                                  <tr>
                                    <td style="padding-left: 2px;">[@{if $customer_group.input_checkbox}@][@{$customer_group.input_checkbox}@][@{else}@]<img src="[@{$images_path}@]checkbox_dummy.gif" alt="" />[@{/if}@]&nbsp;<b>[@{$customer_group.name}@]</b></td>
                                  </tr>                                       
                                  <tr>
                                    <td style="padding-left: 20px;"><table class="price-table" id="box_[@{$customer_group.id}@]">
                                      <tr>                  
                                        <td style="position: relative;">[@{if $customer_group.display}@]<a href="" onclick="toggle('[@{$customer_group.toggle_name}@]');return false"><img style="position: absolute; left: -20px;" onmouseover="this.style.cursor='pointer'" src="[@{$images_path}@]icon_arrow_down.gif" alt="" /></a>[@{/if}@][@{#text_products_price_net#}@]</td>
                                        <td>[@{#text_products_price_gross#}@]</td>
                                        <td style="color: red;">[@{#text_specials#}@]</td>
                                        <td style="color : red;">[@{#text_specials_scheduled_date#}@]</td>
                                      </tr>                        
                                      <tr>
                                        <td style="vertical-align: top;">[@{$customer_group.input_price|replace:'<input':'<input class="form-control input-sm input-price"'}@][@{$customer_group.input_special_price|replace:'<input':'<input class="form-control input-sm input-price"'}@]</td>
                                        <td style="vertical-align: top;">[@{$customer_group.input_price_gross|replace:'<input':'<input class="form-control input-sm input-price"'}@][@{$customer_group.input_special_price_gross|replace:'<input':'<input class="form-control input-sm input-price"'}@]</td>
                                        <td style="vertical-align: top; padding-top: 5px" class="text-center"><span style="background: green; margin: 5px; padding: 5px;">[@{$customer_group.radio_special_status_1}@]</span><span style="background: red; margin: 5px; padding: 5px;">[@{$customer_group.radio_special_status_0}@]</span></td>
                                        <td rowspan="2" style="vertical-align: top;">[@{$customer_group.input_special_date_scheduled|replace:'<input':'<input class="form-control input-sm input-price"'}@]<br><span style="color : red;">[@{#text_specials_expires_date#}@]</span><br>[@{$customer_group.input_special_expires_date|replace:'<input':'<input class="form-control input-sm input-price"'}@]</td>
                                      </tr>                           
                                      <tr id="[@{$customer_group.toggle_name}@]" style="[@{$customer_group.display}@]">
                                        <td colspan="3"><table class="price-table">
                                          [@{foreach name=inner item=price_break from=$customer_group.price_breaks}@]
                                          [@{if $smarty.foreach.inner.first}@]                                           
                                          <tr>
                                            <td>[@{#text_products_price_breaks_quantity#}@]</td>
                                            <td>[@{#text_products_price_breaks_net#}@]</td>
                                            <td>[@{#text_products_price_breaks_gross#}@]</td>
                                          </tr>
                                          [@{/if}@]                         
                                          <tr>
                                            <td>[@{$price_break.input_quantity|replace:'<input':'<input class="form-control input-sm price-break-input-quantity"'}@]</td>
                                            <td>[@{$price_break.input_price_break|replace:'<input':'<input class="form-control input-sm input-price"'}@][@{$price_break.input_special_price_break|replace:'<input':'<input class="form-control input-sm input-price"'}@]</td>
                                            <td>[@{$price_break.input_price_break_gross|replace:'<input':'<input class="form-control input-sm input-price"'}@][@{$price_break.input_special_price_break_gross|replace:'<input':'<input class="form-control input-sm input-price"'}@]</td>
                                          </tr> 
                                          [@{/foreach}@]                                                           
                                        </table></td>
                                      </tr>               
                                    </table></td>                
                                  </tr>                                                                                  
                                  [@{if !$smarty.foreach.outer.last}@]
                                  <tr>
                                    <td><img src="[@{$images_path}@]pixel_black.gif" alt="" style="width: 100%; height: 1px" /></td>
                                  </tr>                              
                                  [@{/if}@]
                                  [@{/foreach}@]
                                  [@{foreach name=outer1 item=attributes_value from=$attributes_values}@]
                                  [@{if $smarty.foreach.outer1.first}@]
                                  <tr>
                                    <td>[@{$hidden_attributes_price_array}@]<img src="[@{$images_path}@]pixel_black.gif" alt="" style="width: 100%; height: 1px" /></td>
                                  </tr>
                                  <tr>
                                    <td style="padding-left: 20px;"><b>[@{#text_attributes#}@]</b></td>
                                  </tr>               
                                  <tr>
                                    <td style="padding-left: 20px;"><table class="price-table">
                                      <tr>                  
                                        <td>[@{#text_attributes_opt_name#}@]</td>
                                        <td>[@{#text_attributes_opt_value#}@]</td>
                                        <td class="text-center">[@{#text_attributes_opt_price_prefix#}@]</td>
                                        <td>[@{#text_attributes_opt_price_net#}@]</td>
                                        <td>[@{#text_attributes_opt_price_gross#}@]</td>
                                      </tr>
                                  [@{/if}@]                        
                                      <tr>
                                        <td>[@{$attributes_value.option_name}@]</td>
                                        <td>[@{$attributes_value.value_name}@]</td>
                                        <td>[@{$attributes_value.input_price_prefix|replace:'<input':'<input class="form-control input-sm attributes-value-input-price-prefix"'}@]</td>
                                        <td>[@{$attributes_value.input_value_price|replace:'<input':'<input class="form-control input-sm input-price"'}@]</td>
                                        <td>[@{$attributes_value.input_value_price_gross|replace:'<input':'<input class="form-control input-sm input-price"'}@]</td>
                                      </tr>
                                  [@{if $smarty.foreach.outer1.last}@]                                           
                                    </table></td>                
                                  </tr>                                                                      
                                  [@{/if}@]            
                                  [@{/foreach}@]                             
                                </table>                        
<script>
  [@{$update_prices}@]
  [@{$update_checked_string}@]
</script>                                     
                              </div>                            
                            </div>                                
                          </div>      
                        </div>                                     
                     </div>                                                             
                    </div>
                  </div>                                                 
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-horizontal">
                        [@{foreach name=name_url item=product_value from=$product_values}@]
                        <div class="form-group clearfix">
                          <div class="col-lg-4 col-md-3 col-sm-4 control-label">[@{if $smarty.foreach.name_url.first}@]<b>[@{#text_products_name#}@]</b>[@{/if}@]</div>
                          <div class="col-lg-8 col-md-9 col-sm-8 col-xs-12">
                            <div class="input-group">
                              <span class="input-group-addon">[@{$product_value.languages_image}@]</span>[@{$product_value.input_name|replace:'<input':'<input class="form-control"'}@]
                            </div>    
                          </div>      
                        </div>        
                        [@{/foreach}@]                                                                                                     
                      </div>                                       
                    </div>
                    <div class="col-lg-6">                                           
                      <div class="form-horizontal">                       
                        [@{foreach name=name_url item=product_value from=$product_values}@]
                        <div class="form-group clearfix">
                          <div class="col-lg-4 col-md-3 col-sm-4 control-label">[@{if $smarty.foreach.name_url.first}@]<b>[@{#text_products_url#}@]</b>[@{/if}@]</div>
                          <div class="col-lg-8 col-md-9 col-sm-8 col-xs-12">
                            <div class="input-group">
                              <span class="input-group-addon">[@{$product_value.languages_image}@]</span>[@{$product_value.input_url|replace:'<input':'<input class="form-control"'}@]
                            </div>    
                          </div>      
                        </div>        
                        [@{/foreach}@]                                                                 
                      </div>                                                             
                    </div>
                  </div>                                                    
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-horizontal">
                        [@{foreach name=p_unit item=product_value from=$product_values}@]
                        <div class="form-group clearfix">
                          <div class="col-lg-4 col-md-3 col-sm-4 control-label">[@{if $smarty.foreach.p_unit.first}@]<b>[@{#text_products_packing_unit#}@]</b>[@{/if}@]</div>
                          <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                            <div class="input-group">
                              <span class="input-group-addon">[@{$product_value.languages_image}@]</span>[@{$product_value.pull_down_input_p_unit|replace:'<select':'<select class="form-control"'|replace:'style="width: 17em"':''}@]
                            </div>    
                          </div>      
                        </div>        
                        [@{/foreach}@]                                                                                                     
                      </div>                                       
                    </div>
                    <div class="col-lg-6">                                           
                      <div class="form-horizontal">                       
                        [@{foreach name=p_unit item=product_value from=$product_values}@]
                        <div class="form-group clearfix">
                          <div class="col-lg-4 col-md-3 col-sm-4 control-label">[@{if $smarty.foreach.p_unit.first}@]<b>[@{#text_new_products_packing_unit#}@]</b>[@{/if}@]</div>
                          <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                            <div class="input-group">
                              <span class="input-group-addon">[@{$product_value.languages_image}@]</span>[@{$product_value.input_new_p_unit|replace:'<input':'<input class="form-control"'}@]
                            </div>    
                          </div>      
                        </div>        
                        [@{/foreach}@]                                                                 
                      </div>                                                             
                    </div>
                  </div>                                
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="form-horizontal"> 
                        [@{if $wysiwyg}@]
                        [@{foreach key=loop name=info item=product_value from=$product_values}@]
                        <div class="form-group clearfix">
                          <div class="col-lg-2 col-md-3 col-sm-4 control-label"><b>[@{if $smarty.foreach.info.first}@][@{#text_products_info#}@][@{/if}@]</b><br>[@{$product_value.languages_image|replace:'<img':'<img class="form-lng-flag"'}@]</div>
                          <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12">
                            [@{$product_value.textarea_info|replace:'<textarea':'<textarea class="form-control"'}@]
                          </div>
<script>
  CKEDITOR.replace( '[@{$product_value.info_name}@]',
    {
      baseHref: '[@{$product_base_href}@]',
      filebrowserBrowseUrl: '[@{$link_filename_popup_file_manager_link_selection}@]',
      filebrowserImageBrowseUrl: '[@{$link_filename_popup_file_manager_image}@]',
      filebrowserFlashBrowseUrl: '[@{$link_filename_popup_file_manager_flash}@]',
      customConfig: '[@{$product_config}@]',
      toolbar: 'ProductInfoToolbar',
      width: '',
      height: '150',
      uiColor: '#9DFF9D',      
      language: '[@{$lang_code}@]',
      templates_files: [ '[@{$product_value.product_info_template_file}@]' ],
      templates: '[@{$product_value.product_info_template_lang}@]'     
    });
</script>                       
                        </div>               
                        [@{/foreach}@]
                        [@{foreach name=description item=product_value from=$product_values}@] 
                        <div class="form-group clearfix">
                          <div class="col-lg-2 col-md-3 col-sm-4 control-label"><b>[@{if $smarty.foreach.description.first}@][@{#text_products_description#}@][@{/if}@]</b><br>[@{$product_value.languages_image|replace:'<img':'<img class="form-lng-flag"'}@]</div>
                          <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12">
                            <div class="input-group">
                              <span class="input-group-addon">[@{#text_tab_label#}@]</span>[@{$product_value.input_description_tab_label|replace:'<input':'<input class="form-control"'}@]
                            </div>                           
                            [@{$product_value.textarea_description|replace:'<textarea':'<textarea class="form-control"'}@]
                          </div>
<script>
  CKEDITOR.replace( '[@{$product_value.description_name}@]',
    {
      baseHref: '[@{$product_base_href}@]',
      filebrowserBrowseUrl: '[@{$link_filename_popup_file_manager_link_selection}@]',
      filebrowserImageBrowseUrl: '[@{$link_filename_popup_file_manager_image}@]',
      filebrowserFlashBrowseUrl: '[@{$link_filename_popup_file_manager_flash}@]',
      customConfig: '[@{$product_config}@]',
      toolbar: 'ProductDescriptionToolbar',
      width: '',
      height: '300',
      uiColor: '#9AB8F3',            
      language: '[@{$lang_code}@]',
      templates_files: [ '[@{$product_value.product_description_template_file}@]' ],
      templates: '[@{$product_value.product_description_template_lang}@]'     
    });
</script>                       
                        </div>               
                        [@{/foreach}@]                       
                        [@{else}@]
                        [@{foreach key=loop name=info item=product_value from=$product_values}@]
                        <div class="form-group clearfix">
                          <div class="col-lg-2 col-md-3 col-sm-4 control-label"><b>[@{if $smarty.foreach.info.first}@][@{#text_products_info#}@][@{/if}@]</b><br>[@{$product_value.languages_image|replace:'<img':'<img class="form-lng-flag"'}@]</div>
                          <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12">
                            [@{$product_value.textarea_info|replace:'<textarea':'<textarea class="form-control"'}@]
                          </div>                       
                        </div>               
                        [@{/foreach}@]
                        [@{foreach name=description item=product_value from=$product_values}@] 
                        <div class="form-group clearfix">
                          <div class="col-lg-2 col-md-3 col-sm-4 control-label"><b>[@{if $smarty.foreach.description.first}@][@{#text_products_description#}@][@{/if}@]</b><br>[@{$product_value.languages_image|replace:'<img':'<img class="form-lng-flag"'}@]</div>
                          <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12">
                            <div class="input-group">
                              <span class="input-group-addon">[@{#text_tab_label#}@]</span>[@{$product_value.input_description_tab_label|replace:'<input':'<input class="form-control"'}@]
                            </div>                           
                            [@{$product_value.textarea_description|replace:'<textarea':'<textarea class="form-control"'}@]
                          </div>                      
                        </div>               
                        [@{/foreach}@]
                        [@{/if}@]                         
                     </div>                                                             
                    </div>
                  </div>                                                   
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="form-horizontal"> 
                        [@{$hidden_image_array}@]                                   
                        [@{foreach name=image item=product_image from=$product_images}@]
                        [@{if $smarty.foreach.image.first}@]
                        <hr>
                        [@{/if}@]
                        [@{if $product_image.image_name}@]
                        <div class="form-group clearfix">
                          <div class="col-lg-2 col-md-3 col-sm-4 control-label"><b>[@{#text_products_image#}@]&nbsp;[@{$product_image.img_no}@]</b></div>
                          <div class="col-sm-6 col-xs-9 text-nowrap">
                            [@{$product_image.image}@]<br>[@{#text_image_name#}@] <b>[@{$product_image.image_name}@]</b><br>[@{#text_width_size_large#}@] <b>[@{$product_image.large_img_width}@] px</b><br>[@{#text_height_size_large#}@] <b>[@{$product_image.large_img_height}@] px</b><br>[@{if $product_image.large_img_base == 'default_size'}@][@{#text_info#}@] <b>[@{#text_default_values_used#}@]</b>[@{elseif $product_image.large_img_base == 'origin_size'}@][@{#text_info#}@] <b>[@{#text_original_size_used#}@]</b>[@{elseif $product_image.large_img_base == 'self_selected_size'}@][@{#text_info#}@] <b>[@{#text_own_values_used#}@]</b>[@{/if}@]
                            <div class="checkbox">
                              <label>
                                [@{$product_image.hidden_current_image}@][@{$product_image.selection_delete_image}@] [@{#text_delete#}@]
                              </label>
                            </div>                            
                           </div>      
                        </div>                                                                         
                        <div class="form-group clearfix">
                          <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12">
                            [@{#text_replace_image_with#}@]<br>
                            [@{$product_image.file_image}@]
                          </div>
                                                    
                          <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12 radio">
                            <label>
                              [@{$product_image.radio_large_image_default_size}@]
                              [@{#text_default_values#}@]
                            </label>
                          </div>
                          <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12 radio">
                            <label>
                              [@{$product_image.radio_large_image_uploaded_size}@]
                              [@{#text_original_size#}@]
                            </label>
                          </div>
                          <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12 radio">
                            <i>[@{#text_note_image_size#}@]</i><br>
                            <label>
                              [@{$product_image.radio_large_image_input_size}@]
                              [@{#text_own_values#}@]
                            </label>
                          </div>                            
                        </div>                        
                        <div class="form-group clearfix">                        
                          <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12">
                            <div class="input-group">
                              <span class="input-group-addon">[@{#text_max_width#}@]</span>[@{$product_image.input_large_image_max_width|replace:'<input':'<input class="form-control"'|replace:'style="':'style="max-width: 70px; '}@]&nbsp;&nbsp;[@{#text_pixel#}@]
                            </div>
                          </div>
                        </div>   
                        <div class="form-group clearfix">   
                          <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12">
                            <div class="input-group">
                              <span class="input-group-addon">[@{#text_max_height#}@]</span>[@{$product_image.input_large_image_max_height|replace:'<input':'<input class="form-control"'|replace:'style="':'style="max-width: 70px; '}@]&nbsp;&nbsp;[@{#text_pixel#}@] 
                            </div>
                          </div>                                                   
                        </div>                                                
                        <hr> 
                        [@{/if}@]                     
                        [@{/foreach}@]                                              
                      </div>                                                             
                    </div>
                  </div>                                                                                
                  [@{foreach name=image item=product_image from=$product_images}@]
                  [@{if $smarty.foreach.image.first}@]
                  [@{if $more_images}@]               
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="form-horizontal">                       
                        <div class="form-group clearfix">
                          <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12">
                            [@{#text_upload_images#}@]&nbsp;<a href="" onclick="toggle('images');return false"><img onmouseover="this.style.cursor='pointer'" src="[@{$images_path}@]icon_arrow_down.gif" height="15" width="24" title=" [@{#text_upload_images#}@] " alt="[@{#text_upload_images#}@]" /></a>
                          </div>
                        </div>                                              
                      </div>                                                             
                    </div>
                  </div>                                                                                        	                                 
                  [@{/if}@]              
                  <div class="row" id="images" style="display: none">
                    <div class="col-xs-12">
                      <div class="form-horizontal">               
                        <hr>                        
                  [@{/if}@]              
                  [@{if !$product_image.image_name}@]
                        <div class="form-group clearfix">
                          <div class="col-lg-2 col-md-3 col-sm-4 control-label"><b>[@{#text_products_image#}@]&nbsp;[@{$product_image.img_no}@]</b></div>
                          <div class="col-sm-6 col-xs-9">
                          <img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="[@{$product_image.small_product_image_max_height}@]" />
                          </div>      
                        </div>                                                                         
                        <div class="form-group clearfix">
                          <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12">
                            [@{#text_upload_image#}@]<br>
                            [@{$product_image.file_image}@]
                          </div>
                                                    
                          <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12 radio">
                            <label>
                              [@{$product_image.radio_large_image_default_size}@]
                              [@{#text_default_values#}@]
                            </label>
                          </div>
                          <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12 radio">
                            <label>
                              [@{$product_image.radio_large_image_uploaded_size}@]
                              [@{#text_original_size#}@]
                            </label>
                          </div>
                          <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12 radio">
                            <i>[@{#text_note_image_size#}@]</i><br>
                            <label>
                              [@{$product_image.radio_large_image_input_size}@]
                              [@{#text_own_values#}@]
                            </label>
                          </div>                            
                        </div>                        
                        <div class="form-group clearfix">                        
                          <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12">
                            <div class="input-group">
                              <span class="input-group-addon">[@{#text_max_width#}@]</span>[@{$product_image.input_large_image_max_width|replace:'<input':'<input class="form-control"'|replace:'style="':'style="max-width: 70px; '}@]&nbsp;&nbsp;[@{#text_pixel#}@]
                            </div>
                          </div>
                        </div>   
                        <div class="form-group clearfix">   
                          <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-lg-7 col-sm-8 col-xs-12">
                            <div class="input-group">
                              <span class="input-group-addon">[@{#text_max_height#}@]</span>[@{$product_image.input_large_image_max_height|replace:'<input':'<input class="form-control"'|replace:'style="':'style="max-width: 70px; '}@]&nbsp;&nbsp;[@{#text_pixel#}@] 
                            </div>
                          </div>                                                   
                        </div>                                                
                        <hr>              
                  [@{/if}@]                
                  [@{if $smarty.foreach.image.last}@]               
                      </div>                                                             
                    </div>
                  </div>                                                            
                  [@{/if}@]                             
                  [@{/foreach}@]    
                </div>
              </div>     
              <a href="[@{$link_filename_categories}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_cancel#}@] ">[@{#button_text_cancel#}@]</a>
              [@{$hidden_products_date_added}@] 
              [@{if $update}@]
              <a href="" onclick="if(update_product.onsubmit())update_product.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_update#}@] ">[@{#button_text_update#}@]</a>
              [@{else}@]
              <a href="" onclick="if(insert_product.onsubmit())insert_product.submit(); return false" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_insert#}@] ">[@{#button_text_insert#}@]</a>
              [@{/if}@]   
            [@{$form_end}@]  
            </div>            
          </div>
        </section>
      </div>
<!-- new_product_eof -->