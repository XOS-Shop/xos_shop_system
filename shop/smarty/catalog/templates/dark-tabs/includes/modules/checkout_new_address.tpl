[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : dark-tabs
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop extra template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : checkout_new_address.tpl
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

<!-- checkout_new_address -->
          <fieldset>          
          <div>
                      
            [@{if $account_gender}@]
            <div class="main checkout-new-address-label">[@{#entry_gender#}@]</div>
            <div class="main checkout-new-address-input">[@{$input_gender}@]</div>
            <div class="clear">&nbsp;</div>
            [@{/if}@]
            
            <label class="main checkout-new-address-label" for="firstname">[@{#entry_first_name#}@]</label>
            <div class="main checkout-new-address-input">[@{$input_firstname}@]</div>
            <div class="clear">&nbsp;</div>
                
            <label class="main checkout-new-address-label" for="lastname">[@{#entry_last_name#}@]</label>
            <div class="main checkout-new-address-input">[@{$input_lastname}@]</div>
            <div class="clear">&nbsp;</div>                                 

            <div style="height: 10px; font-size: 0;">&nbsp;</div>
            
            [@{if $account_company}@]
            <label class="main checkout-new-address-label" for="company">[@{#entry_company#}@]</label>
            <div class="main checkout-new-address-input">[@{$input_company}@]</div>
            <div class="clear">&nbsp;</div>                       
            <div style="height: 10px; font-size: 0;">&nbsp;</div>
            [@{/if}@]             
            
            <label class="main checkout-new-address-label" for="street_address">[@{#entry_street_address#}@]</label>
            <div class="main checkout-new-address-input">[@{$input_street_address}@]</div>
            <div class="clear">&nbsp;</div>            

            [@{if $account_suburb}@] 
            <label class="main checkout-new-address-label" for="suburb">[@{#entry_suburb#}@]</label>
            <div class="main checkout-new-address-input">[@{$input_suburb}@]</div>
            <div class="clear">&nbsp;</div>                
            [@{/if}@]
              
            <label class="main checkout-new-address-label" for="postcode">[@{#entry_post_code#}@]</label>
            <div class="main checkout-new-address-input">[@{$input_postcode}@]</div>
            <div class="clear">&nbsp;</div>                

            <label class="main checkout-new-address-label" for="city">[@{#entry_city#}@]</label>
            <div class="main checkout-new-address-input">[@{$input_city}@]</div>
            <div class="clear">&nbsp;</div>                

            [@{if $account_state}@] 
            <label class="main checkout-new-address-label" for="state">[@{#entry_state#}@]</label>
            <div class="main checkout-new-address-input">[@{$input_state}@]</div>
            <div class="clear">&nbsp;</div>                
            [@{/if}@]
            
            <label class="main checkout-new-address-label" for="country">[@{#entry_country#}@]</label>
            <div class="main checkout-new-address-input">[@{$input_country}@]</div>
            <div class="clear">&nbsp;</div>             
                            
          </div>
          </fieldset>
<!-- checkout_new_address_eof -->
