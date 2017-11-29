[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.7
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
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
[@{$html_header}@]
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>XOS-Shop Admin</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p><b>[@{#heading_title#}@]</b></p>
    <p>[@{#text_main#}@]</p>         
    <div class="row">              
      <div class="col-lg-offset-7 col-md-offset-7 col-sm-offset-6 col-lg-5 col-md-5 col-sm-6 col-xs-12">
        <a href="[@{$link_filename_login}@]" class="btn btn-primary btn-block btn-flat" title=" [@{#text_relogin#}@] ">[@{#button_text_back#}@]</a>
      </div>
    </div>  
  </div>
</div>
</body>
</html>