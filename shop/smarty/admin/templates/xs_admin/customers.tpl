[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : xs_admin
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template for admin with css-buttons
*              and tables for layout                                                                     
* filename   : customers.tpl
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

<!-- customers -->
  [@{if $edit_or_update}@]
    <td width="100%" valign="top">[@{$form_begin_customers}@][@{$hidden_default_address_id}@][@{$hidden_field_customers_language_id}@]<table border="0" width="100%" cellspacing="0" cellpadding="2">        
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="10">              
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="8" /></td> 
          </tr>                    
          <tr class="dataTableRow">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">                  
              <tr class="dataTableRow">
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="1" /></td>
              </tr>         
              <tr class="dataTableRow">
                <td class="formAreaTitle">[@{#category_personal#}@]</td>
              </tr>
              <tr class="dataTableRow">
                <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
                  [@{if $account_gender}@]
                  <tr>
                    <td class="main">[@{#entry_gender#}@]</td>
                    <td class="main">[@{$gender_in_out_values}@]</td>
                  </tr>
                  [@{/if}@]
                  <tr>
                    <td class="main">[@{#entry_customer_id#}@]</td>
                    <td class="main">[@{$cid_in_out_values}@]</td>
                  </tr>          
                  <tr>
                    <td class="main">[@{#entry_first_name#}@]</td>
                    <td class="main">[@{$firstname_in_out_values}@]</td>
                  </tr>
                  <tr>
                    <td class="main">[@{#entry_last_name#}@]</td>
                    <td class="main">[@{$lastname_in_out_values}@]</td>
                  </tr>
                  [@{if $account_dob}@]
                  <tr>
                    <td class="main">[@{#entry_date_of_birth#}@]</td>
                    <td class="main">[@{$dob_in_out_values}@]</td>
                  </tr>
                  [@{/if}@]
                  <tr>
                    <td class="main">[@{#entry_email_address#}@]</td>
                    <td class="main">[@{$email_address_in_out_values}@]</td>
                  </tr>
                  [@{if $languages}@]
                  <tr>
                    <td class="main">[@{#entry_language#}@]</td>
                    <td class="main">[@{$languages_in_out_values}@]</td>
                  </tr> 
                  [@{/if}@]                   
                </table></td>
              </tr>
              [@{if $account_company}@]
              <tr class="dataTableRow">
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>      
              <tr class="dataTableRow">
                <td class="formAreaTitle">[@{#category_company#}@]</td>
              </tr>
              <tr class="dataTableRow">
                <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
                  <tr>
                    <td class="main">[@{#entry_company#}@]</td>
                    <td class="main">[@{$company_in_out_values}@]</td>
                  </tr>
                  <tr>
                    <td class="main">[@{#entry_company_tax_id#}@]</td>
                    <td class="main">[@{$company_tax_id_in_out_values}@]</td>
                  </tr>
                  <tr>
                    <td class="main">[@{#entry_customers_group_request_authentication#}@]</td>
                    <td class="main">[@{$customers_group_ra_in_out_values}@]</td>
                  </tr>                 
                </table></td>
              </tr>
              [@{/if}@]
              <tr class="dataTableRow">
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr class="dataTableRow">
                <td class="formAreaTitle">[@{#category_address#}@]</td>
              </tr>
              <tr class="dataTableRow">
                <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
                  <tr>
                    <td class="main">[@{#entry_street_address#}@]</td>
                    <td class="main">[@{$street_address_in_out_values}@]</td>
                  </tr>
                  [@{if $account_suburb}@]
                  <tr>
                    <td class="main">[@{#entry_suburb#}@]</td>
                    <td class="main">[@{$suburb_in_out_values}@]</td>
                  </tr>
                  [@{/if}@]
                  <tr>
                    <td class="main">[@{#entry_post_code#}@]</td>
                    <td class="main">[@{$post_code_in_out_values}@]</td>
                  </tr>
                  <tr>
                    <td class="main">[@{#entry_city#}@]</td>
                    <td class="main">[@{$city_in_out_values}@]</td>
                  </tr>
                  [@{if $account_state}@]
                  <tr>
                    <td class="main">[@{#entry_state#}@]</td>
                    <td class="main">[@{$state_in_out_values}@]</td>
                  </tr>
                  [@{/if}@]
                  <tr>
                    <td class="main">[@{#entry_country#}@]</td>
                    <td class="main">[@{$country_in_out_values}@]</td>
                  </tr>
                </table></td>
              </tr>
              <tr class="dataTableRow">
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr class="dataTableRow">
                <td class="formAreaTitle">[@{#category_contact#}@]</td>
              </tr>
              <tr class="dataTableRow">
                <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
                  <tr>
                    <td class="main">[@{#entry_telephone_number#}@]</td>
                    <td class="main">[@{$telephone_in_out_values}@]</td>
                  </tr>
                  <tr>
                    <td class="main">[@{#entry_fax_number#}@]</td>
                    <td class="main">[@{$fax_in_out_values}@]</td>
                  </tr>
                </table></td>
              </tr>
              <tr class="dataTableRow">
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>
              <tr class="dataTableRow">
                <td class="formAreaTitle">[@{#category_options#}@]</td>
              </tr>
              <tr class="dataTableRow">
                <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
                  [@{if $newsletter_in_out_values}@]
                  <tr>
                    <td class="main">[@{#entry_newsletter#}@]</td>
                    <td class="main">[@{$newsletter_in_out_values}@]</td>
                  </tr>
                  [@{/if}@]          
                  <tr>
                    <td class="main">[@{#entry_customers_group_name#}@]</td>
                    <td class="main">[@{$customers_group_id_in_out_values}@]</td>
                  </tr>          
                </table></td>
              </tr>    
              <tr class="dataTableRow">
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
              </tr>              
              <tr class="dataTableRow">
                <td class="formAreaTitle">[@{#category_comments#}@]</td>
              </tr>
              <tr class="dataTableRow">
                <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
                  [@{if $several_lng_in_admin}@]
                  <tr>
                    <td class="main" valign="top">&nbsp;</td>
                    <td class="main"><div style="font-style: italic; margin: 0; padding: 0; width: 500px;">[@{#entry_comments_text_multilingualism#}@]</div></td>
                  </tr>                 
                  [@{/if}@]   
                  <tr>
                    <td class="main" valign="top">[@{#entry_comments#}@]</td>
                    <td class="main"><div style="font-style: italic; margin: 0; padding: 0; width: 500px;">[@{$comments_in_out_values}@]</div></td>
                  </tr>          
                </table></td>
              </tr>                                                               
            </table></td>
          </tr>                       
          <tr>
            <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="1" height="10" /></td>
          </tr>
          <tr>
            <td nowrap="nowrap" align="right" class="main"><a href="[@{$link_filename_customers}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_cancel#}@] "><span>[@{#button_text_cancel#}@]</span></a><a href="" onclick="if(customers.onsubmit())customers.submit(); return false" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_update#}@] "><span>[@{#button_text_update#}@]</span></a></td>
          </tr>
        </table></td>      
      </tr>      
    </table>[@{$form_end}@]</td>      
  [@{else}@]
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">        
      <tr>
        <td>[@{$form_begin_search}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">[@{#heading_title#}@]</td>
            <td class="pageHeading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#heading_image_width#}@]" height="[@{#heading_image_height#}@]" /></td>
            <td class="smallText" align="right">[@{#heading_title_search#}@]&nbsp;[@{$input_search}@]</td>
          </tr>
        </table>[@{$hidden_field_session}@][@{$form_end}@]</td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">         
                <td nowrap="nowrap" class="dataTableHeadingContent" valign="top"><a href="[@{$link_self_company_sort_asc}@]"><img src="[@{$images_path}@]ic_up.gif" alt="[@{$text_company_sort_asc}@]" title=" [@{$text_company_sort_asc}@] " /></a>&nbsp;<a href="[@{$link_self_company_sort_desc}@]"><img src="[@{$images_path}@]ic_down.gif" alt="[@{$text_company_sort_desc}@]" title=" [@{$text_company_sort_desc}@] " /></a><br />[@{#table_heading_company#}@]</td>
                <td nowrap="nowrap" class="dataTableHeadingContent" valign="top"><a href="[@{$link_self_lastname_sort_asc}@]"><img src="[@{$images_path}@]ic_up.gif" alt="[@{$text_lastname_sort_asc}@]" title=" [@{$text_lastname_sort_asc}@] " /></a>&nbsp;<a href="[@{$link_self_lastname_sort_desc}@]"><img src="[@{$images_path}@]ic_down.gif" alt="[@{$text_lastname_sort_desc}@]" title=" [@{$text_lastname_sort_desc}@] " /></a><br />[@{#table_heading_lastname#}@]</td>
                <td nowrap="nowrap" class="dataTableHeadingContent" valign="top"><a href="[@{$link_self_firstname_sort_asc}@]"><img src="[@{$images_path}@]ic_up.gif" alt="[@{$text_firstname_sort_asc}@]" title=" [@{$text_firstname_sort_asc}@] " /></a>&nbsp;<a href="[@{$link_self_firstname_sort_desc}@]"><img src="[@{$images_path}@]ic_down.gif" alt="[@{$text_firstname_sort_desc}@]" title=" [@{$text_firstname_sort_desc}@] " /></a><br />[@{#table_heading_firstname#}@]</td>
		<td nowrap="nowrap" class="dataTableHeadingContent" valign="top"><a href="[@{$link_self_cg_name_sort_asc}@]"><img src="[@{$images_path}@]ic_up.gif" alt="[@{$text_cg_name_sort_asc}@]" title=" [@{$text_cg_name_sort_asc}@] " /></a>&nbsp;<a href="[@{$link_self_cg_name_sort_desc}@]"><img src="[@{$images_path}@]ic_down.gif" alt="[@{$text_cg_name_sort_desc}@]" title=" [@{$text_cg_name_sort_desc}@] " /></a><br />[@{#table_heading_customers_groups#}@]</td>
                <td nowrap="nowrap" class="dataTableHeadingContent" align="right" valign="top"><a href="[@{$link_self_id_sort_asc}@]"><img src="[@{$images_path}@]ic_up.gif" alt="[@{$text_id_sort_asc}@]" title=" [@{$text_id_sort_asc}@] " /></a>&nbsp;<a href="[@{$link_self_id_sort_desc}@]"><img src="[@{$images_path}@]ic_down.gif" alt="[@{$text_id_sort_desc}@]" title=" [@{$text_id_sort_desc}@] " /></a><br />[@{#table_heading_account_created#}@]</td>
                <td nowrap="nowrap" class="dataTableHeadingContent" align="center" valign="top"><a href="[@{$link_self_ra_sort_asc}@]"><img src="[@{$images_path}@]ic_up.gif" alt="[@{$text_ra_sort_asc}@]" title=" [@{$text_ra_sort_asc}@] " /></a>&nbsp;<a href="[@{$link_self_ra_sort_desc}@]"><img src="[@{$images_path}@]ic_down.gif" alt="[@{$text_ra_sort_desc}@]" title=" [@{$text_ra_sort_desc}@] " /></a><br />[@{#table_heading_request_authentication#}@]&nbsp;</td>
                <td nowrap="nowrap" class="dataTableHeadingContent" align="right" valign="bottom">[@{#table_heading_action#}@]&nbsp;</td> 
              </tr>
              [@{foreach item=customer from=$customers}@]
              [@{if $customer.selected}@]                            
              <tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$customer.link_filename_customers}@]'">
                <td class="dataTableContent">[@{$customer.company}@]</td>
                <td class="dataTableContent">[@{$customer.lastname}@]</td>
                <td class="dataTableContent">[@{$customer.firstname}@]</td>
                <td class="dataTableContent">[@{$customer.group_name}@]</td>
                <td class="dataTableContent" align="right">[@{$customer.date_account_created}@]</td>
                <td class="dataTableContent" align="center">[@{$customer.group_ra_status_image}@]</td>
                <td class="dataTableContent" align="right"><img src="[@{$images_path}@]icon_arrow_right.gif" alt="" />&nbsp;</td>
              </tr>              
              [@{else}@]
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='[@{$customer.link_filename_customers}@]'">
                <td class="dataTableContent">[@{$customer.company}@]</td>
                <td class="dataTableContent">[@{$customer.lastname}@]</td>
                <td class="dataTableContent">[@{$customer.firstname}@]</td>
                <td class="dataTableContent">[@{$customer.group_name}@]</td>
                <td class="dataTableContent" align="right">[@{$customer.date_account_created}@]</td>
                <td class="dataTableContent" align="center">[@{$customer.group_ra_status_image}@]</td>
                <td class="dataTableContent" align="right"><a href="[@{$customer.link_filename_customers}@]"><img src="[@{$images_path}@]icon_info.gif" alt="[@{#icon_title_info#}@]" title=" [@{#icon_title_info#}@] " /></a>&nbsp;</td>
              </tr>
              [@{/if}@]
              [@{/foreach}@]
              <tr>
                <td colspan="7"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top">[@{$nav_bar_number}@]</td>
                    <td class="smallText" align="right">[@{$nav_bar_result}@]</td>
                  </tr>
                  [@{if $link_filename_customers_reset}@]
                  <tr>
                    <td nowrap="nowrap" colspan="2" align="right"><a href="[@{$link_filename_customers_reset}@]" class="button-default" style="margin-right: 5px; float: right" title=" [@{#button_title_reset#}@] "><span>[@{#button_text_reset#}@]</span></a></td>
                  </tr>                  
                  [@{/if}@]
                </table></td>
              </tr>
            </table></td>
          [@{$infobox_customers}@]
          </tr>
        </table></td>
      </tr>
    </table></td>      
  [@{/if}@]            
<!-- customers_eof -->
