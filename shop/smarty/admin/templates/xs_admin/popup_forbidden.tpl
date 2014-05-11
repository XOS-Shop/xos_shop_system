[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : popup_forbidden.tpl
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
[@{$html_header}@]
<body bgcolor="#ffffff" style="margin: 0; padding: 0" onload="adjustHeight();">
<div class="main-div" id="main-div" style="overflow: auto; margin: 0; padding: 0; width:100%;">
<div id="inner-div" style="margin: 0; padding: 0; width:100%;">
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%" valign="top">
<!-- popup_forbidden -->
[@{$message_stack_output}@]
      <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>
            <table border="0" width="100%" cellspacing="0" cellpadding="2" align="center">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">&nbsp;[@{#text_forbidden#}@]</td>
              </tr>
              <tr class="dataTableRow">
                <td align="left" class="dataTableContent">&nbsp;[@{#text_main#}@]&nbsp;</td>
              </tr>
              <tr class="dataTableRow">
                <td nowrap="nowrap"><a href="javascript:window.close()" class="button-default" style="margin-left: 5px; float: left" title=" [@{#button_title_close_window#}@] "><span>[@{#button_text_close_window#}@]</span></a></td>
              </tr>
            </table>
        </td>
      </tr>
    </table>
<!-- popup_forbidden_eof --> 
<!-- footer -->
[@{$footer}@]
<!-- footer_eof --> 
    <br />
    </td>
  </tr>
</table>
</div>
</div>
</body>
</html>