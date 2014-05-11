[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-tabs
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : tabs.tpl
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

<!-- tabs -->
  <div class="tab-nav">
    <ul class="ul-tab-outer">
    [@{foreach name=outer item=tab_cat from=$boxes_categories_tabs_full_tabs}@]
      [@{if $tab_cat.level_will_change == '+1'}@]
      <li class="tab-[@{$tab_cat.class_name}@]" style="position: relative; z-index: [@{1700 - $smarty.foreach.outer.iteration}@];"><a href="[@{$tab_cat.href_link}@]">[@{$tab_cat.name}@][@{if $tab_cat.count_products}@]&nbsp;([@{$tab_cat.count_products}@])[@{/if}@]</a><div class="clear">&nbsp;</div><ul class="ul-tab-inner">
      [@{elseif $tab_cat.level_will_change == '-1'}@]
      <li class="tab-[@{$tab_cat.class_name}@]"><a href="[@{$tab_cat.href_link}@]">[@{$tab_cat.name}@][@{if $tab_cat.count_products}@]&nbsp;([@{$tab_cat.count_products}@])[@{/if}@]</a></li></ul></li>                    
      [@{elseif $tab_cat.level_will_change == '-2'}@]
      <li class="tab-[@{$tab_cat.class_name}@]"><a href="[@{$tab_cat.href_link}@]">[@{$tab_cat.name}@][@{if $tab_cat.count_products}@]&nbsp;([@{$tab_cat.count_products}@])[@{/if}@]</a></li></ul></li></ul></li>                    
      [@{elseif $tab_cat.level_will_change == '-3'}@]
      <li class="tab-[@{$tab_cat.class_name}@]"><a href="[@{$tab_cat.href_link}@]">[@{$tab_cat.name}@][@{if $tab_cat.count_products}@]&nbsp;([@{$tab_cat.count_products}@])[@{/if}@]</a></li></ul></li></ul></li></ul></li>                                                             
      [@{else}@]                                        
      <li class="tab-[@{$tab_cat.class_name}@]">[@{if $tab_cat.href_link}@]<a href="[@{$tab_cat.href_link}@]">[@{else}@]<a>[@{/if}@][@{$tab_cat.name|replace:'SMARTY_SHOP_HOME':#box_text_shop_home#}@][@{if $tab_cat.count_products}@]&nbsp;([@{$tab_cat.count_products}@])[@{/if}@]</a></li>  
      [@{/if}@]  
    [@{/foreach}@]
    </ul>              
  </div>
  <div class="clear">&nbsp;</div>      
<!-- tabs_eof -->
