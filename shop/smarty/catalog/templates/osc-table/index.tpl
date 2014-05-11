[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : osc-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : oscommerce default template with css-buttons and tables for layout                                                                     
* filename   : index.tpl
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
[@{if $display == 'categories'}@]
<!-- index_category listing -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
        [@{if $page_info == 'false' or $heading_title}@]
          <tr>
            <td class="pageHeading">[@{$heading_title|default:$category_name}@]</td>
            <td class="pageHeading" align="right">[@{$heading_image}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="60" /></td>
          </tr> 
          [@{if $category_description}@]
          <tr>
            <td colspan="2" class="main">[@{$category_description}@]</td>
          </tr>
          [@{/if}@]                              
        [@{else}@]                    
          <tr>
            <td class="main">[@{$category_description}@]</td>
          </tr>  
        [@{/if}@]       
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      [@{if $page_info == 'false'}@]
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
              [@{foreach item=categorie from=$categories}@]
                <td align="center" class="smallText" width="[@{$categorie.td_width}@]" valign="top"><a href="[@{$categorie.link_to_product_listing}@]">[@{$categorie.image}@]<br />[@{$categorie.name}@]</a></td>
              [@{if $categorie.more_rows}@]  
              </tr>
              <tr> 
              [@{/if}@]               
              [@{/foreach}@]  
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
          </tr>
          <tr>
            <td>
              [@{if $product_listing}@][@{$product_listing}@][@{else}@][@{$new_products}@][@{/if}@]
            </td>
          </tr>
        </table></td>
      </tr>
      [@{/if}@] 
    </table></td>
<!-- index_category_listing_eof -->                    
[@{elseif $display == 'products'}@]
<!-- index_product listing -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
        [@{if $page_info == 'false' or $heading_title or $manufacturer}@] 
          <tr>
            [@{if $manufacturer}@]
            <td class="pageHeading">[@{#heading_title_manufacturer#}@] [@{$heading_title}@]</td>
            [@{else}@]
            <td class="pageHeading">[@{$heading_title|default:$category_name}@]</td>
            [@{/if}@]
            <td align="right">[@{$heading_image}@]<img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="60" /></td>
          </tr>
          [@{if $category_description}@]          
          <tr>
            <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
          </tr>
          <tr>
            <td colspan="2" class="main">[@{$category_description}@]</td>
          </tr>
          [@{/if}@]                                     
        [@{else}@]
          <tr>
            <td class="main">[@{$category_description}@]</td>
          </tr>           
        [@{/if}@]                      
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      [@{if $page_info == 'false'}@]
      <tr>
        <td>
        [@{$product_listing}@]
        </td>
      </tr>
      [@{/if}@]
    </table></td>
<!-- index_product_listing_eof -->     
[@{else}@]
<!-- index_default --> 
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
     [@{if $heading_title}@]
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">          
          <tr>
            <td class="pageHeading">[@{$heading_title}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]table_background_default.gif" alt="[@{#heading_title_default#}@]" title=" [@{#heading_title_default#}@] " /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
     [@{/if}@]
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="main">[@{$content}@]</td>
          </tr>
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
          </tr>
          [@{if $heading_title}@]
          <tr>
            <td>
              [@{$new_products}@]
            </td>
          </tr>
          [@{$upcoming_products}@]
          [@{/if}@]
        </table></td>
      </tr>
    </table></td>
<!-- index_default_eof -->    
[@{/if}@]
