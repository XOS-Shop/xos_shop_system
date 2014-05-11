[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : image_processing.tpl
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

[@{if $recreate_product_images_now}@] 
        <table border="0" width="100%" cellspacing="20" cellpadding="2">
          <tr>
            <td><table class="tableRecreateImages" border="0" width="100%" cellpadding="4" cellspacing="4">
              <tr>
                <td nowrap="nowrap" width="1%"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="79" height="24" /></td>
                <td nowrap="nowrap" width="1%">[@{#text_product_images_regenerated#}@]</td>
                <td nowrap="nowrap" width="98%">&nbsp;</td>
              </tr>
              <tr>
                <td nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="79" height="24" /></td>
                <td nowrap="nowrap"><a href="[@{$link_filename_image_processing_back}@]" class="button-default" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
                <td nowrap="nowrap">&nbsp;</td>
              </tr>              
            </table></td>
          </tr>
        </table>
[@{elseif $recreate_category_images_now}@]
        <table border="0" width="100%" cellspacing="20" cellpadding="2">
          <tr>
            <td><table class="tableRecreateImages" border="0" width="100%" cellpadding="4" cellspacing="4">
              <tr>
                <td nowrap="nowrap" width="1%"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="79" height="24" /></td>
                <td nowrap="nowrap" width="1%">[@{#text_category_images_regenerated#}@]</td>
                <td nowrap="nowrap" width="98%">&nbsp;</td>
              </tr>
              <tr>
                <td nowrap="nowrap"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="79" height="24" /></td>
                <td nowrap="nowrap"><a href="[@{$link_filename_image_processing_back}@]" class="button-default" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
                <td nowrap="nowrap">&nbsp;</td>
              </tr>              
            </table></td>
          </tr>
        </table>
[@{else}@]
<!-- image_processing -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>
        </table></td>
      </tr>
  [@{if $action == 'confirm_recreate'}@]                     
      <tr>
        <td><div id="infoSend"><table border="0" width="100%" cellspacing="20" cellpadding="2">
          <tr>
            <td><table class="tableRecreateImages" border="0" width="100%" cellpadding="4" cellspacing="4">
              <tr>
                <td nowrap="nowrap" width="1%"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="50" height="24" /><img src="[@{$images_path}@]progress.gif" alt="progress" title=" progress " /></td>
                <td nowrap="nowrap" width="1%">[@{#text_please_wait#}@]</td>
                <td nowrap="nowrap" width="98%">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table></div></td>
      </tr>
  [@{else}@]      
      <tr>  
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>      
            <td>[@{$form_begin_action_confirm_recreate_product_images}@]<table border="0" width="100%" cellspacing="20" cellpadding="2">
              <tr>
                <td><table class="tableRecreateImages" border="0" width="100%" cellpadding="4" cellspacing="4">
                  <tr>
                    <td nowrap="nowrap"><a href="" onclick="if(processing_product_images.onsubmit())processing_product_images.submit(); return false" class="button-default" style="margin-left: 50px; float: left" title=" [@{#button_title_product_images_regenerate#}@] "><span>[@{#button_text_product_images_regenerate#}@]</span></a></td>
                  </tr>
                </table></td>
              </tr>
            </table>[@{$form_end}@]</td>
          </tr>
          <tr>  
            <td>[@{$form_begin_action_confirm_recreate_category_images}@]<table border="0" width="100%" cellspacing="20" cellpadding="2">
              <tr>
                <td><table class="tableRecreateImages" border="0" width="100%" cellpadding="4" cellspacing="4">
                  <tr>
                    <td nowrap="nowrap"><a href="" onclick="if(processing_category_images.onsubmit())processing_category_images.submit(); return false" class="button-default" style="margin-left: 50px; float: left" title=" [@{#button_title_category_images_regenerate#}@] "><span>[@{#button_text_category_images_regenerate#}@]</span></a></td>
                  </tr>
                </table></td>
              </tr>
            </table>[@{$form_end}@]</td> 
          </tr>
        </table></td>               
      </tr>
  [@{/if}@]            
    </table></td>
<!-- image_processing_eof --> 
[@{/if}@]
