[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with css-buttons and tables for layout                                                                     
* filename   : address_book.tpl
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

<!-- address_book -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="page-heading">[@{#heading_title#}@]</td>
            <td class="page-heading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#page_heading_width#}@]" height="[@{#page_heading_height#}@]" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      [@{if $message_stack}@]
      <tr>
        <td>[@{$message_stack}@]</td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>      
      [@{/if}@]      
      <tr>
        <td class="main"><b>[@{#primary_address_title#}@]</b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td class="main" width="50%" valign="top">[@{#primary_address_description#}@]</td>
                <td align="right" width="50%" valign="top"><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="main" align="center" valign="top"><b>[@{#primary_address_title#}@]</b><br /><img src="[@{$images_path}@]arrow_south_east.gif" alt="" /></td>
                    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                    <td class="main" valign="top">[@{$primary_address_label}@]</td>
                    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td class="main"><b>[@{#address_book_title#}@]</b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
            [@{foreach item=address from=$addresses}@]
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr class="module-row" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
                    <td nowrap="nowrap" class="main" width="80%" onclick="document.location.href='[@{$address.link_filename_address_book_process_edit}@]'"><b>[@{$address.name}@]</b>[@{if $address.primary_address}@]&nbsp;<small><i>[@{#primary_address#}@]</i></small>[@{/if}@]</td>
                    <td nowrap="nowrap" class="main" width="10%" align="right"><a href="[@{$address.link_filename_address_book_process_edit}@]" class="button-small-edit" style="float: right" title=" [@{#small_button_title_edit#}@] "><span>[@{#small_button_text_edit#}@]</span></a></td>
                    <td nowrap="nowrap" class="main" width="10%" align="right"><a href="[@{$address.link_filename_address_book_process_delete}@]" class="button-small-delete" style="float: right" title=" [@{#small_button_title_delete#}@] "><span>[@{#small_button_text_delete#}@]</span></a></td>
                  </tr>
                  <tr>
                    <td colspan="3"><table border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                        <td class="main">[@{$address.format_address}@]</td>
                        <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>
            [@{/foreach}@]  
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>                
                <td nowrap="nowrap"><a href="[@{$link_filename_account}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>                
                [@{if $link_filename_address_book_process}@]                
                <td nowrap="nowrap" align="right"><a href="[@{$link_filename_address_book_process}@]" class="button-add-address" style="float: right" title=" [@{#button_title_add_address#}@] "><span>[@{#button_text_add_address#}@]</span></a></td>                
                [@{/if}@]
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td class="small-text"><span class="red-mark"><b>[@{#text_maximum_entries_1#}@]</b></span> [@{eval var=#text_maximum_entries_2#}@]</td>
      </tr>
    </table></td>
<!-- address_book_eof -->
