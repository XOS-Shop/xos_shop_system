[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : blue-tabs-a
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
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
      <div style="display: none;">                     
[@{$box_search_js_check_keywords}@]                  
      </div> 
      <div>
      [@{$box_search_form_begin}@]
        <label for="box_search_keywords" id="text_for_box_search_keywords" title=" [@{#box_heading_search#}@] " style="font-family: Verdana, Arial, sans-serif; font-size: 11px; line-height: 16px; position:absolute; left:0px; top:0px; width: 121px; color: #999999; padding: 3px 0 0 3px; cursor: text; display: none;">[@{#box_heading_search#}@]</label>      
        <div style="float: left;">
          <span class="wrapper-search-keywords">
            [@{$box_search_imput_field}@]
          </span>
        </div>
        <div style="float: left;">
          <input type="image" src="[@{$images_path}@]button_quick_find.gif" alt="[@{#button_title_quick_find#}@]" title=" [@{#button_title_quick_find#}@] " />
        </div>
        <div class="header">
          <a href="[@{$box_search_link_filename_advanced_search_and_results}@]"><b>[@{#box_search_advanced_search#}@]</b></a>
        </div>
      [@{$box_search_form_end}@]
      </div>      
      <div style="width:1px; position:relative; z-index:10001; left:0px; top:-14px;">
        <div id="list-quick-search-suggest" style="position:absolute; left:0px; top:0px; margin:0; padding:0; visibility:hidden;"></div>                     
      </div>                  
      
<script type="text/javascript">
/* <![CDATA[ */
  $('#text_for_box_search_keywords').css({display:"block"});
  $('#box_search_keywords').attr({autocomplete:"off", title:" [@{#box_heading_search#}@] "});     
  $('#list-quick-search-suggest').css({'box-shadow' : '3px 3px 7px #333333', '-moz-box-shadow' : '3px 3px 7px #333333', '-webkit-box-shadow' : '3px 3px 7px #333333'});
  $('#text_for_box_search_keywords').click(function() {
    $('#text_for_box_search_keywords').css({display:"none"});
  });   
  quick_search_suggest('box_search_keywords', 'list-quick-search-suggest', '[@{$box_search_link_quick_search_suggest}@]');
/* ]]> */   
</script>                         
<!-- search_eof -->