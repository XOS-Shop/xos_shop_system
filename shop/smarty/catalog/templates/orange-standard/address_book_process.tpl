[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-standard
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with div/css layout                                                                     
* filename   : address_book_process.tpl
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

<!-- address_book_process -->
[@{if $delete_address}@]
          <div class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title_delete_entry#}@]</div>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div>                    
          [@{if $message_stack}@]
          [@{$message_stack}@]          
          <div style="height: 10px; font-size: 0;">&nbsp;</div>              
          [@{/if}@]
          <div class="main"><b>[@{#delete_address_title#}@]</b></div>
          <div class="info-box-central-contents">
            <div class="main" style="width: 50%; padding: 4px 0 4px 16px; float: left;">[@{#delete_address_description#}@]</div>
            <div class="main" style="padding: 2px; float: right;">
              <div class="main" style="padding: 2px 14px 2px 2px; text-align: center; float: left;"><b>[@{#selected_address#}@]</b><br /><img src="[@{$images_path}@]arrow_south_east.gif" alt="" /></div>
              <div class="main" style="padding: 2px 16px 2px 2px; float: left;">[@{$address_label}@]</div>
              <div class="clear">&nbsp;</div>                
            </div>
            <div class="clear">&nbsp;</div>
          </div>
          <div style="height: 10px; font-size: 0;">&nbsp;</div>
          <div class="info-box-central-contents">                             
            <div class="main" style="margin: 4px 15px 4px 15px;">
              <a href="[@{$link_filename_address_book}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a>
              <a href="[@{$link_filename_address_book_process_delete}@]" class="button-delete" style="float: right" title=" [@{#button_title_delete#}@] "><span>[@{#button_text_delete#}@]</span></a>                                                                                                                                 
              <div class="clear">&nbsp;</div>                    
            </div>             
          </div>                     
[@{elseif $edit_address}@]
    [@{$form_begin}@]
          <div class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title_modify_entry#}@]</div>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div>                    
          [@{if $message_stack}@]
          [@{$message_stack}@]          
          <div style="height: 10px; font-size: 0;">&nbsp;</div>              
          [@{/if}@]
          <div>
          [@{$address_book_details}@]
          </div>
          <div style="height: 10px; font-size: 0;">&nbsp;</div>           
          <div class="info-box-central-contents">                             
            <div class="main" style="margin: 4px 15px 4px 15px;">
              <div style="float: left;">
                <a href="[@{$link_filename_address_book}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a>
              </div>
              <div style="float: right;">[@{$hidden_field_update}@][@{$hidden_field_edit}@]
                <script type="text/javascript">
                /* <![CDATA[ */
                  document.write('<a href="" onclick="if(addressbook.onsubmit())addressbook.submit(); return false" class="button-update" style="float: left" title=" [@{#button_title_update#}@] "><span>[@{#button_text_update#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
                /* ]]> */  
                </script>
                <noscript>
                  <input type="submit" value="[@{#button_text_update#}@]" />
                </noscript>                             
              </div>                                                                                                                                 
              <div class="clear">&nbsp;</div>                    
            </div>             
          </div>     
    [@{$form_end}@]
[@{else}@]
    [@{$form_begin}@]
          <div class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title_add_entry#}@]</div>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div>                    
          [@{if $message_stack}@]
          [@{$message_stack}@]          
          <div style="height: 10px; font-size: 0;">&nbsp;</div>              
          [@{/if}@]
          <div>
          [@{$address_book_details}@]
          </div>
          <div style="height: 10px; font-size: 0;">&nbsp;</div>           
          <div class="info-box-central-contents">                             
            <div class="main" style="margin: 4px 15px 4px 15px;">
              <div style="float: left;">
                <a href="[@{$link_back}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a>
              </div>
              <div style="float: right;">[@{$hidden_field_process}@]
                <script type="text/javascript">
                /* <![CDATA[ */
                  document.write('<a href="" onclick="if(addressbook.onsubmit())addressbook.submit(); return false" class="button-continue" style="float: left" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
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
[@{/if}@]
<!-- address_book_process_eof -->
    
