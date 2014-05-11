[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with css-buttons and tables for layout                                                                     
* filename   : template_changer.tpl
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

<!-- template_changer -->
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="info-box-heading"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="6" height="18" /></td>
              <td width="100%" class="info-box-heading">[@{#box_heading_template_changer#}@]</td>
              <td class="info-box-heading" nowrap="nowrap"></td>
            </tr>
          </table>
          <table border="0" width="100%" cellspacing="0" cellpadding="1" class="info-box">
            <tr>
              <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="info-box-contents">
                <tr>
                  <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="1" /></td>
                </tr>
                <tr>
                  <td class="box-text">
                  <script type="text/javascript">
                  /* <![CDATA[ */
                    document.write('[@{$box_template_changer_content}@]');
                  /* ]]> */  
                  </script>
                  <noscript>
                    [@{$box_template_changer_content_noscript}@]
                  </noscript><br />
                  [@{#box_template_changer_text#}@]    
                  </td>
                </tr>
                <tr>
                  <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="1" /></td>
                </tr>
              </table></td>
            </tr>
          </table>
        </td>
      </tr>
<!-- template_changer_eof -->
