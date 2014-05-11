[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : black-tabs-cbox-dotted
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : order_email_html.tpl
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
<html xmlns="http://www.w3.org/1999/xhtml" lang="[@{$xhtml_lang}@]" xml:lang="[@{$xhtml_lang}@]">
<head>
<meta http-equiv="content-type" content="text/html; charset=[@{$charset}@]" />
<meta http-equiv="content-language" content="[@{$xhtml_lang}@]" />
<meta http-equiv="content-style-type" content="text/css" />
<meta name="generator" content="XOS-Shop version 1.0 rc7s, open source e-commerce system" />
<title></title>
</head>
<body>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 18px; color: #727272; font-weight: bold;">[@{$store_name_address|nl2br}@]</td>
        <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 18px; color: #727272; font-weight: bold;" align="right"><img src="[@{$src_embedded_shop_logo}@]" style="border: 0;" alt="shop-logo" title=" shop-logo " /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td colspan="3" style="font-size: 1px; line-height: 1px; height: 1px; width: 100%; border-top: 1px solid black;">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top" width="33%"><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 12px;"><b>[@{#html_email_text_default_address#}@]</b></td>
          </tr>
          <tr>
            <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 12px;">[@{$default_address|nl2br}@]</td>
          </tr>
          <tr>
            <td style="font-size: 5px; line-height: 5px; height: 5px;">&nbsp;</td>
          </tr>
        </table></td>
        <td valign="top" width="33%"><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 12px;"><b>[@{#html_email_text_billing_address#}@]</b></td>
          </tr>
          <tr>
            <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 12px;">[@{$billing_address|nl2br}@]</td>
          </tr>
          <tr>
            <td style="font-size: 5px; line-height: 5px; height: 5px;">&nbsp;</td>
          </tr>
        </table></td> 
        <td valign="top"  width="33%">
        [@{if $delivery_address}@]
          <table border="0" cellspacing="0" cellpadding="2">
            <tr>
              <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 12px;"><b>[@{#html_email_text_delivery_address#}@]</b></td>
            </tr>
            <tr>
              <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 12px;">[@{$delivery_address|nl2br}@]</td>
            </tr>
            <tr>
              <td style="font-size: 5px; line-height: 5px; height: 5px;">&nbsp;</td>
            </tr>          
          </table>
        [@{/if}@]  
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td style="font-size: 10px; line-height: 10px; height: 10px;">&nbsp;</td>
  </tr> 
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 12px;"><b>[@{#html_email_text_order_number#}@]: </b></td>
        <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 12px;">[@{$order_id}@]</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 12px;"><b>[@{#html_email_text_date_ordered#}@]: </b></td>
        <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 12px;">[@{$date_ordered}@]</td>
      </tr>
    </table></td>
  </tr>    
 [@{if $payment_method}@] 
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 12px;"><b>[@{#html_email_text_payment_method#}@]: </b></td>
        <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 12px;">[@{$payment_method}@]</td>
      </tr>
    </table></td>
  </tr> 
 [@{/if}@]
 [@{if $order_comments}@] 
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td valign="top" style="font-family: Verdana, Arial, sans-serif; font-size: 12px;"><b>[@{#html_email_text_comments#}@]:</b><br /><div style="font-size: 11px; width: 80%;">[@{$order_comments|nl2br}@]</div></td>
      </tr>
    </table></td>
  </tr> 
 [@{/if}@]  
  <tr>
    <td style="font-size: 10px; line-height: 10px; height: 10px;">&nbsp;</td>
  </tr>
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr style="background-color: #BBC3D3;">
       [@{if $more_tax_groups}@]
        <td width="20%" nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #ffffff; font-weight: bold;">[@{#html_email_table_heading_products_model#}@]</td>
        <td width="8%" nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #ffffff; font-weight: bold;" colspan="2">[@{#html_email_table_heading_products#}@]</td>
        <td width="32%" nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #ffffff; font-weight: bold;" align="right">[@{#html_email_table_heading_tax#}@]</td>
        <td width="1%" nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #ffffff; font-weight: bold;">&nbsp;</td>
        <td width="20%" nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #ffffff; font-weight: bold;" align="right">[@{#html_email_table_heading_price#}@]</td>
        <td width="1%" nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #ffffff; font-weight: bold;">&nbsp;</td>
        <td width="15%" nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #ffffff; font-weight: bold;" align="center">[@{#html_email_text_quantity#}@]</td>
        <td width="1%" nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #ffffff; font-weight: bold;">&nbsp;</td>
        <td width="2%" nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #ffffff; font-weight: bold;" align="right">[@{#html_email_table_heading_total#}@]</td>      
       [@{else}@]
        <td width="20%" nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #ffffff; font-weight: bold;">[@{#html_email_table_heading_products_model#}@]</td>
        <td width="8%" nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #ffffff; font-weight: bold;" colspan="2">[@{#html_email_table_heading_products#}@]</td>
        <td width="53%" nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #ffffff; font-weight: bold;" align="right">[@{#html_email_table_heading_price#}@]</td>
        <td width="1%" nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #ffffff; font-weight: bold;">&nbsp;</td>
        <td width="15%" nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #ffffff; font-weight: bold;" align="center">[@{#html_email_text_quantity#}@]</td>
        <td width="1%" nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #ffffff; font-weight: bold;">&nbsp;</td>
        <td width="2%" nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #ffffff; font-weight: bold;" align="right">[@{#html_email_table_heading_total#}@]</td>
       [@{/if}@]
      </tr>
     [@{foreach name=outer item=order_product from=$order_products}@]
      <tr style="background-color: #F0F1F1;">
        <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000;" valign="top" colspan="[@{if $more_tax_groups}@]10[@{else}@]8[@{/if}@]">&nbsp;</td>
      </tr> 
      <tr style="background-color: #F0F1F1;">
        <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000;" valign="top"><b>[@{$order_product.model}@]</b></td>        
        <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000;" valign="top">        
          <table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000;" valign="top">                         
                <table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000;" valign="top">&nbsp;</td>              
                    <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000;" valign="top"><b>[@{$order_product.name}@]</b>[@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{$product_attribute.option_name}@]: [@{$product_attribute.option_value_name}@][@{/foreach}@]</td>                                        
                  </tr>
                </table>                 
              </td> 
              <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000;" valign="top">&nbsp;</td>
              <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000;" valign="top" align="right">
              [@{if $order_product.products_attributes_option_price}@]
                <table border="0" cellspacing="0" cellpadding="0"> 
                  <tr>
                    <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000;">&nbsp;</td>              
                    <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000;" align="center" valign="top">[@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{if $product_attribute.option_price}@][@{$product_attribute.option_price_prefix}@][@{/if}@][@{/foreach}@]</td>
                    <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000;" align="right" valign="top">[@{$order_product.price}@][@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]<br />[@{if $product_attribute.option_price}@][@{$product_attribute.option_price}@][@{/if}@][@{/foreach}@]</td>
                  </tr>
                </table>  
              [@{/if}@]                                
              </td>
            </tr>                                                
            <tr>            
              <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000;" colspan="3">[@{if $order_product.packaging_unit}@]<span style="font-family: Verdana, Arial, sans-serif; font-size: 2px;">&nbsp;</span><br />&nbsp;[@{#html_email_text_packaging_unit#}@]&nbsp;[@{$order_product.packaging_unit}@][@{/if}@]</td>                                        
            </tr>                                     
          </table>         
        </td>                                             
        <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000;" valign="top">&nbsp;</td>
        [@{if $more_tax_groups}@]
        <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000;" align="right" valign="top">[@{$order_product.tax_value}@]%</td>
        <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000;" valign="top">&nbsp;</td>
        [@{/if}@]        
        <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000;" align="right" valign="top"><b>[@{$order_product.final_single_price}@]</b></td>
        <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000;">&nbsp;</td>
        <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000;" align="center" valign="top"><b>[@{$order_product.qty}@]</b></td>
        <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000;">&nbsp;</td>
        <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000;" align="right" valign="top"><b>[@{$order_product.final_price}@]</b></td>
      </tr>
     [@{/foreach}@]
      <tr style="background-color: #F0F1F1;">
        <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000;" valign="top" colspan="[@{if $more_tax_groups}@]10[@{else}@]8[@{/if}@]">&nbsp;</td>
      </tr>      
    </table></td>
  </tr>   
  <tr>
    <td align="right"><table border="0" cellspacing="0" cellpadding="2">
     [@{foreach item=order from=$order_totals}@] 
      <tr>
        <td nowrap="nowrap" align="right" style="font-family: Verdana, Arial, sans-serif; font-size: 10px;">[@{if $more_tax_groups && $order.totals_tax > -1}@]<span style="color : #ff0000;">[@{#html_email_table_heading_tax#}@]&nbsp;([@{$order.totals_tax}@]%)&nbsp;</span>[@{/if}@][@{$order.totals_title}@]</td>
        <td nowrap="nowrap" align="right" style="font-family: Verdana, Arial, sans-serif; font-size: 10px;">[@{$order.totals_text}@]</td>
      </tr>
     [@{/foreach}@] 
    </table></td>
  </tr>      
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="2">   
      <tr>
        <td style="font-size: 10px; line-height: 10px; height: 10px; width: 100%; border-top: 1px solid #BBC3D3;">&nbsp;</td>
      </tr>    
      <tr>
        <td nowrap="nowrap" style="font-family: Verdana, Arial, sans-serif; font-size: 12px;">[@{$payment_email_footer|nl2br}@]</td>
      </tr>
    </table></td>
  </tr>  
</table>
</body>
</html>
