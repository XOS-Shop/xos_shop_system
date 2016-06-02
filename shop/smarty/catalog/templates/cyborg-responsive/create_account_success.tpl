[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : cyborg-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.3
* descrip    : xos-shop template built with Bootstrap3 and theme cyborg                                                                    
* filename   : create_account_success.tpl
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

<!-- create_account_success -->
          <div style="float: left;"><img src="[@{$images_path}@]table_background.gif" alt="[@{#heading_title#}@]" title=" [@{#heading_title#}@] " /></div>
          <div style="padding-left: 200px;">
            <h1 class="text-orange">[@{#heading_title#}@]</h1>
            [@{if $email}@]
            <div>[@{eval var=#text_account_created_with_mail#}@]</div>
            [@{else}@]
            <div>[@{eval var=#text_account_created#}@]</div>              
            [@{/if}@]            
          </div>
          <div class="clearfix invisible"></div>          
          <div class="div-spacer-h10"></div> 
          <div class="well well-sm clearfix">
            <a href="[@{$link_continue}@]" class="btn btn-success pull-right" title=" [@{#button_title_continue#}@] ">[@{#button_text_continue#}@]</a>                                                                                                                                                                             
          </div>             
<!-- create_account_success_eof -->
