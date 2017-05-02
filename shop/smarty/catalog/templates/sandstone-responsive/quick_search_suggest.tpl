[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : sandstone-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.5
* descrip    : xos-shop default template built with Bootstrap3                                                                   
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
<div>
  <div id="quick-search-suggest-header">[@{#text_suggestions#}@]</div>
  [@{foreach item=result from=$results}@]      
  <div id="quick-search-suggest-list-item"><a href="[@{$result.products_link}@]">[@{$result.products_name}@]</a></div> 
  [@{/foreach}@]
</div>                         
</body>
</html>