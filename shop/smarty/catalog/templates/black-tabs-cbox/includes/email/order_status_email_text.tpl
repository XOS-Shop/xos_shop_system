[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : black-tabs-cbox
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : order_status_email_text.tpl
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

------------------------------------------------------------
[@{#text_email_text_order_number#}@]
[@{$order_id}@]

[@{#text_email_text_date_ordered#}@]
[@{$date_ordered}@]

------------------------------------------------------------
[@{#text_email_text_status_update#}@]
[@{#text_email_text_new_status#}@] [@{$order_status}@]

[@{if $order_comments}@]
[@{#text_email_text_comments_update#}@]
[@{$order_comments}@]
[@{/if}@]
------------------------------------------------------------

[@{#text_email_text_invoice_url#}@]
[@{$link_invoice}@]

[@{#text_email_text_please_reply#}@]



[@{#text_email_text_signature#}@]
[@{$store_name}@] 
