[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : cosmo-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.5
* descrip    : xos-shop template built with Bootstrap3 and theme cosmo                                                                    
* filename   : advanced_search_and_results.tpl
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

<!-- advanced_search_and_results -->
          <div id="advanced-search-and-results-forms">
            [@{$form_begin}@][@{$hide_session_id}@]
            <h1 class="text-orange">[@{#heading_title_1#}@]</h1>                  
            [@{if $message_stack_error}@]
            <div class="alert alert-danger" role="alert">
              [@{$message_stack_error}@]
            </div>                            
            [@{/if}@]
            [@{if $message_stack_warning}@]
            <div class="alert alert-warning" role="alert">
              [@{$message_stack_warning}@]
            </div>                            
            [@{/if}@]          
            [@{if $message_stack_success}@]
            <div class="alert alert-success" role="alert">
              [@{$message_stack_success}@]
            </div>                            
            [@{/if}@]                    
            <fieldset> 
              <div class="row">            
                <div class="col-sm-7 form-group">
                  <label class="control-label" for="keywords">[@{#heading_search_criteria#}@]:</label>
                  [@{$input_field_keywords}@]                
                </div> 
                <div class="col-sm-5" style=""> 
                  <p class="hidden-xs">&nbsp;</p>
                  <div class="checkbox" style="">
                    <label>
                      [@{$checkbox_search_in_description}@]
                      [@{#text_search_in_description#}@]
                    </label>
                  </div>
                </div>
              </div>  
              <div class="row">           
                <div class="col-sm-6 col-lg-5 form-group">
                  <label class="control-label" for="categories_or_pages_id">[@{#entry_categories#}@]</label>
                  [@{$categories_pull_down_menu}@]  
                </div>            
                <div class="col-sm-6 col-lg-5 col-lg-offset-1 form-group">
                  <label class="control-label" for="manufacturers_id">[@{#entry_manufacturers#}@]</label>
                  [@{$manufacturers_pull_down_menu}@]
                </div>
              </div> 
              <div class="row">                             
                <div class="col-sm-6 col-lg-5 form-group">
                  <label class="control-label" for="pfrom">[@{#entry_price_from#}@]</label>
                  [@{$input_field_pfrom}@]
                </div>           
                <div class="col-sm-6 col-lg-5 col-lg-offset-1 form-group">
                  <label class="control-label" for="pto">[@{#entry_price_to#}@]</label>
                  [@{$input_field_pto}@]
                </div>
              </div> 
              <div class="row">                                          
                <div class="col-sm-6 col-lg-5 form-group">
                  <label class="control-label" for="id_dfrom">[@{#entry_date_from#}@]</label>
                  [@{$input_field_dfrom}@]
                </div>               
                <div class="col-sm-6 col-lg-5 col-lg-offset-1 form-group">
                  <label class="control-label" for="id_dto">[@{#entry_date_to#}@]</label>
                  [@{$input_field_dto}@]
                </div>
              </div>    
            </fieldset>                                                                                                    
            <div class="well well-sm clearfix">          
              <div class="pull-left" style="padding: 6px 0 6px 0;">
                [@{if $link_filename_popup_content_9}@]            
                <a href="[@{$link_filename_popup_content_9}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_search_help_link#}@]</span> [?]</a>
                [@{/if}@]            
              </div>
              <div class="pull-right">
                <a href="[@{$link_filename_advanced_search_and_results}@]" class="btn btn-warning  pull-right" style="margin-left: 15px;" title=" [@{#button_title_reset#}@] ">[@{#button_text_reset#}@]</a>                                   
                <input class="btn btn-success pull-right" type="submit" value="[@{#button_text_search#}@]" /> 
              </div>
            </div>                      
            [@{$form_end}@]
          </div>
          <div id="advanced-search-and-results-heading">
          <div class="text-right text-nowrap"><a style="cursor: pointer; display: none;" id="toggle_forms">[@{#text_search_criteria_show_hide#}@]</a></div>
          <h1 class="text-orange text-left">[@{#heading_title_2#}@]</h1>
          </div>
<script type="text/javascript">
  document.getElementById("advanced-search-and-results-heading").style.display = "none";
</script>                     
          <div>[@{$product_listing}@]</div>
          <div class="div-spacer-h10"></div>                
<!-- advanced_search_and_results_eof -->
