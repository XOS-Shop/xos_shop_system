[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : define_language.tpl
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

<!-- define_language -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td>[@{$form_begin_language}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
            <td class="pageHeading" align="right">[@{$pull_down_lngdir}@]</td>
          </tr>
        </table>[@{$hidden_field_session}@][@{$form_end}@]</td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">       
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left">&nbsp;</td> 
          </tr>               
        [@{if $file_edit}@]
          [@{if $file_exists}@]        
          <tr class="dataTableRow">
            <td width="100%">[@{$form_begin_save}@]<table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><b>[@{$filename}@]</b></td>
              </tr>
              <tr>
                <td class="main">[@{$textarea_file_contents}@]</td>
              </tr>
              <tr>
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr>
                [@{if $file_writeable}@]
                <td nowrap="nowrap" class="main" align="right"><a href="[@{$link_filename_define_language}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a><a href="" onclick="define_lng.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_save#}@] "><span>[@{#button_text_save#}@]</span></a></td>
                [@{else}@]
                <td nowrap="nowrap" class="main" align="right">[@{$file_not_writeable}@]&nbsp;<br />&nbsp;<br /><a href="[@{$link_filename_define_language}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
                [@{/if}@] 
              </tr>
            </table>[@{$form_end}@]</td>
          </tr>
          [@{else}@]          
          <tr class="dataTableRow">
            <td class="main"><b>[@{#text_file_does_not_exist#}@]</b></td>
          </tr>
          <tr class="dataTableRow">
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
          </tr>
          <tr class="dataTableRow">
            <td nowrap="nowrap"><a href="[@{$link_filename_define_language}@]" class="button-default" style="margin-left: 5px; float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
          </tr>          
          [@{/if}@]
        [@{else}@]               
          <tr class="dataTableRow">
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="smallText"><a href="[@{$link_filename_define_language_filename_conf}@]"><b>[@{$filename_conf}@]</b></a></td>
              </tr>            
              <tr>
                <td class="smallText"><a href="[@{$link_filename_define_language_filename_email_conf}@]"><b>[@{$filename_email_conf}@]</b></a></td>
              </tr>            
              <tr>
                <td class="smallText"><a href="[@{$link_filename_define_language_filename}@]"><b>[@{$filename}@]</b></a></td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="6" /></td>
              </tr>             
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="4" /></td>
              </tr>                           
            [@{foreach name=loop item=file from=$files}@]
              [@{if (($smarty.foreach.loop.iteration-1)%2) == 0}@]
              <tr>
              [@{/if}@]                      
                <td class="smallText"><a href="[@{$file.link_filename_define_language_filename}@]">[@{$file.filename}@]</a></td>
              [@{if ((($smarty.foreach.loop.iteration)%2) == 0) or $smarty.foreach.loop.last}@]
              </tr>  
              [@{/if}@]
            [@{/foreach}@]
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="6" /></td>
              </tr>             
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="4" /></td>
              </tr>                          
            [@{foreach name=loop item=file_order_total from=$files_order_total}@]
              [@{if (($smarty.foreach.loop.iteration-1)%2) == 0}@]
              <tr>
              [@{/if}@]                      
                <td class="smallText"><a href="[@{$file_order_total.link_filename_define_language_filename}@]">[@{$file_order_total.filename}@]</a></td>
              [@{if ((($smarty.foreach.loop.iteration)%2) == 0) or $smarty.foreach.loop.last}@]
              </tr>  
              [@{/if}@]
            [@{/foreach}@]
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="6" /></td>
              </tr>             
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="4" /></td>
              </tr>                          
            [@{foreach name=loop item=file_payment from=$files_payment}@]
              [@{if (($smarty.foreach.loop.iteration-1)%2) == 0}@]
              <tr>
              [@{/if}@]                      
                <td class="smallText"><a href="[@{$file_payment.link_filename_define_language_filename}@]">[@{$file_payment.filename}@]</a></td>
              [@{if ((($smarty.foreach.loop.iteration)%2) == 0) or $smarty.foreach.loop.last}@]
              </tr>  
              [@{/if}@]
            [@{/foreach}@] 
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="6" /></td>
              </tr>             
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_black.gif" alt="" width="100%" height="1" /></td>
              </tr>
              <tr>
                <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="4" /></td>
              </tr>                          
            [@{foreach name=loop item=file_shipping from=$files_shipping}@]
              [@{if (($smarty.foreach.loop.iteration-1)%2) == 0}@]
              <tr>
              [@{/if}@]                      
                <td class="smallText"><a href="[@{$file_shipping.link_filename_define_language_filename}@]">[@{$file_shipping.filename}@]</a></td>
              [@{if ((($smarty.foreach.loop.iteration)%2) == 0) or $smarty.foreach.loop.last}@]
              </tr>  
              [@{/if}@]
            [@{/foreach}@]                         
            </table></td>
          </tr>
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
          </tr>
          <tr>
            <td nowrap="nowrap" align="right"><a href="[@{$link_filename_file_manager}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_file_manager#}@] "><span>[@{#button_text_file_manager#}@]</span></a></td>
          </tr>          
        [@{/if}@]                    
        </table></td>
      </tr>
    </table></td>
<!-- define_language_eof -->
