[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : dark-standard
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop extra template with popup windows as lightboxes 
*              and div/css layout                                                                     
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
         <div class="rt-gray">
	    <div class="lt-gray">
              <div class="rb">
                <div class="lb">
                  <div class="box-content"> 
                    <h3 class="info-box-heading">[@{#box_heading_currencies#}@]</h3>
                    <div class="info-box-contents" style="padding: 11px 3px 11px 3px;">
                      <script type="text/javascript">
                      /* <![CDATA[ */
                        document.write('[@{$box_currencies_currencies}@]');
                      /* ]]> */  
                      </script>
                      <noscript>
                        [@{$box_currencies_currencies_noscript}@]
                      </noscript>    
                    </div>
                  </div>
                </div>
              </div>
	    </div>
          </div>
          <div class="clear">&nbsp;</div>           
<!-- currencies_eof -->
