[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : index.tpl
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
<body bgcolor="#FFFFFF" onload="center()">
<div id="spacer"></div>
<div id="content">
<table id="text" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><table border="0" width="600" cellspacing="0" cellpadding="1" align="center">
      <tr class="mainback">
        <td><table border="0" width="600" cellspacing="0" cellpadding="0">
          <tr class="logo-head">
            <td height="50"><img src="[@{$images_path}@][@{$project_logo}@]" alt="[@{$project_title}@]" title=" [@{$project_title}@] " /></td>
            <td align="right" class="nav-head" nowrap="nowrap"><a href="[@{$link_filename_default}@]" class="nav-head">[@{#header_title_administration#}@]</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="[@{$link_catalog}@]" class="nav-head">[@{#header_title_online_catalog#}@]</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://www.xos-shop.com" target="_blank" class="nav-head">[@{#header_title_support_site#}@]</a>&nbsp;&nbsp;</td>
          </tr>
          <tr class="main">
            <td colspan="2"><table border="0" width="460" cellspacing="0" cellpadding="2">
              <tr valign="top">
                <td width="140" valign="top"><table border="0" width="140" cellspacing="0" cellpadding="2">
                  <tr>
                    <td valign="top">
                      <br />
                      <table border="0" width="100%" cellspacing="0" cellpadding="2">
                        <tr class="menuBoxHeading">
                          <td class="menuBoxHeading">&nbsp;[@{$project_title}@]&nbsp;</td>
                        </tr>
                      </table>
                      <table border="0" width="100%" cellspacing="0" cellpadding="2">
                        <tr class="infoBox">
                          <td class="infoBox">[@{$box_software_content}@]</td>
                        </tr>
                      </table>
                      <br />
                      <table border="0" width="100%" cellspacing="0" cellpadding="2">
                        <tr class="menuBoxHeading">
                          <td class="menuBoxHeading">&nbsp;[@{#box_title_orders#}@]&nbsp;</td>
                        </tr>
                      </table>
                      <table border="0" width="100%" cellspacing="0" cellpadding="2">
                        <tr class="infoBox">
                          <td class="infoBox">[@{$box_orders_content}@]</td>
                        </tr>
                      </table>
                      <br />
                      <table border="0" width="100%" cellspacing="0" cellpadding="2">
                        <tr class="menuBoxHeading">
                          <td class="menuBoxHeading">&nbsp;[@{#box_title_statistics#}@]&nbsp;</td>
                        </tr>
                      </table>
                      <table border="0" width="100%" cellspacing="0" cellpadding="2">
                        <tr class="infoBox">
                          <td class="infoBox">[@{$box_statistics_content}@]</td>
                        </tr>
                      </table>
                      <br />
                      <table border="0" width="100%" cellspacing="0" cellpadding="2">
                        <tr class="infoBox">
                          <td class="infoBox">[@{$box_ssl_content}@]</td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table></td>
                <td width="460"><table border="0" width="460" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="2">[@{$form_languages_begin}@]<table border="0" width="100%" cellspacing="0" cellpadding="2">
                      <tr>
                        <td class="heading">[@{#heading_title#}@]</td>
                        <td align="right">[@{$pull_down_menu_language}@][@{$hidden_field_session}@]</td>                                              
                      </tr>
                    </table>[@{$form_end}@]</td>
                  </tr>                  
                  [@{foreach name=outer item=category from=$categories}@]
                  [@{if (($smarty.foreach.outer.iteration-1)%2) == 0}@]
                  <tr>
                  [@{/if}@]
                    <td valign="top"><table border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td valign="top">[@{if $category.href}@]<a href="[@{$category.href}@]"><img src="[@{$images_path}@]categories/[@{$category.image}@]" alt="[@{$category.title}@]" title=" [@{$category.title}@] " /></a>[@{/if}@]</td>
                        <td><table border="0" cellspacing="0" cellpadding="2">
                          <tr>
                            <td class="indexmain"><a href="[@{$category.href}@]" class="indexmain">[@{$category.title}@]</a></td>
                          </tr>
                          <tr>
                            <td class="sub">
                            [@{foreach name=inner item=child from=$category.children}@]
                              [@{if $child.link}@]
                              <a href="[@{$child.link}@]" class="sub">[@{$child.title}@]</a>&nbsp;
                              [@{/if}@]
                            [@{/foreach}@] 
                            </td> 
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  [@{if ((($smarty.foreach.outer.iteration)%2) == 0) or $smarty.foreach.outer.last}@]  
                  </tr>
                  [@{/if}@]
                  [@{/foreach}@]
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>
        [@{$footer}@]
        </td>
      </tr>
    </table></td>
  </tr>
</table>
</div>  
</body>
</html>
