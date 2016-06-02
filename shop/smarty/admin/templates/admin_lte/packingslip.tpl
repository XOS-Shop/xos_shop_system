[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.3
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : packingslip.tpl
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="[@{$html_lang}@]" xml:lang="[@{$html_lang}@]">
<head>
<meta http-equiv="content-type" content="text/html; charset=[@{$charset}@]" />
<meta http-equiv="content-language" content="[@{$html_lang}@]" />
<meta http-equiv="content-script-type" content="text/javascript" />
<meta http-equiv="content-style-type" content="text/css" />
<meta name="generator" content="XOS-Shop version 1.0.3, open source e-commerce system" />
<title>[@{$project_title}@][@{$add_title}@]</title>
[@{if $base_href}@]
<base href="[@{$base_href}@]" />
[@{/if}@]
<link rel="shortcut icon" type="image/x-icon" href="[@{$images_path}@]favicon.ico" />
<link rel="stylesheet" type="text/css" href="[@{$images_path}@]stylesheet.css" />
[@{$style}@][@{$javascript}@]</head>
<body bgcolor="#ffffff" onload="resize();">
<!-- packingslip -->
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td nowrap="nowrap" class="pageHeading">[@{$store_name_address}@]</td>
        <td nowrap="nowrap" class="pageHeading" align="right">[@{$shop_logo}@]</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td colspan="3"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
      </tr>
      <tr>
        <td valign="top" width="33%"><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td nowrap="nowrap" class="main"><b>[@{#entry_sold_to#}@]</b></td>
          </tr>
          <tr>
            <td nowrap="nowrap" class="main">[@{$customer_address}@]</td>
          </tr>                    
        </table></td>        
        <td valign="top" width="33%"><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td nowrap="nowrap" class="main"><b>[@{#entry_bill_to#}@]</b></td>
          </tr>
          <tr>
            <td nowrap="nowrap" class="main">[@{$billing_address}@]</td>
          </tr>
        </table></td>                
        <td valign="top" width="33%">
        [@{if $delivery_address}@]
          <table border="0" cellspacing="0" cellpadding="2">
            <tr>
              <td nowrap="nowrap" class="main"><b>[@{#entry_ship_to#}@]</b></td>
            </tr>
            <tr>
              <td nowrap="nowrap" class="main">[@{$delivery_address}@]</td>
            </tr>
          </table>
        [@{/if}@]  
        </td>
      </tr>
    </table></td>
  </tr>  
  <tr>
    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="5" /></td>
  </tr>          
  <tr>
    <td><table border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td nowrap="nowrap" class="main"><b>[@{#entry_order_id#}@]</b>&nbsp;</td>
        <td nowrap="nowrap" class="main">[@{$o_id}@]</td>
      </tr>                                 
      [@{if $c_id}@]
      <tr>
        <td nowrap="nowrap" class="main"><b>[@{#entry_customer_id#}@]</b>&nbsp;</td>
        <td nowrap="nowrap" class="main">[@{$c_id}@]</td>
      </tr>          
      [@{/if}@]          
      <tr>
        <td nowrap="nowrap" class="main"><b>[@{#entry_telephone_number#}@]</b>&nbsp;</td>
        <td nowrap="nowrap" class="main">[@{$customer_telephone}@]</td>
      </tr>
      <tr>
        <td nowrap="nowrap" class="main"><b>[@{#entry_email_address#}@]</b>&nbsp;</td>
        <td nowrap="nowrap" class="main">[@{$customer_email_address}@]</td>
      </tr>
    </table></td> 
  </tr>  
  <tr>
    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
  </tr>
  <tr>
    <td><table border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td class="main"><b>[@{#entry_payment_method#}@]</b></td>
        <td class="main">[@{$payment_method}@]</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
  </tr>
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr bgcolor="#d3d3d3">
        <td width="1%" nowrap="nowrap" class="smallText" align="center"><b>[@{#table_heading_quantity#}@]</b></td> 
        <td width="1%" nowrap="nowrap" class="smallText"><b>&nbsp;</b></td>             
        <td width="20%" nowrap="nowrap" class="smallText"><b>[@{#table_heading_products_model#}@]</b></td>
        <td width="78%" nowrap="nowrap" class="smallText"><b>[@{#table_heading_products#}@]</b></td> 
      </tr>
     [@{foreach name=outer item=order_product from=$order_products}@]
      <tr bgcolor="#ececec">
        <td nowrap="nowrap" class="smallText" valign="top" colspan="4">&nbsp;</td>
      </tr> 
      <tr bgcolor="#ececec">
        <td nowrap="nowrap" class="smallText" align="center" valign="top"><b>[@{$order_product.qty}@]</b></td> 
        <td nowrap="nowrap" class="smallText">&nbsp;</td>             
        <td nowrap="nowrap" class="smallText" valign="top"><b>[@{$order_product.model}@]</b></td>        
        <td nowrap="nowrap" class="smallText" valign="top">
          <table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td nowrap="nowrap" class="smallText" valign="top">&nbsp;</td>              
              <td nowrap="nowrap" class="smallText" valign="top"><b>[@{$order_product.name}@]</b>[@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{$product_attribute.option_name}@]: [@{$product_attribute.option_value_name}@][@{/foreach}@][@{if $order_product.packaging_unit}@]<br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="4" /><br />[@{#text_packaging_unit#}@]&nbsp;[@{$order_product.packaging_unit}@][@{/if}@]</td>                                        
            </tr>
          </table>                 
        </td>
      </tr>
     [@{/foreach}@]
      <tr bgcolor="#ececec">
        <td nowrap="nowrap" class="smallText" valign="top" colspan="4">&nbsp;</td>
      </tr>    
    </table></td>
  </tr>
</table>
<!-- packingslip_eof -->
<br />
</body>
</html>
