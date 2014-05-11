<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : payment.php
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
//              filename: payment.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  class payment {
    var $modules, $selected_module;

// class constructor
    function payment($module = '') {
      global $customer_group_id;

      if (defined('MODULE_PAYMENT_INSTALLED') && xos_not_null(MODULE_PAYMENT_INSTALLED)) {
        
        $customer_payment_query = xos_db_query("select group_payment_allowed as payment_allowed from " . TABLE_CUSTOMERS_GROUPS . " where customers_group_id =  '" . $customer_group_id . "'");
        if ($customer_payment = xos_db_fetch_array($customer_payment_query)  ) {
          if (xos_not_null($customer_payment['payment_allowed'])) {
            $temp_payment_array = explode(';', $customer_payment['payment_allowed']);
            $installed_modules = explode(';', MODULE_PAYMENT_INSTALLED);
            for ($n = 0; $n < sizeof($installed_modules) ; $n++) {
              // check to see if a payment method is not de-installed
              if ( in_array($installed_modules[$n], $temp_payment_array ) ) {
                $payment_array[] = $installed_modules[$n];
              }
            }
            $this->modules = $payment_array;
          } else {
            $this->modules = explode(';', MODULE_PAYMENT_INSTALLED);
          }
        } else {
          $this->modules = explode(';', MODULE_PAYMENT_INSTALLED);
        }

        $include_modules = array();

        if ( (xos_not_null($module)) && (in_array($module . '.' . substr(basename($_SERVER['PHP_SELF']), (strrpos(basename($_SERVER['PHP_SELF']), '.')+1)), $this->modules)) ) {
          $this->selected_module = $module;

          $include_modules[] = array('class' => $module, 'file' => $module . '.php');
        } else {
          reset($this->modules);
          while (list(, $value) = each($this->modules)) {
            $class = substr($value, 0, strrpos($value, '.'));
            $include_modules[] = array('class' => $class, 'file' => $value);
          }
        }

        for ($i=0, $n=sizeof($include_modules); $i<$n; $i++) {
          include(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/modules/payment/' . $include_modules[$i]['file']);
          include(DIR_WS_MODULES . 'payment/' . $include_modules[$i]['file']);

          $GLOBALS[$include_modules[$i]['class']] = new $include_modules[$i]['class'];
        }

        if ( (xos_count_payment_modules() == 1) && (!isset($_SESSION['payment']) || (isset($_SESSION['payment']) && !is_object($_SESSION['payment']))) ) {
          $_SESSION['payment'] = $include_modules[0]['class'];
        }

        if ( (xos_not_null($module)) && (in_array($module, $this->modules)) && (isset($GLOBALS[$module]->form_action_url)) ) {
          $this->form_action_url = $GLOBALS[$module]->form_action_url;
        }
      }
    }

// class methods
/* The following method is needed in the checkout_confirmation.php page
   due to a chicken and egg problem with the payment class and order class.
   The payment modules needs the order destination data for the dynamic status
   feature, and the order class needs the payment module title.
   The following method is a work-around to implementing the method in all
   payment modules available which would break the modules in the contributions
   section. This should be looked into again post 2.2.
*/   
    function update_status() {
      if (is_array($this->modules)) {
        if (is_object($GLOBALS[$this->selected_module]) && method_exists($GLOBALS[$this->selected_module], 'update_status')) {
          $GLOBALS[$this->selected_module]->update_status();
        }
      }
    }

    function js_validation() {
      if (is_array($this->modules)) {
        if (is_object($GLOBALS[$this->selected_module]) && ($GLOBALS[$this->selected_module]->enabled)  && method_exists($GLOBALS[$this->selected_module], 'js_validation')) {
          return $GLOBALS[$this->selected_module]->js_validation();
        }
      }
    }

    function javascript_validation() {

      $js = '<script type="text/javascript">' . "\n" .
            '/* <![CDATA[ */' . "\n" .
            'function check_form() {' . "\n" .
            '  var error = 0;' . "\n" .
            '  var error_message = "' . JS_ERROR . '";' . "\n";
             
      if (is_array($this->modules)) {              
        $js .= '  var payment_value = null;' . "\n\n" .
               '  if (document.checkout_payment.payment.length) {' . "\n" .
               '    for (var i=0; i<document.checkout_payment.payment.length; i++) {' . "\n" .
               '      if (document.checkout_payment.payment[i].checked) {' . "\n" .
               '        payment_value = document.checkout_payment.payment[i].value;' . "\n" .
               '      }' . "\n" .
               '    }' . "\n" .
               '  } else if (document.checkout_payment.payment.checked) {' . "\n" .
               '    payment_value = document.checkout_payment.payment.value;' . "\n" .
               '  } else if (document.checkout_payment.payment.value) {' . "\n" .
               '    payment_value = document.checkout_payment.payment.value;' . "\n" .
               '  }' . "\n\n" .

               '  if (payment_value == null) {' . "\n" .
               '    error_message = error_message + "' . JS_ERROR_NO_PAYMENT_MODULE_SELECTED . '";' . "\n" .
               '    error = 1;' . "\n" .
               '  }' . "\n"; 
      }              
              
      if (MUST_ACCEPT_CONDITIONS == 'true') {
        $js .= "\n" . '  if (!document.checkout_payment["accept_conditions"].checked) {' . "\n" .
               '    error_message = error_message + "' . JS_ERROR_CONDITIONS_NOT_ACCEPTED . '";' . "\n" .
               '    error = 1;' . "\n" .
               '  }' . "\n";
      }                 
              
      $js .= "\n" . '  if (error == 1) {' . "\n" .
             '    alert(error_message);' . "\n" .
             '    return false;' . "\n" .
             '  } else {' . "\n" .
             '    return true;' . "\n" .
             '  }' . "\n" .
             '}' . "\n" .
             '/* ]]> */' . "\n" .
             '</script>' . "\n";

      return $js;
    }

    function checkout_initialization_method() {
      $initialize_array = array();

      if (is_array($this->modules)) {
        reset($this->modules);
        while (list(, $value) = each($this->modules)) {
          $class = substr($value, 0, strrpos($value, '.'));
          if ($GLOBALS[$class]->enabled && method_exists($GLOBALS[$class], 'checkout_initialization_method')) {
            $initialize_array[] = $GLOBALS[$class]->checkout_initialization_method();
          }
        }
      }

      return $initialize_array;
    }

    function selection() {
      $selection_array = array();

      if (is_array($this->modules)) {
        reset($this->modules);
        while (list(, $value) = each($this->modules)) {
          $class = substr($value, 0, strrpos($value, '.'));
          if ($GLOBALS[$class]->enabled) {
            $selection = $GLOBALS[$class]->selection();
            if (is_array($selection)) $selection_array[] = $selection;
          }
        }
      }

      return $selection_array;
    }

    function pre_confirmation_check() {
      if (is_array($this->modules)) {
        if (is_object($GLOBALS[$this->selected_module]) && ($GLOBALS[$this->selected_module]->enabled) ) {
          $GLOBALS[$this->selected_module]->pre_confirmation_check();
        }
      }
    }

    function confirmation() {
      if (is_array($this->modules)) {
        if (is_object($GLOBALS[$this->selected_module]) && ($GLOBALS[$this->selected_module]->enabled) ) {
          return $GLOBALS[$this->selected_module]->confirmation();
        }
      }
    }

    function process_button() {
      if (is_array($this->modules)) {
        if (is_object($GLOBALS[$this->selected_module]) && ($GLOBALS[$this->selected_module]->enabled) ) {
          return $GLOBALS[$this->selected_module]->process_button();
        }
      }
    }

    function before_process() {
      if (is_array($this->modules)) {
        if (is_object($GLOBALS[$this->selected_module]) && ($GLOBALS[$this->selected_module]->enabled) ) {
          return $GLOBALS[$this->selected_module]->before_process();
        }
      }
    }

    function after_process() {
      if (is_array($this->modules)) {
        if (is_object($GLOBALS[$this->selected_module]) && ($GLOBALS[$this->selected_module]->enabled) ) {
          return $GLOBALS[$this->selected_module]->after_process();
        }
      }
    }

    function get_error() {
      if (is_array($this->modules)) {
        if (is_object($GLOBALS[$this->selected_module]) && ($GLOBALS[$this->selected_module]->enabled) ) {
          return $GLOBALS[$this->selected_module]->get_error();
        }
      }
    }
  }
?>
