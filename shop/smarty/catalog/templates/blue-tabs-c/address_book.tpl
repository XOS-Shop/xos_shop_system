[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : blue-tabs-c
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : address_book.tpl
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

<!-- address_book -->  
          <div class="page-heading" style="line-height: [@{#page_heading_height#}@]px;">[@{#heading_title#}@]</div>                
          <div style="height: 10px; font-size: 0;">&nbsp;</div>                    
          [@{if $message_stack}@]
          [@{$message_stack}@]          
          <div style="height: 10px; font-size: 0;">&nbsp;</div>              
          [@{/if}@]          
          <div class="main"><b>[@{#primary_address_title#}@]</b></div>
          <div class="info-box-central-contents">
            <div class="main" style="width: 50%; padding: 4px 0 4px 16px; float: left;">[@{#primary_address_description#}@]</div>
            <div class="main" style="padding: 2px; float: right;">
              <div class="main" style="padding: 2px 14px 2px 2px; text-align: center; float: left;"><b>[@{#primary_address_title#}@]</b><br /><img src="[@{$images_path}@]arrow_south_east.gif" alt="" /></div>
              <div class="main" style="padding: 2px 16px 2px 2px; float: left;">[@{$primary_address_label}@]</div>
              <div class="clear">&nbsp;</div>                
            </div>
            <div class="clear">&nbsp;</div>
          </div>
          <div style="height: 10px; font-size: 0;">&nbsp;</div>           
          <div class="main"><b>[@{#address_book_title#}@]</b></div>         
          <div class="info-box-central-contents">
          [@{foreach item=address from=$addresses}@]
          <div style="width: 95%; padding: 2px 2px 2px 12px;">
            <div class="module-row" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
              <div class="main" style="width: 70%; padding: 2px; float: left;" onclick="document.location.href='[@{$address.link_filename_address_book_process_edit}@]'"><b>[@{$address.name}@]</b>[@{if $address.primary_address}@]&nbsp;<small><i>[@{#primary_address#}@]</i></small>[@{/if}@]</div>
              <div class="main" style="width: 12%; padding: 4px; float: left;"><a href="[@{$address.link_filename_address_book_process_edit}@]" class="button-small-edit" style="float: right" title=" [@{#small_button_title_edit#}@] "><span>[@{#small_button_text_edit#}@]</span></a></div>
              <div class="main" style="width: 12%; padding: 4px; float: left;"><a href="[@{$address.link_filename_address_book_process_delete}@]" class="button-small-delete" style="float: right" title=" [@{#small_button_title_delete#}@] "><span>[@{#small_button_text_delete#}@]</span></a></div>
              <div class="clear">&nbsp;</div>
            </div>
            <div class="main" style="padding: 2px 16px 2px 16px;">[@{$address.format_address}@]</div>
          </div>
          [@{/foreach}@]  
          </div>
          <div style="height: 10px; font-size: 0;">&nbsp;</div>          
          <div class="info-box-central-contents">                             
            <div class="main" style="margin: 4px 15px 4px 15px;">
              <a href="[@{$link_filename_account}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a>
              [@{if $link_filename_address_book_process}@]                
              <a href="[@{$link_filename_address_book_process}@]" class="button-add-address" style="float: right" title=" [@{#button_title_add_address#}@] "><span>[@{#button_text_add_address#}@]</span></a>              
              [@{/if}@]                                                                                                                                
              <div class="clear">&nbsp;</div>                    
            </div>
          </div>                        
          <div style="height: 10px; font-size: 0;">&nbsp;</div>       
          <div class="small-text"><span class="red-mark"><b>[@{#text_maximum_entries_1#}@]</b></span> [@{eval var=#text_maximum_entries_2#}@]</div>
<!-- address_book_eof -->
