[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : cyborg-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.5
* descrip    : xos-shop template built with Bootstrap3 and theme cyborg                                                                    
* filename   : template_changer.tpl
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

<!-- template_changer -->
          <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">[@{#box_heading_template_changer#}@]</h3></div>
            <div class="panel-body">
              <script type="text/javascript">
                document.write('[@{$box_template_changer_content}@]'); 
              </script>
              <noscript>
                [@{$box_template_changer_content_noscript}@]
              </noscript><br />
              [@{#box_template_changer_text#}@]    
            </div>
          </div>          
<!-- template_changer_eof -->
