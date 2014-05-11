[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : coupon_admin.tpl
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
 */
*}@]

<!-- coupon_admin -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">        
   [@{if $new}@]   
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>
        </table></td>
      </tr>           
      <tr>
        <td>[@{$form_begin}@][@{$hidden_field_date_created}@]     
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left">&nbsp;</td> 
          </tr>
          <tr class="dataTableRow">            
            <td><table border="0" cellspacing="0" cellpadding="2">            
              <tr>
                <td class="main">COUPON_STATUS</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="10" />&nbsp;<span style="background: green;">[@{$radio_coupon_status_Y}@]</span>&nbsp;IMAGE_ICON_STATUS_GREEN[@{#text_product_available#}@]&nbsp;&nbsp;&nbsp;<span style="background: red;">[@{$radio_coupon_status_N}@]</span>&nbsp;IMAGE_ICON_STATUS_RED[@{#text_product_not_available#}@]</td>
                <td class="main"  width="40%">COUPON_STATUS_HELP</td>
              </tr>             
              <tr>
                <td colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>            
              [@{foreach name=c_name item=c_content from=$coupon_content}@]                                       
              <tr>
                <td class="main">[@{if $smarty.foreach.c_name.first}@]COUPON_NAME[@{/if}@]</td>
                <td class="main">[@{$c_content.languages_image}@]&nbsp;[@{$c_content.input_coupon_name}@]</td>
                <td class="main">[@{if $smarty.foreach.c_name.first}@]COUPON_NAME_HELP[@{/if}@]</td>
              </tr>
              [@{/foreach}@]
              <tr>
                <td colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>              
              [@{foreach name=c_desc item=c_content from=$coupon_content}@]                                       
              <tr>
                <td class="main" valign="top">[@{if $smarty.foreach.c_desc.first}@]COUPON_DESC[@{/if}@]</td>
                <td><table border="0" cellspacing="0" cellpadding="0">         
                  <tr>
                    <td class="main" valign="top">[@{$c_content.languages_image}@]&nbsp;</td>
                    <td class="main">[@{$c_content.textarea_coupon_desc}@]</td>
                  </tr>              
                </table></td>
                <td class="main" valign="top" width="40%">[@{if $smarty.foreach.c_desc.first}@]COUPON_DESC_HELP[@{/if}@]</td>
              </tr>
              [@{/foreach}@]
              <tr>
                <td colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">COUPON_AMOUNT</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="10" />&nbsp;[@{$input_coupon_amount}@]</td>
                <td class="main">COUPON_AMOUNT_HELP</td>
              </tr>               
              <tr>
                <td colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">COUPON_MIN_ORDER</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="10" />&nbsp;[@{$input_coupon_min_order}@]</td>
                <td class="main">COUPON_MIN_ORDER_HELP</td>
              </tr>                            
              <tr>
                <td colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">COUPON_FREE_SHIP</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="10" />&nbsp;[@{$checkbox_coupon_free_ship}@]</td>
                <td class="main">COUPON_FREE_SHIP_HELP</td>
              </tr>                
              <tr>
                <td colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">COUPON_CODE</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="10" />&nbsp;[@{$input_coupon_code}@]</td>
                <td class="main">COUPON_CODE_HELP</td>
              </tr>               
              <tr>
                <td colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">COUPON_USES_COUPON</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="10" />&nbsp;[@{$input_coupon_uses_coupon}@]</td>
                <td class="main">COUPON_USES_COUPON_HELP</td>
              </tr>              
              <tr>
                <td colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">COUPON_USES_USER</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="10" />&nbsp;[@{$input_coupon_uses_user}@]</td>
                <td class="main">COUPON_USES_USER_HELP</td>
              </tr>                                          
              <tr>
                <td colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">COUPON_PRODUCTS</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="10" />&nbsp;[@{$input_coupon_products}@]</td>
                <td class="main">COUPON_PRODUCTS_HELP</td>
              </tr> 
              <tr>
                <td colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">COUPON_CATEGORIES</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="10" />&nbsp;[@{$input_coupon_categories}@]</td>
                <td class="main">COUPON_CATEGORIES_HELP</td>
              </tr>                
              <tr>
                <td colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">COUPON_STARTDATE</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="10" />&nbsp;[@{$input_coupon_startdate}@]</td>
                <td class="main">COUPON_STARTDATE_HELP</td>
              </tr>              
              <tr>
                <td colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">COUPON_FINISHDATE</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="10" />&nbsp;[@{$input_coupon_finishdate}@]</td>
                <td class="main">COUPON_FINISHDATE_HELP</td>
              </tr>                                                                      
              <tr>
                <td colspan="3"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
            </table></td>
          </tr>                            
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2"> 
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>            
              <tr>
                <td class="main" align="right" valign="top" nowrap="nowrap"><a href="[@{$link_filename_coupon_admin}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a><a href="" onclick="coupon.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_preview#}@] "><span>[@{#button_text_preview#}@]</span></a></td>
              </tr>
            </table></td>                
          </tr>
        </table>[@{$form_end}@]</td>               
      </tr>      
   [@{elseif $update_preview}@]   
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>
        </table></td>
      </tr>           
      <tr>
        <td>[@{$form_begin}@][@{$hidden_fields}@]     
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left">&nbsp;</td> 
          </tr>
          <tr class="dataTableRow">            
            <td><table border="0" cellspacing="0" cellpadding="2">            
              <tr>
                <td class="main">COUPON_STATUS</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="10" />&nbsp;[@{$coupon_status}@]</td>
              </tr>             
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>            
              [@{foreach name=c_name item=c_content from=$coupon_content}@]                                       
              <tr>
                <td class="main">[@{if $smarty.foreach.c_name.first}@]COUPON_NAME[@{/if}@]</td>
                <td class="main">[@{$c_content.languages_image}@]&nbsp;[@{$c_content.coupon_name}@]</td>
              </tr>
              [@{/foreach}@]
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>              
              [@{foreach name=c_desc item=c_content from=$coupon_content}@]                                       
              <tr>
                <td class="main" valign="top">[@{if $smarty.foreach.c_desc.first}@]COUPON_DESC[@{/if}@]</td>
                <td><table border="0" cellspacing="0" cellpadding="0">         
                  <tr>
                    <td class="main" valign="top">[@{$c_content.languages_image}@]&nbsp;</td>
                    <td class="main">[@{$c_content.coupon_desc}@]</td>
                  </tr>              
                </table></td>
              </tr>
              [@{/foreach}@]
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">COUPON_AMOUNT</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="10" />&nbsp;[@{$coupon_amount}@]</td>
              </tr>               
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">COUPON_MIN_ORDER</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="10" />&nbsp;[@{$coupon_min_order}@]</td>
              </tr>                            
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">COUPON_FREE_SHIP</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="10" />&nbsp;[@{$coupon_free_ship}@]</td>
              </tr>                
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">COUPON_CODE</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="10" />&nbsp;[@{$coupon_code}@]</td>
              </tr>               
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">COUPON_USES_COUPON</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="10" />&nbsp;[@{$coupon_uses_coupon}@]</td>
              </tr>              
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">COUPON_USES_USER</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="10" />&nbsp;[@{$coupon_uses_user}@]</td>
              </tr>                                          
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">COUPON_PRODUCTS</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="10" />&nbsp;[@{$coupon_products}@]</td>
              </tr> 
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">COUPON_CATEGORIES</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="10" />&nbsp;[@{$coupon_categories}@]</td>
              </tr>                
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">COUPON_STARTDATE</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="10" />&nbsp;[@{$coupon_startdate}@]</td>
              </tr>              
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                <td class="main">COUPON_FINISHDATE</td>
                <td class="main"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="24" height="10" />&nbsp;[@{$coupon_finishdate}@]</td>
              </tr>                                                                     
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
            </table></td>
          </tr>                            
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2"> 
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>            
              <tr>
                <td class="main" align="right" valign="top" nowrap="nowrap"><a href="[@{$link_filename_coupon_admin}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a><a href="" onclick="coupon.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_preview#}@] "><span>[@{#button_text_preview#}@]</span></a></td>
              </tr>
            </table></td>                
          </tr>
        </table>[@{$form_end}@]</td>               
      </tr>                  
   [@{else}@]    
      <tr>
        <td>[@{$form_begin_status}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
            <td class="smallText" align="right">[@{#heading_title_status#}@][@{$pull_down_status}@]</td>
          </tr>
        </table>[@{$hidden_field_session}@][@{$form_end}@]</td>
      </tr>        
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">              
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">[@{#table_heading_coupon_name#}@]</td>
                <td class="dataTableHeadingContent">[@{#table_heading_coupon_amount#}@]</td>
                <td class="dataTableHeadingContent" align="center">[@{#table_heading_coupon_code#}@]</td>
                <td class="dataTableHeadingContent" align="center">[@{#table_heading_text_redemptions#}@]</td>
                <td class="dataTableHeadingContent" align="center">[@{#table_heading_coupon_status#}@]</td>  
                <td class="dataTableHeadingContent" align="right">[@{#table_heading_action#}@]&nbsp;</td>
              </tr>
              [@{foreach item=cc from=$cc_list}@]
              [@{if $cc.selected}@]
              <tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
                <td class="dataTableContent" onclick="document.location.href='[@{$cc.link_filename_coupon_admin_edit}@]'">[@{$cc.name}@]</td>
                <td class="dataTableContent" onclick="document.location.href='[@{$cc.link_filename_coupon_admin_edit}@]'">[@{$cc.amount}@]</td>
                <td class="dataTableContent" align="center" onclick="document.location.href='[@{$cc.link_filename_coupon_admin_edit}@]'">[@{$cc.code}@]</td>
                <td class="dataTableContent" align="center" onclick="document.location.href='[@{$cc.link_filename_coupon_admin_edit}@]'">[@{$cc.redemptions}@]</td> 
                <td class="dataTableContent" align="center" onclick="document.location.href='[@{$cc.link_filename_coupon_admin_edit}@]'">
                [@{if $cc.status}@]                
                  [@{$cc.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$cc.link_filename_coupon_admin_action_setflag_N}@]">[@{$cc.icon_status_red_light}@]</a></td>
                [@{else}@]
                  <a href="[@{$cc.link_filename_coupon_admin_action_setflag_Y}@]">[@{$cc.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$cc.icon_status_red}@]</td>
                [@{/if}@]
                <td class="dataTableContent" align="right" onclick="document.location.href='[@{$cc.link_filename_coupon_admin_edit}@]'">&nbsp;<img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>             
              [@{else}@]
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
                <td class="dataTableContent" onclick="document.location.href='[@{$cc.link_filename_coupon_admin}@]'">[@{$cc.name}@]</td>
                <td class="dataTableContent" onclick="document.location.href='[@{$cc.link_filename_coupon_admin}@]'">[@{$cc.amount}@]</td>
                <td class="dataTableContent" align="center" onclick="document.location.href='[@{$cc.link_filename_coupon_admin}@]'">[@{$cc.code}@]</td>
                <td class="dataTableContent" align="center" onclick="document.location.href='[@{$cc.link_filename_coupon_admin}@]'">[@{$cc.redemptions}@]</td>
                <td class="dataTableContent" align="center" onclick="document.location.href='[@{$cc.link_filename_coupon_admin}@]'">
                [@{if $cc.status}@]                
                  [@{$cc.icon_status_green}@]&nbsp;&nbsp;<a href="[@{$cc.link_filename_coupon_admin_action_setflag_N}@]">[@{$cc.icon_status_red_light}@]</a></td>
                [@{else}@]
                  <a href="[@{$cc.link_filename_coupon_admin_action_setflag_Y}@]">[@{$cc.icon_status_green_light}@]</a>&nbsp;&nbsp;[@{$cc.icon_status_red}@]</td>
                [@{/if}@]
                <td class="dataTableContent" align="right" onclick="document.location.href='[@{$cc.link_filename_coupon_admin}@]'">&nbsp;<img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " />&nbsp;</td>
              </tr>
              [@{/if}@]               
              [@{/foreach}@]              
              <tr>
                <td colspan="6"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top">[@{$nav_bar_number}@]</td>
                    <td class="smallText" align="right">[@{$nav_bar_result}@]</td>
                  </tr>
                  <tr>
                    <td nowrap="nowrap" align="right" colspan="2"><a href="[@{$link_filename_coupon_admin_new}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_insert#}@] "><span>[@{#button_text_insert#}@]</span></a></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          [@{$infobox_coupon_admin}@]
          </tr>
        </table></td>
      </tr>
   [@{/if}@]     
    </table></td>
<!-- coupon_admin_eof -->
