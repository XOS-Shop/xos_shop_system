[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : sandstone-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.3
* descrip    : xos-shop default template built with Bootstrap3                                                                    
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
[@{$header_message_stack_output}@]
<nav class="navbar navbar-default navbar-static-top" style="z-index: 1001;">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Navigation ein-/ausblenden</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="[@{$header_link_filename_default}@]">
        <span class="glyphicon glyphicon-home" title=" [@{$header_store_name}@] [@{$smarty.const.HEADER_TITLE_HOME}@]"></span>
      </a>      
    </div>       
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      
      [@{$box_categories}@] 
      [@{$box_search}@] 
<!-- logoff -->     
      [@{if $is_shop && $header_link_filename_logoff}@]       
          <ul class="nav navbar-nav navbar-right">
            <li class="visible-xs">
              <a href="[@{$header_link_filename_logoff}@]">[@{#header_title_logoff#}@]</a>  
            </li>                      
            <li id="logoff_box" class="dropdown hidden-xs">
              <a class="dropdown-toggle navbar-brand" role="button" aria-expanded="false">
                <span class="glyphicon glyphicon-log-out"></span>
              </a>
              <ul id="logoff_contents" class="dropdown-menu" role="menu">
                <li>
                  <div class="box-logoff_contents">                 
                    <a href="[@{$header_link_filename_logoff}@]">[@{#header_title_logoff#}@]</a> 
                  </div>                                    
                  <script type="text/javascript">
                    $('#logoff_contents').css('display','none');                                                     
                    $('#logoff_box').mouseleave(function(){
                      $('#logoff_contents').css('display','none');
                    }).mouseenter(function(){               
                      $('#logoff_contents').show(400); 
                    });                                                  
                  </script>                                         
                </li>
              </ul>
            </li>
          </ul>                    
      [@{/if}@]
<!-- logoff_eof -->             
      [@{$box_languages}@]
      [@{$box_currencies}@] 
      [@{$box_login_my_account}@]
      [@{$box_shopping_cart}@]      
    </div>
  </div>
</nav>
[@{if $header_banner_header}@]
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      [@{$header_banner_header}@]
    </div>  
  </div>   
</div>
[@{/if}@]
<div class="container">
  <div class="row">
    <div class="col-xs-12">
    [@{if $header_banner_logo}@]
      [@{$header_banner_logo}@]
    [@{else}@]
      <a href="[@{$header_link_filename_default}@]"><img class="img-responsive" src="[@{$images_path}@]shop_logo.gif" alt="[@{$header_store_name}@]" title=" [@{$header_store_name}@] " /></a>
    [@{/if}@]
    </div>  
  </div>   
</div>