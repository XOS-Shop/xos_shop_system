[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : dark-tabs
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop extra template with tabs navigation
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
          <div class="rt-gray">
	    <div class="lt-gray">
              <div class="rb">
                <div class="lb">
                  <div class="box-content">
                    <h3 id="info-box-heading-search"><label for="box_search_keywords">[@{#box_heading_search#}@]</label></h3>
                    <div class="info-box-contents" style="background : #fff; padding: 4px 0 1px 2px; position:relative;">[@{$box_search_form_begin}@]<span class="wrapper-search-keywords">[@{$box_search_imput_field}@]</span><input type="image" src="[@{$images_path}@]button_quick_find.gif" alt="[@{#button_title_quick_find#}@]" title=" [@{#button_title_quick_find#}@] " /><div style="height: 1px; font-size: 0;">&nbsp;</div><a href="[@{$box_search_link_filename_advanced_search_and_results}@]"><b>[@{#box_search_advanced_search#}@]</b></a>[@{$box_search_form_end}@]</div>                    
                  </div>
                </div>
              </div>
	    </div>
          </div>
          <div class="clear">&nbsp;</div>
          <div style="width:1px; position:relative; z-index:10001; left:132px; top:-20px;">
            <div id="list-quick-search-suggest" style="position:absolute; right:0px; top:0px; margin:0; padding:0; visibility:hidden;"></div>                     
          </div>
<script type="text/javascript">
/* <![CDATA[ */
  $('#box_search_keywords').attr({ autocomplete:"off" });
  $('#list-quick-search-suggest').css({'box-shadow' : '3px 3px 7px #333333', '-moz-box-shadow' : '3px 3px 7px #333333', '-webkit-box-shadow' : '3px 3px 7px #333333'});
  quick_search_suggest('box_search_keywords', 'list-quick-search-suggest', '[@{$box_search_link_quick_search_suggest}@]');
/* ]]> */   
</script>                         
<!-- search_eof -->
