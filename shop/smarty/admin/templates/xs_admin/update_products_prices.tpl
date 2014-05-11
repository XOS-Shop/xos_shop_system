[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : update_products_prices.tpl
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

<!-- update_products_prices -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td valign="top">[@{if $set_filter}@][@{$form_begin_filter_update_products_prices}@][@{/if}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading" colspan="5">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>
        [@{if $set_filter}@]            
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent"  align="left" width="20%"><b>&nbsp;[@{#table_heading_set_filter#}@]</b></td>
            <td class="dataTableHeadingContent" align="left" width="25%">[@{#table_heading_categories#}@]&nbsp;<br />[@{$pull_down_menu_categories_or_pages_id}@]<br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="4" /></td>
            <td class="dataTableHeadingContent" align="left" width="20%">[@{#table_heading_manufacturers#}@]&nbsp;<br />[@{$pull_down_menu_manufacturers_id}@]<br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="4" /></td>
            <td class="dataTableHeadingContent" align="left" width="10%">[@{#table_heading_max_rows#}@]&nbsp;<br />[@{$pull_down_menu_max_rows}@]<br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="4" /></td>
            <td class="dataTableHeadingContent" align="center" width="15%">&nbsp;[@{#table_heading_only_specials#}@]&nbsp;<br />[@{$checkbox_specials_only}@]<br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="3" /></td>
            <td class="dataTableHeadingContent" align="right" width="10%" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="7" /><br /><a href="" onclick="filter_update_products_prices.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_select#}@] "><span>[@{#button_text_select#}@]</span></a></td>            
          </tr>
        [@{else}@]
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" colspan="6" align="left"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="35" /></td> 
          </tr>
        [@{/if}@]                            
        </table>[@{if $set_filter}@][@{$hidden_field_add_related_product_ID}@][@{$hidden_field_session}@][@{$form_end}@][@{/if}@]</td>
      </tr>
      <tr>
        <td width="100%" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td>
[@{if $info_prices == 'yes'}@]
[@{$javascript}@]
[@{$form_begin}@]                    
              <table align="center" width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="#ff7c2a">
                <tr class="dataHeadingRow">
                  <td class="dataHeadingContent" nowrap="nowrap">[@{#text_product_id#}@] </td>
                  <td class="dataHeadingContent" nowrap="nowrap">[@{#text_quickfind_code#}@] </td>
                  <td class="dataHeadingContent" nowrap="nowrap">[@{#text_product_name#}@] </td>
                  <td class="dataHeadingContent" nowrap="nowrap">[@{#text_product_price#}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="108" height="10" />&nbsp;[@{#text_products_tax_rates#}@] &nbsp;[@{$pull_down_tax_rates}@]</td>
                </tr>                              
               
                [@{foreach name=outer item=product from=$products}@]                  
                <tr class="dataTableRow" onmouseover="cOn(this);" onmouseout="cOut(this);">
                  <td class="dataTableContent" valign="top" nowrap="nowrap">[@{$product.products_id}@]&nbsp;</td>
                  <td class="dataTableContent" valign="top" nowrap="nowrap">[@{$product.products_model}@]&nbsp;</td>
                  <td class="dataTableContent" valign="top" nowrap="nowrap">&nbsp;[@{$product.products_status_image}@]&nbsp;[@{$product.products_name}@]&nbsp;</td>                                                     
                  <td class="dataTableContent" nowrap="nowrap"><table class="dataTableContent" border="0" width="100%" cellspacing="0" cellpadding="2">                                 
                  [@{foreach name=inner item=products_prices from=$product.products_prices}@]                                   
                    <tr onmouseover="this.style.cursor='pointer'; this.style.cursor='pointer';" onclick="document.location.href='[@{$product.link_to_edit_related_product}@]'">
                      <td valign="top" nowrap="nowrap">[@{$products_prices.name}@]<br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="70" height="1" /></td>
                      <td colspan="4"><table class="dataTableContent" border="0" width="100%" cellspacing="0" cellpadding="2">
                        <tr>                  
                          <td width="5%" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="4" height="5" />&nbsp;[@{#text_products_price_net#}@]</td>
                          <td width="5%" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="4" height="5" />&nbsp;[@{#text_products_price_gross#}@]</td>
                          [@{if $products_prices.is_special}@]
                          <td style="color : red;" width="5%" nowrap="nowrap" align="center">&nbsp;&nbsp;&nbsp;[@{#text_specials#}@]</td>
                          <td style="color : red;" width="85%" nowrap="nowrap">&nbsp;&nbsp;&nbsp;[@{#text_specials_expires_date#}@]</td>
                          [@{else}@]
                          <td style="visibility : hidden" width="5%" nowrap="nowrap" align="center">&nbsp;&nbsp;&nbsp;[@{#text_specials#}@]</td>
                          <td style="visibility : hidden" width="85%" nowrap="nowrap">&nbsp;&nbsp;&nbsp;[@{#text_specials_expires_date#}@]</td>                          
                          [@{/if}@]
                        </tr>                        
                        <tr>
                          [@{if $products_prices.is_special}@]
                          <td nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="4" height="15" />&nbsp;[@{$products_prices.input_price}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="5" height="15" />[@{$products_prices.input_special_price}@]</td>
                          <td nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="4" height="15" />&nbsp;[@{$products_prices.input_price_gross}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="5" height="15" />[@{$products_prices.input_special_price_gross}@]</td>                           
                          <td nowrap="nowrap" align="center">&nbsp;&nbsp;&nbsp;[@{$products_prices.special_status_image}@]</td>
                          <td nowrap="nowrap">&nbsp;&nbsp;&nbsp;[@{$products_prices.input_special_expires_date}@]</td>
                          [@{else}@]
                          <td nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="4" height="15" />&nbsp;[@{$products_prices.input_price}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="5" height="15" /><span style="visibility : hidden">[@{$products_prices.input_special_price}@]</span></td>
                          <td nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="4" height="15" />&nbsp;[@{$products_prices.input_price_gross}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="5" height="15" /><span style="visibility : hidden">[@{$products_prices.input_special_price_gross}@]</span></td>                                                    
                          <td style="visibility : hidden" nowrap="nowrap" align="center">&nbsp;&nbsp;&nbsp;[@{$products_prices.special_status_image}@]</td>
                          <td style="visibility : hidden" nowrap="nowrap">&nbsp;&nbsp;&nbsp;[@{$products_prices.input_special_expires_date}@]</td>
                          [@{/if}@]
                        </tr>                           
                        <tr>
                          <td colspan="4">
                          [@{foreach name=inner_inner item=price_break from=$products_prices.price_breaks}@]
                            [@{if $smarty.foreach.inner_inner.first}@]
                            <table class="dataTableContent" border="0" width="100%" cellspacing="0" cellpadding="2">                                           
                              <tr>
                                <td width="2%" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="2" height="15" />&nbsp;[@{#text_products_price_breaks_quantity#}@]</td>
                                <td width="5%" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="15" />&nbsp;[@{#text_products_price_breaks_net#}@]</td>
                                <td nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{#text_products_price_breaks_gross#}@]</td>
                              </tr>
                            [@{/if}@]                         
                              <tr>
                                [@{if $products_prices.is_special}@]
                                <td nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="2" height="15" />&nbsp;[@{$price_break.input_quantity}@]&nbsp;</td>
                                <td nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="15" />&nbsp;[@{$price_break.input_price_break}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="5" height="15" />[@{$price_break.input_special_price_break}@]</td>
                                <td nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{$price_break.input_price_break_gross}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="5" height="15" />[@{$price_break.input_special_price_break_gross}@]</td>
                                [@{else}@]
                                <td nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="2" height="15" />&nbsp;[@{$price_break.input_quantity}@]&nbsp;</td>
                                <td nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="15" />&nbsp;[@{$price_break.input_price_break}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="5" height="15" /><span style="visibility : hidden">[@{$price_break.input_special_price_break}@]</span></td>
                                <td nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{$price_break.input_price_break_gross}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="5" height="15" /><span style="visibility : hidden">[@{$price_break.input_special_price_break_gross}@]</span></td>                                
                                [@{/if}@]
                              </tr>
                            [@{if $smarty.foreach.inner_inner.last}@]
                            </table>
                            [@{/if}@]                                            
                          [@{/foreach}@]                                                           
                          </td>
                        </tr>               
                      </table></td>                
                    </tr>                                                                                   
                    [@{if !$smarty.foreach.inner.last}@]
                    <tr>
                      <td colspan="5"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
                    </tr> 
                    [@{else}@]
                    <tr>
                      <td class="dataTableContent" align="right" valign="top" nowrap="nowrap" colspan="5" onmouseover="this.style.cursor='pointer'; this.style.cursor='pointer';" onclick="document.location.href='[@{$product.link_to_edit_related_product}@]'"><a href="[@{$product.link_to_edit_related_product}@]"><img src="[@{$images_path}@]icon_edit.gif" alt="[@{#text_edit#}@]" title=" [@{#text_edit#}@] " width="16" height="16" />[@{#text_edit#}@]&nbsp;</a></td>
                    </tr>                                            
                    [@{/if}@]
                  [@{/foreach}@]              
                  </table></td>                        
                </tr>     
                [@{/foreach}@]     
              </table>              
              [@{$form_end}@]                              
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
[@{elseif $info_prices == 'no_prices'}@]
              <table align="center" border="0" cellspacing="1" cellpadding="2" bgcolor="#ffffff">
                <tr>
                  <td class="main" ><br />&nbsp;<br />&nbsp;<br /><b>[@{#text_no_products_1#}@]</b><br /><br />[@{#text_no_products_2#}@]</td>
                </tr>
              </table>    
[@{/if}@]
[@{if $edit_prices}@]         
[@{$javascript}@]
[@{$form_begin}@]           
              <table align="center" width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="#ff7c2a">
                <tr class="dataHeadingRow">
                  <td class="dataHeadingContent" nowrap="nowrap">[@{#text_product_id#}@] </td>
                  <td class="dataHeadingContent" nowrap="nowrap">[@{#text_product_name#}@] </td>
                  <td class="dataHeadingContent" nowrap="nowrap">[@{#text_product_price#}@] </td>
                </tr>                                              
                <tr class="dataTableRow">
                  <td class="dataTableContent" valign="top" nowrap="nowrap">[@{$product_id}@]&nbsp;</td>
                  <td class="dataTableContent" valign="top" nowrap="nowrap">&nbsp;[@{$product_status_image}@]&nbsp;[@{$product_name}@]&nbsp;</td>                
                  <td class="dataTableContent" nowrap="nowrap"><table class="dataTableContent" border="0" width="100%" cellspacing="0" cellpadding="2">                   
                  [@{foreach name=outer item=customer_group from=$customers_groups}@]
                    [@{if $smarty.foreach.outer.first}@]
                    <tr>
                      <td colspan="5" style="font-style: italic">[@{#text_note#}@]</td>
                    </tr> 
                    <tr>
                      <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="3" /></td>
                    </tr>                                             
                    <tr>
                      <td>[@{#text_products_tax_class#}@]</td>
                      <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{$pull_down_products_tax_class}@]</td>
                    </tr>         
                    <tr style="display: none">             
                      <td colspan="2">[@{$hidden_price_array}@]</td>
                    </tr> 
                    <tr>
                      <td colspan="5"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="2" /></td>
                    </tr>          
                    <tr>
                      <td nowrap="nowrap">[@{#text_products_tax_rates#}@]</td>
                      <td colspan="4" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{$pull_down_tax_rates}@]</td>
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
                      <td valign="top" nowrap="nowrap">[@{if $customer_group.input_checkbox}@][@{$customer_group.input_checkbox}@][@{else}@]<img src="[@{$images_path}@]checkbox_dummy.gif" alt="" width="21" height="17" />[@{/if}@]&nbsp;[@{$customer_group.name}@]&nbsp;</td>
                      <td colspan="4"><table class="dataTableContent" id="box_[@{$customer_group.id}@]" border="0" width="100%" cellspacing="0" cellpadding="2">
                        <tr>                  
                          <td width="5%" nowrap="nowrap">[@{if $customer_group.display}@]<a href="" onclick="toggle('[@{$customer_group.toggle_name}@]');return false"><img onmouseover="this.style.cursor='pointer'" src="[@{$images_path}@]icon_arrow_down.gif" height="15" width="24" alt="" /></a>[@{else}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />[@{/if}@]&nbsp;[@{#text_products_price_net#}@]</td>
                          <td width="5%" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{#text_products_price_gross#}@]</td>
                          <td style="color : red;" width="5%" nowrap="nowrap">&nbsp;&nbsp;&nbsp;[@{#text_specials#}@]</td>
                          <td style="color : red;" width="85%" nowrap="nowrap">&nbsp;&nbsp;&nbsp;[@{#text_specials_expires_date#}@]</td>
                        </tr>                        
                        <tr>
                          <td nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{$customer_group.input_price}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="5" height="15" />[@{$customer_group.input_special_price}@]</td>
                          <td nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{$customer_group.input_price_gross}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="5" height="15" />[@{$customer_group.input_special_price_gross}@]</td>
                          <td nowrap="nowrap" align="center">&nbsp;&nbsp;&nbsp;<span style="background: green;">[@{$customer_group.radio_special_status_1}@]</span>&nbsp;&nbsp;<span style="background: red;">[@{$customer_group.radio_special_status_0}@]</span>&nbsp;</td>
                          <td nowrap="nowrap">&nbsp;&nbsp;&nbsp;[@{$customer_group.input_special_expires_date}@]</td>
                        </tr>                           
                        <tr id="[@{$customer_group.toggle_name}@]" style="[@{$customer_group.display}@]">
                          <td colspan="4"><table class="dataTableContent" border="0" width="100%" cellspacing="0" cellpadding="2">
                          [@{foreach name=inner item=price_break from=$customer_group.price_breaks}@]
                          [@{if $smarty.foreach.inner.first}@]                                           
                            <tr>
                              <td width="2%" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="22" height="15" />&nbsp;[@{#text_products_price_breaks_quantity#}@]</td>
                              <td width="5%" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="15" />&nbsp;[@{#text_products_price_breaks_net#}@]</td>
                              <td nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{#text_products_price_breaks_gross#}@]</td>
                            </tr>
                          [@{/if}@]                         
                            <tr>
                              <td nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="22" height="15" />&nbsp;[@{$price_break.input_quantity}@]&nbsp;</td>
                              <td nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="15" />&nbsp;[@{$price_break.input_price_break}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="5" height="15" />[@{$price_break.input_special_price_break}@]</td>
                              <td nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="15" />&nbsp;[@{$price_break.input_price_break_gross}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="5" height="15" />[@{$price_break.input_special_price_break_gross}@]</td>
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
                <tr style="display: none;">
                  <td>                         
<script type="text/javascript">
/* <![CDATA[ */ 
[@{$update_prices}@]
[@{$update_checked_string}@]
/* ]]> */
</script>                    
                  </td>
                </tr>                                               
              </table>                                          
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td nowrap="nowrap" class="main" align="right">&nbsp;<br /><a href="[@{$link_filename_update_products_prices}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a><a href="" onclick="if(update_prices.onsubmit())update_prices.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_update#}@] "><span>[@{#button_text_update#}@]</span></a></td>
                </tr>
              </table>                                         
[@{$form_end}@]                                                    
[@{/if}@]
            </td>
          </tr>
        </table></td>
      </tr>
    </table></td> 
<!-- update_products_prices_eof --> 
