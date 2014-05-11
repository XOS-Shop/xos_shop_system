[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : black-tabs
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : address_book_details.tpl
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

<!-- address_book_details -->
          <fieldset>
          <legend>[@{#new_address_title#}@]</legend>
          
          <div class="main" style="float: left;"><b>[@{#new_address_title#}@]</b></div>
          <div class="input-requirement" style="text-align: right; float: right;">[@{#form_required_information#}@]</div>
          <div class="clear">&nbsp;</div>
          
          <div class="info-box-central-contents">
                      
            [@{if $account_gender}@]
            <div class="main address-book-details-label">[@{#entry_gender#}@]</div>
            <div class="main address-book-details-input">[@{$input_gender}@]</div>
            <div class="clear">&nbsp;</div>
            [@{/if}@]
            
            <label class="main address-book-details-label" for="firstname">[@{#entry_first_name#}@]</label>
            <div class="main address-book-details-input">[@{$input_firstname}@]</div>
            <div class="clear">&nbsp;</div>
                
            <label class="main address-book-details-label" for="lastname">[@{#entry_last_name#}@]</label>
            <div class="main address-book-details-input">[@{$input_lastname}@]</div>
            <div class="clear">&nbsp;</div>                                 

            <div style="height: 10px; font-size: 0;">&nbsp;</div>
            
            [@{if $account_company}@]
            <label class="main address-book-details-label" for="company">[@{#entry_company#}@]</label>
            <div class="main address-book-details-input">[@{$input_company}@]</div>
            <div class="clear">&nbsp;</div>                       
            [@{if $default_address}@]
            <label class="main address-book-details-label" for="company_tax_id">[@{#entry_company_tax_id#}@]</label>
            <div class="main address-book-details-input">[@{$company_tax_id}@]</div>
            <div class="clear">&nbsp;</div>  
            [@{/if}@]
            <div style="height: 10px; font-size: 0;">&nbsp;</div>
            [@{/if}@]             
            
            <label class="main address-book-details-label" for="street_address">[@{#entry_street_address#}@]</label>
            <div class="main address-book-details-input">[@{$input_street_address}@]</div>
            <div class="clear">&nbsp;</div>            

            [@{if $account_suburb}@] 
            <label class="main address-book-details-label" for="suburb">[@{#entry_suburb#}@]</label>
            <div class="main address-book-details-input">[@{$input_suburb}@]</div>
            <div class="clear">&nbsp;</div>                
            [@{/if}@]
              
            <label class="main address-book-details-label" for="postcode">[@{#entry_post_code#}@]</label>
            <div class="main address-book-details-input">[@{$input_postcode}@]</div>
            <div class="clear">&nbsp;</div>                

            <label class="main address-book-details-label" for="city">[@{#entry_city#}@]</label>
            <div class="main address-book-details-input">[@{$input_city}@]</div>
            <div class="clear">&nbsp;</div>                

            [@{if $account_state}@] 
            <label class="main address-book-details-label" for="state">[@{#entry_state#}@]</label>
            <div class="main address-book-details-input">[@{$input_state}@]</div>
            <div class="clear">&nbsp;</div>                
            [@{/if}@]
            
            <label class="main address-book-details-label" for="country">[@{#entry_country#}@]</label>
            <div class="main address-book-details-input">[@{$input_country}@]</div>
            <div class="clear">&nbsp;</div>             

            [@{if $not_default_address}@]
            <div style="height: 10px; font-size: 0;">&nbsp;</div>
            <div class="main" style="padding: 4px 0 6px 0;">[@{$checkbox_field_primary_address}@]<label for="primary">&nbsp;&nbsp;[@{#set_as_primary#}@]</label></div>
            [@{/if}@]
                            
          </div>
          </fieldset>
<!-- address_book_details_eof -->
