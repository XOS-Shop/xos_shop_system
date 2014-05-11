[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : blue-tabs-a
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : currencies.tpl
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

<!-- currencies -->
            <script type="text/javascript">
            /* <![CDATA[ */
              document.write('[@{$box_currencies_currencies}@]');
            /* ]]> */  
            </script>
            <noscript>
              <div id="currencies_box_noscript">                         
                <div class="header" style="float: right; cursor: pointer;">[@{#box_heading_currencies#}@]</div>
                <div class="clear">&nbsp;</div>              
                <div id="currencies_list_noscript">              
                  <div class="info-box-contents" style="padding: 3px; float: right; text-align: right; border: 1px solid #b6b7cb;">            
                    [@{$box_currencies_currencies_noscript}@]
                  </div>
                  <div class="clear">&nbsp;</div>               
                </div>               
              </div>                            
            </noscript>    
<!-- currencies_eof -->
