[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with css-buttons and tables for layout                                                                     
* filename   : create_account.tpl
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

<!-- create_account -->
    <td width="100%" valign="top">[@{$form_begin}@][@{$hidden_field}@]<table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="page-heading">[@{#heading_title#}@]</td>
            <td class="page-heading" align="right"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#page_heading_width#}@]" height="[@{#page_heading_height#}@]" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td class="small-text"><br /><span class="red-mark"><small><b>[@{#sub_title_origin_login#}@]</b></small></span> [@{eval var=#text_origin_login#}@]</td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>      
      [@{if $message_stack}@]
      <tr>
        <td>[@{$message_stack}@]</td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>      
      [@{/if}@]
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b>[@{#category_personal#}@]</b></td>
           <td class="input-requirement" align="right">[@{#form_required_information#}@]</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td><table border="0" cellspacing="2" cellpadding="2">
              <tr>            
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#create_account_width#}@]" height="1" /></td>
                <td></td> 
              </tr>                          
              [@{if $account_gender}@]
              <tr>
                <td class="main" nowrap="nowrap">[@{#entry_gender#}@]</td>
                <td class="main" nowrap="nowrap">[@{$input_gender}@]</td>
              </tr>
              [@{/if}@]
              <tr>
                <td class="main" nowrap="nowrap">[@{#entry_first_name#}@]</td>
                <td class="main" nowrap="nowrap">[@{$input_firstname}@]</td>
              </tr>
              <tr>
                <td class="main" nowrap="nowrap">[@{#entry_last_name#}@]</td>
                <td class="main" nowrap="nowrap">[@{$input_lastname}@]</td>
              </tr>
              [@{if $account_dob}@]
              <tr>
                <td class="main" nowrap="nowrap">[@{#entry_date_of_birth#}@]</td>
                <td class="main" nowrap="nowrap">[@{$pull_down_menus_dob}@]</td>
              </tr>
              [@{/if}@]
              <tr>
                <td class="main" nowrap="nowrap">[@{#entry_email_address#}@]</td>
                <td class="main" nowrap="nowrap">[@{$input_email_address}@]</td>
              </tr>
              [@{if $languages}@]
              <tr>
                <td class="main" nowrap="nowrap">[@{#entry_language#}@]</td>
                <td class="main" nowrap="nowrap">[@{$pull_down_menu_languages}@]</td>
              </tr> 
              [@{/if}@]
              <tr>            
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#create_account_width#}@]" height="1" /></td>
                <td></td> 
              </tr>                            
            </table></td>
          </tr>
        </table></td>
      </tr>
      [@{if $account_company}@]
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td class="main"><b>[@{#category_company#}@]</b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td><table border="0" cellspacing="2" cellpadding="2">
              <tr>            
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#create_account_width#}@]" height="1" /></td>
                <td></td> 
              </tr>             
              <tr>
                <td class="main" nowrap="nowrap">[@{#entry_company#}@]</td>
                <td class="main" nowrap="nowrap">[@{$input_company}@]</td>
              </tr>
              <tr>
                <td class="main" nowrap="nowrap">[@{#entry_company_tax_id#}@]</td>
                <td valign="top" class="main" nowrap="nowrap">[@{$input_company_tax_id}@]</td>
              </tr>
              <tr>            
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#create_account_width#}@]" height="1" /></td>
                <td></td> 
              </tr>                              
            </table></td>
          </tr>
        </table></td>
      </tr>
      [@{/if}@]
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td class="main"><b>[@{#category_address#}@]</b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td><table border="0" cellspacing="2" cellpadding="2">
              <tr>            
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#create_account_width#}@]" height="1" /></td>
                <td></td> 
              </tr>             
              <tr>
                <td class="main" nowrap="nowrap">[@{#entry_street_address#}@]</td>
                <td class="main" nowrap="nowrap">[@{$input_street_address}@]</td>
              </tr>
              [@{if $account_suburb}@]
              <tr>
                <td class="main" nowrap="nowrap">[@{#entry_suburb#}@]</td>
                <td class="main" nowrap="nowrap">[@{$input_suburb}@]</td>
              </tr>
              [@{/if}@]
              <tr>
                <td class="main" nowrap="nowrap">[@{#entry_post_code#}@]</td>
                <td class="main" nowrap="nowrap">[@{$input_postcode}@]</td>
              </tr>
              <tr>
                <td class="main" nowrap="nowrap">[@{#entry_city#}@]</td>
                <td class="main" nowrap="nowrap">[@{$input_city}@]</td>
              </tr>
              [@{if $account_state}@]
              <tr>
                <td class="main" nowrap="nowrap">[@{#entry_state#}@]</td>
                <td class="main" nowrap="nowrap">[@{$input_state}@]</td>
              </tr>
              [@{/if}@]
              <tr>
                <td class="main" nowrap="nowrap">[@{#entry_country#}@]</td>
                <td class="main" nowrap="nowrap">[@{$input_country}@]</td>
              </tr>
              <tr>            
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#create_account_width#}@]" height="1" /></td>
                <td></td> 
              </tr>               
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td class="main"><b>[@{#category_contact#}@]</b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td><table border="0" cellspacing="2" cellpadding="2">
              <tr>            
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#create_account_width#}@]" height="1" /></td>
                <td></td> 
              </tr>             
              <tr>
                <td class="main" nowrap="nowrap">[@{#entry_telephone_number#}@]</td>
                <td class="main" nowrap="nowrap">[@{$input_telephone}@]</td>
              </tr>
              <tr>
                <td class="main" nowrap="nowrap">[@{#entry_fax_number#}@]</td>
                <td class="main" nowrap="nowrap">[@{$input_fax}@]</td>
              </tr>
              <tr>            
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#create_account_width#}@]" height="1" /></td>
                <td></td> 
              </tr>               
            </table></td>
          </tr>
        </table></td>
      </tr>
      [@{if $input_newsletter}@]
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td class="main"><b>[@{#category_options#}@]</b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td><table border="0" cellspacing="2" cellpadding="2">
              <tr>            
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#create_account_width#}@]" height="1" /></td>
                <td></td> 
              </tr>             
              <tr>
                <td class="main" nowrap="nowrap">[@{#entry_newsletter#}@]</td>
                <td class="main" nowrap="nowrap">[@{$input_newsletter}@]</td>
              </tr>
              <tr>            
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#create_account_width#}@]" height="1" /></td>
                <td></td> 
              </tr>               
            </table></td>
          </tr>
        </table></td>
      </tr>
      [@{/if}@]
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>
      <tr>
        <td class="main"><b>[@{#category_password#}@]</b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td><table border="0" cellspacing="2" cellpadding="2">
              <tr>            
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#create_account_width#}@]" height="1" /></td>
                <td></td> 
              </tr>             
              <tr>
                <td class="main" nowrap="nowrap">[@{#entry_password#}@]</td>
                <td class="main" nowrap="nowrap">[@{$input_password}@]</td>
              </tr>
              <tr>
                <td class="main" nowrap="nowrap">[@{#entry_password_confirmation#}@]</td>
                <td class="main" nowrap="nowrap">[@{$input_confirmation}@]</td>
              </tr>
              <tr>            
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#create_account_width#}@]" height="1" /></td>
                <td></td> 
              </tr>               
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>           
      [@{if $link_filename_popup_content_6}@]      
      <tr>
        <td class="main"><b>[@{#category_information#}@]</b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td><table border="0" cellspacing="2" cellpadding="2">
              <tr>            
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#create_account_width#}@]" height="1" /></td>
              </tr>             
              <tr>
                <td class="main" nowrap="nowrap"> 
                  <script type="text/javascript">
                  /* <![CDATA[ */
                    document.write('<a href="[@{$link_filename_popup_content_6}@]" class="lightbox-system-popup" target="_blank"><span class="text-deco-underline">[@{#text_privacy_notice_link#}@]</span></a>');
                  /* ]]> */   
                  </script>
                  <noscript>
                    <a href="[@{$link_filename_popup_content_6}@]" target="_blank"><span class="text-deco-underline">[@{#text_privacy_notice_link#}@]</span></a>
                  </noscript>                  
                </td>
              </tr>
              <tr>            
                <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="[@{#create_account_width#}@]" height="1" /></td>
              </tr>               
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
      </tr>      
      [@{/if}@]           
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="info-box-central">
          <tr class="info-box-central-contents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
                <td nowrap="nowrap"><a href="[@{$link_back}@]" class="button-back" style="float: left" title=" [@{#button_title_back#}@] "><span>[@{#button_text_back#}@]</span></a></td>
                <td nowrap="nowrap" align="right">
                  <script type="text/javascript">
                  /* <![CDATA[ */
                    document.write('<a href="" onclick="if(create_account.onsubmit())create_account.submit(); return false" class="button-continue" style="float: right" title=" [@{#button_title_continue#}@] "><span>[@{#button_text_continue#}@]</span></a><input type="image" src="[@{$images_path}@]pixel_trans.gif" alt="" />')
                  /* ]]> */  
                  </script>
                  <noscript>
                    <input type="submit" value="[@{#button_text_continue#}@]" />
                  </noscript>                         
                </td>                
                <td width="10"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="10" height="1" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>   
      </tr>
    </table>[@{$form_end}@]</td>
<!-- create_account_eof -->
