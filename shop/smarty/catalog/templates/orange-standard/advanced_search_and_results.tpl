[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-standard
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with div/css layout                                                                     
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
          [@{$form_begin}@][@{$hide_session_id}@]
          <div class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title_1#}@]</div>        
          <div style="height: 10px; font-size: 0;">&nbsp;</div>

          [@{if $message_stack}@]
          [@{$message_stack}@]
          
          <div style="height: 10px; font-size: 0;">&nbsp;</div> 
              
          [@{/if}@]
          
          <fieldset>
          <div class="info-box-heading"><label for="keywords">[@{#heading_search_criteria#}@]</label></div>
          <div class="info-box-central-contents" style="padding: 8px 3px 8px 3px;">
            <div class="box-text"><span class="wrapper-advanced-search-keywords">[@{$input_field_keywords}@]</span></div>
            <div class="box-text" style="text-align: right;">[@{$checkbox_search_in_description}@]<label for="search_in_description">[@{#text_search_in_description#}@]</label></div>
          </div>
          </fieldset>
          
          <div style="height: 10px; font-size: 0;">&nbsp;</div>

          <div class="small-text" style="padding: 0 0 0 1px; float: left; white-space: nowrap;">
            [@{if $link_filename_popup_content_8}@]            
            <script type="text/javascript">
            /* <![CDATA[ */            
              document.write('<a href="[@{$link_filename_popup_content_8}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_search_help_link#}@]</span> [?]</a>');
            /* ]]> */   
            </script>
            <noscript>
              <a href="[@{$link_filename_popup_content_8}@]" target="_blank"><span class="text-deco-underline">[@{#text_search_help_link#}@]</span> [?]</a>
            </noscript>
            [@{/if}@]            
            </div>
            <div class="small-text" style="padding: 0 1px 0 0; white-space: nowrap;">
              <a href="[@{$link_filename_advanced_search_and_results}@]" class="button-reset" style="margin-left: 15px; float: right" title=" [@{#button_title_reset#}@] "><span>[@{#button_text_reset#}@]</span></a>                                   
              <script type="text/javascript">
              /* <![CDATA[ */
                document.write('<a href="" onclick="if(advanced_search_and_results.onsubmit())advanced_search_and_results.submit(); return false" class="button-search" style="float: right" title=" [@{#button_title_search#}@] "><span>[@{#button_text_search#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
              /* ]]> */  
              </script>
              <noscript>
                <input style="margin-left: 15px; float: right" type="submit" value="[@{#button_text_search#}@]" />
              </noscript>
          </div>
          <div class="clear">&nbsp;</div>                                                                                 

          <div style="height: 10px; font-size: 0;">&nbsp;</div>

        
          <fieldset>          
          <div class="info-box-central-contents">
            
            <label class="field-key" for="categories_or_pages_id">[@{#entry_categories#}@]</label>
            <div class="field-value">[@{$categories_pull_down_menu}@]</div>
            <div class="clear">&nbsp;</div>

            <div style="height: 10px; font-size: 0;">&nbsp;</div>
            
            <label class="field-key" for="manufacturers_id">[@{#entry_manufacturers#}@]</label>
            <div class="field-value">[@{$manufacturers_pull_down_menu}@]</div>
            <div class="clear">&nbsp;</div>              
            
            <div style="height: 10px; font-size: 0;">&nbsp;</div>
            
            <label class="field-key" for="pfrom">[@{#entry_price_from#}@]</label>
            <div class="field-value">[@{$input_field_pfrom}@]</div>
            <div class="clear">&nbsp;</div>              

            <label class="field-key" for="pto">[@{#entry_price_to#}@]</label>
            <div class="field-value">[@{$input_field_pto}@]</div>
            <div class="clear">&nbsp;</div>                
            
            <div style="height: 10px; font-size: 0;">&nbsp;</div>
            
            <label class="field-key" for="id_dfrom">[@{#entry_date_from#}@]</label>
            <div class="field-value">[@{$input_field_dfrom}@]</div>
            <div class="clear">&nbsp;</div> 

            <label class="field-key" for="id_dto">[@{#entry_date_to#}@]</label>
            <div class="field-value">[@{$input_field_dto}@]</div>
            <div class="clear">&nbsp;</div> 
                                                               
          </div>
          </fieldset>   
          [@{$form_end}@]
          <div id="advanced-search-and-results-heading" class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title_2#}@]</div> 
<script type="text/javascript">
/* <![CDATA[ */
  document.getElementById("advanced-search-and-results-heading").style.display = "none";
/* ]]> */  
</script>                    
          <div style="padding: 0 0 10px 0;">[@{$product_listing}@]</div>         
<!-- advanced_search_and_results_eof -->
