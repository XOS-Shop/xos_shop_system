[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : blue-tabs-c-html5
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                    
* filename   : quick_search_suggest.tpl
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
<!DOCTYPE html>
<html>
<head>
<meta content="charset=UTF-8" />
<title></title>
</head>
<body>
<div style="font-family: Arial, Helvetica, sans-serif; font-size: 11px; min-width:124px; white-space: nowrap; background-color: #fff; padding: 0; border: 1px solid #b6b7cb;">
<div style="background-color: #fff; padding: 2px 6px 2px 4px;"><strong>[@{#text_suggestions#}@]</strong></div>
[@{foreach item=result from=$results}@]      
  <div style="background-color: #fff; padding: 2px 6px 2px 4px; border-top: 1px solid #b6b7cb;"><a href="[@{$result.products_link}@]">[@{$result.products_name}@]</a></div> 
[@{/foreach}@]
</div>                         
</body>
</html>