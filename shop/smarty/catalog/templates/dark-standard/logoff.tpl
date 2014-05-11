[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : dark-standard
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop extra template with popup windows as lightboxes 
*              and div/css layout                                                                     
* filename   : logoff.tpl
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

<!-- logoff -->
          <div style="float: left;"><img src="[@{$images_path}@]table_background.gif" alt="[@{#heading_title#}@]" title=" [@{#heading_title#}@] " /></div>
          <div style="padding-left: 200px;">
            <h1 class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title#}@]</h1>
            <div style="height: 18px; font-size: 0;">&nbsp;</div>
            <div class="main">[@{#text_main#}@]</div>
          </div>
          <div class="clear">&nbsp;</div>          
          <div style="height: 10px; font-size: 0;">&nbsp;</div> 
          
          <div class="info-box-central-contents">                             
            <div class="main" style="margin: 4px 15px; 4px 15px;">                      
              <a href="[@{$link_filename_default}@]" class="button-continue" style="float: right" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a>
              <div class="clear">&nbsp;</div>                    
            </div>             
          </div>        
<!-- logoff_eof -->
