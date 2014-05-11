[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
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
<!-- new_category_eof -->
