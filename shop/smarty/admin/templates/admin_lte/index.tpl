[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.5
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : index.tpl
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
      <div class="content-wrapper">
        <section class="content-header clearfix">
          <h1 class="pull-left">[@{$project_title}@]</h1>
          <div class="pull-right" style="margin-left: 20px">[@{$form_languages_begin}@][@{$pull_down_menu_language|replace:'<select':'<select class="form-control"'}@][@{$hidden_field_session}@][@{$form_end}@]</div>
        </section>
        <section class="content">
          [@{if $message_stack_header_error}@]
          <div class="callout callout-danger" role="alert">
            [@{$message_stack_header_error}@]
          </div>                            
          [@{/if}@]
          [@{if $message_stack_header_warning}@]
          <div class="callout callout-warning" role="alert">
            [@{$message_stack_header_warning}@]
          </div>                            
          [@{/if}@]          
          [@{if $message_stack_header_success}@]
          <div class="callout callout-success" role="alert">
            [@{$message_stack_header_success}@]
          </div>                            
          [@{/if}@]                
          <div class="row">                
            <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">          
              <div class="info-box" style="position: relative;">
                <span class="info-box-icon bg-aqua" style="position: absolute; height: 100%;"><i class="fa fa-external-link-square "></i></span>
                <div class="info-box-content">
                  [@{*<b>[@{$project_title}@]</b><br>*}@]
                  [@{$box_software_content}@]
                </div>
              </div>        
            </div>
          </div>                                  
          <div class="row">
            <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
              <div class="info-box" style="position: relative;">
                <div class="info-box-icon bg-aqua" style="position: absolute; height: 100%;"><i class="fa fa-shopping-cart"></i></div>
                <div class="info-box-content">
                  <b>[@{#box_title_orders#}@]</b><br>
                  [@{$box_orders_content}@]
                </div>
              </div>
            </div>
          </div>      
          <div class="row">        
            <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
              <div class="info-box" style="position: relative;">
                <span class="info-box-icon bg-green" style="position: absolute; height: 100%;"><i class="ion ion-stats-bars"></i></span>
                <div class="info-box-content">
                  <b>[@{#box_title_statistics#}@]</b><br>
                  [@{$box_statistics_content}@]
                </div>
              </div>
            </div>
          </div>              
          <div class="row">        
            <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
              <div class="info-box" style="position: relative;"> 
                [@{if $link_ssl}@]<a href="[@{$link_ssl}@]" title="[@{$title_ssl}@]">[@{/if}@]          
                [@{if $ssl_enabled}@]
                <span class="info-box-icon bg-green" style="position: absolute; height: 100%;"><i class="fa fa-lock"></i></span>
                [@{else}@]
                <span class="info-box-icon bg-red" style="position: absolute; height: 100%;"><i class="fa fa-unlock"></i></span>
                [@{/if}@]
                <div class="info-box-content">
                  [@{$box_ssl_content}@]
                </div>
                [@{if $link_ssl}@]</a>[@{/if}@]
              </div>
            </div>
          </div>                      
        </section>
      </div> 