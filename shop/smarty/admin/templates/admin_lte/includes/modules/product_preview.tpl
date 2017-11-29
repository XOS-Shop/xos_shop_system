[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : admin_lte
* version    : 1.0 for XOS-Shop version 1.0.7
* descrip    : xos-shop template for admin based on
*              AdminLTE https://github.com/almasaeed2010/AdminLTE                                                                    
* filename   : product_preview.tpl
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
<!-- product_preview -->
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
              <div class="clearfix">
                <a href="[@{$link_back}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                                                   
              </div>
              [@{foreach item=product from=$products}@]                                                                                              
              <p>&nbsp;[@{$product.lang_image}@]</p>       
              <div class="box">
                <div class="box-body">
                  <div class="form-group clearfix">
                    <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_products_price_net#}@]</b></div>
                    <div class="col-sm-6 col-xs-9">
                      <div class="input-group">
                        [@{$product.price}@]
                      </div>    
                    </div>      
                  </div>                                                                 
                  <div class="form-group clearfix">
                    <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_products_name#}@]</b></div>
                    <div class="col-sm-6 col-xs-9">
                      <div class="input-group">
                        [@{$product.name}@]<br>[@{$product.image}@]
                      </div>    
                    </div>      
                  </div>                     
                  <div class="form-group clearfix">
                    <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_products_description#}@]</b></div>
                    <div class="col-sm-6 col-xs-9">
                      <div class="input-group">
                        [@{$product.description}@]
                      </div>    
                    </div>      
                  </div>                    
                  <div class="form-group clearfix">
                    <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_products_info#}@]</b></div>
                    <div class="col-sm-6 col-xs-9">
                      <div class="input-group">
                        [@{$product.info}@]
                      </div>    
                    </div>      
                  </div> 
                  [@{if $product.info_url}@]
                  <div class="form-group clearfix">
                    <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_products_url#}@]</b></div>
                    <div class="col-sm-6 col-xs-9">
                      <div class="input-group">
                        [@{$product.info_url}@]
                      </div>    
                    </div>      
                  </div>            
                  [@{/if}@]
                  <div class="form-group clearfix">
                    <div class="col-lg-2 col-md-3 col-sm-4 control-label text-nowrap"><b>[@{#text_products_date_available#}@]</b></div>
                    <div class="col-sm-6 col-xs-9">
                      <div class="input-group">
                        [@{$product.date_available_or_date_added}@]
                      </div>    
                    </div>      
                  </div>                                                                                                  
                </div>                                                               
              </div>                            
              [@{/foreach}@]                                                                
              <a href="[@{$link_back}@]" class="btn btn-primary pull-right btn-margin-after-pagination" title=" [@{#button_title_back#}@] ">[@{#button_text_back#}@]</a>                          
            </div>            
          </div>
        </section>
      </div>    
<!-- product_preview_eof -->