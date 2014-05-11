[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
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
    <td width="100%" valign="top">
[@{$javascript}@]

    [@{$form_begin}@]    
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{$text_new_product}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>                            
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">         
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left">&nbsp;</td> 
          </tr>                       
          <tr style="background-color: #ffffcc">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">                
              <tr>             
                <td width="5%"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="176" height="1" /></td>
                <td width="5%"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="250" height="1" /></td>
                <td width="5%"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="176" height="1" /></td>
                <td width="85%"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="1" /></td>
              </tr>        
              <tr>
                <td class="main">[@{#text_products_status#}@]</td>
                <td class="main" colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;<span style="background: green;">[@{$radio_products_status_1}@]</span>&nbsp;[@{#text_product_available#}@]&nbsp;&nbsp;&nbsp;<span style="background: red;">[@{$radio_products_status_0}@]</span>&nbsp;[@{#text_product_not_available#}@]</td>              
              </tr>
              <tr>             
                <td colspan="4"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="1" /></td>
              </tr>         
              <tr>
                <td class="main">[@{#text_products_date_available#}@]</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{$input_products_date_available}@]</td>                
                <td class="main">[@{#text_products_quantity#}@]</td>
                <td class="main">
                  [@{if $has_attributes_quantities}@]
                  <div style="width:1px; position:relative; left:60px; top:20px;">                   
                    <div id="loading_list" style="z-index: 999; display:none; position:absolute; right:0px; top:0px; background-color:yellow; padding-left:35px; padding-top:15px; padding-right:35px; padding-bottom:15px;">                                              
                      <table border="0" cellspacing="1" cellpadding="0"> 
                        <tr>
                          <td nowrap="nowrap" class="smallText"><b>[@{#text_loading#}@]</b></td>                         
                        </tr>                                                                                                                      
                      </table>
                    </div>                                                   
                    <div id="box_id_attribute_qty" style="z-index: 999; display:none; position:absolute; right:0px; top:0px; background-color:yellow; padding-left:4px; padding-top:4px; padding-right:4px; padding-bottom:4px;">
                    </div>                
                  </div>                
                  [@{/if}@] 
                  <span>&nbsp;[@{$input_products_quantity}@]</span>                 
                </td>
              </tr>
              <tr>
                <td colspan="4"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="1" /></td>
              </tr> 
              <tr>
                <td class="main">[@{#text_products_model#}@]</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{$input_products_model}@]</td> 
                <td class="main">[@{#text_products_weight#}@]</td>
                <td class="main">&nbsp;[@{$input_products_weight}@]</td>
              </tr>
              <tr>
                <td colspan="4"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="1" /></td>
              </tr>
              <tr>
                <td class="main">[@{#text_products_manufacturer#}@]</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{$pull_down_manufacturers}@]</td>
                <td class="main">[@{#text_products_sort_order#}@]</td>
                <td class="main">&nbsp;[@{$input_products_sort_order}@]</td>                
              </tr>
              <tr>
                <td colspan="4"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="2" /></td>
              </tr>                    
            </table></td>
          </tr>                          
          <tr class="dataTableRow">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">                   
              [@{foreach name=outer item=customer_group from=$customers_groups}@]
              [@{if $smarty.foreach.outer.first}@]
              <tr>
                <td class="smallText" colspan="5" style="font-style: italic">[@{#text_note#}@]</td>
              </tr> 
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="3" /></td>
              </tr>                                             
              <tr>
                <td class="main">[@{#text_products_tax_class#}@]</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{$pull_down_products_tax_class}@]</td>
              </tr>         
              <tr style="display: none">             
                <td colspan="2">[@{$hidden_price_array}@]</td>
              </tr> 
              <tr>
                <td width="1%"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="176" height="2" /></td>
                <td colspan="4"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="2" /></td>
              </tr>          
              <tr>
                <td class="main" nowrap="nowrap">[@{#text_products_tax_rates#}@]</td>
                <td class="main" colspan="4" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{$pull_down_tax_rates}@]</td>
              </tr>              
              <tr>
                <td colspan="5"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="2" /></td>
              </tr> 
              [@{if $message_price_error}@]
              <tr>
                <td colspan="5">[@{$message_price_error}@]</td>
              </tr>                                  
              [@{/if}@]                           
              <tr>
                <td colspan="5"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>                        
              [@{/if}@]                      
              <tr>
                <td class="main" valign="top" nowrap="nowrap">[@{if $customer_group.input_checkbox}@][@{$customer_group.input_checkbox}@][@{else}@]<img src="[@{$images_path}@]checkbox_dummy.gif" alt="" width="21" height="17" />[@{/if}@]&nbsp;[@{$customer_group.name}@]&nbsp;</td>
                <td colspan="4"><table id="box_[@{$customer_group.id}@]" border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>                  
                    <td class="main" width="5%" nowrap="nowrap">[@{if $customer_group.display}@]<a href="" onclick="toggle('[@{$customer_group.toggle_name}@]');return false"><img onmouseover="this.style.cursor='pointer'" src="[@{$images_path}@]icon_arrow_down.gif" height="15" width="24" alt="" /></a>[@{else}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />[@{/if}@]&nbsp;[@{#text_products_price_net#}@]</td>
                    <td class="main" width="5%" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{#text_products_price_gross#}@]</td>
                    <td class="main" style="color : red;" width="5%" nowrap="nowrap">&nbsp;&nbsp;&nbsp;[@{#text_specials#}@]</td>
                    <td class="main" style="color : red;" width="85%" nowrap="nowrap">&nbsp;&nbsp;&nbsp;[@{#text_specials_expires_date#}@]</td>
                  </tr>                        
                  <tr>
                    <td class="main" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{$customer_group.input_price}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="5" height="15" />[@{$customer_group.input_special_price}@]</td>
                    <td class="main" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{$customer_group.input_price_gross}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="5" height="15" />[@{$customer_group.input_special_price_gross}@]</td>
                    <td class="main" nowrap="nowrap" align="center">&nbsp;&nbsp;&nbsp;<span style="background: green;">[@{$customer_group.radio_special_status_1}@]</span>&nbsp;&nbsp;<span style="background: red;">[@{$customer_group.radio_special_status_0}@]</span>&nbsp;</td>
                    <td class="main" nowrap="nowrap">&nbsp;&nbsp;&nbsp;[@{$customer_group.input_special_expires_date}@]</td>
                  </tr>                           
                  <tr id="[@{$customer_group.toggle_name}@]" style="[@{$customer_group.display}@]">
                    <td colspan="4"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                      [@{foreach name=inner item=price_break from=$customer_group.price_breaks}@]
                      [@{if $smarty.foreach.inner.first}@]                                           
                      <tr>
                        <td class="main" width="2%" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="22" height="15" />&nbsp;[@{#text_products_price_breaks_quantity#}@]</td>
                        <td class="main" width="5%" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="15" />&nbsp;[@{#text_products_price_breaks_net#}@]</td>
                        <td class="main" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{#text_products_price_breaks_gross#}@]</td>
                      </tr>
                      [@{/if}@]                         
                      <tr>
                        <td class="main" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="22" height="15" />&nbsp;[@{$price_break.input_quantity}@]&nbsp;</td>
                        <td class="main" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="15" />&nbsp;[@{$price_break.input_price_break}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="5" height="15" />[@{$price_break.input_special_price_break}@]</td>
                        <td class="main" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{$price_break.input_price_break_gross}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="5" height="15" />[@{$price_break.input_special_price_break_gross}@]</td>
                      </tr> 
                      [@{/foreach}@]                                                           
                    </table></td>
                  </tr>               
                </table></td>                
              </tr>                                         
              <tr>
                <td colspan="5"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="1" /></td>
              </tr>                                          
              [@{if !$smarty.foreach.outer.last}@]
              <tr>
                <td colspan="5"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>                              
              [@{/if}@]
              [@{/foreach}@]              
            </table></td>
          </tr>                    
          <tr style="display: none; background: #ccffcc">
            <td>                         
<script type="text/javascript">
/* <![CDATA[ */
[@{$update_prices}@]
[@{$update_checked_string}@]
/* ]]> */
</script>                    
            </td>
          </tr>          
          <tr style="background-color: #ccffcc">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">          
              <tr>             
                <td width="5%"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="176" height="8" /></td>
                <td width="5%"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="250" height="1" /></td>
                <td width="5%"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="176" height="1" /></td>
                <td width="85%"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="1" /></td>
              </tr>                      
              [@{foreach name=name_url item=product_value from=$product_values}@]          
              <tr>
                <td class="main">[@{if $smarty.foreach.name_url.first}@][@{#text_products_name#}@][@{/if}@]</td>
                <td class="main">[@{$product_value.languages_image}@]&nbsp;[@{$product_value.input_name}@]</td>              
                <td class="main">[@{if $smarty.foreach.name_url.first}@][@{#text_products_url#}@]<br /><small>[@{#text_products_url_without_http#}@]</small>[@{/if}@]</td>
                <td class="main">[@{$product_value.languages_image}@]&nbsp;[@{$product_value.input_url}@]</td>          
              </tr>
              [@{/foreach}@]           
            </table></td>
          </tr>          
          <tr style="background-color: #ccffcc">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">           
              <tr>             
                <td width="5%"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="176" height="10" /></td>
                <td width="95%"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="250" height="1" /></td>
              </tr>                                       
              [@{foreach name=p_unit item=product_value from=$product_values}@]              
              <tr>
                <td class="main">[@{if $smarty.foreach.p_unit.first}@][@{#text_products_packing_unit#}@][@{/if}@]</td>
                <td class="main">[@{$product_value.languages_image}@]&nbsp;[@{$product_value.pull_down_input_p_unit}@]&nbsp;&nbsp;[@{if $smarty.foreach.p_unit.first}@][@{#text_new_products_packing_unit#}@][@{else}@]<font style="color: #ccffcc;">[@{#text_new_products_packing_unit#}@]</font>[@{/if}@]&nbsp;&nbsp;[@{$product_value.input_new_p_unit}@]</td>
              </tr>  
              [@{/foreach}@]          
            </table></td>
          </tr>                     
          <tr style="background-color: #ccffcc">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2"> 
              <tr>             
                <td width="5%"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="176" height="10" /></td>
                <td width="95%"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="250" height="1" /></td>
              </tr>                                                                    
              [@{if $wysiwyg}@]
              [@{foreach key=loop name=info item=product_value from=$product_values}@]
              <tr>
                <td class="main" valign="top">[@{if $smarty.foreach.info.first}@][@{#text_products_info#}@][@{/if}@]</td>
                <td><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="main" valign="top">[@{$product_value.languages_image}@]&nbsp;</td>
                    <td class="main">[@{$product_value.textarea_info}@]
<script type="text/javascript">
/* <![CDATA[ */
  CKEDITOR.replace( '[@{$product_value.info_name}@]',
    {
      filebrowserBrowseUrl: '[@{$link_filename_popup_file_manager_link_selection}@]',
      filebrowserImageBrowseUrl: '[@{$link_filename_popup_file_manager_image}@]',
      filebrowserFlashBrowseUrl: '[@{$link_filename_popup_file_manager_flash}@]',
      customConfig: '[@{$product_config}@]',
      toolbar: 'ProductInfoToolbar',
      width: '700',
      height: '70',
      uiColor: '#9DFF9D',      
      language: '[@{$lang_code}@]',
      templates_files: [ '[@{$product_value.product_info_template_file}@]' ],
      templates: '[@{$product_value.product_info_template_lang}@]'     
    });
/* ]]> */
</script>                      
                    </td>
                  </tr>
                </table></td>
              </tr>
              [@{/foreach}@]
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>          
              [@{foreach name=description item=product_value from=$product_values}@]          
              <tr>
                <td class="main" valign="top">[@{if $smarty.foreach.description.first}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /><br />[@{#text_products_description#}@][@{/if}@]</td>
                <td><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
                  </tr>                                                
                  <tr>
                    <td class="main" valign="top">[@{$product_value.languages_image}@]&nbsp;</td>
                    <td class="main">[@{#text_tab_label#}@]<br />[@{$product_value.input_description_tab_label}@]</td>
                  </tr>                   
                  <tr>
                    <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="2" /></td>
                  </tr>                                                
                  <tr>
                    <td class="main" valign="top">&nbsp;</td>
                    <td class="main">[@{$product_value.textarea_description}@]
<script type="text/javascript">
/* <![CDATA[ */
  CKEDITOR.replace( '[@{$product_value.description_name}@]',
    {
      filebrowserBrowseUrl: '[@{$link_filename_popup_file_manager_link_selection}@]',
      filebrowserImageBrowseUrl: '[@{$link_filename_popup_file_manager_image}@]',
      filebrowserFlashBrowseUrl: '[@{$link_filename_popup_file_manager_flash}@]',
      customConfig: '[@{$product_config}@]',
      toolbar: 'ProductDescriptionToolbar',
      width: '700',
      height: '300',
      uiColor: '#9DFF9D',            
      language: '[@{$lang_code}@]',
      templates_files: [ '[@{$product_value.product_description_template_file}@]' ],
      templates: '[@{$product_value.product_description_template_lang}@]'     
    });
/* ]]> */
</script>                      
                    </td>
                  </tr>
                </table></td>
              </tr>
              [@{/foreach}@]
              [@{else}@]
              [@{foreach name=info item=product_value from=$product_values}@]
              <tr>
                <td class="main" valign="top">[@{if $smarty.foreach.info.first}@][@{#text_products_info#}@][@{/if}@]</td>
                <td><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="main" valign="top">[@{$product_value.languages_image}@]&nbsp;</td>
                    <td class="main">[@{$product_value.textarea_info}@]</td>
                  </tr>
                </table></td>
              </tr>
              [@{/foreach}@]
              [@{foreach name=description item=product_value from=$product_values}@]          
              <tr>
                <td class="main" valign="top">[@{if $smarty.foreach.description.first}@][@{#text_products_description#}@][@{/if}@]</td>
                <td><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="main" valign="top">[@{$product_value.languages_image}@]&nbsp;</td>
                    <td class="main">[@{$product_value.textarea_description}@]</td>
                  </tr>
                </table></td>
              </tr>
              [@{/foreach}@]
              [@{/if}@]          
              <tr>
                <td colspan="2">[@{$hidden_image_array}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr> 
            </table></td>
          </tr>          
          <tr style="background-color: #ffefef">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="0">                                                                                            
              [@{foreach name=image item=product_image from=$product_images}@]
              [@{if $smarty.foreach.image.first}@]              
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">              
                  <tr>
                    <td colspan="2"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
                  </tr> 
              [@{/if}@]
              [@{if $product_image.image_name}@]
                  <tr>             
                    <td width="5%"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="176" height="1" /></td>
                    <td width="95%"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="250" height="1" /></td>
                  </tr>                               
                  <tr>
                    <td class="main">[@{#text_products_image#}@]&nbsp;[@{$product_image.img_no}@]<br />[@{#text_delete#}@][@{$product_image.selection_delete_image}@]</td>
                    <td class="main">[@{$product_image.hidden_current_image}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
                      <tr>
                        <td colspan="2" nowrap="nowrap" class="main"><img style="float: left;" src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="[@{$product_image.small_product_image_max_height}@]" /><div style="float: left; padding: 0 10px 0 0;">&nbsp;[@{$product_image.image}@]</div><div style="float: left; line-height: 19px;">[@{#text_image_name#}@] <b>[@{$product_image.image_name}@]</b><br />[@{#text_width_size_large#}@] <b>[@{$product_image.large_img_width}@] px</b><br />[@{#text_height_size_large#}@] <b>[@{$product_image.large_img_height}@] px</b><br />[@{if $product_image.large_img_base == 'default_size'}@][@{#text_info#}@] <b>[@{#text_default_values_used#}@]</b>[@{elseif $product_image.large_img_base == 'origin_size'}@][@{#text_info#}@] <b>[@{#text_original_size_used#}@]</b>[@{elseif $product_image.large_img_base == 'self_selected_size'}@][@{#text_info#}@] <b>[@{#text_own_values_used#}@]</b>[@{/if}@]</div></td>
                      </tr>                
                      <tr>
                        <td colspan="2" nowrap="nowrap" class="main">&nbsp;<br />&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2" nowrap="nowrap" class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="12" />&nbsp;[@{#text_replace_image_with#}@]</td>
                      </tr> 
                      <tr>
                        <td colspan="2" nowrap="nowrap" class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="22" height="15" />&nbsp;[@{$product_image.file_image}@]</td>
                      </tr>
                      
                      <tr>
                        <td  colspan="2" nowrap="nowrap" class="smallText" style="font-style: italic"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{#text_note_image_size#}@]</td>
                      </tr>                                          
                      <tr>
                        <td class="main" width="5%" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{#text_default_values#}@]</td>
                        <td class="main">&nbsp;[@{$product_image.radio_large_image_default_size}@]</td>
                      </tr>
                      <tr>
                        <td class="main" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{#text_original_size#}@]</td>
                        <td class="main" nowrap="nowrap">&nbsp;[@{$product_image.radio_large_image_uploaded_size}@]</td>
                      </tr> 
                      <tr>
                        <td class="main" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{#text_own_values#}@]</td>
                        <td class="main" nowrap="nowrap">&nbsp;[@{$product_image.radio_large_image_input_size}@]&nbsp;-->&nbsp;[@{#text_max_width#}@]&nbsp;[@{$product_image.input_large_image_max_width}@][@{#text_pixel#}@]&nbsp;&nbsp;&nbsp;&nbsp;[@{#text_max_height#}@]&nbsp;[@{$product_image.input_large_image_max_height}@][@{#text_pixel#}@]</td>
                      </tr>                   
                    </table></td>
                  </tr>
                  <tr>
                    <td colspan="2"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
                  </tr> 
              [@{/if}@]               
              [@{if $smarty.foreach.image.last}@]               
                </table></td>
              </tr>               
              [@{/if}@]              
              [@{/foreach}@]              
              [@{foreach name=image item=product_image from=$product_images}@]
              [@{if $smarty.foreach.image.first}@]
              [@{if $more_images}@]                  
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">  
                  <tr>
                    <td class="main">[@{#text_upload_images#}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="5" height="15" /><a href="" onclick="toggle('images');return false"><img onmouseover="this.style.cursor='pointer'" src="[@{$images_path}@]icon_arrow_down.gif" height="15" width="24" title=" [@{#text_upload_images#}@] " alt="[@{#text_upload_images#}@]" /></a></td>
                  </tr> 
                </table></td>
              </tr>  
              [@{/if}@]                 
              <tr id="images" style="display: none">
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">  
                  <tr>
                    <td colspan="2"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
                  </tr>                                                    
              [@{/if}@]              
              [@{if !$product_image.image_name}@]
                  <tr>             
                    <td width="5%"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="176" height="1" /></td>
                    <td width="95%"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="250" height="1" /></td>
                  </tr>                              
                  <tr>
                    <td class="main">[@{#text_products_image#}@]&nbsp;[@{$product_image.img_no}@]</td>
                    <td class="main"><table border="0" width="100%" cellspacing="0" cellpadding="0">                    
                      <tr>
                        <td colspan="2" nowrap="nowrap" class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="[@{$product_image.small_product_image_max_height}@]" /></td>
                      </tr>                
                      <tr>
                        <td colspan="2" nowrap="nowrap" class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="12" /></td>
                      </tr>
                      <tr>
                        <td colspan="2" nowrap="nowrap" class="main">&nbsp;</td>
                      </tr>                                         
                      <tr>
                        <td colspan="2" nowrap="nowrap" class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="22" height="15" />&nbsp;[@{$product_image.file_image}@]</td>
                      </tr>                      
                      <tr>
                        <td  colspan="2" nowrap="nowrap" class="smallText" style="font-style: italic"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{#text_note_image_size#}@]</td>
                      </tr>                                          
                      <tr>
                        <td class="main" width="5%" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{#text_default_values#}@]</td>
                        <td class="main">&nbsp;[@{$product_image.radio_large_image_default_size}@]</td>
                      </tr>
                      <tr>
                        <td class="main" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{#text_original_size#}@]</td>
                        <td class="main" nowrap="nowrap">&nbsp;[@{$product_image.radio_large_image_uploaded_size}@]</td>
                      </tr> 
                      <tr>
                        <td class="main" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{#text_own_values#}@]</td>
                        <td class="main" nowrap="nowrap">&nbsp;[@{$product_image.radio_large_image_input_size}@]&nbsp;-->&nbsp;[@{#text_max_width#}@]&nbsp;[@{$product_image.input_large_image_max_width}@][@{#text_pixel#}@]&nbsp;&nbsp;&nbsp;&nbsp;[@{#text_max_height#}@]&nbsp;[@{$product_image.input_large_image_max_height}@][@{#text_pixel#}@]</td>
                      </tr>                   
                    </table></td>                  
                  </tr>         
                  <tr>
                    <td colspan="2"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
                  </tr> 
              [@{/if}@]                
              [@{if $smarty.foreach.image.last}@]               
                </table></td>
              </tr>               
              [@{/if}@]                             
              [@{/foreach}@]          
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
        [@{$hidden_products_date_added}@]
        [@{if $update}@]
        <a href="" onclick="if(update_product.onsubmit())update_product.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_update#}@] "><span>[@{#button_text_update#}@]</span></a>
        [@{else}@]
        <a href="" onclick="if(insert_product.onsubmit())insert_product.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_insert#}@] "><span>[@{#button_text_insert#}@]</span></a>
        [@{/if}@]      
        </td> 
      </tr>
    </table>[@{$form_end}@]  
    </td>
<!-- new_product_eof -->
