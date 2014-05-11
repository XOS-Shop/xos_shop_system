[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with css-buttons and tables for layout                                                                     
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
    <td width="100%" valign="top">[@{$form_begin}@][@{$hide_session_id}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="page-heading">[@{#heading_title_1#}@]</td>
            <td class="page-heading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#page_heading_width#}@]" height="[@{#page_heading_height#}@]" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr> 
      [@{if $message_stack}@]
      <tr>
        <td>[@{$message_stack}@]</td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>      
      [@{/if}@]
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td height="14" class="info-box-heading"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="11" height="14" /></td>
            <td width="100%" height="14" class="info-box-heading">[@{#heading_search_criteria#}@]</td>
            <td height="14" class="info-box-heading" nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="11" height="14" /></td>
          </tr>
        </table>
        <table border="0" width="100%" cellspacing="0" cellpadding="1" class="info-box-central">
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="info-box-central-contents">
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="1" /></td>
              </tr>
              <tr>
                <td class="box-text"><span class="wrapper-advanced-search-keywords">[@{$input_field_keywords}@]</span></td>
              </tr>
              <tr>
                <td align="right" class="box-text">[@{$checkbox_search_in_description}@][@{#text_search_in_description#}@]</td>
              </tr>
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="1" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="small-text">
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
            </td>
            <td nowrap="nowrap" class="small-text" align="right">
              <a href="[@{$link_filename_advanced_search_and_results}@]" class="button-reset" style="margin-left: 15px; float: right" title=" [@{#button_title_reset#}@] "><span>[@{#button_text_reset#}@]</span></a>                                   
              <script type="text/javascript">
              /* <![CDATA[ */
                document.write('<a href="" onclick="if(advanced_search_and_results.onsubmit())advanced_search_and_results.submit(); return false" class="button-search" style="float: right" title=" [@{#button_title_search#}@] "><span>[@{#button_text_search#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
              /* ]]> */  
              </script>
              <noscript>
                <input style="margin-left: 15px; float: right" type="submit" value="[@{#button_text_search#}@]" />
              </noscript>
            </td>                                                                                 
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="field-key" width="35%">[@{#entry_categories#}@]</td>
                <td class="field-value" width="65%">[@{$categories_pull_down_menu}@]</td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
              </tr>
              <tr>
                <td class="field-key">[@{#entry_manufacturers#}@]</td>
                <td class="field-value">[@{$manufacturers_pull_down_menu}@]</td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
              </tr>
              <tr>
                <td class="field-key">[@{#entry_price_from#}@]</td>
                <td class="field-value">[@{$input_field_pfrom}@]</td>
              </tr>
              <tr>
                <td class="field-key">[@{#entry_price_to#}@]</td>
                <td class="field-value">[@{$input_field_pto}@]</td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
              </tr>
              <tr>
                <td class="field-key">[@{#entry_date_from#}@]</td>
                <td class="field-value">[@{$input_field_dfrom}@]</td>
              </tr>
              <tr>
                <td class="field-key">[@{#entry_date_to#}@]</td>
                <td class="field-value">[@{$input_field_dto}@]</td>
              </tr>              
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table>[@{$form_end}@]
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr id="advanced-search-and-results-heading">
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="page-heading">[@{#heading_title_2#}@]</td>
            <td class="page-heading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#page_heading_width#}@]" height="[@{#page_heading_height#}@]" /></td>
          </tr>
        </table></td>
      </tr>
      <tr style="display: none;">
        <td>                       
        <script type="text/javascript">
        /* <![CDATA[ */
          document.getElementById("advanced-search-and-results-heading").style.display = "none";
        /* ]]> */  
        </script>                  
        </td>
      </tr>       
      <tr>
        <td>[@{$product_listing}@]</td>
      </tr>
    </table></td>    
<!-- advanced_search_and_results_eof -->
