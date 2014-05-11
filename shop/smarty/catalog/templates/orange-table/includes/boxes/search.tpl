[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with css-buttons and tables for layout                                                                     
* filename   : search.tpl
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

<!-- search -->
      <tr style="display: none;">
        <td>                       
[@{$box_search_js_check_keywords}@]                  
        </td>
      </tr> 
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="info-box-heading"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="6" height="18" /></td>
              <td width="100%" class="info-box-heading">[@{#box_heading_search#}@]</td>
              <td class="info-box-heading" nowrap="nowrap"></td>
            </tr>
          </table>
          <table border="0" width="100%" cellspacing="0" cellpadding="1" class="info-box" style="background: #000000;">
            <tr>
              <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="info-box-contents" style="background: #d8d8d8;">
                <tr>
                  <td class="box-text">[@{$box_search_form_begin}@]<span class="wrapper-search-keywords">[@{$box_search_imput_field}@]</span><input type="image" src="[@{$images_path}@]button_quick_find.gif" alt="[@{#button_title_quick_find#}@]" title=" [@{#button_title_quick_find#}@] " /><br /><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="7" /><br /><a href="[@{$box_search_link_filename_advanced_search_and_results}@]"><b>[@{#box_search_advanced_search#}@]</b></a>[@{$box_search_form_end}@]</td>
                </tr>
              </table></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>      
          <div style="width:1px; position:relative; z-index:10001; left:129px; top:-21px;">
            <div id="list-quick-search-suggest" style="position:absolute; right:0px; top:0px; margin:0; padding:0; visibility:hidden;"></div>                     
          </div>
        </td>
      </tr>
      <tr style="display: none;">
        <td>                       
<script type="text/javascript">
/* <![CDATA[ */
  $('#box_search_keywords').attr({ autocomplete:"off" });
  $('#list-quick-search-suggest').css({'box-shadow' : '3px 3px 7px #333333', '-moz-box-shadow' : '3px 3px 7px #333333', '-webkit-box-shadow' : '3px 3px 7px #333333'});
  quick_search_suggest('box_search_keywords', 'list-quick-search-suggest', '[@{$box_search_link_quick_search_suggest}@]');
/* ]]> */   
</script>                 
        </td>
      </tr>      
<!-- search_eof -->
