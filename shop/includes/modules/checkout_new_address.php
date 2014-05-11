<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : checkout_new_address.php
// author     : Hanspeter Zeller <hpz@xos-shop.com>
// copyright  : Copyright (c) 2007 Hanspeter Zeller
// license    : This file is part of XOS-Shop.
//
//              XOS-Shop is free software: you can redistribute it and/or modify
//              it under the terms of the GNU General Public License as published
//              by the Free Software Foundation, either version 3 of the License,
//              or (at your option) any later version.
//
//              XOS-Shop is distributed in the hope that it will be useful,
//              but WITHOUT ANY WARRANTY; without even the implied warranty of
//              MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//              GNU General Public License for more details.
//
//              You should have received a copy of the GNU General Public License
//              along with XOS-Shop.  If not, see <http://www.gnu.org/licenses/>.   
//------------------------------------------------------------------------------
// this file is based on: 
//              osCommerce, Open Source E-Commerce Solutions
//              http://www.oscommerce.com
//              Copyright (c) 2003 osCommerce
//              filename: checkout_new_address.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/includes/modules/checkout_new_address.php') == 'overwrite_all')) :
  if (!isset($process)) $process = false;

  if (ACCOUNT_GENDER == 'true') {
    if (isset($gender)) {
      $male = ($gender == 'm') ? true : false;
      $female = ($gender == 'f') ? true : false;
    } else {
      $male = false;
      $female = false;
    }      
    $smarty->assign(array('account_gender' => true,
                          'input_gender' => xos_draw_radio_field('gender', 'm', $male, 'id="gender_m"') . '<label for="gender_m">&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;</label>' . xos_draw_radio_field('gender', 'f', $female, 'id="gender_f"') . '<label for="gender_f">&nbsp;&nbsp;' . FEMALE . '&nbsp;</label>' . (xos_not_null(ENTRY_GENDER_TEXT) ? '<span class="input-requirement">' . ENTRY_GENDER_TEXT . '</span>': '')));
  }
  
  if (ACCOUNT_COMPANY == 'true') {
    $smarty->assign(array('account_company' => true,
                          'input_company' => xos_draw_input_field('company', '', 'id="company"') . '&nbsp;' . (xos_not_null(ENTRY_COMPANY_TEXT) ? '<span class="input-requirement">' . ENTRY_COMPANY_TEXT . '</span>': '')));
  }
  
  if (ACCOUNT_SUBURB == 'true') {
    $smarty->assign(array('account_suburb' => true,
                          'input_suburb' => xos_draw_input_field('suburb', '', 'id="suburb"') . '&nbsp;' . (xos_not_null(ENTRY_SUBURB_TEXT) ? '<span class="input-requirement">' . ENTRY_SUBURB_TEXT . '</span>': '')));
  }
  
  if (ACCOUNT_STATE == 'true') {
    $smarty->assign('account_state', true);
    if ($process == true) {
      if ($entry_state_has_zones == true) {
        $zones_array = array();
        $zones_query = xos_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' order by zone_name");
        while ($zones_values = xos_db_fetch_array($zones_query)) {
          $zones_array[] = array('id' => $zones_values['zone_name'], 'text' => $zones_values['zone_name']);
        }
        $smarty->assign('input_state', xos_draw_pull_down_menu('state', $zones_array, '', 'id="state"') . '&nbsp;' . (xos_not_null(ENTRY_STATE_TEXT) ? '<span class="input-requirement">' . ENTRY_STATE_TEXT . '</span>': ''));
      } else {
        $smarty->assign('input_state', xos_draw_input_field('state', '', 'id="state"') . '&nbsp;' . (xos_not_null(ENTRY_STATE_TEXT) ? '<span class="input-requirement">' . ENTRY_STATE_TEXT . '</span>': ''));
      }
    } else {
      $smarty->assign('input_state', xos_draw_input_field('state', '', 'id="state"') . '&nbsp;' . (xos_not_null(ENTRY_STATE_TEXT) ? '<span class="input-requirement">' . ENTRY_STATE_TEXT . '</span>': ''));
    }   
  }                  

  $smarty->assign(array('input_firstname' => xos_draw_input_field('firstname', '', 'id="firstname"') . '&nbsp;' . (xos_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="input-requirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''),
                        'input_lastname' => xos_draw_input_field('lastname', '', 'id="lastname"') . '&nbsp;' . (xos_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="input-requirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''),
                        'input_street_address' => xos_draw_input_field('street_address', '', 'id="street_address"') . '&nbsp;' . (xos_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="input-requirement">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''),
                        'input_postcode' => xos_draw_input_field('postcode', '', 'id="postcode"') . '&nbsp;' . (xos_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="input-requirement">' . ENTRY_POST_CODE_TEXT . '</span>': ''),
                        'input_city' => xos_draw_input_field('city', '', 'id="city"') . '&nbsp;' . (xos_not_null(ENTRY_CITY_TEXT) ? '<span class="input-requirement">' . ENTRY_CITY_TEXT . '</span>': ''),
                        'input_country' => xos_get_country_list('country', '', 'id="country"') . '&nbsp;' . (xos_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="input-requirement">' . ENTRY_COUNTRY_TEXT . '</span>': '')));

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'checkout_new_address');
  $output_checkout_new_address = $smarty->fetch(SELECTED_TPL . '/includes/modules/checkout_new_address.tpl');
  $smarty->clearAssign(array('account_gender',
                              'input_gender',
                              'account_company',
                              'input_company',
                              'account_suburb',
                              'input_suburb',
                              'account_state',
                              'input_state',
                              'input_firstname',
                              'input_lastname',
                              'input_street_address',
                              'input_postcode',
                              'input_city',
                              'input_country'));
                      
  $smarty->assign('checkout_new_address', $output_checkout_new_address);
endif;  
?>
