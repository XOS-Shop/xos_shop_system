[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : reviews.tpl
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

<!-- reviews -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>
        </table></td>
      </tr>
     [@{if $edit}@]
      <tr>
        <td>[@{$form_begin_review}@]<table border="0" width="100%" cellspacing="0" cellpadding="2">         
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left">&nbsp;</td> 
          </tr>                            
          <tr class="dataTableRow">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td class="main" valign="top"><b>[@{#entry_product#}@]&nbsp;</b>[@{$products_name}@]<br /><b>[@{#entry_from#}@]&nbsp;</b>[@{$customers_name}@]<br /><br /><b>[@{#entry_date#}@]&nbsp;</b>[@{$date_added}@]</td>
                <td class="main" align="right" valign="top">[@{$products_image}@]</td>
              </tr>
            </table></td>
          </tr>      
          <tr class="dataTableRow">
            <td><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="main" valign="top"><b>[@{#entry_review#}@]</b><br /><br />[@{$textarea_reviews_text}@]</td>
              </tr>
              <tr>
                <td class="smallText" align="right">[@{#entry_review_text#}@]</td>
              </tr>
            </table></td>
          </tr>
          <tr class="dataTableRow">
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
          </tr>
          <tr class="dataTableRow">
            <td class="main"><b>[@{#entry_rating#}@]</b>&nbsp;<small><font color="#ff0000"><b>[@{#text_bad#}@]</b></font></small>&nbsp;[@{$reviews_rating}@]&nbsp;<small><font color="#ff0000"><b>[@{#text_good#}@]</b></font></small></td>
          </tr>
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
          </tr>
          <tr>
            <td nowrap="nowrap" align="right" class="main"><input type="hidden" name="reviews_id" value="1" />[@{$hidden_reviews_id}@][@{$hidden_products_id}@][@{$hidden_customers_name}@][@{$hidden_products_name}@][@{$hidden_products_image}@][@{$hidden_date_added}@]<a href="[@{$link_filename_reviews_cancel}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a><a href="" onclick="review.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_preview#}@] "><span>[@{#button_text_preview#}@]</span></a></td>
          </tr>      
        </table>[@{$form_end}@]</td>
      </tr>       
     [@{elseif $preview}@]
      <tr>
        <td>[@{if $hidden_post_values}@][@{$form_begin_update}@][@{/if}@]<table border="0" width="100%" cellspacing="0" cellpadding="2"> 
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left">&nbsp;</td> 
          </tr>                  
          <tr class="dataTableRow">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td class="main" valign="top"><b>[@{#entry_product#}@]&nbsp;</b>[@{$products_name}@]<br /><b>[@{#entry_from#}@]&nbsp;</b>[@{$customers_name}@]<br /><br /><b>[@{#entry_date#}@]&nbsp;</b>[@{$date_added}@]</td>
                <td class="main" align="right" valign="top">[@{$products_image}@]</td>
              </tr>
            </table></td>
          </tr>
          <tr class="dataTableRow">
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top" class="main"><b>[@{#entry_review#}@]</b><br /><br />[@{$reviews_text}@]</td>
              </tr>
            </table></td>
          </tr>
          <tr class="dataTableRow">
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
          </tr>
          <tr class="dataTableRow">
            <td class="main"><b>[@{#entry_rating#}@]</b>&nbsp;[@{$stars_image}@]&nbsp;<small>[@{$text_of_5_stars}@]</small></td>
          </tr>
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
          </tr>
      [@{if $hidden_post_values}@]         
          <tr>
            <td nowrap="nowrap" align="right" class="smallText">[@{$hidden_post_values}@]<a href="[@{$link_filename_reviews_cancel}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a><a href="" onclick="update.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_update#}@] "><span>[@{#button_text_update#}@]</span></a><a href="[@{$link_filename_reviews_back_edit}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
          </tr>     
        </table>[@{$form_end}@]</td>
      </tr>       
      [@{else}@]
          <tr>
            <td nowrap="nowrap" align="right"><a href="[@{$link_filename_reviews_back}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
          </tr>         
        </table></td>
      </tr> 
      [@{/if}@]           
     [@{else}@]      
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">[@{#table_heading_products#}@]</td>
                <td class="dataTableHeadingContent" align="right">[@{#table_heading_rating#}@]</td>
                <td class="dataTableHeadingContent" align="right">[@{#table_heading_date_added#}@]</td>
                <td class="dataTableHeadingContent" align="right">[@{#table_heading_action#}@]&nbsp;</td>
              </tr>
              [@{foreach item=review from=$reviews}@]
              [@{if $review.selected}@]              
              <tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$review.link_filename_reviews}@]'">
                <td class="dataTableContent"><a href="[@{$review.link_filename_reviews_review}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a>&nbsp;[@{$review.products_name}@]</td>
                <td class="dataTableContent" align="right">[@{$review.stars_image}@]</td>
                <td class="dataTableContent" align="right">[@{$review.date_added}@]</td>
                <td class="dataTableContent" align="right"><img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>
              [@{else}@]
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$review.link_filename_reviews}@]'">
                <td class="dataTableContent"><a href="[@{$review.link_filename_reviews_review}@]"><img src="[@{$images_path}@]icons/preview.gif" alt="[@{#icon_title_preview#}@]" title=" [@{#icon_title_preview#}@] " /></a>&nbsp;[@{$review.products_name}@]</td>
                <td class="dataTableContent" align="right">[@{$review.stars_image}@]</td>
                <td class="dataTableContent" align="right">[@{$review.date_added}@]</td>
                <td class="dataTableContent" align="right"><a href="[@{$review.link_filename_reviews}@]"><img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " /></a>&nbsp;</td>
              </tr>               
              [@{/if}@]              
              [@{/foreach}@]
              <tr>
                <td colspan="4"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top">[@{$nav_bar_number}@]</td>
                    <td class="smallText" align="right">[@{$nav_bar_result}@]</td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          [@{$infobox_reviews}@]
          </tr>
        </table></td>
      </tr>      
     [@{/if}@]      
    </table></td>
<!-- reviews_eof -->
