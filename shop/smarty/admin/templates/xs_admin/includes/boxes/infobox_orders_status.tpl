[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : infobox_orders_status.tpl
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

<!-- infobox_orders_status -->
            [@{foreach name=box_content item=info_box_content from=$info_box_contents}@]
            [@{if $smarty.foreach.box_content.first}@]
            
            <td width="25%" valign="top">
              <table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr class="infoBoxHeading">
                  <td width="1" class="infoBoxHeading"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="1" /></td>
                  <td class="infoBoxHeading">[@{$info_box_heading_title}@]</td>
                </tr>
              </table>
              [@{$info_box_form_tag}@]
              <table border="0" width="100%" cellspacing="0" cellpadding="2">
            [@{/if}@]              
                <tr>
                  <td width="1" class="infoBoxContent"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="1" /></td>
                  <td class="infoBoxContent">[@{$info_box_content.text}@]</td>     
                </tr>
            [@{if $smarty.foreach.box_content.last}@]                
              </table>
              [@{if $info_box_form_tag}@]</form>[@{/if}@]
              
            </td>
            [@{/if}@]
            [@{foreachelse}@] 
            <td width="25%" valign="top">
              <table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr class="infoBoxHeading">
                  <td width="1" class="infoBoxHeading"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="1" /></td>
                  <td class="infoBoxHeading">&nbsp;</td>
                </tr>
              </table>             
            </td>                                   
            [@{/foreach}@]

<!-- infobox_orders_status_eof -->
            
