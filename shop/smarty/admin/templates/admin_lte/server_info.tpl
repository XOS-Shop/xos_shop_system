[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.8
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : server_info.tpl
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
<!-- server_info -->
      <div class="content-wrapper">
        <section class="content-header">
          <h1>[@{#heading_title#}@]</h1>
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
            <div class="col-xs-12">                                 
              <div class="box">
                <div class="box-body table-responsive">
                  <table>
                    <tr>
                      <td colspan="2"><div style="padding: 2px; border-color: #ff7c2a; border-style: solid; border-width: 1px"><a href="http://www.xos-shop.com"><img src="[@{$images_path}@][@{$project_logo}@]" alt="[@{$project_title}@]" title=" [@{$project_title}@] " /></a><h2 style="font-family: sans-serif;">[@{$project_version}@]</h2></div></td>
                    </tr>                  
                    <tr>
                      <td><b>[@{#title_server_host#}@]</b></td>
                      <td>[@{$system.host}@] ([@{$system.ip}@])</td>
                    </tr>
                    <tr>
                      <td><b>[@{#title_server_os#}@]</b></td>
                      <td>[@{$system.system}@] [@{$system.kernel}@]</td>
                    </tr>
                    <tr>
                      <td><b>[@{#title_server_date#}@]</b></td>
                      <td>[@{$system.date}@]</td>
                    </tr>
                    <tr>
                      <td><b>[@{#title_server_up_time#}@]</b></td>
                      <td>[@{$system.uptime}@]</td>
                    </tr>
                    <tr>
                      <td><b>[@{#title_http_server#}@]</b></td>
                      <td>[@{$system.http_server}@]</td>
                    </tr>                    
                    <tr>
                      <td><b>[@{#title_database_host#}@]</b></td>
                      <td>[@{$system.db_server}@] ([@{$system.db_ip}@])</td>
                    </tr>
                    <tr>
                      <td><b>[@{#title_database#}@]</b></td>
                      <td>[@{$system.db_version}@]</td>
                    </tr>
                    <tr>
                      <td><b>[@{#title_database_date#}@]</b></td>
                      <td>[@{$system.db_date}@]</td>
                    </tr>                                        
                    <tr>
                      <td><b>[@{#title_php_version#}@]</b></td>
                      <td>[@{$system.php}@] ([@{#title_zend_version#}@] [@{$system.zend}@])</td>
                    </tr>            
                  </table>
                  <br>
                  [@{$phpinfo}@]            
                </div>
              </div>                            
            </div>             
          </div>
        </section>        
      </div>    
<!-- server_info_eof -->