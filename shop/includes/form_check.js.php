<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : form_check.js.php
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
//              filename: form_check.js.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  $add_header .= '<script type="text/javascript">' . "\n" .
                 '/* <![CDATA[ */' . "\n" .
                 'var form = "";' . "\n" .
                 'var submitted = false;' . "\n" .
                 'var error_dob = false;' . "\n" .                 
                 'var error = false;' . "\n" .
                 'var error_message = "";' . "\n\n" .

                 'function check_input(field_name, field_size, message) {' . "\n" .
                 '  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {' . "\n" .
                 '    var field_value = form.elements[field_name].value;' . "\n\n" .

                 '    if (field_value == "" || field_value.length < field_size) {' . "\n" .
                 '      error_message = error_message + "* " + message + "\n";' . "\n" .
                 '      error = true;' . "\n" .
                 '    }' . "\n" .
                 '  }' . "\n" .
                 '}' . "\n\n" .

                 'function check_radio(field_name, message) {' . "\n" .
                 '  var isChecked = false;' . "\n\n" .

                 '  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {' . "\n" .
                 '    var radio = form.elements[field_name];' . "\n\n" .

                 '    for (var i=0; i<radio.length; i++) {' . "\n" .
                 '      if (radio[i].checked == true) {' . "\n" .
                 '        isChecked = true;' . "\n" .
                 '        break;' . "\n" .
                 '      }' . "\n" .
                 '    }' . "\n\n" .

                 '    if (isChecked == false) {' . "\n" .
                 '      error_message = error_message + "* " + message + "\n";' . "\n" .
                 '      error = true;' . "\n" .
                 '    }' . "\n" .
                 '  }' . "\n" .
                 '}' . "\n\n" .

                 'function check_select(field_name, field_default, message) {' . "\n" .
                 '  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {' . "\n" .
                 '    var field_value = form.elements[field_name].value;' . "\n\n" .

                 '    if (field_value == field_default) {' . "\n" .
                 '      error_message = error_message + "* " + message + "\n";' . "\n" . 
                 '      error_dob = true;' . "\n" .                  
                 '      error = true;' . "\n" .
                 '    }' . "\n" .
                 '  }' . "\n" .
                 '}' . "\n\n" .

                 'function check_password(field_name_1, field_name_2, field_size, message_1, message_2) {' . "\n" .
                 '  if (form.elements[field_name_1] && (form.elements[field_name_1].type != "hidden")) {' . "\n" .
                 '    var password = form.elements[field_name_1].value;' . "\n" .
                 '    var confirmation = form.elements[field_name_2].value;' . "\n\n" .

                 '    if (password == "" || password.length < field_size) {' . "\n" .
                 '      error_message = error_message + "* " + message_1 + "\n";' . "\n" .
                 '      error = true;' . "\n" .
                 '    } else if (password != confirmation) {' . "\n" .
                 '      error_message = error_message + "* " + message_2 + "\n";' . "\n" .
                 '      error = true;' . "\n" .
                 '    }' . "\n" .
                 '  }' . "\n" .
                 '}' . "\n\n" .
        
                 'function check_form(form_name) {' . "\n" .
                 '  if (submitted == true) {' . "\n" .
                 '    alert("' . JS_ERROR_SUBMITTED . '");' . "\n" .
                 '    return false;' . "\n" .
                 '  }' . "\n\n" .
                 
                 '  error_dob = false;' . "\n" . 
                 '  error = false;' . "\n" .
                 '  form = form_name;' . "\n" .
                 '  error_message = "' . JS_ERROR . '";' . "\n\n";
        
  if (ACCOUNT_GENDER == 'true') {
    $add_header .= '  check_radio("gender", "' . ENTRY_GENDER_ERROR . '");' . "\n\n";
  }  
  
  $add_header .= '  check_input("firstname", ' . ENTRY_FIRST_NAME_MIN_LENGTH . ', "' . ENTRY_FIRST_NAME_ERROR . '");' . "\n" .
                 '  check_input("lastname", ' . ENTRY_LAST_NAME_MIN_LENGTH . ', "' . ENTRY_LAST_NAME_ERROR . '");' . "\n\n";
                 
  if (ACCOUNT_DOB == 'true') {
    $add_header .= '  check_input("dob", ' . ENTRY_DOB_MIN_LENGTH . ', "' . ENTRY_DATE_OF_BIRTH_ERROR . '");' . "\n" .
                   '  if (error_dob == false) check_select("dob_month", "", "' . ENTRY_DATE_OF_BIRTH_ERROR . '");' . "\n" .
                   '  if (error_dob == false) check_select("dob_day", "", "' . ENTRY_DATE_OF_BIRTH_ERROR . '");' . "\n" .                   
                   '  if (error_dob == false) check_select("dob_year", "", "' . ENTRY_DATE_OF_BIRTH_ERROR . '");' . "\n\n";                                      
  }

  $add_header .= '  check_input("email_address", ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ', "' . ENTRY_EMAIL_ADDRESS_ERROR . '");' . "\n" .
                 '  check_input("street_address", ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ', "' . ENTRY_STREET_ADDRESS_ERROR . '");' . "\n" .
                 '  check_input("postcode", ' . ENTRY_POSTCODE_MIN_LENGTH . ', "' . ENTRY_POST_CODE_ERROR . '");' . "\n" .
                 '  check_input("city", ' . ENTRY_CITY_MIN_LENGTH . ', "' . ENTRY_CITY_ERROR . '");' . "\n\n";
                 
  if (ACCOUNT_STATE == 'true') {
    $add_header .= '  check_input("state", ' . ENTRY_STATE_MIN_LENGTH . ', "' . ENTRY_STATE_ERROR . '");' . "\n\n";
  }

  $add_header .= '  check_select("country", "", "' . ENTRY_COUNTRY_ERROR . '");' . "\n\n" .

                 '  check_input("telephone", ' . ENTRY_TELEPHONE_MIN_LENGTH . ', "' . ENTRY_TELEPHONE_NUMBER_ERROR . '");' . "\n\n" .

                 '  check_password("password", "confirmation", ' . ENTRY_PASSWORD_MIN_LENGTH . ', "' . ENTRY_PASSWORD_ERROR . '", "' . ENTRY_PASSWORD_ERROR_NOT_MATCHING . '");' . "\n" .
                 '  check_password("password_new", "password_confirmation", ' . ENTRY_PASSWORD_MIN_LENGTH . ', "' . ENTRY_PASSWORD_NEW_ERROR . '", "' . ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING . '");' . "\n\n" .

                 '  if (error == true) {' . "\n" .
                 '    alert(error_message);' . "\n" .
                 '    return false;' . "\n" .
                 '  } else {' . "\n" .
                 '    submitted = true;' . "\n" .
                 '    return true;' . "\n" .
                 '  }' . "\n" .
                 '}' . "\n" .
                 '/* ]]> */' . "\n" .
                 '</script> ' . "\n";
?>
