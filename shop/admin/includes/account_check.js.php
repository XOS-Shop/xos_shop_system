<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : account_check.js.php
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
//              filename: account_check.js.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  if (substr(basename($_SERVER['PHP_SELF']), 0, 12) == 'admin_member') {

    $javascript .= '<script type="text/JavaScript">' . "\n" .
                   '/* <![CDATA[ */' . "\n" . 
                   'function validateForm() {' . "\n" .
                   '  var p,z,xEmail,errors="",dbEmail,result=0,i;' . "\n\n" .
  
                   '  var adminName1 = document.newmember.admin_firstname.value;' . "\n" .
                   '  var adminName2 = document.newmember.admin_lastname.value;' . "\n" .
                   '  var adminEmail = document.newmember.admin_email_address.value;' . "\n\n" .

                   '  if (adminName1 == "") {' . "\n" .
                   '    errors+="' . JS_ALERT_FIRSTNAME . '";' . "\n" .
                   '  } else if (adminName1.length < ' . ENTRY_FIRST_NAME_MIN_LENGTH . ') {' . "\n" .
                   '    errors+="' .JS_ALERT_FIRSTNAME_LENGTH . '\n";' . "\n" .
                   '  }' . "\n\n" .

                   '  if (adminName2 == "") {' . "\n" .
                   '    errors+="' . JS_ALERT_LASTNAME . '";' . "\n" .
                   '  } else if (adminName2.length < ' . ENTRY_FIRST_NAME_MIN_LENGTH . ') {' . "\n" .
                   '    errors+="' . JS_ALERT_LASTNAME_LENGTH . '\n";' . "\n" .
                   '  }' . "\n\n" .

                   '  if (adminEmail == "") {' . "\n" .
                   '    errors+="' . JS_ALERT_EMAIL . '";' . "\n" .
                   '  } else if (adminEmail.length < ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ') {' . "\n" .
                   '    errors+="' . JS_ALERT_EMAIL_LENGTH . '\n";' . "\n" .
                   '  }' . "\n\n" .

                   '  if (errors) alert("' .JS_ERROR . '"+errors);' . "\n" .
                   '  document.returnValue = (errors == "");' . "\n" .
                   '}' . "\n\n\n" .

       
                   'function checkGroups(obj) {' . "\n" .
                   '  var id_substr,element,i;' . "\n" .
                   '  element = document.getElementsByName(obj.name);' . "\n" .
                   '  id_substr = obj.id.substr(7, 2);' . "\n\n" .
                   
                   '  for (i=0; i<element.length; i++) {' . "\n" .                  
                   '    if (obj.checked == true && element[i].id.substr(10, id_substr.length) == id_substr) { element[i].checked = true; }' . "\n" .
                   '    else if (obj.checked == false && element[i].id.substr(10, id_substr.length) == id_substr) { element[i].checked = false; }' . "\n" .
                   '  }' . "\n\n" .

                   '}' . "\n\n\n" .


                   'function checkSub(obj) {' . "\n" .
                   '  var id_substr,element,i,num=0;' . "\n" .
                   '  element = document.getElementsByName(obj.name);' . "\n" .
                   '  id_substr = obj.id.substr(10, 2);' . "\n\n" .

                   '  for (i=0; i<element.length; i++) {' . "\n" .
                   '    if (element[i].checked == true && element[i].id.substr(10, id_substr.length) == id_substr) { num++; }' . "\n" .
                   '  }' . "\n\n" . 
                   
                   '  for (i=0; i<element.length; i++) {' . "\n" .                   
                   '    if (num > 0 && element[i].id.substr(7, id_substr.length) == id_substr) { element[i].checked = true; }' . "\n" .
                   '    else if (element[i].id.substr(7, id_substr.length) == id_substr) { element[i].checked = false; }' . "\n" .                                   
                   '  }' . "\n\n" .
                   
                   '}' . "\n" .
                   '/* ]]> */' . "\n" .
                   '</script>' . "\n";

  } else {

    $javascript .= '<script type="text/JavaScript">' . "\n" .
                   '/* <![CDATA[ */' . "\n" .
                   'function validateForm() {' . "\n" .
                   '  var p,z,xEmail,errors="",dbEmail,result=0,i;' . "\n\n" .

                   '  var adminName1 = document.account.admin_firstname.value;' . "\n" .
                   '  var adminName2 = document.account.admin_lastname.value;' . "\n" .
                   '  var adminEmail = document.account.admin_email_address.value;' . "\n" .
                   '  var adminPass1 = document.account.admin_password.value;' . "\n" .
                   '  var adminPass2 = document.account.admin_password_confirm.value;' . "\n\n" .

                   '  if (adminName1 == "") {' . "\n" .
                   '    errors+="' .JS_ALERT_FIRSTNAME . '";' . "\n" .
                   '  } else if (adminName1.length < ' . ENTRY_FIRST_NAME_MIN_LENGTH . ') {' . "\n" .
                   '    errors+="' . JS_ALERT_FIRSTNAME_LENGTH . '\n";' . "\n" .
                   '  }' . "\n\n" .

                   '  if (adminName2 == "") {' . "\n" .
                   '    errors+="' . JS_ALERT_LASTNAME . '";' . "\n" .
                   '  } else if (adminName2.length < ' . ENTRY_LAST_NAME_MIN_LENGTH . ') {' . "\n" .
                   '    errors+="' . JS_ALERT_LASTNAME_LENGTH . '\n";' . "\n" .
                   '  }' . "\n\n" .

                   '  if (adminEmail == "") {' . "\n" .
                   '    errors+="' . JS_ALERT_EMAIL . '";' . "\n" .
                   '  } else if (adminEmail.length < ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ') {' . "\n" .
                   '    errors+="' . JS_ALERT_EMAIL_LENGTH . '\n";' . "\n" .
                   '  }' . "\n\n" .

                   '  if (adminPass1.length < ' . ENTRY_PASSWORD_MIN_LENGTH . ' && adminPass1 != "") {' . "\n" .
                   '    errors+="' . JS_ALERT_PASSWORD_LENGTH . '\n";' . "\n" .
                   '  } else if (adminPass1 != adminPass2) {' . "\n" .
                   '    errors+="' . JS_ALERT_PASSWORD_CONFIRM . '";' . "\n" .
                   '  }' . "\n\n" .

                   '  if (errors) alert("' .JS_ERROR . '"+errors);' . "\n" .
                   '  document.returnValue = (errors == "");' . "\n" .
                   '}' . "\n" .
                   '/* ]]> */' . "\n" .
                   '</script>' . "\n";
                                    
  }
?>
