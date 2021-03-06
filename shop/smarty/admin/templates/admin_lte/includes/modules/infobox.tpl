[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.9
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : infobox.tpl
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

<!-- infobox -->
            [@{foreach name=box_content item=info_box_content from=$info_box_contents}@]
            [@{if $smarty.foreach.box_content.first}@]
            
            <td width="25%" valign="top">
              <table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr class="infoBoxHeading">
                  <td class="infoBoxHeading">[@{$info_box_heading_title}@]</td>
                </tr>
              </table>
              [@{$info_box_form_tag}@]
              <table border="0" width="100%" cellspacing="0" cellpadding="2">
            [@{/if}@]              
                <tr>
                  <td [@{if $info_box_content.align}@]align="[@{$info_box_content.align}@]"[@{/if}@] class="infoBoxContent">[@{$info_box_content.text}@]</td>     
                </tr>
            [@{if $smarty.foreach.box_content.last}@]                
              </table>
              [@{if $info_box_form_tag}@]</form>[@{/if}@]
              
            </td>
            [@{/if}@]
            [@{/foreach}@]

<!-- infobox_eof -->
            
