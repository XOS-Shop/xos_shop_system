[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : xsell.tpl
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

<!-- xsell -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td valign="top">[@{if $set_filter}@][@{$form_begin_filter_xsell_products}@][@{/if}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading" colspan="4">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>
        [@{if $set_filter}@]            
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left" width="30%"><b>&nbsp;[@{#table_heading_set_filter#}@]</b></td>
            <td class="dataTableHeadingContent" align="left" width="25%">[@{#table_heading_categories#}@]&nbsp;<br />[@{$pull_down_menu_categories_or_pages_id}@]<br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="4" /></td>
            <td class="dataTableHeadingContent" align="left" width="20%">[@{#table_heading_manufacturers#}@]&nbsp;<br />[@{$pull_down_menu_manufacturers_id}@]<br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="4" /></td>
            <td class="dataTableHeadingContent" align="left" width="15%">[@{#table_heading_max_rows#}@]&nbsp;<br />[@{$pull_down_menu_max_rows}@]<br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="4" /></td>
            <td class="dataTableHeadingContent" align="right" width="10%" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="7" /><br /><a href="" onclick="filter_xsell_products.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_select#}@] "><span>[@{#button_text_select#}@]</span></a></td>            
          </tr>
        [@{else}@]
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" colspan="5" align="left"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="35" /></td> 
          </tr>
        [@{/if}@]                            
        </table>[@{if $set_filter}@][@{$hidden_field_add_related_product_ID}@][@{$hidden_field_session}@][@{$form_end}@][@{/if}@]</td>
      </tr>
      <tr>
        <td width="100%" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td>
         [@{if $relating_products == 'yes'}@]   
              <table align="center" width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="#ff7c2a">
                <tr class="dataHeadingRow">
                  <td class="dataHeadingContent" width="70" nowrap="nowrap">[@{#text_product_id#}@] </td>
                  <td class="dataHeadingContent" nowrap="nowrap">[@{#text_quickfind_code#}@] </td>
                  <td class="dataHeadingContent" nowrap="nowrap">[@{#text_product_name#}@] </td>
                  <td class="dataHeadingContent" nowrap="nowrap">[@{#text_cur_cross_sells#}@] </td>
                  <td class="dataHeadingContent" colspan="2" nowrap="nowrap" align="center">[@{#text_update_cross_sells#}@] </td>
                </tr>
               [@{foreach name=outer item=product from=$products}@]                  
                <tr class="dataTableRow" onmouseover="cOn(this);" onmouseout="cOut(this);">
                  <td class="dataTableContent" valign="top" nowrap="nowrap">&nbsp;[@{$product.products_id}@]&nbsp;</td>
                  <td class="dataTableContent" valign="top" nowrap="nowrap">[@{$product.products_model}@]&nbsp;</td>
                  <td class="dataTableContent" valign="top" nowrap="nowrap">&nbsp;[@{$product.products_status_image}@]&nbsp;[@{$product.products_name}@]&nbsp;</td>
                  <td class="dataTableContent" nowrap="nowrap">
                  [@{foreach name=inner item=related_product from=$product.related_products}@]
                    <div>&nbsp;[@{$related_product.related_products_status_image}@]&nbsp;&nbsp;<span style="font-style: italic">[@{$related_product.related_products_model}@]</span> [@{$related_product.related_products_name}@]</div>
                  [@{if $smarty.foreach.inner.last}@]              
                  </td>
                  [@{/if}@]          
                  [@{foreachelse}@]
                  &nbsp;--</td>
                  [@{/foreach}@]
                  <td class="dataTableContent" valign="top" align="center" width="7%" nowrap="nowrap" onmouseover="this.style.cursor='pointer'; this.style.cursor='pointer';" onclick="document.location.href='[@{$product.link_to_edit_related_product}@]'">&nbsp;<a href="[@{$product.link_to_edit_related_product}@]">[@{#text_edit#}@]</a>&nbsp;</td>
                [@{if $product.link_to_sort_related_products}@]
                  <td class="dataTableContent" valign="top" align="center" width="7%" nowrap="nowrap" onmouseover="this.style.cursor='pointer'; this.style.cursor='pointer';" onclick="document.location.href='[@{$product.link_to_sort_related_products}@]'">&nbsp;<a href="[@{$product.link_to_sort_related_products}@]">[@{#text_prioritise#}@]</a>&nbsp;</td>
                </tr>
                [@{else}@]
                  <td class="dataTableContent" valign="top" align="center" width="7%" nowrap="nowrap">--</td>
                </tr>
                [@{/if}@]      
               [@{/foreach}@]     
              </table>  
              <table width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="#ff7c2a">
                <tr class="dataTableSplitPageRow"> 
                  <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="dataTableSplitPageContent">[@{$nav_bar_number}@]</td>
                        <td class="dataTableSplitPageContent" align="right">[@{$nav_bar_result}@]</td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>  
         [@{elseif $relating_products == 'no_products'}@]
              <table align="center" border="0" cellspacing="1" cellpadding="2" bgcolor="#ffffff">
                <tr>
                  <td class="main" ><br />&nbsp;<br />&nbsp;<br /><b>[@{#text_no_products_1#}@]</b><br /><br />[@{#text_no_products_2#}@]</td>
                </tr>
              </table>    
         [@{/if}@]
         [@{if $run_update_product}@]
              <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                <tr>
                  <td>&nbsp;</td>
                  <td  nowrap="nowrap" width="10%" align="center">                                     
                    <span class="main">
                      [@{#text_cross_sells_for#}@]&nbsp;[@{$product_id}@]<br />
                      <b>[@{$product_name}@]</b><br />
                      [@{#text_quickfind_code_for#}@]&nbsp;[@{$product_model}@]<br />
                      [@{#text_status#}@]&nbsp;[@{$product_status_image}@]<br /><br />
                      [@{$product_image}@]<br /><br />
                    [@{if $update_products}@]
                      [@{#text_update_product#}@]
                    [@{else}@]                
                      [@{#text_no_update_product#}@]
                    [@{/if}@]
                    </span><br /><br />
                    <a href="[@{$link_to_relating_products}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_new_product#}@] "><span>[@{#button_text_new_product#}@]</span></a>
                    [@{if $link_to_sort_related_products}@]
                    <a href="[@{$link_to_sort_related_products}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_sort_product#}@] "><span>[@{#button_text_sort_product#}@]</span></a>
                    [@{/if}@]                                                 
                  </td>
                  <td>&nbsp;</td>
                </tr>
              </table>                
         [@{/if}@]
         [@{if $add_relating_products}@]
              <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                <tr>
                  <td align="center">                                                
                    <span class="main">
                      [@{#text_cross_sells_for#}@]&nbsp;[@{$product_id}@]<br />
                      <b>[@{$product_name}@]</b><br />
                      [@{#text_quickfind_code_for#}@]&nbsp;[@{$product_model}@]<br />
                      [@{#text_status#}@]&nbsp;[@{$product_status_image}@]<br /><br />
                      [@{$product_image}@]
                    </span><br /><br />              
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                      <tr>
                        <td align="center">[@{$form_begin_add_relating_products}@]                                                        
                          <table width="80%" border="0" cellpadding="2" cellspacing="1" bgcolor="#ff7c2a">
                            <tr align="left" class="dataHeadingRow">
                              <td class="dataHeadingContent">[@{#text_product_id#}@] </td>
                              <td class="dataHeadingContent">[@{#text_quickfind_code#}@] </td>
                              <td class="dataHeadingContent">[@{#text_cross_sells#}@] </td>
                              <td class="dataHeadingContent">[@{#text_product_name#}@] </td>
                            </tr>
                  [@{if $related_products}@]                     
                            <tr align="left" bgcolor="#FFFFFF">
                              <td class="main" colspan="5">[@{#text_prducts_cross_sell#}@]</td>
                            </tr>
                            [@{foreach name=related_products item=cross_product from=$cross_products}@]                     
                            <tr class="dataTableRow" align="left">
                              <td class="dataTableContent" align="center">[@{$cross_product.product_id}@]</td>
                              <td class="dataTableContent">&nbsp;[@{$cross_product.product_model}@]&nbsp;</td>
                              <td class="dataTableContent" align="center" valign="middle">
                                <label onmouseover="this.style.cursor='pointer'; this.style.cursor='pointer'">
                                <input onmouseover="this.style.cursor='pointer'; this.style.cursor='pointer'" checked="checked" size="20" name="xsell_id[]" type="checkbox" value="[@{$cross_product.product_id}@]" />&nbsp;[@{#text_cross_sell#}@]</label>
                              </td>                     
                              <td class="dataTableContent" nowrap="nowrap">&nbsp;[@{$cross_product.product_status_image}@]&nbsp;[@{$cross_product.product_name}@]</td>
                            </tr>                               
                            [@{/foreach}@]                 
                  [@{/if}@]                 
                  [@{if $new_products}@]
                            <tr align="left" bgcolor="#FFFFFF"><td class="main" colspan="5">[@{#text_prducts_for_adding_cross_sell#}@]</td></tr>
                            [@{foreach name=relating_products item=product from=$products}@]                     
                            <tr class="dataTableRow" align="left">
                              <td class="dataTableContent" align="center">[@{$product.product_id}@]</td>
                              <td class="dataTableContent">&nbsp;[@{$product.product_model}@]&nbsp;</td>
                              <td class="dataTableContent" align="center" valign="middle">
                                <label onmouseover="this.style.cursor='pointer'; this.style.cursor='pointer'">
                                <input onmouseover="this.style.cursor='pointer'; this.style.cursor='pointer'" size="20" name="xsell_id[]" type="checkbox" value="[@{$product.product_id}@]" />&nbsp;[@{#text_cross_sell#}@]</label>
                              </td>                     
                              <td class="dataTableContent" nowrap="nowrap">&nbsp;[@{$product.product_status_image}@]&nbsp;[@{$product.product_name}@]</td>
                            </tr> 
                            [@{/foreach}@]                     
                            <tr>
                              <td colspan="2">&nbsp;</td>
                              <td nowrap="nowrap" class="main"><a href="" onclick="runing_update.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_save#}@] "><span>[@{#button_text_save#}@]</span></a></td>
                              <td nowrap="nowrap" class="main" align="right"><a href="[@{$link_to_relating_products}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_new_product#}@] "><span>[@{#button_text_new_product#}@]</span></a></td> 
                            </tr>
                          </table>                 
                          [@{$hidden_field_run_update}@][@{$hidden_field_categories_or_pages_id}@][@{$hidden_field_manufacturers_id}@][@{$hidden_field_add_related_product_ID}@]              
                          [@{$form_end}@]              
                        </td>
                      </tr>
                    </table>                             
                    <table width="80%" border="0" cellspacing="1" cellpadding="2" bgcolor="#ff7c2a">
                      <tr align="left" class="dataTableSplitPageRow"> 
                        <td>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td class="dataTableSplitPageContent">[@{$nav_bar_number}@]</td>
                              <td class="dataTableSplitPageContent" align="right">[@{$nav_bar_result}@]</td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>                                                          
                  [@{else}@]                          
                            <tr bgcolor="#FFFFFF">
                              <td class="main" align="center" colspan="5"><br />&nbsp;<br /><b>[@{#text_no_products_1a#}@]</b><br /><br />[@{#text_no_products_2#}@]<br />&nbsp;<br /></td>
                            </tr>
                            [@{if $related_products}@]
                              <td colspan="2">&nbsp;</td>
                              <td nowrap="nowrap" class="main"><a href="" onclick="runing_update.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_save#}@] "><span>[@{#button_text_save#}@]</span></a></td>
                              <td nowrap="nowrap" class="main" align="right"><a href="[@{$link_to_relating_products}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_new_product#}@] "><span>[@{#button_text_new_product#}@]</span></a></td> 
                            </tr>                            
                            [@{else}@]
                            <tr>
                              <td colspan="3">&nbsp;</td>
                              <td nowrap="nowrap" class="main" align="right"><a href="[@{$link_to_relating_products}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_new_product#}@] "><span>[@{#button_text_new_product#}@]</span></a></td>                    
                            </tr>
                            [@{/if}@]    
                          </table>              
                          [@{$hidden_field_run_update}@][@{$hidden_field_categories_or_pages_id}@][@{$hidden_field_manufacturers_id}@][@{$hidden_field_add_related_product_ID}@]
                          [@{$form_end}@]                            
                        </td>
                      </tr>
                    </table>                 
                  [@{/if}@]                            
                  </td>
                </tr>
              </table>               
         [@{/if}@]
         [@{if $sort_related_products}@]                  
              <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                <tr>
                  <td align="center">                            
                    [@{$form_begin_runing_update}@]
                    <span class="main">
                      [@{#text_order_for#}@]&nbsp;[@{$product_id}@]<br />
                      <b>[@{$product_name}@]</b><br />
                      [@{#text_quickfind_code_for#}@]&nbsp;[@{$product_model}@]<br />
                      [@{#text_status#}@]&nbsp;[@{$product_status_image}@]<br /><br />
                      [@{$product_image}@]
                    </span><br /><br />
                    <table cellpadding="2" cellspacing="1" bgcolor="#ff7c2a" border="0">
                      <tr align="left" class="dataHeadingRow">
                        <td nowrap="nowrap" class="dataHeadingContent" width="70">[@{#text_product_id#}@] </td>
                        <td nowrap="nowrap" class="dataHeadingContent" width="100">[@{#text_quickfind_code#}@] </td>
                        <td nowrap="nowrap" class="dataHeadingContent">[@{#text_product_name#}@] </td>
                        <td nowrap="nowrap" class="dataHeadingContent" width="120">[@{#text_order#}@] </td>
                      </tr>
                      [@{foreach item=cross_product from=$cross_products}@]                     
                      <tr class="dataTableRow" align="left">
                        <td class="dataTableContent">[@{$cross_product.product_id}@]&nbsp;</td>
                        <td class="dataTableContent">[@{$cross_product.product_model}@]&nbsp;</td>                  
                        <td class="dataTableContent" nowrap="nowrap">&nbsp;[@{$cross_product.product_status_image}@]&nbsp;[@{$cross_product.product_name}@]&nbsp;</td>                
                        <td class="dataTableContent" align="center">
                          [@{$cross_product.select_tag}@]
                        </td>
                      </tr>
                      [@{/foreach}@]                     
                      <tr>
                        <td nowrap="nowrap" class="dataTableRow" colspan="5" align="right">
                          <a href="[@{$link_to_relating_products}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_new_product#}@] "><span>[@{#button_text_new_product#}@]</span></a>
                          <a href="" onclick="runing_update.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_update#}@] "><span>[@{#button_text_update#}@]</span></a>                                                                            
                        </td>
                      </tr>
                    </table>
                    [@{$form_end}@]              
                  </td>
                </tr>
              </table>               
         [@{/if}@]
            </td>
          </tr>
        </table></td>
      </tr>
    </table></td> 
<!-- xsell_eof --> 
