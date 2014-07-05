[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : osc-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7t
* descrip    : oscommerce default template with css-buttons and tables for layout                                                                     
* filename   : reviews.tpl
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

<!-- reviews -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]table_background_reviews_new.gif" alt="[@{#heading_title#}@]" title=" [@{#heading_title#}@] " /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
        [@{if $reviews}@]
          [@{if $nav_bar_top}@]        
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td nowrap="nowrap" class="smallText">[@{$nav_bar_number}@]</td>
                <td nowrap="nowrap" align="right" class="smallText">[@{$nav_bar_result}@]</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
          </tr> 
          [@{/if}@]
          [@{foreach item=review from=$reviews_array}@]          
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><a href="[@{$review.link_filename_product_reviews_info}@]"><span class="text-deco-underline"><b>[@{$review.products_name}@]</b></span></a><span class="smallText"> [@{eval var=#text_review_by#}@]</span></td>
                <td class="smallText" align="right">[@{eval var=#text_review_date_added#}@]</td>
              </tr>
            </table></td>
          </tr>          
          <tr>
            <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
              <tr class="infoBoxContents">
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                    <td width="10" align="center" valign="top" class="main"><a href="[@{$review.link_filename_product_reviews_info}@]">[@{$review.products_image}@]</a></td>
                    <td valign="top" class="main">[@{$review.review_text|truncate:90:'...':false}@]<br /><br /><i>[@{#text_review_rating#}@] [@{$review.stars_image}@] [[@{eval var=#text_of_5_stars#}@]]</i></td>
                    <td width="10" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
          </tr> 
          [@{/foreach}@]
          [@{if $nav_bar_bottom}@]
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td nowrap="nowrap" class="smallText">[@{$nav_bar_number}@]</td>
                <td nowrap="nowrap" align="right" class="smallText">[@{$nav_bar_result}@]</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
          </tr>
          [@{/if}@]
        [@{else}@]
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="1" class="infoBox">
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
                  <tr>
                    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="1" /></td>
                  </tr>
                  <tr>
                    <td class="boxText">[@{#text_no_reviews#}@]</td>
                  </tr>
                  <tr>
                    <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="1" /></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
          </tr>          
        [@{/if}@]  
        </table></td>
      </tr>
    </table></td>
<!-- reviews_eof -->
