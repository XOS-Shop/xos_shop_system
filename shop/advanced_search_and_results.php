<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : advanced_search_and_results.php
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
//              filenames: advanced_search.php
//                         advanced_search_result.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!$is_shop) :
  xos_redirect(xos_href_link(FILENAME_DEFAULT), false);  
elseif (!((@include DIR_FS_SMARTY . 'catalog/templates/' . SELECTED_TPL . '/php/' . FILENAME_ADVANCED_SEARCH_AND_RESULTS) == 'overwrite_all')) :
  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_ADVANCED_SEARCH_AND_RESULTS);
  
  $site_trail->add(NAVBAR_TITLE_1, xos_href_link(FILENAME_ADVANCED_SEARCH_AND_RESULTS));  

  if (isset($_POST['keywords']) && isset($_POST['copid']) && isset($_POST['_m']) && isset($_POST['pfrom']) && isset($_POST['pto']) && isset($_POST['dfrom']) && isset($_POST['dto'])) {
    $_GET['keywords'] = $_POST['keywords'];
    $_GET['sid'] = $_POST['sid'];
    $_GET['copid'] = $_POST['copid'];
    $_GET['_m'] = $_POST['_m'];
    $_GET['pfrom'] = $_POST['pfrom'];
    $_GET['pto'] = $_POST['pto'];
    $_GET['dfrom'] = $_POST['dfrom'];
    $_GET['dto'] = $_POST['dto'];
  }

  $action = (((isset($_GET['keywords']) || isset($_GET['pfrom']) || isset($_GET['pto']) || isset($_GET['dfrom']) || isset($_GET['dto'])) && !isset($_GET['from_search_result'])) ? true : false);
  $error = false;

  if ($action) {
  
  $_SESSION['navigation']->remove_current_page();
  $_SESSION['navigation']->add_current_page();
  
  $_GET['keywords'] = xos_sanitize_string($_GET['keywords']);
  
  if ( (isset($_GET['keywords']) && empty($_GET['keywords'])) &&
       (isset($_GET['dfrom']) && (empty($_GET['dfrom']) || ($_GET['dfrom'] == AS_FORMAT_STRING))) &&
       (isset($_GET['dto']) && (empty($_GET['dto']) || ($_GET['dto'] == AS_FORMAT_STRING))) &&
       (isset($_GET['pfrom']) && !is_numeric($_GET['pfrom'])) &&
       (isset($_GET['pto']) && !is_numeric($_GET['pto'])) ) {
    $error = true;

    $messageStack->add('search', ERROR_AT_LEAST_ONE_INPUT);
  } else {
    $dfrom = '';
    $dto = '';
    $pfrom = '';
    $pto = '';
    $keywords = '';

    if (isset($_GET['dfrom'])) {
      $dfrom = (($_GET['dfrom'] == AS_FORMAT_STRING) ? '' : $_GET['dfrom']);
    }

    if (isset($_GET['dto'])) {
      $dto = (($_GET['dto'] == AS_FORMAT_STRING) ? '' : $_GET['dto']);
    }

    if (isset($_GET['pfrom'])) {
      $pfrom = $_GET['pfrom'];
    }

    if (isset($_GET['pto'])) {
      $pto = $_GET['pto'];
    }

    if (isset($_GET['keywords'])) {
      $keywords = (((strlen(stripcslashes($_GET['keywords'])) > 2) || empty($_GET['keywords'])) ? $_GET['keywords'] : '^^^^^^');
    }

    $date_check_error = false;
    if (xos_not_null($dfrom)) {
      if (!xos_checkdate($dfrom, AS_FORMAT_STRING, $dfrom_array)) {
        $error = true;
        $date_check_error = true;

        $messageStack->add('search', ERROR_INVALID_FROM_DATE);
      }
    }

    if (xos_not_null($dto)) {
      if (!xos_checkdate($dto, AS_FORMAT_STRING, $dto_array)) {
        $error = true;
        $date_check_error = true;

        $messageStack->add('search', ERROR_INVALID_TO_DATE);
      }
    }

    if (($date_check_error == false) && xos_not_null($dfrom) && xos_not_null($dto)) {
      if (mktime(0, 0, 0, $dfrom_array[1], $dfrom_array[2], $dfrom_array[0]) > mktime(0, 0, 0, $dto_array[1], $dto_array[2], $dto_array[0])) {
        $error = true;

        $messageStack->add('search', ERROR_TO_DATE_LESS_THAN_FROM_DATE);
      }
    }

    $price_check_error = false;
    if (xos_not_null($pfrom)) {
      if (!settype($pfrom, 'double')) {
        $error = true;
        $price_check_error = true;

        $messageStack->add('search', ERROR_PRICE_FROM_MUST_BE_NUM);
      }
    }

    if (xos_not_null($pto)) {
      if (!settype($pto, 'double')) {
        $error = true;
        $price_check_error = true;

        $messageStack->add('search', ERROR_PRICE_TO_MUST_BE_NUM);
      }
    }

    if (($price_check_error == false) && is_float($pfrom) && is_float($pto)) {
      if ($pfrom >= $pto) {
        $error = true;

        $messageStack->add('search', ERROR_PRICE_TO_LESS_THAN_PRICE_FROM);
      }
    }

    if (xos_not_null($keywords)) {
      if (!xos_parse_search_string($keywords, $search_keywords)) {
        $error = true;

        $messageStack->add('search', ERROR_INVALID_KEYWORDS);
      }
    }
    
    if (empty($dfrom) && empty($dto) && empty($pfrom) && empty($pto) && empty($keywords)) {
      $error = true;

      $messageStack->add('search', ERROR_AT_LEAST_ONE_INPUT);
    }        
  }

//  if ($error == true) {
//    xos_redirect(xos_href_link(FILENAME_ADVANCED_SEARCH_AND_RESULTS, xos_get_all_get_params()));
//  }

  $site_trail->add(NAVBAR_TITLE_2, xos_href_link(FILENAME_ADVANCED_SEARCH_AND_RESULTS, xos_get_all_get_params(array('lnc', 'cur', 'tpl', 'x', 'y'))));
  
  
  }

  $categories_array = xos_get_categories(array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES)), '', '', false);

// This is a small helper function used in xos_js_manufacturers_list()
  function xos_get_categories_string($parent_id = '', $entrance = false, $categories_string = '') {
    
    $DB = Registry::get('DB');
    if ($entrance) {
      $categories_string = " p2c.categories_or_pages_id = '" . $parent_id . "'";
    }
 
    $child_category_query = $DB->prepare
    (
     "SELECT categories_or_pages_id
        FROM " . TABLE_CATEGORIES_OR_PAGES . "
       WHERE parent_id = :parent_id
         AND categories_or_pages_status = '1'"
    );
    
    $DB->perform($child_category_query, array(':parent_id' => (int)$parent_id)); 
 
    while ($categories = $child_category_query->fetch()) {
      $categories_string .= " OR p2c.categories_or_pages_id = '" . $categories['categories_or_pages_id'] . "'";
      $categories_string = xos_get_categories_string($categories['categories_or_pages_id'], '', $categories_string);
    }

    return $categories_string;
  }

// javascript to dynamically update the manufacturers list when the category is changed
  function xos_js_manufacturers_list($category, $form, $field) {
  global $categories_array;
    
    $DB = Registry::get('DB');
    $num_category = 1;
    $output_string = '';
    
    foreach ($categories_array as $category_value) {    
    
      if ($num_category == 1) {
        $output_string .= '  if (' . $category . ' == "' . $category_value['id'] . '") {' . "\n";
      } else {
        $output_string .= '  } else if (' . $category . ' == "' . $category_value['id'] . '") {' . "\n";
      }

      $manufacturers_sql = $DB->prepare
      (
       "SELECT DISTINCT mi.manufacturers_id   AS id,
                        mi.manufacturers_name AS name
        FROM            " . TABLE_PRODUCTS . " p,
                        " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c,
                        " . TABLE_MANUFACTURERS_INFO . " mi
        WHERE           p.products_status = '1'
        AND             p.manufacturers_id = mi.manufacturers_id
        AND             mi.languages_id = :languages_id
        AND             p.products_id = p2c.products_id
        AND             (" . xos_get_categories_string((int)$category_value['id'], true) . ")
        ORDER BY        mi.manufacturers_name"
      );
      
      $DB->perform($manufacturers_sql, array(':languages_id' => (int)$_SESSION['languages_id']));

      $output_string .= '    document.' . $form . '.' . $field . '.options[0] = new Option("' . TEXT_ALL_MANUFACTURERS . '", "");' . "\n";
      $num_manufacturer = 1;
      while ($manufacturers = $manufacturers_sql->fetch()) {
        
        $output_string .= '    document.' . $form . '.' . $field . '.options[' . $num_manufacturer . '] = new Option("' . $manufacturers['name'] . '", "' . $manufacturers['id'] . '");' . "\n";
        $num_manufacturer++;
      }
      $num_category++;
    }
    $output_string .= '  }';

    return $output_string;
  }
  
  $add_header =  '<script type="text/javascript" src="' . DIR_WS_CATALOG . DIR_WS_IMAGES . 'catalog/templates/' . SELECTED_TPL .'/' . $_SESSION['language'] . '/jquery.ui.datepicker-language.min.js"></script>' . "\n" . 
                 '<script type="text/javascript">' . "\n" .
                 '/* <![CDATA[ */' . "\n\n" .

                 '$(function() {' . "\n" .                                                                                        
                 '  $( "#id_dfrom" ).datepicker({' . "\n" .
                 '    changeMonth: true,' . "\n" .
                 '    changeYear: true' . "\n" .
                 '  });' . "\n\n" .
                              
                 '  $( "#id_dto" ).datepicker({' . "\n" .
                 '    changeMonth: true,' . "\n" .
                 '    changeYear: true' . "\n" .
                 '  });' . "\n\n" .
                 
//                 '  $( "#ui-datepicker-div" ).css( "font-size", "75%" );' . "\n\n" .
                 
                 '});' . "\n\n" .
                 
                 'function UpdateManufacturers() {' . "\n" .
                 '  var NumManufacturers = document.advanced_search_and_results._m.options.length;' . "\n" .
                 '  var PostNumManufacturers = "";' . "\n" .
                 '  var SelectedManufacturer = "";' . "\n" .
                 '  var SelectedCategory = "";' . "\n\n" .
                 
                 '  SelectedManufacturer = document.advanced_search_and_results._m.options[document.advanced_search_and_results._m.selectedIndex].value;' . "\n" .
                 '  SelectedCategory = document.advanced_search_and_results.copid.options[document.advanced_search_and_results.copid.selectedIndex].value;' . "\n\n" .

                 '  while(NumManufacturers > 0) {' . "\n" .
                 '    NumManufacturers--;' . "\n" .
                 '    document.advanced_search_and_results._m.options[NumManufacturers] = null;' . "\n" .
                 '  }' . "\n\n" .         

                 xos_js_manufacturers_list('SelectedCategory', 'advanced_search_and_results', '_m') . "\n\n" .
                 
                 '  PostNumManufacturers = document.advanced_search_and_results._m.options.length;' . "\n\n" .
                 
                 '  while(PostNumManufacturers > 0) {' . "\n" .
                 '    PostNumManufacturers--;' . "\n" .
                 '    if (document.advanced_search_and_results._m.options[PostNumManufacturers].value == SelectedManufacturer)' . "\n" .
                 '    document.advanced_search_and_results._m.options[PostNumManufacturers].selected = true;' . "\n" .
                 '  }' . "\n\n" .                   
                 
                 '}' . "\n\n" .                  
                 
                 'function SetFocus(TargetFormName) {' . "\n" .
                 '  var target = 0;' . "\n" .
                 '  if (TargetFormName != "") {' . "\n" .
                 '    for (i=0; i<document.forms.length; i++) {' . "\n" .
                 '      if (document.forms[i].name == TargetFormName) {' . "\n" .
                 '        target = i;' . "\n" .
                 '        break;' . "\n" .
                 '      }' . "\n" .
                 '    }' . "\n" .
                 '  }' . "\n\n" .

                 '  var TargetForm = document.forms[target];' . "\n\n" .
    
                 '  for (i=0; i<TargetForm.length; i++) {' . "\n" .
                 '    if ( (TargetForm.elements[i].type != "image") && (TargetForm.elements[i].type != "hidden") && (TargetForm.elements[i].type != "reset") && (TargetForm.elements[i].type != "submit") ) {' . "\n" .
                 '      TargetForm.elements[i].focus();' . "\n\n" .

                 '      if ( (TargetForm.elements[i].type == "text") || (TargetForm.elements[i].type == "password") ) {' . "\n" .
                 '        TargetForm.elements[i].select();' . "\n" .
                 '      }' . "\n\n" .

                 '      break;' . "\n" .
                 '    }' . "\n" .
                 '  }' . "\n" .
                 '}' . "\n\n" .

                 'function RemoveFormatString(TargetElement, FormatString) {' . "\n" .
                 '  if (TargetElement.value == FormatString) {' . "\n" .
                 '    TargetElement.value = "";' . "\n" .
                 '  }' . "\n\n" .

                 '  TargetElement.select();' . "\n" .
                 '}' . "\n\n" .

                 'function IsValidDate(DateToCheck, FormatString, RemoveFormat) {' . "\n" .
                 '  var strDateToCheck;' . "\n" .
                 '  var strDateToCheckArray;' . "\n" .
                 '  var strFormatArray;' . "\n" .
                 '  var strFormatString;' . "\n" .
                 '  var strDay;' . "\n" .
                 '  var strMonth;' . "\n" .
                 '  var strYear;' . "\n" .
                 '  var intday;' . "\n" .
                 '  var intMonth;' . "\n" .
                 '  var intYear;' . "\n" .
                 '  var intDateSeparatorIdx = -1;' . "\n" .
                 '  var intFormatSeparatorIdx = -1;' . "\n" .
                 '  var strSeparatorArray = new Array("-"," ","/",".");' . "\n" .
                 '  var strMonthArray = new Array("jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec");' . "\n" .
                 '  var intDaysArray = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);' . "\n\n" .

                 '  strDateToCheck = DateToCheck.toLowerCase();' . "\n" .
                 '  strFormatString = FormatString.toLowerCase();' . "\n\n" .
  
                 '  if (strDateToCheck.length != strFormatString.length) {' . "\n" .
                 '    return false;' . "\n" .
                 '  }' . "\n\n" .

                 '  for (i=0; i<strSeparatorArray.length; i++) {' . "\n" .
                 '    if (strFormatString.indexOf(strSeparatorArray[i]) != -1) {' . "\n" .
                 '      intFormatSeparatorIdx = i;' . "\n" .
                 '      break;' . "\n" .
                 '    }' . "\n" .
                 '  }' . "\n\n" .

                 '  for (i=0; i<strSeparatorArray.length; i++) {' . "\n" .
                 '    if (strDateToCheck.indexOf(strSeparatorArray[i]) != -1) {' . "\n" .
                 '      intDateSeparatorIdx = i;' . "\n" .
                 '      break;' . "\n" .
                 '    }' . "\n" .
                 '  }' . "\n\n" .

                 '  if (intDateSeparatorIdx != intFormatSeparatorIdx) {' . "\n" .
                 '    return false;' . "\n" .
                 '  }' . "\n\n" .

                 '  if (intDateSeparatorIdx != -1) {' . "\n" .
                 '    strFormatArray = strFormatString.split(strSeparatorArray[intFormatSeparatorIdx]);' . "\n" .
                 '    if (strFormatArray.length != 3) {' . "\n" .
                 '      return false;' . "\n" .
                 '    }' . "\n\n" .

                 '    strDateToCheckArray = strDateToCheck.split(strSeparatorArray[intDateSeparatorIdx]);' . "\n" .
                 '    if (strDateToCheckArray.length != 3) {' . "\n" .
                 '      return false;' . "\n" .
                 '    }' . "\n\n" .

                 '    for (i=0; i<strFormatArray.length; i++) {' . "\n" .
                 '      if (strFormatArray[i] == "mm" || strFormatArray[i] == "mmm") {' . "\n" .
                 '        strMonth = strDateToCheckArray[i];' . "\n" .
                 '      }' . "\n\n" .

                 '      if (strFormatArray[i] == "dd") {' . "\n" .
                 '        strDay = strDateToCheckArray[i];' . "\n" .
                 '      }' . "\n\n" .

                 '      if (strFormatArray[i] == "yyyy") {' . "\n" .
                 '        strYear = strDateToCheckArray[i];' . "\n" .
                 '      }' . "\n" .
                 '    }' . "\n" .
                 '  } else {' . "\n" .
                 '    if (FormatString.length > 7) {' . "\n" .
                 '      if (strFormatString.indexOf("mmm") == -1) {' . "\n" .
                 '        strMonth = strDateToCheck.substring(strFormatString.indexOf("mm"), 2);' . "\n" .
                 '      } else {' . "\n" .
                 '        strMonth = strDateToCheck.substring(strFormatString.indexOf("mmm"), 3);' . "\n" .
                 '      }' . "\n\n" .

                 '      strDay = strDateToCheck.substring(strFormatString.indexOf("dd"), 2);' . "\n" .
                 '      strYear = strDateToCheck.substring(strFormatString.indexOf("yyyy"), 2);' . "\n" .
                 '    } else {' . "\n" .
                 '      return false;' . "\n" .
                 '    }' . "\n" .
                 '  }' . "\n\n" .

                 '  if (RemoveFormat == true) {' . "\n" . 
                 '    return strYear + strMonth + strDay;' . "\n" .
                 '  }' . "\n\n" .

                 '  if (strYear.length != 4) {' . "\n" .
                 '    return false;' . "\n" .
                 '  }' . "\n\n" .

                 '  intday = parseInt(strDay, 10);' . "\n" .
                 '  if (isNaN(intday)) {' . "\n" .
                 '    return false;' . "\n" .
                 '  }' . "\n" .
                 '  if (intday < 1) {' . "\n" .
                 '    return false;' . "\n" .
                 '  }' . "\n\n" .

                 '  intMonth = parseInt(strMonth, 10);' . "\n" .
                 '  if (isNaN(intMonth)) {' . "\n" .
                 '    for (i=0; i<strMonthArray.length; i++) {' . "\n" .
                 '      if (strMonth == strMonthArray[i]) {' . "\n" .
                 '        intMonth = i+1;' . "\n" .
                 '        break;' . "\n" .
                 '      }' . "\n" .
                 '    }' . "\n" .
                 '    if (isNaN(intMonth)) {' . "\n" .
                 '      return false;' . "\n" .
                 '    }' . "\n" .
                 '  }' . "\n" .
                 '  if (intMonth > 12 || intMonth < 1) {' . "\n" .
                 '    return false;' . "\n" .
                 '  }' . "\n\n" .

                 '  intYear = parseInt(strYear, 10);' . "\n" .
                 '  if (isNaN(intYear)) {' . "\n" .
                 '    return false;' . "\n" .
                 '  }' . "\n\n" .
  
                 '  if (IsLeapYear(intYear) == true) {' . "\n" .
                 '    intDaysArray[1] = 29;' . "\n" .
                 '  }' . "\n\n" .

                 '  if (intday > intDaysArray[intMonth - 1]) {' . "\n" .
                 '    return false;' . "\n" .
                 '  }' . "\n\n" .
  
                 '  return true;' . "\n" .
                 '}' . "\n\n" .

                 'function IsLeapYear(intYear) {' . "\n" .
                 '  if (intYear % 100 == 0) {' . "\n" .
                 '    if (intYear % 400 == 0) {' . "\n" .
                 '      return true;' . "\n" .
                 '    }' . "\n" .
                 '  } else {' . "\n" .
                 '    if ((intYear % 4) == 0) {' . "\n" .
                 '      return true;' . "\n" .
                 '    }' . "\n" .
                 '  }' . "\n\n" .

                 '  return false;' . "\n" .
                 '}' . "\n\n" .  
                              
                 'function check_form() {' . "\n" .
                 '  var error_message = "' . JS_ERROR . '";' . "\n" .
                 '  var error_found = false;' . "\n" .
                 '  var error_field;' . "\n" .
                 '  var keywords = document.advanced_search_and_results.keywords.value;' . "\n" .
                 '  var dfrom = document.advanced_search_and_results.dfrom.value;' . "\n" .
                 '  var dto = document.advanced_search_and_results.dto.value;' . "\n" .
                 '  var pfrom = document.advanced_search_and_results.pfrom.value;' . "\n" .
                 '  var pto = document.advanced_search_and_results.pto.value;' . "\n" .
                 '  var pfrom_float;' . "\n" .
                 '  var pto_float;' . "\n\n" .

                 '  String.prototype.trim = function () {' . "\n" .
                 '    return (this.replace(/\s+$/,"").replace(/^\s+/,""));' . "\n" .
                 '  };' . "\n\n" .

                 '  if ( ((keywords == "") || (keywords.trim().length < 1)) && ((dfrom == "") || (dfrom == "' . AS_FORMAT_STRING . '") || (dfrom.length < 1)) && ((dto == "") || (dto == "' . AS_FORMAT_STRING . '") || (dto.length < 1)) && ((pfrom == "") || (pfrom.length < 1)) && ((pto == "") || (pto.length < 1)) ) {' . "\n" .
                 '    error_message = error_message + "* ' . ERROR_AT_LEAST_ONE_INPUT . '\n";' . "\n" .
                 '    error_field = document.advanced_search_and_results.keywords;' . "\n" .
                 '    error_found = true;' . "\n" .
                 '  }' . "\n\n" .

                 '  if ((dfrom.length > 0) && (dfrom != "' . AS_FORMAT_STRING . '")) {' . "\n" .
                 '    if (!IsValidDate(dfrom, "' . AS_FORMAT_STRING_JS . '")) {' . "\n" .
                 '      error_message = error_message + "* ' . ERROR_INVALID_FROM_DATE . '\n";' . "\n" .
                 '      error_field = document.advanced_search_and_results.dfrom;' . "\n" .
                 '      error_found = true;' . "\n" .
                 '    }' . "\n" .
                 '  }' . "\n\n" .

                 '  if ((dto.length > 0) && (dto != "' . AS_FORMAT_STRING . '")) {' . "\n" .
                 '    if (!IsValidDate(dto, "' . AS_FORMAT_STRING_JS . '")) {' . "\n" .
                 '      error_message = error_message + "* ' . ERROR_INVALID_TO_DATE . '\n";' . "\n" .
                 '      error_field = document.advanced_search_and_results.dto;' . "\n" .
                 '      error_found = true;' . "\n" .
                 '    }' . "\n" .
                 '  }' . "\n\n" .

                 '  if ((dfrom.length > 0) && (dfrom != "' . AS_FORMAT_STRING . '") && (IsValidDate(dfrom, "' . AS_FORMAT_STRING_JS . '")) && (dto.length > 0) && (dto != "' . AS_FORMAT_STRING . '") && (IsValidDate(dto, "' . AS_FORMAT_STRING_JS . '"))) {' . "\n" .
                 '    if (IsValidDate(dfrom, "' . AS_FORMAT_STRING_JS . '", true) > IsValidDate(dto, "' . AS_FORMAT_STRING_JS . '", true)) {' . "\n" .
                 '      error_message = error_message + "* ' . ERROR_TO_DATE_LESS_THAN_FROM_DATE . '\n";' . "\n" .
                 '      error_field = document.advanced_search_and_results.dto;' . "\n" .
                 '      error_found = true;' . "\n" .
                 '    }' . "\n" .
                 '  }' . "\n\n" .

                 '  if (pfrom.length > 0) {' . "\n" .
                 '    pfrom_float = parseFloat(pfrom);' . "\n" .
                 '    if (isNaN(pfrom_float)) {' . "\n" .
                 '      error_message = error_message + "* ' . ERROR_PRICE_FROM_MUST_BE_NUM . '\n";' . "\n" .
                 '      error_field = document.advanced_search_and_results.pfrom;' . "\n" .
                 '      error_found = true;' . "\n" .
                 '    }' . "\n" .
                 '  } else {' . "\n" .
                 '    pfrom_float = 0;' . "\n" .
                 '  }' . "\n\n" .

                 '  if (pto.length > 0) {' . "\n" .
                 '    pto_float = parseFloat(pto);' . "\n" .
                 '    if (isNaN(pto_float)) {' . "\n" .
                 '      error_message = error_message + "* ' . ERROR_PRICE_TO_MUST_BE_NUM . '\n";' . "\n" .
                 '      error_field = document.advanced_search_and_results.pto;' . "\n" .
                 '      error_found = true;' . "\n" .
                 '    }' . "\n" .
                 '  } else {' . "\n" .
                 '    pto_float = 0;' . "\n" .
                 '  }' . "\n\n" .

                 '  if ( (pfrom.length > 0) && (pto.length > 0) ) {' . "\n" .
                 '    if ( (!isNaN(pfrom_float)) && (!isNaN(pto_float)) && (pto_float <= pfrom_float) ) {' . "\n" .
                 '      error_message = error_message + "* ' . ERROR_PRICE_TO_LESS_THAN_PRICE_FROM . '\n";' . "\n" .
                 '      error_field = document.advanced_search_and_results.pto;' . "\n" .
                 '      error_found = true;' . "\n" .
                 '    }' . "\n" .
                 '  }' . "\n\n" .

                 '  if (error_found == true) {' . "\n" .
                 '    alert(error_message);' . "\n" .
                 '    error_field.focus();' . "\n" .
                 '    return false;' . "\n" .
                 '  } else {' . "\n" . 
                 '    $( "#id_dfrom, #id_dto" ).datepicker( "destroy" );' . "\n" .               
                 '    RemoveFormatString(document.advanced_search_and_results.dfrom, "' . AS_FORMAT_STRING . '");' . "\n" .
                 '    RemoveFormatString(document.advanced_search_and_results.dto, "' . AS_FORMAT_STRING . '");' . "\n" .
                 '    $( "#id_dfrom, #id_dto" ).blur();' . "\n" .
                 '    return true;' . "\n" .
                 '  }' . "\n" .
                 '}' . "\n" .
                 '/* ]]> */' . "\n" .
                 '</script> ' . "\n"; 
                                  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');                                 

  $search_in_description = $_GET['sid'];

  if ($messageStack->size('search') > 0) {
    $smarty->assign('message_stack', $messageStack->output('search'));
    $smarty->assign('message_stack_error', $messageStack->output('search', 'error'));
    $smarty->assign('message_stack_warning', $messageStack->output('search', 'warning')); 
    $smarty->assign('message_stack_success', $messageStack->output('search', 'success'));     
  }
  
  $popup_status_query = $DB->query
  (
   "SELECT status
    FROM   " . TABLE_CONTENTS . "
    WHERE  type = 'system_popup'
    AND    status = '1'
    AND    content_id = '9'
    LIMIT  1"
  );

  $smarty->assign(array('form_begin' => xos_draw_form('advanced_search_and_results', xos_href_link(FILENAME_ADVANCED_SEARCH_AND_RESULTS, '', 'NONSSL', false), 'post', 'onsubmit="return check_form(this);"'), 
                        'hide_session_id' => xos_hide_session_id(),
                        'input_field_keywords' => xos_draw_input_field('keywords', stripslashes($_GET['keywords']), 'class="form-control" id="keywords"'),
                        'checkbox_search_in_description' => xos_draw_checkbox_field('sid', '1', ($action && !isset($_GET['sid']) ? false : true), 'id="search_in_description"'),
                        'link_filename_advanced_search_and_results' => xos_href_link(FILENAME_ADVANCED_SEARCH_AND_RESULTS),
                        'link_filename_popup_content_9' => $popup_status_query->rowCount() == 1 ? xos_href_link(FILENAME_POPUP_CONTENT, 'co=9', $request_type) : '',
                        'categories_pull_down_menu' => xos_draw_pull_down_menu('copid', $categories_array, $_GET['copid'], 'class="form-control" id="categories_or_pages_id" onchange="UpdateManufacturers();"'),                        
                        'manufacturers_pull_down_menu' => xos_draw_pull_down_menu('_m', xos_get_manufacturers(array(array('id' => '', 'text' => TEXT_ALL_MANUFACTURERS))), $_GET['_m'], 'class="form-control" id="manufacturers_id"'),
                        'input_field_pfrom' => xos_draw_input_field('pfrom', $_GET['pfrom'], 'class="form-control" id="pfrom"'),
                        'input_field_pto' => xos_draw_input_field('pto', $_GET['pto'], 'class="form-control" id="pto"'),
                        'input_field_dfrom' => xos_draw_input_field('dfrom', (($_GET['dfrom']) ? $_GET['dfrom'] : AS_FORMAT_STRING), 'class="form-control" id="id_dfrom" autocomplete="off"'),
                        'input_field_dto' => xos_draw_input_field('dto', (($_GET['dto']) ? $_GET['dto'] : AS_FORMAT_STRING), 'class="form-control" id="id_dto" autocomplete="off"'),
                        'body_tag_params' => 'onload="UpdateManufacturers();"',                        
                        'form_end' => '</form>'));
                        
if ($action && !$error) {
  is_numeric($_GET['mdsr']) && $_GET['mdsr'] >= 1 ? $_SESSION['mdsr'] = (int)$_GET['mdsr'] : '';

  if ($_GET['srv'] == 'list') { 
    $_SESSION['srv'] = 'list'; 
  } elseif ($_GET['srv'] == 'grid') { 
    $_SESSION['srv'] = 'grid';
  }
                       
  if((PRODUCT_LISTS_FOR_SEARCH_RESULTS == 'B' && $_SESSION['srv'] != 'list') || $_SESSION['srv'] == 'grid') {  
  
    $product_list_b = true;
      
    // create column list
    $define_list = array('PRODUCT_LIST_MODEL' => PRODUCT_LIST_B_MODEL,
                         'PRODUCT_LIST_NAME' => PRODUCT_LIST_B_NAME,
                         'PRODUCT_LIST_INFO' => PRODUCT_LIST_B_INFO,
                         'PRODUCT_LIST_PACKING_UNIT' => PRODUCT_LIST_B_PACKING_UNIT,
                         'PRODUCT_LIST_MANUFACTURER' => PRODUCT_LIST_B_MANUFACTURER,
                         'PRODUCT_LIST_PRICE' => PRODUCT_LIST_B_PRICE,
                         'PRODUCT_LIST_QUANTITY' => STOCK_CHECK == 'true' ? PRODUCT_LIST_B_QUANTITY : '',
                         'PRODUCT_LIST_WEIGHT' => PRODUCT_LIST_B_WEIGHT,
                         'PRODUCT_LIST_IMAGE' => PRODUCT_LIST_B_IMAGE,
                         'PRODUCT_LIST_BUY_NOW' => PRODUCT_LIST_B_BUY_NOW);
      
  } else {
  
    $product_list_b = false; 
      
    // create column list
    $define_list = array('PRODUCT_LIST_MODEL' => PRODUCT_LIST_A_MODEL,
                         'PRODUCT_LIST_NAME' => PRODUCT_LIST_A_NAME,
                         'PRODUCT_LIST_INFO' => PRODUCT_LIST_A_INFO,
                         'PRODUCT_LIST_PACKING_UNIT' => PRODUCT_LIST_A_PACKING_UNIT,
                         'PRODUCT_LIST_MANUFACTURER' => PRODUCT_LIST_A_MANUFACTURER,
                         'PRODUCT_LIST_PRICE' => PRODUCT_LIST_A_PRICE,
                         'PRODUCT_LIST_QUANTITY' => STOCK_CHECK == 'true' ? PRODUCT_LIST_A_QUANTITY : '',
                         'PRODUCT_LIST_WEIGHT' => PRODUCT_LIST_A_WEIGHT,
                         'PRODUCT_LIST_IMAGE' => PRODUCT_LIST_A_IMAGE,
                         'PRODUCT_LIST_BUY_NOW' => PRODUCT_LIST_A_BUY_NOW); 
                                          
  }

  asort($define_list);

  $column_list = array();
  reset($define_list);
  foreach($define_list as $key => $value) { 
    if ($value == '') $value = -1;
    if ($value >= 0) $column_list[] = $key;
  }

  $select_column_list = '';

  for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
    switch ($column_list[$i]) {
      case 'PRODUCT_LIST_MODEL':
        $select_column_list .= 'p.products_model, ';
        break;
      case 'PRODUCT_LIST_INFO':  
        $select_column_list .= 'pd.products_info, ';
        break;
      case 'PRODUCT_LIST_PACKING_UNIT':
	      $select_column_list .= 'pd.products_p_unit, ';
        break;                 
      case 'PRODUCT_LIST_MANUFACTURER':
        $select_column_list .= 'mi.manufacturers_name, ';
        break;
      case 'PRODUCT_LIST_QUANTITY':
        $select_column_list .= 'p.products_quantity, ';
        break;
      case 'PRODUCT_LIST_IMAGE':
        $select_column_list .= 'p.products_image, ';
        break;
      case 'PRODUCT_LIST_WEIGHT':
        $select_column_list .= 'p.products_weight, ';
        break;
    }
  }
  
  $select_str_param_array = array();
  $from_str_param_array = array();
  $where_str_param_array = array();
  $order_str_param_array = array();
  
  if (($_SESSION['sppc_customer_group_show_tax'] == '1') && ($_SESSION['sppc_customer_group_tax_exempt'] != '1')) { 
    $select_str = "SELECT DISTINCT " . $select_column_list . " 
                                   p.manufacturers_id,
                                   p.products_id,
                                   p.products_delivery_time_id,
                                   pd.products_name,
                                   p.products_price,
                                   p.products_tax_class_id,
                                   IF(s.status, s.specials_new_products_price, NULL) AS specials_new_products_price,(
                                     IF(s.status, s.specials_new_products_price, 
                                       IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) * 
                                     IF(tr.tax_rate_final IS NULL, 1, 1 + (tr.tax_rate_final / 100))) AS final_price,
                                   tr.tax_rate_final ";  
                                   
  } else {
    $select_str = "SELECT DISTINCT " . $select_column_list . " 
                                   p.manufacturers_id,
                                   p.products_id,
                                   p.products_delivery_time_id,
                                   pd.products_name,
                                   p.products_price,
                                   p.products_tax_class_id,
                                   IF(s.status, s.specials_new_products_price, NULL) AS specials_new_products_price,
                                   IF(s.status, s.specials_new_products_price, 
                                     IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) AS final_price ";
                                   
  }

  $from_str = "FROM      " . TABLE_PRODUCTS . " p
               LEFT JOIN " . TABLE_MANUFACTURERS_INFO . " mi
               ON        (
                          p.manufacturers_id = mi.manufacturers_id 
                          AND mi.languages_id = :languages_id
                          )
               LEFT JOIN " . TABLE_PRODUCTS_PRICES . " ppz
               ON        p.products_id = ppz.products_id
               AND       ppz.customers_group_id = '0'
               LEFT JOIN " . TABLE_PRODUCTS_PRICES . " pp
               ON        p.products_id = pp.products_id
               AND       pp.customers_group_id = :customer_group_id
               LEFT JOIN " . TABLE_SPECIALS . " s
               ON        p.products_id = s.products_id
               AND       s.customers_group_id = :customer_group_id";
      
  $from_str_param_array[':languages_id'] = (int)$_SESSION['languages_id'];
  $from_str_param_array[':customer_group_id'] = (int)$customer_group_id;
  
  if (($_SESSION['sppc_customer_group_show_tax'] == '1') && ($_SESSION['sppc_customer_group_tax_exempt'] != '1')) {
    if (!isset($_SESSION['customer_id'])) {
      $customer_country_id = STORE_COUNTRY;
      $customer_zone_id = STORE_ZONE;
    } else {
      $customer_country_id = $_SESSION['customer_country_id'];
      $customer_zone_id = $_SESSION['customer_zone_id'];
    }
    $from_str .=  " LEFT JOIN " . TABLE_ZONES_TO_GEO_ZONES . " gz
                    ON        (
                               gz.zone_country_id IS NULL
                               OR gz.zone_country_id = '0'
                               OR gz.zone_country_id = :customer_country_id
                               )
                    AND        (
                               gz.zone_id IS NULL
                               OR gz.zone_id = '0'
                               OR gz.zone_id = :customer_zone_id
                              )
                    LEFT JOIN " . TABLE_TAX_RATES_FINAL . " tr
                    ON        p.products_tax_class_id = tr.tax_class_id
                    AND       gz.geo_zone_id = tr.tax_zone_id";
        
    $from_str_param_array[':customer_country_id'] = (int)$customer_country_id;
    $from_str_param_array[':customer_zone_id'] = (int)$customer_zone_id;
  }

  $from_str .= ", " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                  " . TABLE_CATEGORIES_OR_PAGES . " c, 
                  " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c";

  $where_str =  " WHERE p.products_status = '1'
                  AND   c.categories_or_pages_status = '1'
                  AND   p.products_id = pd.products_id
                  AND   pd.language_id = :languages_id
                  AND   p.products_id = p2c.products_id
                  AND   p2c.categories_or_pages_id = c.categories_or_pages_id ";
    
//  $where_str_param_array[':languages_id'] = (int)$_SESSION['languages_id']; // ist bereits im $from_str_param_array enthalten (Zeile ca. 663)
  
  if (isset($_GET['copid']) && xos_not_null($_GET['copid'])) {
    $subcategories_array = array();
    xos_get_subcategories($subcategories_array, $_GET['copid']);

    $where_str .= " AND p2c.products_id = p.products_id 
                    AND p2c.products_id = pd.products_id 
                    AND (p2c.categories_or_pages_id = :copid";
                    
    $where_str_param_array[':copid'] = (int)$_GET['copid'];
    
    for ($i=0, $n=sizeof($subcategories_array); $i<$n; $i++ ) {
      $where_str .= " OR p2c.categories_or_pages_id = :subcategory_" . $i . "";
      $where_str_param_array[':subcategory_' . $i] = (int)$subcategories_array[$i];
    }

    $where_str .= ")";
  }

  if (isset($_GET['_m']) && xos_not_null($_GET['_m'])) {
    $where_str .= " AND mi.manufacturers_id = :_m";
    $where_str_param_array[':_m'] = (int)$_GET['_m'];
  }

  if (isset($search_keywords) && (sizeof($search_keywords) > 0)) {
    $where_str .= " AND (";
    for ($i=0, $n=sizeof($search_keywords); $i<$n; $i++ ) {
      switch ($search_keywords[$i]) {
        case '(':
        case ')':
        case 'and':
        case 'or':
          $where_str .= " " . $search_keywords[$i] . " ";
          break;
        default:
          $where_str .= "(pd.products_name like :keyword_" . $i . " 
                          OR p.products_model like :keyword_" . $i . " 
                          OR mi.manufacturers_name like :keyword_" . $i . "";
                          
          if (isset($_GET['sid']) && ($_GET['sid'] == '1')) $where_str .= " OR pd.products_description like :keyword_" . $i . " 
                                                                            OR pd.products_info like :keyword_" . $i . "";
                                                                            
          $where_str_param_array[':keyword_' . $i] = '%' . $search_keywords[$i] . '%';
          $where_str .= ')';
          break;
      }
    }
    $where_str .= " )";
  }

  if (xos_not_null($dfrom)) {
    $where_str .= " AND p.products_date_added >= :dfrom";
    $where_str_param_array[':dfrom'] = xos_date_raw($dfrom);
  }

  if (xos_not_null($dto)) {
    $where_str .= " AND p.products_date_added <= :dto";
    $where_str_param_array[':dto'] = xos_date_raw($dto);
  }

  if ($currencies->is_set($_SESSION['currency'])) {
    $rate = $currencies->get_value($_SESSION['currency']);
    if (xos_not_null($pfrom)) {
      $pfrom = $pfrom / $rate;
    }

    if (xos_not_null($pto)) {
      $pto = $pto / $rate;
    }    
  }
  
  $precision = $currencies->currencies[$_SESSION['currency']]['decimal_places'];

  if (($_SESSION['sppc_customer_group_show_tax'] == '1') && ($_SESSION['sppc_customer_group_tax_exempt'] != '1')) {
    if ($pfrom > 0) $where_str .= " AND (
                                          round(
                                          IF(s.status, s.specials_new_products_price,
                                            IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) *
                                            IF(tr.tax_rate_final IS NULL, 1, 1 + (tr.tax_rate_final / 100) ), :precision) >= round(:pfrom, :precision)
                                        )";
                                        
    if ($pto > 0) $where_str .= " AND (
                                        round(
                                        IF(s.status, s.specials_new_products_price,
                                          IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)) *
                                          IF(tr.tax_rate_final IS NULL, 1, 1 + (tr.tax_rate_final / 100) ), :precision) <= round(:pto, :precision)
                                      )";
                                      
  } else {
    if ($pfrom > 0) $where_str .= " AND (
                                          round(
                                          IF(s.status, s.specials_new_products_price,
                                            IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)), :precision) >= round(:pfrom, :precision)
                                        )";
                                        
    if ($pto > 0) $where_str .= " AND (
                                        round(
                                        IF(s.status, s.specials_new_products_price,
                                          IF(pp.customers_group_price >= 0, pp.customers_group_price, ppz.customers_group_price)), :precision) <= round(:pto, :precision)
                                      )";
                                      
  }
  if ($pfrom > 0) $where_str_param_array[':pfrom'] = (double)$pfrom;
  if ($pto > 0) $where_str_param_array[':pto'] = (double)$pto;
  if ($pfrom > 0 || $pto > 0) $where_str_param_array[':precision'] = $precision;

  if (($_SESSION['sppc_customer_group_show_tax'] == '1') && ($_SESSION['sppc_customer_group_tax_exempt'] != '1')) {
    $where_str .= " GROUP BY p.products_id, s.status, s.specials_new_products_price, tr.tax_rate_final";
  }

  if ( (empty($_GET['sort'])) || (!preg_match('/^[0-9][ad]$/', $_GET['sort'])) || (substr($_GET['sort'], 0, 1) > sizeof($column_list)) ) {
    for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
      if ($column_list[$i] == 'PRODUCT_LIST_NAME') {
        $_GET['sort'] = $i . 'a';
        $order_str = ' ORDER BY pd.products_name';
        break;
      }
    }
  } else {
    $sort_col = substr($_GET['sort'], 0 , 1);
    $sort_order = substr($_GET['sort'], 1);
    switch ($column_list[$sort_col]) {
      case 'PRODUCT_LIST_MODEL':
        $order_str .= " ORDER BY p.products_model " . ($sort_order == 'd' ? "DESC" : "") . ", pd.products_name";
        break;
      case 'PRODUCT_LIST_NAME':
        $order_str .= " ORDER BY pd.products_name " . ($sort_order == 'd' ? "DESC" : "");
        break;
      case 'PRODUCT_LIST_INFO':
//--------[Alternative] wenn hier aendern auch product_listing.php, index.php und specials.php aendern-----------  
//        $order_str .= " ORDER BY pd.products_info " . ($sort_order == 'd' ? "DESC" : "") . ", pd.products_name";
//------------------------------------------------------------------------------------------------------------------      
        $order_str .= " ORDER BY pd.products_name";
        break;
      case 'PRODUCT_LIST_PACKING_UNIT':       
        $order_str .= " ORDER BY pd.products_p_unit " . ($sort_order == 'd' ? "DESC" : "") . ", pd.products_name";
        break;                
      case 'PRODUCT_LIST_MANUFACTURER':
        $order_str .= " ORDER BY mi.manufacturers_name " . ($sort_order == 'd' ? "DESC" : "") . ", pd.products_name";
        break;
      case 'PRODUCT_LIST_QUANTITY':
        $order_str .= " ORDER BY p.products_quantity " . ($sort_order == 'd' ? "DESC" : "") . ", pd.products_name";
        break;
      case 'PRODUCT_LIST_IMAGE':
        $order_str .= " ORDER BY pd.products_name";
        break;
      case 'PRODUCT_LIST_WEIGHT':
        $order_str .= " ORDER BY p.products_weight " . ($sort_order == 'd' ? "DESC" : "") . ", pd.products_name";
        break;
      case 'PRODUCT_LIST_PRICE':
        $order_str .= " ORDER BY final_price " . ($sort_order == 'd' ? "DESC" : "") . ", pd.products_name";
        break;
    }
  }

  if ($session_started) { 
    
    $hidden_get_variables = '';
    reset($_GET);
    foreach($_GET as $key => $value) {
      if ( ($key != 'mdsr') && ($key != xos_session_name()) && ($key != 'page') ) {
        $hidden_get_variables .= xos_draw_hidden_field($key, $value);
      }
    }
         
    $pull_down_menu_display_search_results = xos_draw_form('display_search_results', xos_href_link(FILENAME_ADVANCED_SEARCH_AND_RESULTS, '', 'NONSSL', false, true, false, false, false), 'get');
    $pull_down_menu_display_search_results_noscript = xos_draw_form('display_search_results', xos_href_link(FILENAME_ADVANCED_SEARCH_AND_RESULTS, '', 'NONSSL', false, false, false, false, false), 'get') . xos_hide_session_id();
    $pull_down_menu_display_search_results_noscript .= $hidden_get_variables;
    $max_display_search_results_array = array();
    $max_display_search_results_array_noscript = array();
    $set = false;
    for ($i = 10; $i <=50 ; $i=$i+10) {  
      if (MAX_DISPLAY_SEARCH_RESULTS <= $i && $set == false) {
        $max_display_search_results_array[] = array('id' => xos_href_link(FILENAME_ADVANCED_SEARCH_AND_RESULTS, xos_get_all_get_params(array('mdsr', 'page')) . 'mdsr=' . MAX_DISPLAY_SEARCH_RESULTS, 'NONSSL', true, true, false, false, false), 'text' => MAX_DISPLAY_SEARCH_RESULTS . TEXT_MAX_PRODUCTS);
        $max_display_search_results_array_noscript[] = array('id' => MAX_DISPLAY_SEARCH_RESULTS, 'text' => MAX_DISPLAY_SEARCH_RESULTS . TEXT_MAX_PRODUCTS);
        $set = true;      
      }    
      if (MAX_DISPLAY_SEARCH_RESULTS != $i) {
        $max_display_search_results_array[] = array('id' => xos_href_link(FILENAME_ADVANCED_SEARCH_AND_RESULTS, xos_get_all_get_params(array('mdsr', 'page')) . 'mdsr=' . $i, 'NONSSL', true, true, false, false, false), 'text' => $i . TEXT_MAX_PRODUCTS);
        $max_display_search_results_array_noscript[] = array('id' => $i, 'text' => $i . TEXT_MAX_PRODUCTS);
      }
    }  
    if ($set == false) {
      $max_display_search_results_array[] = array('id' => xos_href_link(FILENAME_ADVANCED_SEARCH_AND_RESULTS, xos_get_all_get_params(array('mdsr', 'page')) . 'mdsr=' . MAX_DISPLAY_SEARCH_RESULTS, 'NONSSL', true, true, false, false, false), 'text' => MAX_DISPLAY_SEARCH_RESULTS . TEXT_MAX_PRODUCTS);
      $max_display_search_results_array_noscript[] = array('id' => MAX_DISPLAY_SEARCH_RESULTS, 'text' => MAX_DISPLAY_SEARCH_RESULTS . TEXT_MAX_PRODUCTS);
    }      
    $pull_down_menu_display_search_results .= xos_draw_pull_down_menu('mdsr', $max_display_search_results_array, xos_href_link(FILENAME_ADVANCED_SEARCH_AND_RESULTS, xos_get_all_get_params(array('mdsr', 'page')) . 'mdsr=' . (isset($_SESSION['mdsr']) ? $_SESSION['mdsr'] : MAX_DISPLAY_SEARCH_RESULTS), 'NONSSL', true, true, false, false, false), 'class="form-control" id="mdsr" onchange="location = form.mdsr.options[form.mdsr.selectedIndex].value;"') . '</form>';
    $pull_down_menu_display_search_results_noscript .= xos_draw_pull_down_menu('mdsr', $max_display_search_results_array_noscript, (isset($_SESSION['mdsr']) ? $_SESSION['mdsr'] : MAX_DISPLAY_SEARCH_RESULTS), 'class="form-control" id="mdsr"');    

    $link_switch_search_results_view = xos_href_link(FILENAME_ADVANCED_SEARCH_AND_RESULTS, xos_get_all_get_params(array('srv', 'sort', 'page')) . 'srv=' . ($product_list_b ? 'list' : 'grid'), 'NONSSL', true, true, false, false, false);
  }

  $smarty->assign(array('pull_down_menu_display_products' => $pull_down_menu_display_search_results,
                        'pull_down_menu_display_products_noscript_begin' => $pull_down_menu_display_search_results_noscript,
                        'pull_down_menu_display_products_noscript_end' => '</form>',
                        'label_for_max_display_products' => 'mdsr',
                        'link_switch_view' => $link_switch_search_results_view)); 

  $listing_sql = $select_str . $from_str . $where_str . $order_str;
  
  $listing_param_array = array_merge($select_str_param_array, $from_str_param_array, $where_str_param_array, $order_str_param_array);

  $max_display = isset($_SESSION['mdsr']) ? $_SESSION['mdsr'] : MAX_DISPLAY_SEARCH_RESULTS;

  require(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING);
  
  }
  
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'advanced_search_and_results');
  $output_advanced_search_and_results = $smarty->fetch(SELECTED_TPL . '/advanced_search_and_results.tpl');
                        
  $smarty->assign('central_contents', $output_advanced_search_and_results);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;