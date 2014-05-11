[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : osc-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : oscommerce default template with css-buttons and tables for layout                                                                     
* filename   : manufacturer_info.tpl
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

[@{if $box_manufacturer_info_has_content}@]
<!-- manufacturer_info -->
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td height="14" class="infoBoxHeading"><img src="[@{$images_path}@]corner_right_left.gif" alt="" /></td>
              <td width="100%" height="14" class="infoBoxHeading">[@{#box_heading_manufacturer_info#}@]</td>
              <td height="14" class="infoBoxHeading" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="11" height="14" /></td>
            </tr>
          </table>
          <table border="0" width="100%" cellspacing="0" cellpadding="1" class="infoBox">
            <tr>
              <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
                <tr>
                  <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="1" /></td>
                </tr>
                <tr>
                  <td class="boxText"><table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="center" class="infoBoxContents" colspan="2">[@{$box_manufacturer_info_manufacturer_image}@]</td>
                    </tr>
                    [@{if $box_manufacturer_info_link_to_the_manufacturer}@]
                    <tr>
                      <td valign="top" class="infoBoxContents">-&nbsp;</td>
                      <td valign="top" class="infoBoxContents"><a href="[@{$box_manufacturer_info_link_to_the_manufacturer}@]" target="_blank">[@{eval var = #box_manufacturer_info_homepage#}@]</a></td>
                    </tr>
                    [@{/if}@]
                    <tr>
                      <td valign="top" class="infoBoxContents">-&nbsp;</td>
                      <td valign="top" class="infoBoxContents"><a href="[@{$box_manufacturer_info_link_filename_default}@]">[@{#box_manufacturer_info_other_products#}@]</a></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="1" /></td>
                </tr>
              </table></td>
            </tr>
          </table>
        </td>
      </tr>
<!-- manufacturer_info_eof -->
[@{/if}@]