[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.6
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : header.tpl
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
<!-- header -->
      <header class="main-header">
        <a href="[@{$link_filename_default}@]" class="logo">
          <span class="logo-mini">XOS</span>
          <span class="logo-lg">XOS-Shop Admin</span>
        </a>
        <nav class="navbar navbar-static-top">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">              
              <li>
                <a href="[@{$link_filename_default}@]">[@{#header_title_administration#}@]</a>
              </li> 
              <li>              
                <a href="[@{$link_catalog}@]" target="_blank">[@{#header_title_online_catalog#}@]</a>
              </li>              
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="[@{$images_path}@]user.png" class="user-image" alt="User Image">
                  <span class="hidden-xs">[@{$admin_firstname}@] [@{$admin_lastname}@]</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <img src="[@{$images_path}@]user.png" class="img-circle" alt="User Image">
                    <p>
                      [@{$admin_firstname}@] [@{$admin_lastname}@]<br>
                      [@{#text_info_group#}@]&nbsp;[@{$admin_groups_name}@]<br>
                      <small>[@{#text_info_created#}@]&nbsp;[@{$admin_created}@]</small>
                    </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="[@{$link_filename_admin_account}@]" class="btn btn-default btn-flat">[@{#header_title_account#}@]</a>
                    </div>
                    <div class="pull-right">
                      <a href="[@{$link_filename_logoff}@]" class="btn btn-default btn-flat">[@{#header_title_logoff#}@]</a>
                    </div>
                  </li>
                </ul>
              </li>
[@{*
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
*}@]
            </ul>
          </div>
        </nav>
      </header>
<!-- header_eof -->      