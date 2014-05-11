[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : frame.tpl
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
<body bgcolor="#ffffff" [@{$BODY_TAG_PARAMS}@]>
<div class="main-div">
<table border="0" width="100%" cellspacing="0" cellpadding="0">
<tr>
<td>
<!-- header -->
[@{$header}@]
<!-- header_eof -->
<!-- body -->
    
<table border="0" width="100%" cellspacing="1" cellpadding="1">
  <tr>
    <td width="[@{#box_width#}@]" valign="top"><table border="0" width="[@{#box_width#}@]" cellspacing="0" cellpadding="2" class="columnLeft">
        
<!-- left_navigation -->
[@{$menubox_administrator}@][@{$menubox_configuration}@][@{$menubox_modules}@][@{$menubox_content_manager}@][@{$menubox_catalog}@][@{$menubox_customers}@][@{$menubox_gv_admin}@][@{$menubox_taxes}@][@{$menubox_localization}@][@{$menubox_reports}@][@{$menubox_tools}@]
<!-- left_navigation_eof --> 

    </table>
        
<!-- validator_icon --> 
    <table border="0" width="[@{#box_width#}@]" cellspacing="0" cellpadding="0">        
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="4" /></td>
      </tr>
    </table>  
    <table border="0" width="[@{#box_width#}@]" cellspacing="0" cellpadding="2" class="columnLeft">        
      <tr>
        <td>                                               
          <table border="0" width="100%" cellspacing="0" cellpadding="2">
            <tr>
              <td class="menuBoxContent" style="text-align: center;">              
                [@{*<a href="http://www.validome.org/referer" target="_blank">*}@]<img style="border:none" src="[@{$images_path}@]valid_xhtml_1_0.gif" alt="Valid XHTML 1.0" width="80" height="15" />[@{*</a>*}@]           
              </td>
            </tr> 
          </table>                                      
        </td>
      </tr>
    </table> 
<!-- validator_icon_eof -->
 
    </td>
           
<!-- central_contents -->    
[@{$central_contents}@]
<!-- central_contents_eof -->  
 
  </tr>
</table> 

<!-- body_eof -->
<!-- footer -->
[@{$footer}@]
<!-- footer_eof --> 

<br />
</td>
</tr>
</table>
</div>
[@{$end_tags}@]
