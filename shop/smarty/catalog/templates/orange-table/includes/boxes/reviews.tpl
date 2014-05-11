[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with css-buttons and tables for layout                                                                     
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
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="info-box-heading"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="6" height="18" /></td>
              <td width="100%" class="info-box-heading"><a href="[@{$box_reviews_link_filename_reviews}@]">[@{#box_heading_reviews#}@]</a></td>
              <td class="info-box-heading" nowrap="nowrap"><a href="[@{$box_reviews_link_filename_reviews}@]"><img src="[@{$images_path}@]arrow_right.gif" alt="[@{#more#}@]" title=" [@{#more#}@] " /></a></td>
            </tr>
          </table>
          <table border="0" width="100%" cellspacing="0" cellpadding="1" class="info-box">
            <tr>
              <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="info-box-contents">
                <tr>
                  <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="1" /></td>
                </tr>
               [@{if $box_reviews_link_filename_product_reviews_info}@]
                <tr>
                  <td class="box-text"><div align="center"><a href="[@{$box_reviews_link_filename_product_reviews_info}@]">[@{$box_reviews_product_image}@]</a><br />&nbsp;</div><a href="[@{$box_reviews_link_filename_product_reviews_info}@]">[@{$box_reviews_review_text|truncate:60:'...':false}@]</a><br /><br /><div align="center">[@{$box_reviews_stars_image}@]</div></td>
                </tr>
               [@{elseif $box_reviews_link_filename_product_reviews_write}@]
                <tr>
                  <td class="box-text"><table border="0" cellspacing="0" cellpadding="2">
                    <tr>
                      <td class="info-box-contents"><a href="[@{$box_reviews_link_filename_product_reviews_write}@]">[@{$box_reviews_write_review_image}@]</a></td>
                      <td class="info-box-contents"><a href="[@{$box_reviews_link_filename_product_reviews_write}@]">[@{#box_reviews_write_review#}@]</a></td>
                    </tr>
                  </table></td>
                </tr>
               [@{else}@]  
                <tr>
                  <td class="box-text">[@{#box_reviews_no_reviews#}@]</td>
                </tr>
               [@{/if}@]  
                <tr>
                  <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="1" /></td>
                </tr>  
              </table></td>
            </tr>
          </table>
        </td>
      </tr>
<!-- reviews_eof -->
