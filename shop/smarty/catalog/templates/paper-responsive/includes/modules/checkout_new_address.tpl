[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : paper-responsive
* version    : 1.0.7 for XOS-Shop version 1.0 rc7z
* descrip    : xos-shop template built with Bootstrap3 and theme paper                                                                    
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
              <div class="form-horizontal">

                [@{if $account_gender}@]
                  <div class="form-group[@{if $gender_error}@] has-error[@{/if}@]">                                
                    <div class="col-sm-offset-4 col-sm-12">            
                      [@{$input_gender}@]<span class="input-requirement-moved">&nbsp;[@{$smarty.const.ENTRY_GENDER_TEXT}@]</span>
                    </div>            
                  </div>             
                [@{/if}@]  

                <div class="form-group[@{if $first_name_error}@] has-error[@{/if}@]">
                  <label class="col-sm-4 control-label" for="firstname">[@{#entry_first_name#}@]</label><span class="input-requirement-moved">[@{$smarty.const.ENTRY_FIRST_NAME_TEXT}@]</span>
                  <div class="col-sm-6 col-md-5 col-lg-4">
                    [@{$input_firstname|replace:'>&nbsp;':'>'}@]
                  </div>  
                </div>
            
                <div class="form-group[@{if $last_name_error}@] has-error[@{/if}@]">
                  <label class="col-sm-4 control-label" for="lastname">[@{#entry_last_name#}@]</label><span class="input-requirement-moved">[@{$smarty.const.ENTRY_LAST_NAME_TEXT}@]</span>
                  <div class="col-sm-6 col-md-5 col-lg-4">
                    [@{$input_lastname|replace:'>&nbsp;':'>'}@]
                  </div>  
                </div>  
                
                [@{if $account_company}@]
                <div class="form-group">
                  <label class="col-sm-4 control-label" for="company">[@{#entry_company#}@]</label><span class="input-requirement-moved">[@{$smarty.const.ENTRY_COMPANY_TEXT}@]</span>
                  <div class="col-sm-6 col-md-5 col-lg-4">
                    [@{$input_company|replace:'>&nbsp;':'>'}@]
                  </div>  
                </div>                                       
                [@{/if}@]                

                <div class="form-group[@{if $street_address_error}@] has-error[@{/if}@]">
                  <label class="col-sm-4 control-label" for="street_address">[@{#entry_street_address#}@]</label><span class="input-requirement-moved">[@{$smarty.const.ENTRY_STREET_ADDRESS_TEXT}@]</span>
                  <div class="col-sm-6 col-md-5 col-lg-4">
                    [@{$input_street_address|replace:'>&nbsp;':'>'}@]
                  </div>  
                </div>                                       

                [@{if $account_suburb}@]
                <div class="form-group">
                  <label class="col-sm-4 control-label" for="suburb">[@{#entry_suburb#}@]</label><span class="input-requirement-moved">[@{$smarty.const.ENTRY_SUBURB_TEXT}@]</span>
                  <div class="col-sm-6 col-md-5 col-lg-4">
                    [@{$input_suburb|replace:'>&nbsp;':'>'}@]
                  </div>  
                </div>                             
                [@{/if}@]             

                <div class="form-group[@{if $post_code_error}@] has-error[@{/if}@]">
                  <label class="col-sm-4 control-label" for="postcode">[@{#entry_post_code#}@]</label><span class="input-requirement-moved">[@{$smarty.const.ENTRY_POST_CODE_TEXT}@]</span>
                  <div class="col-sm-6 col-md-5 col-lg-4">
                    [@{$input_postcode|replace:'>&nbsp;':'>'}@]
                  </div>  
                </div>  
                
                <div class="form-group[@{if $city_error}@] has-error[@{/if}@]">
                  <label class="col-sm-4 control-label" for="city">[@{#entry_city#}@]</label><span class="input-requirement-moved">[@{$smarty.const.ENTRY_CITY_TEXT}@]</span>
                  <div class="col-sm-6 col-md-5 col-lg-4">
                    [@{$input_city|replace:'>&nbsp;':'>'}@]
                  </div>  
                </div>                                               

                [@{if $account_state}@]
                <div class="form-group[@{if $state_error}@] has-error[@{/if}@]">
                  <label class="col-sm-4 control-label" for="state">[@{#entry_state#}@]</label><span class="input-requirement-moved">[@{$smarty.const.ENTRY_STATE_TEXT}@]</span>
                  <div class="col-sm-6 col-md-5 col-lg-4">
                    [@{$input_state|replace:'>&nbsp;':'>'}@]
                  </div>  
                </div>                             
                [@{/if}@]

                <div class="form-group[@{if $country_error}@] has-error[@{/if}@]">
                  <label class="col-sm-4 control-label" for="country">[@{#entry_country#}@]</label><span class="input-requirement-moved">[@{$smarty.const.ENTRY_COUNTRY_TEXT}@]</span>
                  <div class="col-sm-6 col-md-5 col-lg-4">
                    [@{$input_country|replace:'>&nbsp;':'>'}@]
                  </div>  
                </div>             
                            
              </div>
              </fieldset>
<!-- checkout_new_address_eof -->
