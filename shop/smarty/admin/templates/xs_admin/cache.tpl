[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : cache.tpl
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

<!-- cache -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">[@{#table_heading_cache#}@]</td>
                <td class="dataTableHeadingContent">[@{#table_heading_action#}@]&nbsp;</td>
                <td class="dataTableHeadingContent">&nbsp;</td>
              </tr>
              [@{foreach name=loop item=cache_block from=$cache_blocks}@]
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
                <td class="dataTableContent">[@{$cache_block.title}@]</td>
                <td class="dataTableContent">&nbsp;&nbsp;<a href="[@{$cache_block.link_filename_cache_reset_block}@]"><img src="[@{$images_path}@]icon_reset.gif" alt="[@{#image_reset#}@]:&nbsp;[@{$cache_block.title}@]" title=" [@{#image_reset#}@]:&nbsp;[@{$cache_block.title}@] " /></a>&nbsp;</td>
                <td class="dataTableContent">&nbsp;</td>                
              </tr>
              [@{if $smarty.foreach.loop.last}@]            
              <tr>
                <td class="smallText" colspan="3">&nbsp;</td>
              </tr>
              <tr>
                <td class="smallText">[@{#text_cache_directory#}@]&nbsp;[@{$cache_dir}@]</td>
                <td class="smallText">&nbsp;&nbsp;<a href="[@{$link_filename_cache_reset_all_blocks}@]"><img src="[@{$images_path}@]icon_reset.gif" alt="[@{#text_clear_all_cache#}@]" title=" [@{#text_clear_all_cache#}@] " /></a>&nbsp;</td>
                <td class="dataTableContent">&nbsp;</td>
              </tr>              
              [@{/if}@]
              [@{/foreach}@]               
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- cache_eof -->
