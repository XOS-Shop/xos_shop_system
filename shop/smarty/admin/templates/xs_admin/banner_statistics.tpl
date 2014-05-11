[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : banner_statistics.tpl
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

<!-- banner_statistics -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%">[@{$form_begin}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>            
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
            <td class="main" align="right">
              [@{#title_type#}@]&nbsp;[@{$pull_down_type}@]<br />
              [@{if $case_daily}@]
              [@{#title_month#}@]&nbsp;[@{$pull_down_month}@]<br />[@{#title_year#}@]&nbsp;[@{$pull_down_year}@]
              [@{elseif $case_monthly}@]
              [@{#title_year#}@]&nbsp;[@{$pull_down_year}@]
              [@{/if}@]
            </td>            
          </tr>
        </table>[@{$hidden_field_page}@][@{$hidden_field_bid}@][@{$hidden_field_session}@][@{$form_end}@]</td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
      </tr>
      <tr>
        <td align="center"> 
          [@{if $function_exists_imagecreate}@]        
          [@{$banner_graph}@]
          [@{$javascript}@]         
          <table border="0" width="600" cellspacing="0" cellpadding="2">
            <tr class="dataTableHeadingRow">
             <td class="dataTableHeadingContent">[@{#table_heading_source#}@]</td>
             <td class="dataTableHeadingContent" align="right">[@{#table_heading_views#}@]</td>
             <td class="dataTableHeadingContent" align="right">[@{#table_heading_clicks#}@]</td>
           </tr>
           [@{foreach item=stat_value from=$stat_values}@]           
            <tr class="dataTableRow">
              <td class="dataTableContent">[@{$stat_value.source}@]</td>
              <td class="dataTableContent" align="right">[@{$stat_value.views}@]</td>
              <td class="dataTableContent" align="right">[@{$stat_value.clicks}@]</td>
            </tr>
           [@{/foreach}@]            
          </table>
          [@{else}@]
          [@{$html_banner_graph}@]
          [@{/if}@]                  
        </td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
      </tr>
      <tr>
        <td nowrap="nowrap" class="main" align="right"><a href="[@{$link_filename_banner_manager}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
      </tr>
    </table></td>
<!-- banner_statistics_eof -->
