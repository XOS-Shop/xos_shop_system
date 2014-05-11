[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : invoice.tpl
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
<body bgcolor="#ffffff" onload="resize();">
<!-- invoice -->
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
      [@{if $tax_groups}@]
        <td width="20%" nowrap="nowrap" class="smallText"><b>[@{#table_heading_products_model#}@]</b></td>
        <td width="8%" nowrap="nowrap" class="smallText" colspan="2"><b>[@{#table_heading_products#}@]</b></td>        
        <td width="32%" nowrap="nowrap" class="smallText" align="right"><b>[@{#table_heading_tax#}@]</b></td>    
        <td width="1%" nowrap="nowrap" class="smallText"><b>&nbsp;</b></td>
        <td width="20%" nowrap="nowrap" class="smallText" align="right"><b>[@{#table_heading_price#}@]</b></td>
        <td width="1%" nowrap="nowrap" class="smallText"><b>&nbsp;</b></td>
        <td width="15%" nowrap="nowrap" class="smallText" align="center"><b>[@{#table_heading_quantity#}@]</b></td>
        <td width="1%" nowrap="nowrap" class="smallText"><b>&nbsp;</b></td>
        <td width="2%" nowrap="nowrap" class="smallText" align="right"><b>[@{#table_heading_total#}@]</b></td>
      [@{else}@]
        <td width="20%" nowrap="nowrap" class="smallText"><b>[@{#table_heading_products_model#}@]</b></td>
        <td width="8%" nowrap="nowrap" class="smallText" colspan="2"><b>[@{#table_heading_products#}@]</b></td>        
        <td width="53%" nowrap="nowrap" class="smallText" align="right"><b>[@{#table_heading_price#}@]</b></td>
        <td width="1%" nowrap="nowrap" class="smallText"><b>&nbsp;</b></td>
        <td width="15%" nowrap="nowrap" class="smallText" align="center"><b>[@{#table_heading_quantity#}@]</b></td>
        <td width="1%" nowrap="nowrap" class="smallText"><b>&nbsp;</b></td>
        <td width="2%" nowrap="nowrap" class="smallText" align="right"><b>[@{#table_heading_total#}@]</b></td>      
      [@{/if}@]  
      </tr>
     [@{foreach name=outer item=order_product from=$order_products}@]
      <tr bgcolor="#ececec">
        <td nowrap="nowrap" class="smallText" valign="top" colspan="[@{if $tax_groups}@]10[@{else}@]8[@{/if}@]">&nbsp;</td>
      </tr> 
      <tr bgcolor="#ececec">
        <td nowrap="nowrap" class="smallText" valign="top"><b>[@{$order_product.model}@]</b></td>                         
        <td nowrap="nowrap" class="smallText" valign="top">
          <table border="0" cellspacing="0" cellpadding="0">
            <tr>                                 
              <td nowrap="nowrap" class="smallText" valign="top">
                <table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td nowrap="nowrap" class="smallText" valign="top">&nbsp;</td>              
                    <td nowrap="nowrap" class="smallText" valign="top"><b>[@{$order_product.name}@]</b>[@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{$product_attribute.option_name}@]: [@{$product_attribute.option_value_name}@][@{/foreach}@]</td>                                        
                  </tr>
                </table>                 
              </td>
              <td nowrap="nowrap" class="smallText">&nbsp;</td>
              <td nowrap="nowrap" class="smallText" valign="top" align="right">
              [@{if $order_product.products_attributes_option_price}@]
                <table border="0" cellspacing="0" cellpadding="0"> 
                  <tr>
                    <td nowrap="nowrap" class="smallText">&nbsp;</td>              
                    <td nowrap="nowrap" class="smallText" align="center" valign="top">[@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{if $product_attribute.option_price}@][@{$product_attribute.option_price_prefix}@][@{/if}@][@{/foreach}@]</td>
                    <td nowrap="nowrap" class="smallText" align="right" valign="top">[@{$order_product.price}@][@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{if $product_attribute.option_price}@][@{$product_attribute.option_price}@][@{/if}@][@{/foreach}@]</td>
                  </tr>
                </table>  
              [@{/if}@]  
              </td>                                                            
            </tr>                                                
            <tr>            
              <td colspan="3" class="smallText" nowrap="nowrap">[@{if $order_product.packaging_unit}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="4" /><br />&nbsp;[@{#text_packaging_unit#}@]&nbsp;[@{$order_product.packaging_unit}@][@{/if}@]</td>                                        
            </tr>                                                                                                                                                 
          </table>                 
        </td>                                     
        <td nowrap="nowrap" class="smallText" valign="top">&nbsp;</td>
        [@{if $tax_groups}@]        
        <td nowrap="nowrap" class="smallText" align="right" valign="top">[@{$order_product.tax}@]%</td>
        <td nowrap="nowrap" class="smallText">&nbsp;</td>
        [@{/if}@]
        <td nowrap="nowrap" class="smallText" align="right" valign="top"><b>[@{$order_product.final_single_price}@]</b></td>
        <td nowrap="nowrap" class="smallText">&nbsp;</td>
        <td nowrap="nowrap" class="smallText" align="center" valign="top"><b>[@{$order_product.qty}@]</b></td>
        <td nowrap="nowrap" class="smallText">&nbsp;</td>
        <td nowrap="nowrap" class="smallText" align="right" valign="top"><b>[@{$order_product.final_price}@]</b></td>
      </tr>
     [@{/foreach}@]
      <tr bgcolor="#ececec">
        <td nowrap="nowrap" class="smallText" valign="top" colspan="[@{if $tax_groups}@]10[@{else}@]8[@{/if}@]">&nbsp;</td>
      </tr>       
    </table></td>
  </tr>  
  <tr>
    <td align="right"><table border="0" cellspacing="0" cellpadding="2">
     [@{foreach item=order_total from=$order_totals}@]
      <tr>
        <td nowrap="nowrap" align="right" class="smallText">[@{if $tax_groups && $order_total.tax > -1}@]<span style="color : #ff0000;">[@{#table_heading_tax#}@]&nbsp;([@{$order_total.tax}@]%)&nbsp;</span>[@{/if}@][@{$order_total.title}@]</td>
        <td nowrap="nowrap" align="right" class="smallText">[@{$order_total.text}@]</td>
      </tr>
     [@{/foreach}@]
    </table></td>
  </tr>  
</table>
<!-- invoice_eof -->
<br />
</body>
</html>
