[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : blue-tabs-c-html5
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : account_newsletters.tpl
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

<!-- account_newsletters -->
    [@{$form_begin}@][@{$hidden_field}@]
          <div class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title#}@]</div>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div>            
          <div class="main"><b>[@{#my_newsletters_title#}@]</b></div>
          <div class="info-box-central-contents" style="padding: 2px 12px 2px 12px;">            
            <div class="module-row" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="checkBox('newsletter_general')">
              <div class="main" style="padding: 4px;">[@{$checkbox_field}@]&nbsp;<b>[@{#my_newsletters_general_newsletter#}@]</b></div>
            </div>
            <div class="main" style="padding: 2px 28px 4px 28px;">[@{#my_newsletters_general_newsletter_description#}@]</div>
          </div>
          <div style="height: 10px; font-size: 0;">&nbsp;</div>          
          <div class="info-box-central-contents">                             
            <div class="main" style="margin: 4px 15px 4px 15px;">
              <div style="float: left;">
                <a href="[@{$link_filename_account}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a>
              </div>
              <div style="float: right;">                                
                <script type="text/javascript">
                /* <![CDATA[ */
                  document.write('<a href="" onclick="account_newsletter.submit(); return false" class="button-continue" style="float: left;" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
                /* ]]> */  
                </script>
                <noscript>
                  <input type="submit" value="[@{#button_text_continue#}@]" />
                </noscript> 
              </div>                                                                                                                                 
              <div class="clear">&nbsp;</div>                    
            </div>             
          </div>     
    [@{$form_end}@]
<!-- account_newsletters_eof -->
