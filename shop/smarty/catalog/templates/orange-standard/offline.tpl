[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-standard
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with div/css layout                                                                     
* filename   : offline.tpl
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

<!-- offline -->
    [@{$form_begin}@]
          <div style="height: 100px; font-size: 0;">&nbsp;</div>
          [@{if $message_stack}@]          
          [@{$message_stack}@]               
          <div style="height: 10px; font-size: 0;">&nbsp;</div> 
          [@{else}@]
          <div style="height: 26px; font-size: 0;">&nbsp;</div>          
          [@{/if}@]           
          <div class="info-box-central-contents"> 
            <div style="padding: 5px 5px 52px 5px; text-align: right;">[@{$language_str}@]</div>
            <div class="main"  style="padding: 2px 2px 52px 2px; text-align: center;"><b>[@{#text_offline#}@]</b></div>
            <fieldset>
              <label class="main" style="padding: 4px; width: 100px; float: left; display: block;" for="email_address">[@{#entry_email_address#}@]</label>
              <div class="main" style="padding: 4px; float: left;">[@{$input_field_email_address}@]</div>
              <div class="clear">&nbsp;</div>              
              <label class="main" style="padding: 0 4px 4px 4px; width: 100px; float: left; display: block;" for="password">[@{#entry_password#}@]</label>
              <div class="main" style="padding:  0 4px 4px 4px; float: left;">[@{$input_field_password}@]</div>
              <div class="clear">&nbsp;</div>                        
            </fieldset>
            <div class="main" style="padding: 14px 0 0 4px">
              <script type="text/javascript">
              /* <![CDATA[ */
                document.write('<a href="" onclick="offline.submit(); return false" class="button-login" style="float: left" title=" [@{#button_title_login#}@] "><span>[@{#button_text_login#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
              /* ]]> */  
              </script>
              <noscript>
                <input type="submit" value="[@{#button_text_login#}@]" />
              </noscript>  
            </div>
            <div class="clear">&nbsp;</div>
            <div style="height: 5px; font-size: 0;">&nbsp;</div>
          </div>                  
    [@{$form_end}@]
<!-- offline_eof -->
