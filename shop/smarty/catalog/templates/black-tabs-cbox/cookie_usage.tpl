[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : black-tabs-cbox
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : cookie_usage.tpl
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

<!-- cookie_usage -->
          <div class="page-heading" style="line-height: [@{#page_heading_height#}@]px; padding: 0 0 10px 0">[@{#heading_title#}@]</div> 
          <div style="height: 10px; font-size: 0;">&nbsp;</div>
          <div  class="main">           
            <div style="padding: 0 0 4px 4px; width: 40%; float: right;">  
              <div class="info-box-heading">[@{#box_information_heading#}@]</div>
              <div class="info-box-central-contents" style="padding: 8px 3px 8px 3px;">
                <div class="box-text">[@{#box_information#}@]</div>
              </div>            
            </div>  
            [@{#text_information#}@]
          </div>            
          <div class="clear">&nbsp;</div> 
          <div style="height: 10px; font-size: 0;">&nbsp;</div>        
          <div class="info-box-central-contents">                             
            <div class="main" style="margin: 4px 15px 4px 15px;">                      
              <a href="[@{$link_filename_default}@]" class="button-continue" style="float: right" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a>
              <div class="clear">&nbsp;</div>                    
            </div>             
          </div>
<!-- cookie_usage_eof -->
