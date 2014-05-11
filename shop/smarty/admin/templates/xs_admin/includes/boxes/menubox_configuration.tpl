[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : menubox_configuration.tpl
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

<!-- menubox_configuration -->
      <tr>
        <td>        
          <table border="0" width="100%" cellspacing="0" cellpadding="2">
            <tr>
              <td class="[@{if $menu_box_selected}@]menuBoxHeadingSelected[@{else}@]menuBoxHeading[@{/if}@]">
                <a href="[@{$menu_box_heading_link}@]" class="menuBoxHeadingLink">&nbsp;[@{$menu_box_heading_name}@]&nbsp;</a>
              </td>
            </tr>
          </table>
          [@{foreach name=outer item=menu_box_content from=$menu_box_contents}@]
          [@{if $smarty.foreach.outer.first}@]                    
          <table border="0" width="100%" cellspacing="0" cellpadding="2">
            <tr>
              <td class="[@{if $menu_box_selected}@]menuBoxContentSelected[@{else}@]menuBoxContent[@{/if}@]">
            [@{/if}@]  
                <a href="[@{$menu_box_content.link}@]" class="[@{if $menu_box_content.selected}@]menuBoxContentLinkSelected[@{else}@]menuBoxContentLink[@{/if}@]">[@{$menu_box_content.name}@]</a><br />
            [@{if $smarty.foreach.outer.last}@]  
              </td>
            </tr> 
          </table>
          [@{/if}@]           
          [@{/foreach}@]         
        </td>
      </tr>
<!-- menubox_configuration_eof --> 
