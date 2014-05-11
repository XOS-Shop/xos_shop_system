[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : dark-tabs
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop extra template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : order_email_text.tpl
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
[@{$store_name_address}@]


[@{#text_email_text_default_address#}@]:
-----------------------------
[@{$default_address}@]


[@{#text_email_text_billing_address#}@]:
-----------------------------
[@{$billing_address}@]


[@{if $delivery_address}@]
[@{#text_email_text_delivery_address#}@]:
-----------------------------
[@{$delivery_address}@] 


[@{/if}@]
[@{#text_email_text_order_number#}@]:
-----------------------------
[@{$order_id}@]


[@{#text_email_text_date_ordered#}@]:
-----------------------------
[@{$date_ordered}@]


[@{if $payment_method}@] 
[@{#text_email_text_payment_method#}@]:
-----------------------------
[@{$payment_method}@]
[@{/if}@]


[@{if $order_comments}@] 
[@{#text_email_text_comments#}@]:
-----------------------------
[@{$order_comments}@]
[@{/if}@]


[@{#text_email_text_products#}@]:
-----------------------------
[@{foreach name=outer item=order_product from=$order_products}@] 
 [@{$order_product.qty}@] x
  [@{$order_product.name}@] [@{if $order_product.products_attributes_option_price}@]([@{$order_product.price}@])
[@{/if}@]
[@{foreach name=inner item=product_attribute from=$order_product.product_attributes}@]
  [@{$product_attribute.option_name}@]: [@{$product_attribute.option_value_name}@] [@{if $product_attribute.option_price}@]([@{$product_attribute.option_price_prefix}@][@{$product_attribute.option_price}@])
[@{/if}@]
[@{/foreach}@]
[@{if $order_product.packaging_unit}@]  
  [@{#text_email_text_packaging_unit#}@]: [@{$order_product.packaging_unit}@]
[@{/if}@]
  [@{#text_email_text_products_model#}@]: [@{$order_product.model}@]
  [@{if $more_tax_groups}@][@{#text_email_text_tax_rate#}@]: ([@{$order_product.tax_value}@]%)[@{/if}@]  
  [@{#text_email_text_products_price#}@]: [@{$order_product.final_single_price}@]
  [@{#text_email_text_products_total#}@]: [@{$order_product.final_price}@]
[@{/foreach}@]


[@{#text_email_text_total#}@]:
----------------------------- 
[@{foreach item=order from=$order_totals}@][@{if $more_tax_groups && $order.totals_tax > -1}@][@{#text_email_text_tax_rate#}@]([@{$order.totals_tax}@]%) [@{/if}@][@{$order.totals_title}@] [@{$order.totals_text}@]
[@{/foreach}@]
=============================


[@{#text_email_text_invoice_url#}@]:
-----------------------------
[@{$link_invoice}@]


[@{$payment_email_footer}@]
