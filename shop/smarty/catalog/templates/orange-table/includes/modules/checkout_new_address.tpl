[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : orange-table
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with css-buttons and tables for layout                                                                     
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
                      <table border="0" width="100%" cellspacing="0" cellpadding="2">
                        [@{if $account_gender}@]
                        <tr>
                          <td class="main">[@{#entry_gender#}@]</td>
                          <td class="main">[@{$input_gender}@]</td>
                        </tr>
                        [@{/if}@]
                        <tr>
                          <td class="main">[@{#entry_first_name#}@]</td>
                          <td class="main">[@{$input_firstname}@]</td>
                        </tr>
                        <tr>
                          <td class="main">[@{#entry_last_name#}@]</td>
                          <td class="main">[@{$input_lastname}@]</td>
                        </tr>
                        <tr>
                          <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
                        </tr>  
                        [@{if $account_company}@]
                        <tr>
                          <td class="main">[@{#entry_company#}@]</td>
                          <td class="main">[@{$input_company}@]</td>
                        </tr>
                        <tr>
                          <td colspan="2"><img src="[@{$images_path}@]pixel_trans.gif" alt="" width="100%" height="10" /></td>
                        </tr>  
                        [@{/if}@]
                        <tr>
                          <td class="main">[@{#entry_street_address#}@]</td>
                          <td class="main">[@{$input_street_address}@]</td>
                        </tr>
                        [@{if $account_suburb}@]
                        <tr>
                          <td class="main">[@{#entry_suburb#}@]</td>
                          <td class="main">[@{$input_suburb}@]</td>
                        </tr>
                        [@{/if}@]
                        <tr>
                          <td class="main">[@{#entry_post_code#}@]</td>
                          <td class="main">[@{$input_postcode}@]</td>
                        </tr>
                        <tr>
                          <td class="main">[@{#entry_city#}@]</td>
                          <td class="main">[@{$input_city}@]</td>
                        </tr>
                        [@{if $account_state}@]
                        <tr>
                          <td class="main">[@{#entry_state#}@]</td>
                          <td class="main">[@{$input_state}@]</td>
                        </tr>
                        [@{/if}@]
                        <tr>
                          <td class="main">[@{#entry_country#}@]</td>
                          <td class="main">[@{$input_country}@]</td>
                        </tr>
                      </table>
<!-- checkout_new_address_eof -->
