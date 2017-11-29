<?php
// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled (or the session has not started)
  if ($session_started == false) {
    xos_redirect(xos_href_link(FILENAME_COOKIE_USAGE));
  }

// needs to be included earlier to set the success message in the messageStack
  require(DIR_FS_SMARTY . 'catalog/languages/' . $_SESSION['language'] . '/' . FILENAME_CREATE_ACCOUNT);

  $process = false;
  if (isset($_POST['action']) && ($_POST['action'] == 'process') && isset($_POST['formid']) && ($_POST['formid'] == $_SESSION['sessiontoken'])) {
    $process = true;

    if (ACCOUNT_GENDER == 'true') {
      if (isset($_POST['gender'])) {
        $gender = $_POST['gender'];
      } else {
        $gender = false;
      }
    }
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    if (ACCOUNT_DOB == 'true') {
      $dob_month = $_POST['dob_month'];    
      $dob_day = $_POST['dob_day'];
      $dob_year = $_POST['dob_year'];
    }  
    $email_address = $_POST['email_address'];    
    if (isset($_POST['languages'])) { 
      $language_id = $_POST['languages'];
    } else {    
      $language_id = $_SESSION['languages_id'];
    }
    if (ACCOUNT_COMPANY == 'true') {
      $company = $_POST['company'];
      $company_tax_id = $_POST['company_tax_id'];
    } 
    $street_address = $_POST['street_address'];
    if (ACCOUNT_SUBURB == 'true') $suburb = $_POST['suburb'];
    $postcode = $_POST['postcode'];
    $city = $_POST['city'];
    if (ACCOUNT_STATE == 'true') {
      $state = $_POST['state'];
      if (isset($_POST['zone_id'])) {
        $zone_id = $_POST['zone_id'];
      } else {
        $zone_id = 0;
      }
    }
    $country = $_POST['country'];
    $telephone = $_POST['telephone'];
    $fax = $_POST['fax'];
    if (isset($_POST['newsletter'])) {
      $newsletter = $_POST['newsletter'];
    } else {
      $newsletter = 0;
    }
    $password = $_POST['password'];
    $confirmation = $_POST['confirmation'];

    $error = false;

    if (ACCOUNT_GENDER == 'true') {
      if ( ($gender != 'm') && ($gender != 'f') ) {
        $error = true;

        $smarty->assign('gender_error', true);
      }
    } 

    if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
      $error = true;

      $smarty->assign('first_name_error', true);
    }

    if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
      $error = true;

      $smarty->assign('last_name_error', true);
    }

    if (ACCOUNT_DOB == 'true') {
      if ((strlen($dob_month . $dob_day . $dob_year) != 8) || (ctype_digit($dob_month . $dob_day . $dob_year) == false) || (@checkdate($dob_month, $dob_day, $dob_year) == false)) {
        $error = true;

        $smarty->assign('date_of_birth_error', true);
      }
    }

    if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
      $error = true;

      $smarty->assign('email_address_error', true);
    } elseif (xos_validate_email($email_address) == false) {
      $error = true;

      $smarty->assign('email_address_check_error', true);
    } else {
      $check_email_query = $DB->prepare
      (
       "SELECT Count(*) AS total
        FROM   " . TABLE_CUSTOMERS . "
        WHERE  customers_email_address = :email_address"
      );
      
      $DB->perform($check_email_query, array(':email_address' => $email_address));
                                            
      $check_email = $check_email_query->fetch();
      
      $check_admin_email_query = $DB->prepare
      (
       "SELECT Count(*) AS total
        FROM   " . TABLE_ADMIN . "
        WHERE  admin_email_address = :email_address"
      );
      
      $DB->perform($check_admin_email_query, array(':email_address' => $email_address));
                                            
      $check_admin_email = $check_admin_email_query->fetch();      
      
      if ($check_email['total'] > 0 || $check_admin_email['total'] > 0) {
        $error = true;

        $smarty->assign('email_address_error_exists', true);
      }
    }

    if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
      $error = true;

      $smarty->assign('street_address_error', true);
    }

    if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
      $error = true;

      $smarty->assign('post_code_error', true);
    }

    if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
      $error = true;

      $smarty->assign('city_error', true);
    }

    if (is_numeric($country) == false) {
      $error = true;

      $smarty->assign('country_error', true);
    }

    if (ACCOUNT_STATE == 'true') {
      $zone_id = 0;
      $check_query = $DB->prepare
      (
       "SELECT Count(*) AS total
        FROM    " . TABLE_ZONES . "
        WHERE  zone_country_id = :country"
      );
      
      $DB->perform($check_query, array(':country' => (int)$country ));
            
      $check = $check_query->fetch();
      $entry_state_has_zones = ($check['total'] > 0);
      if ($entry_state_has_zones == true) {
        $zone_query = $DB->prepare
        (
         "SELECT DISTINCT zone_id
          FROM   " . TABLE_ZONES . "
          WHERE  zone_country_id = :country 
          AND    zone_name = :state"
        );
        
        $DB->perform($zone_query, array(':country' => (int)$country,
                                        ':state' => $state));
        
        if ($zone_query->rowCount() == 1) {
          $zone = $zone_query->fetch();
          $zone_id = $zone['zone_id'];
        } else {
          $error = true;

          $smarty->assign('state_error', true);
          $smarty->assign('state_error_select', true);
        }
      } else {
        if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
          $error = true;

          $smarty->assign('state_error', true);
        }
      }
    }

    if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
      $error = true;

      $smarty->assign('telephone_number_error', true);
    }


    if (strlen($password) < ENTRY_PASSWORD_MIN_LENGTH) {
      $error = true;

      $smarty->assign('password_error', true);      
    } elseif ($password != $confirmation) {
      $error = true;

      $smarty->assign('password_error_not_matching', true);
    }

    if ($error == false) {
      $sql_data_array = array('customers_firstname' => $firstname,
                              'customers_lastname' => $lastname,
                              'customers_email_address' => $email_address,
                              'customers_language_id' => $language_id,
                              'customers_telephone' => $telephone,
                              'customers_fax' => $fax,
                              'customers_password' => xos_encrypt_password($password));

      if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
      if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = $dob_year . $dob_month . $dob_day;
      // if you would like to have an alert in the admin section when either a company name has been entered in
      // the appropriate field or a tax id number, or both then uncomment the next line and comment the default
      // setting: only alert when a tax_id number has been given
      //if ( (ACCOUNT_COMPANY == 'true' && xos_not_null($company) ) || (ACCOUNT_COMPANY == 'true' && xos_not_null($company_tax_id) ) ) {      
      if ( ACCOUNT_COMPANY == 'true' && xos_not_null($company_tax_id)  ) {
        $sql_data_array['customers_group_ra'] = '1';
      }
      
      $DB->insertPrepareExecute(TABLE_CUSTOMERS, $sql_data_array);

      $_SESSION['customer_id'] = $DB->lastInsertId();

      $sql_data_array = array('customers_id' => (int)$_SESSION['customer_id'],
                              'entry_firstname' => $firstname,
                              'entry_lastname' => $lastname,
                              'entry_street_address' => $street_address,
                              'entry_postcode' => $postcode,
                              'entry_city' => $city,
                              'entry_country_id' => $country);

      if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
      if (ACCOUNT_COMPANY == 'true') {
        $sql_data_array['entry_company'] = $company;
        $sql_data_array['entry_company_tax_id'] = $company_tax_id;
      }
      if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
      if (ACCOUNT_STATE == 'true') {
        if ($zone_id > 0) {
          $sql_data_array['entry_zone_id'] = (int)$zone_id;
          $sql_data_array['entry_state'] = '';
        } else {
          $sql_data_array['entry_zone_id'] = '0';
          $sql_data_array['entry_state'] = $state;
        }
      }

      $DB->insertPrepareExecute(TABLE_ADDRESS_BOOK, $sql_data_array);

      $address_id = $DB->lastInsertId();

      $update_customers_query = $DB->prepare
      (
       "UPDATE " . TABLE_CUSTOMERS . "
        SET    customers_default_address_id = :address_id
        WHERE  customers_id = :customer_id"
      );
      
      $DB->perform($update_customers_query, array(':address_id' => (int)$address_id,
                                                  ':customer_id' => (int)$_SESSION['customer_id']));       

      $insert_customers_info_query = $DB->prepare
      (
       "INSERT INTO " . TABLE_CUSTOMERS_INFO . "
                    (
                    customers_info_id,
                    customers_info_number_of_logons,
                    customers_info_date_account_created
                    )
                    VALUES
                    (
                    :customer_id,
                    '0',
                    now()
                    )"
      );
      
      $DB->perform($insert_customers_info_query, array(':customer_id' => (int)$_SESSION['customer_id']));      
      
      $check_subscriber_query = $DB->prepare
      (
       "SELECT subscriber_id,
               newsletter_status
        FROM   " . TABLE_NEWSLETTER_SUBSCRIBERS . "
        WHERE  subscriber_email_address = :email_address"
      );
      
      $DB->perform($check_subscriber_query, array(':email_address' => $email_address));
      
      if ($check_subscriber_query->rowCount()) {
        $check_subscriber = $check_subscriber_query->fetch();

        if ($newsletter == '1' && $check_subscriber['newsletter_status'] == '0') {
          $update_newsletter_subscribers_query = $DB->prepare
          (
           "UPDATE " . TABLE_NEWSLETTER_SUBSCRIBERS . "
            SET    customers_id = :customer_id,
                   subscriber_language_id = :language_id,
                   newsletter_status = :newsletter,
                   newsletter_status_change = now()
            WHERE  subscriber_id = :subscriber_id"
          ); 
          
          $DB->perform($update_newsletter_subscribers_query, array(':customer_id' => (int)$_SESSION['customer_id'],
                                                                   ':language_id' => (int)$language_id,
                                                                   ':newsletter' => (int)$newsletter,
                                                                   ':subscriber_id' => (int)$check_subscriber['subscriber_id'])); 
                                                                           
        } else {
          $update_newsletter_subscribers_query = $DB->prepare
          (
           "UPDATE " . TABLE_NEWSLETTER_SUBSCRIBERS . "
            SET    customers_id = :customer_id,
                   subscriber_language_id = :language_id
            WHERE  subscriber_id = :subscriber_id"
          );
          
          $DB->perform($update_newsletter_subscribers_query, array(':customer_id' => (int)$_SESSION['customer_id'],
                                                                   ':language_id' => (int)$language_id,
                                                                   ':subscriber_id' => (int)$check_subscriber['subscriber_id']));           
        }                                                   
      } else {
        $identity_code  = xos_create_random_value(12);
        $insert_newsletter_subscribers_query = $DB->prepare
        (
         "INSERT INTO " . TABLE_NEWSLETTER_SUBSCRIBERS . "
                      (
                      customers_id,
                      subscriber_language_id,
                      subscriber_email_address,
                      subscriber_identity_code,
                      newsletter_status,
                      subscriber_date_added
                      )
                      VALUES
                      (
                      :customer_id,
                      :language_id,
                      :email_address,
                      :identity_code,
                      :newsletter,
                      now()
                      )"
        );
        
        $DB->perform($insert_newsletter_subscribers_query, array(':customer_id' => (int)$_SESSION['customer_id'],
                                                                 ':language_id' => (int)$language_id,
                                                                 ':email_address' => $email_address,
                                                                 ':identity_code' => $identity_code,
                                                                 ':newsletter' => (int)$newsletter)); 
                                                                           
      } 
      
      if (SESSION_RECREATE == 'true') {
        xos_session_recreate();
      }

      if (ACCOUNT_GENDER == 'true') {
        $_SESSION['customer_gender'] = $gender;
      }            
      $_SESSION['customer_first_name'] = $firstname;
      $_SESSION['customer_lastname'] = $lastname;
      $_SESSION['customer_default_address_id'] = $address_id;
      $_SESSION['customer_country_id'] = $country;
      $_SESSION['customer_zone_id'] = $zone_id;

// reset session token
      $_SESSION['sessiontoken'] = md5(xos_rand() . xos_rand() . xos_rand() . xos_rand()); 

// restore cart contents
      $_SESSION['cart']->restore_contents();

// build the message content
      if (SEND_EMAILS == 'true') {
      
        $smarty->unregisterFilter('output','smarty_outputfilter_trimwhitespace');
      
        $name = $firstname . ' ' . $lastname;

        if (ACCOUNT_GENDER == 'true') {
           if ($gender == 'm') {
             $smarty->assign('email_greet', sprintf(EMAIL_GREET_MR, $lastname));
           } else {
             $smarty->assign('email_greet', sprintf(EMAIL_GREET_MS, $lastname));
           }
        } else {
          $smarty->assign('email_greet', sprintf(EMAIL_GREET_NONE, $name));
        }

        $smarty->assign(array('html_params' => HTML_PARAMS,
                              'html_lang' => HTML_LANG,
                              'charset' => CHARSET,
                              'store_name_address' => STORE_NAME_ADDRESS,
                              'store_name' => STORE_NAME,
                              'src_embedded_shop_logo' => 'cid:shop_logo',
                              'src_shop_logo' => HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . (is_file(DIR_FS_CATALOG . 'images/email_shop_logo/' . EMAIL_SHOP_LOGO) ? 'email_shop_logo/' : 'catalog/templates/' . SELECTED_TPL . '/') . EMAIL_SHOP_LOGO,
                              'store_owner_email_address' => STORE_OWNER_EMAIL_ADDRESS));
      
        $smarty->configLoad('languages/' . $_SESSION['language'] . '_email.conf', 'create_account_email_html');
        $output_create_account_email_html = $smarty->fetch(SELECTED_TPL . '/includes/email/create_account_email_html.tpl');
        $smarty->configLoad('languages/' . $_SESSION['language'] . '_email.conf', 'create_account_email_text');  
        $output_create_account_email_text = $smarty->fetch(SELECTED_TPL . '/includes/email/create_account_email_text.tpl');
        $smarty->clearAssign(array('email_greet',
                                    'html_params',
                                    'html_lang',
                                    'charset',
                                    'store_name_address',
                                    'store_name',
                                    'src_embedded_shop_logo',
                                    'src_shop_logo',
                                    'store_owner_email_address'));  
  
        $email_to_customer = new mailer($name, $email_address, EMAIL_SUBJECT, $output_create_account_email_html, $output_create_account_email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SHOP_LOGO);
        
        if(!$email_to_customer->send()) {
          $messageStack->add_session('header', sprintf(ERROR_PHPMAILER, $email_to_customer->ErrorInfo));
        }
        
        // if you would like to have an email when either a company name has been entered in
        // the appropriate field or a tax id number, or both then uncomment the next line and comment the default
        // setting: only email when a tax_id number has been given
        //if ( (ACCOUNT_COMPANY == 'true' && xos_not_null($company) ) || (ACCOUNT_COMPANY == 'true' && xos_not_null($company_tax_id) ) ) {        
        if ( ACCOUNT_COMPANY == 'true' && xos_not_null($company_tax_id) ) {
          $alert_email_text = sprintf(EMAIL_TEXT_COMPANY_ACCOUNT_CREATED, $firstname, $lastname, $company);
                  
          $email_to_store_owner = new mailer(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SUBJECT_COMPANY_ACCOUNT_CREATED, '', $alert_email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
        
          if(!$email_to_store_owner->send()) {
            $messageStack->add_session('header', sprintf(ERROR_PHPMAILER, $email_to_store_owner->ErrorInfo));
          }          
        }          
      }
      
      $_SESSION['navigation']->remove_current_page();
      xos_redirect(xos_href_link(FILENAME_CREATE_ACCOUNT_SUCCESS, '', 'SSL'));
    }
  }

  $site_trail->add(NAVBAR_TITLE, xos_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'));

  $add_header = '<script>
  /**
   * @package             jQuery HTML5 Custom Validation Messages plugin
   * @author              Steven Palmer
   * @author url          https://github.com/CoalaWeb
   * @author email        support@coalaweb.com
   * @version             1.0.0
   * @date                13-10-2015
   * @copyright           Copyright (c) 2015 Steven Palmer All rights reserved.
   *
   * Dual licensed under the MIT and GPL licenses:
   *   http://www.opensource.org/licenses/mit-license.php
   *   http://www.gnu.org/licenses/gpl.html
   */
  
  (function ($) {
  
      $.fn.html5cvm = function (options) {
  
          // Establish our default settings
          var settings = $.extend({
              valueMissing: null,
              typeMismatch: null,
              patternMismatch: null,
              tooLong: null,
              rangeUnderflow: null,
              rangeOverflow: null,
              stepMismatch: null,
              generic: null
          }, options);
  
          return this.each(function () {
  
              //lets get our form ID
              var form = $(this).attr("name")
  
              //now to add some custom messages to our form
              $("form[name=" + form + "] :input").on({
                  //lets start out validity check
                  invalid: function (e) { 
                      
                      //clear the custom validity value                                            
                  		e.target.setCustomValidity("");  
  
                      //is the form element invalid?
                      if (!e.target.validity.valid) {
  
                          //initiate our msg variable
                          var msg;
  
                          //returns true if the element has no value but is a required field.
                          if (e.target.validity.valueMissing) {
                              if ($(this).data("errormessage-value-missing")) {
                                  msg = $(this).data("errormessage-value-missing");
                              } else {
                                  msg = settings.valueMissing;
                              }
                          }
  
                          //returns true if the elements value doesnt match its type attribute.
                          if (e.target.validity.typeMismatch) {
                              if ($(this).data("errormessage-type-mismatch")) {
                                  msg = $(this).data("errormessage-type-mismatch");
                              } else {
                                  msg = settings.typeMismatch;
                              }
                          }
  
                          //returns true if the elements value doesnt match its pattern attribute.
                          if (e.target.validity.patternMismatch) {
                              if ($(this).data("errormessage-pattern-mismatch")) {
                                  msg = $(this).data("errormessage-pattern-mismatch");
                              } else {
                                  msg = settings.patternMismatch;
                              }
                          }
  
                          //returns true if the elements value exceeds its maxlength attribute.
                          if (e.target.validity.tooLong) {
                              if ($(this).data("errormessage-pattern-too-long")) {
                                  msg = $(this).data("errormessage-pattern-too-long");
                              } else {
                                  msg = settings.tooLong;
                              }
                          }
  
                          //returns true if the elements value is lower than its min attribute.
                          if (e.target.validity.rangeUnderflow) {
                              if ($(this).data("errormessage-pattern-range-underflow")) {
                                  msg = $(this).data("errormessage-pattern-range-underflow");
                              } else {
                                  msg = settings.rangeUnderflow;
                              }
                          }
  
                          //returns true if the element’s value is higher than its max attribute.
                          if (e.target.validity.rangeOverflow) {
                              if ($(this).data("errormessage-pattern-range-overflow")) {
                                  msg = $(this).data("errormessage-pattern-range-overflow");
                              } else {
                                  msg = settings.rangeUOverflow;
                              }
                          }
  
                          //returns true if the elements value is invalid per its step attribute.
                          if (e.target.validity.stepMismatch) {
                              if ($(this).data("errormessage-step-mismatch")) {
                                  msg = $(this).data("errormessage-step-mismatch");
                              } else {
                                  msg = settings.stepMismatch;
                              }
                          } 
  
                          //generic fall back message.
                          if (!msg) {
                              if ($(this).data("errormessage-generic")) {
                                  msg = $(this).data("errormessage-generic");
                              } else {
                                  msg = settings.generic;
                              }
                          }
  
                          //set the custom validty value to our custom message if we have one.
                          if (msg) {
                              e.target.setCustomValidity(msg);
                          }
  
                      }
                  },
                  input: function (e) {
                      //clear the custom validty value
                      e.target.setCustomValidity("");
                  },
                  change: function (e) {
                      //clear the custom validty value
                      e.target.setCustomValidity("");
                  }
              });
          });
  
      };
  
  }(jQuery));  
    
  $(function () {
    
//    $("form[name=create_account]").html5cvm();    
  
//    $("form[name=create_account] #gender, form[name=create_account] #firstname, form[name=create_account] #lastname, form[name=create_account] #password, form[name=create_account] #confirmation, form[name=create_account] #email_address, form[name=create_account] #country, form[name=create_account] #street_address, form[name=create_account] #postcode, form[name=create_account] #telephone, form[name=create_account] #city, form[name=create_account] #state, form[name=create_account] select[name=dob_day], form[name=create_account] select[name=dob_month], form[name=create_account] select[name=dob_year]").attr("required", true);
    $("form[name=create_account] #gender, form[name=create_account] #firstname, form[name=create_account] #lastname, form[name=create_account] #password, form[name=create_account] #confirmation, form[name=create_account] #email_address, form[name=create_account] #country, form[name=create_account] #street_address, form[name=create_account] #postcode, form[name=create_account] #telephone, form[name=create_account] #city, form[name=create_account] #state, form[name=create_account] select[name=dob_day], form[name=create_account] select[name=dob_month], form[name=create_account] select[name=dob_year]").removeAttr("pattern");    
    $(".has-error input, .has-error select, .has-error textarea").addClass("alert-danger").focus(function () {$(this).removeClass("alert-danger");});
/*
    var password = document.getElementById("password")
      , confirmation = document.getElementById("confirmation");
    
    function validatePassword(){
      if(password.value != confirmation.value) {
        $("form[name=create_account] #confirmation").attr("pattern", "^$");
        $("form[name=create_account]").get(0).checkValidity();        
      } else {
        $("form[name=create_account] #confirmation").removeAttr("pattern");
        $("form[name=create_account]").get(0).checkValidity();        
      }
    }
    
    password.onchange = validatePassword;
    confirmation.onkeyup = validatePassword; 
    
    function scrollToInvalid() {
      // Height of your nav bar plus a bottom margin
      var navHeight = 200;
      // Offset of the first input element minus your nav height
      var invalid_el = $("input:invalid, select:invalid, textarea:invalid").first().offset().top - navHeight;
    
      // If the invalid element is already within the window view, return true. If you return false, the validation will stop.
//      if ( invalid_el > (window.pageYOffset - navHeight) && invalid_el < (window.pageYOffset + window.innerHeight - navHeight) ) {
      if ( invalid_el > (window.pageYOffset) && invalid_el < (window.pageYOffset + window.innerHeight) ) {
        return true;
      } else {
        // If the first invalid input is not within the current view, scroll to it.
        $("html, body").scrollTop(invalid_el);
      }
    }
    
    $("input, select, textarea").on("invalid", scrollToInvalid);  
*/          
  });  
</script>';    

  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'boxes.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'footer.php');  

  if ($messageStack->size('create_account') > 0) {
    $smarty->assign('message_stack', $messageStack->output('create_account'));
    $smarty->assign('message_stack_error', $messageStack->output('create_account', 'error'));
    $smarty->assign('message_stack_warning', $messageStack->output('create_account', 'warning')); 
    $smarty->assign('message_stack_success', $messageStack->output('create_account', 'success'));    
  }
  
  if (ACCOUNT_GENDER == 'true') {
//    $smarty->assign(array('account_gender' => true,
//                          'input_gender' => xos_draw_radio_field('gender', 'm', '', 'id="gender_m" data-errormessage-value-missing="' . ENTRY_GENDER_ERROR . '"') . '<label class="control-label" for="gender_m">&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;</label>' . xos_draw_radio_field('gender', 'f', '', 'id="gender_f"') . '<label class="control-label" for="gender_f">&nbsp;&nbsp;' . FEMALE . '&nbsp;</label>' . (xos_not_null(ENTRY_GENDER_TEXT) ? '<span class="input-requirement">' . ENTRY_GENDER_TEXT . '</span>': '')));

    $gender_array = array(array('id' => '', 'text' => PULL_DOWN_DEFAULT),                                             
                          array('id' => 'm', 'text' => MALE),
                          array('id' => 'f', 'text' => FEMALE));

    $smarty->assign(array('account_gender' => true,          
                          'input_gender' => xos_draw_pull_down_menu('gender', $gender_array, '', 'class="form-control" id="gender" data-errormessage-value-missing="' . ENTRY_GENDER_ERROR . '"') . '&nbsp;' . (xos_not_null(ENTRY_GENDER_TEXT) ? '<span class="input-requirement">' . ENTRY_GENDER_TEXT . '</span>': '')));


  } 
  
  if (ACCOUNT_DOB == 'true') {
  
    $years = array();
    $years_array = array();
    $year = xos_date_format('%Y');

    $years = range((int)($year - 9), (int)($year - 110));
    rsort($years, SORT_NUMERIC);
//    sort($years, SORT_NUMERIC);
    
    $years_array[] = array('id' => '', 'text' => DATE_OF_BIRTH_ENTRY_TEXT_YEAR);
    
    while (list($key, $value) = each($years)) {    
      $years_array[] = array('id' => $value,
                             'text' => $value);
    }    
    
    $days_array = array();

    $days_array[] = array('id' => '', 'text' => DATE_OF_BIRTH_ENTRY_TEXT_DAY);
 
    for ($i = 1; $i <= 31; $i++) {        
      $days_array[] = array('id' => sprintf('%02d', $i),
                            'text' => sprintf('%02d', $i));        
    }                 
    
    $months_array = array();

    $months_array[] = array('id' => '', 'text' => DATE_OF_BIRTH_ENTRY_TEXT_MONTH);
 
    for ($i = 1; $i <= 12; $i++) {        
      $months_array[] = array('id' => sprintf('%02d', $i),
                              'text' => sprintf('%02d', $i));        
    }
    
    $pull_down_menu_field = '';
    $field_order = strtoupper(DATE_OF_BIRTH_FIELD_ORDER);
    for ($i = 0; $i <= 2; $i++) {
      $c = substr($field_order, $i, 1);
      switch ($c) {
        case 'D':
          $pull_down_menu_field .= xos_draw_pull_down_menu('dob_day', $days_array, (int)$_POST['dob_day'], ($i == 0 ? 'class="form-control" id="dob_first" data-errormessage-value-missing="' . ENTRY_DATE_OF_BIRTH_DAY_SELECT . '"' : 'class="form-control" data-errormessage-value-missing="' . ENTRY_DATE_OF_BIRTH_DAY_SELECT . '"'));
          break;
        case 'M':
          $pull_down_menu_field .= xos_draw_pull_down_menu('dob_month', $months_array, (int)$_POST['dob_month'], ($i == 0 ? 'class="form-control" id="dob_first" data-errormessage-value-missing="' . ENTRY_DATE_OF_BIRTH_MONTH_SELECT . '"' : 'class="form-control" data-errormessage-value-missing="' . ENTRY_DATE_OF_BIRTH_MONTH_SELECT . '"'));
          break;
        case 'Y':
          $pull_down_menu_field .= xos_draw_pull_down_menu('dob_year', $years_array, (int)$_POST['dob_year'], ($i == 0 ? 'class="form-control" id="dob_first" data-errormessage-value-missing="' . ENTRY_DATE_OF_BIRTH_JEAR_SELECT . '"' : 'class="form-control" data-errormessage-value-missing="' . ENTRY_DATE_OF_BIRTH_JEAR_SELECT . '"'));
          break;
      } 

      if ($i < 2) {
        $pull_down_menu_field .= DATE_OF_BIRTH_FIELD_SEPARATOR;
//        $pull_down_menu_field .= '&nbsp;' . DATE_OF_BIRTH_FIELD_SEPARATOR . '&nbsp;';
      } 
    }                                        
     
    $smarty->assign(array('account_dob' => true,
                          'pull_down_menus_dob' => $pull_down_menu_field . '&nbsp;' . (xos_not_null(ENTRY_DATE_OF_BIRTH_TEXT_1) ? '<span class="input-requirement">' . ENTRY_DATE_OF_BIRTH_TEXT_1 . '</span>': '')));
  }
  
  if (ACCOUNT_COMPANY == 'true') {
    $smarty->assign(array('account_company' => true,
                          'input_company' => xos_draw_input_field('company', '', 'class="form-control" id="company"') . '&nbsp;' . (xos_not_null(ENTRY_COMPANY_TEXT) ? '<span class="input-requirement">' . ENTRY_COMPANY_TEXT . '</span>': ''),
                          'input_company_tax_id' => xos_draw_input_field('company_tax_id', '', 'class="form-control" id="company_tax_id"') . '&nbsp;' . (xos_not_null(ENTRY_COMPANY_TAX_ID_TEXT) ? '<span class="input-requirement">' . ENTRY_COMPANY_TAX_ID_TEXT . '</span>': '')));
  }
  
  if (ACCOUNT_SUBURB == 'true') {
    $smarty->assign(array('account_suburb' => true,
                          'input_suburb' => xos_draw_input_field('suburb', '', 'class="form-control" id="suburb"') . '&nbsp;' . (xos_not_null(ENTRY_SUBURB_TEXT) ? '<span class="input-requirement">' . ENTRY_SUBURB_TEXT . '</span>': '')));
  }
  
  if (ACCOUNT_STATE == 'true') {
    $smarty->assign('account_state', true);
    if ($process == true) {
      if ($entry_state_has_zones == true) {
        $zones_array = array();
        $zones_query = $DB->prepare
        (
         "SELECT   zone_name
          FROM     " . TABLE_ZONES . "
          WHERE    zone_country_id = :country
          ORDER BY zone_name"
        );
        
        $DB->perform($zones_query, array(':country' => (int)$country));
        
        $zones_array[] = array('id' => '', 'text' => PULL_DOWN_DEFAULT);
                                              
        while ($zones_values = $zones_query->fetch()) {
          $zones_array[] = array('id' => $zones_values['zone_name'], 'text' => $zones_values['zone_name']);
        }
        $smarty->assign('input_state', xos_draw_pull_down_menu('state', $zones_array, '', 'class="form-control" id="state" data-errormessage-value-missing="' . ENTRY_STATE_ERROR_SELECT . '"') . '&nbsp;' . (xos_not_null(ENTRY_STATE_TEXT) ? '<span class="input-requirement">' . ENTRY_STATE_TEXT . '</span>': ''));
      } else {
        $smarty->assign('input_state', xos_draw_input_field('state', '', 'class="form-control" id="state" data-errormessage-value-missing="' . ENTRY_STATE_ERROR . '" data-errormessage-pattern-mismatch="' . ENTRY_STATE_ERROR . '" pattern="^[^ ].{' . (ENTRY_STATE_MIN_LENGTH - 2) . ',}[^ ]$"') . '&nbsp;' . (xos_not_null(ENTRY_STATE_TEXT) ? '<span class="input-requirement">' . ENTRY_STATE_TEXT . '</span>': ''));
      }
    } else {
      $smarty->assign('input_state', xos_draw_input_field('state', '', 'class="form-control" id="state" data-errormessage-value-missing="' . ENTRY_STATE_ERROR . '" data-errormessage-pattern-mismatch="' . ENTRY_STATE_ERROR . '" pattern="^[^ ].{' . (ENTRY_STATE_MIN_LENGTH - 2) . ',}[^ ]$"') . '&nbsp;' . (xos_not_null(ENTRY_STATE_TEXT) ? '<span class="input-requirement">' . ENTRY_STATE_TEXT . '</span>': ''));
    }   
  }

  reset($lng->catalog_languages);
  
  if (sizeof($lng->catalog_languages) > 1) {

    $lang_array = array();
    $languages_selected = '';
    while (list($key, $value) = each($lng->catalog_languages)) {
      $lang_array[] = array('id' => $value['id'],
                            'text' => $value['name']);
      
      if (!empty($language_id)) {
        $languages_selected = $language_id;                      
      } elseif ($value['id'] == $_SESSION['languages_id']) {
        $languages_selected = $value['id'];
      }                            
    }
    $smarty->assign(array('languages' => true,
                          'pull_down_menu_languages' => xos_draw_pull_down_menu('languages', $lang_array, $languages_selected, 'class="form-control" id="languages"')));
  }

  $popup_status_query = $DB->query
  (
   "SELECT status
    FROM   " . TABLE_CONTENTS . "
    WHERE  type = 'system_popup'
    AND    status = '1'
    AND    content_id = '7'
    LIMIT  1"
  );

  $back = sizeof($_SESSION['navigation']->path)-2;
  if (!empty($_SESSION['navigation']->path[$back])) {
    $get_params_array = $_SESSION['navigation']->path[$back]['get'];
    $get_params_array['rmp'] = '0';        
    $back_link = xos_href_link($_SESSION['navigation']->path[$back]['page'], xos_array_to_query_string($get_params_array, array('action', xos_session_name())), $_SESSION['navigation']->path[$back]['mode']);
  } else {
    $back_link = 'javascript:history.go(-1)';
  }

  $smarty->assign(array('form_begin' => xos_draw_form('create_account', xos_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'), 'post', '', true),
                        'hidden_field' => xos_draw_hidden_field('action', 'process'),
                        'link_filename_login' => xos_href_link(FILENAME_LOGIN, xos_get_all_get_params(), 'SSL'),
                        'link_filename_popup_content_7' => $popup_status_query->rowCount() ? xos_href_link(FILENAME_POPUP_CONTENT, 'co=7', $request_type) : '',
                        'input_firstname' => xos_draw_input_field('firstname', '', 'class="form-control" id="firstname" data-errormessage-value-missing="' . ENTRY_FIRST_NAME_ERROR . '" data-errormessage-pattern-mismatch="' . ENTRY_FIRST_NAME_ERROR . '" pattern="^[^ ].{' . (ENTRY_FIRST_NAME_MIN_LENGTH - 2) . ',}[^ ]$"') . '&nbsp;' . (xos_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="input-requirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''),
                        'input_lastname' => xos_draw_input_field('lastname', '', 'class="form-control" id="lastname" data-errormessage-value-missing="' . ENTRY_LAST_NAME_ERROR . '" data-errormessage-pattern-mismatch="' . ENTRY_LAST_NAME_ERROR . '" pattern="^[^ ].{' . (ENTRY_LAST_NAME_MIN_LENGTH - 2) . ',}[^ ]$"') . '&nbsp;' . (xos_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="input-requirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''),
                        'input_email_address' => xos_draw_input_field('email_address', '', 'class="form-control" id="email_address" data-errormessage-value-missing="' . ENTRY_EMAIL_ADDRESS_ERROR . '" data-errormessage-pattern-mismatch="' . ENTRY_EMAIL_ADDRESS_ERROR . '" data-errormessage-type-mismatch="' . ENTRY_EMAIL_ADDRESS_CHECK_ERROR . '" pattern="^[^ ].{' . (ENTRY_EMAIL_ADDRESS_MIN_LENGTH - 2) . ',}[^ ]$"', 'email') . '&nbsp;' . (xos_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="input-requirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''),                        
                        'input_street_address' => xos_draw_input_field('street_address', '', 'class="form-control" id="street_address" data-errormessage-value-missing="' . ENTRY_STREET_ADDRESS_ERROR . '" data-errormessage-pattern-mismatch="' . ENTRY_STREET_ADDRESS_ERROR . '" pattern="^[^ ].{' . (ENTRY_STREET_ADDRESS_MIN_LENGTH - 2) . ',}[^ ]$" onblur="if(!/[1-9]/.test(this.value) && this.value.length >= ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . '){$(\'#number-error\').show(100)}else{$(\'#number-error\').hide(100)}"') . '&nbsp;' . (xos_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="input-requirement">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': '') . '<p id="number-error" style="display: none;"><span class="red-mark">' . ENTRY_MISSING_HOUSE_NUMBER_TEXT_1 . '</span>&nbsp; &nbsp;' . ENTRY_MISSING_HOUSE_NUMBER_TEXT_2 . '</p>',
                        'input_postcode' => xos_draw_input_field('postcode', '', 'class="form-control" id="postcode" data-errormessage-value-missing="' . ENTRY_POST_CODE_ERROR . '" data-errormessage-pattern-mismatch="' . ENTRY_POST_CODE_ERROR . '" pattern="^[^ ].{' . (ENTRY_POSTCODE_MIN_LENGTH - 2) . ',}[^ ]$"') . '&nbsp;' . (xos_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="input-requirement">' . ENTRY_POST_CODE_TEXT . '</span>': ''),
                        'input_city' => xos_draw_input_field('city', '', 'class="form-control" id="city" data-errormessage-value-missing="' . ENTRY_CITY_ERROR . '" data-errormessage-pattern-mismatch="' . ENTRY_CITY_ERROR . '" pattern="^[^ ].{' . (ENTRY_CITY_MIN_LENGTH - 2) . ',}[^ ]$"') . '&nbsp;' . (xos_not_null(ENTRY_CITY_TEXT) ? '<span class="input-requirement">' . ENTRY_CITY_TEXT . '</span>': ''),
                        'input_country' => xos_get_country_list('country', '', 'class="form-control" id="country" data-errormessage-value-missing="' . ENTRY_COUNTRY_ERROR . '"') . '&nbsp;' . (xos_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="input-requirement">' . ENTRY_COUNTRY_TEXT . '</span>': ''),                        
                        'input_telephone' => xos_draw_input_field('telephone', '', 'class="form-control" id="telephone" data-errormessage-value-missing="' . ENTRY_TELEPHONE_NUMBER_ERROR . '" data-errormessage-pattern-mismatch="' . ENTRY_TELEPHONE_NUMBER_ERROR . '" pattern="^[^ ].{' . (ENTRY_TELEPHONE_MIN_LENGTH - 2) . ',}[^ ]$"') . '&nbsp;' . (xos_not_null(ENTRY_TELEPHONE_NUMBER_TEXT) ? '<span class="input-requirement">' . ENTRY_TELEPHONE_NUMBER_TEXT . '</span>': ''),
                        'input_fax' => xos_draw_input_field('fax', '', 'class="form-control" id="fax"') . '&nbsp;' . (xos_not_null(ENTRY_FAX_NUMBER_TEXT) ? '<span class="input-requirement">' . ENTRY_FAX_NUMBER_TEXT . '</span>': ''),
                        'input_newsletter' => (NEWSLETTER_ENABLED == 'true') ? xos_draw_checkbox_field('newsletter', '1', '', 'id="newsletter"') . '&nbsp;' . (xos_not_null(ENTRY_NEWSLETTER_TEXT) ? '<span class="input-requirement">' . ENTRY_NEWSLETTER_TEXT . '</span>': '') : '',
                        'input_password' => xos_draw_password_field('password', '', 'class="form-control" id="password" data-errormessage-value-missing="' . ENTRY_PASSWORD_ERROR . '" data-errormessage-pattern-mismatch="' . ENTRY_PASSWORD_ERROR . '" placeholder="' . ENTRY_PASSWORD_PLACEHOLDER . '" pattern="^\S{' . ENTRY_PASSWORD_MIN_LENGTH . ',}$"', ($smarty->getTemplateVars('password_error') ? false : true)) . '&nbsp;' . (xos_not_null(ENTRY_PASSWORD_TEXT) ? '<span class="input-requirement">' . ENTRY_PASSWORD_TEXT . '</span>': ''),
                        'input_confirmation' => xos_draw_password_field('confirmation', '', 'class="form-control" id="confirmation" data-errormessage-value-missing="' . ENTRY_PASSWORD_ERROR_NOT_MATCHING . '" data-errormessage-pattern-mismatch="' . ENTRY_PASSWORD_ERROR_NOT_MATCHING . '"', ($smarty->getTemplateVars('password_error') || $smarty->getTemplateVars('password_error_not_matching') ? false : true)) . '&nbsp;' . (xos_not_null(ENTRY_PASSWORD_CONFIRMATION_TEXT) ? '<span class="input-requirement">' . ENTRY_PASSWORD_CONFIRMATION_TEXT . '</span>': ''),
                        'link_back' => $back_link,
                        'form_end' => '</form>'));

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'create_account');
  $output_create_account = $smarty->fetch(SELECTED_TPL . '/create_account.tpl');
                        
  $smarty->assign('central_contents', $output_create_account);                        
  

  $smarty->display(SELECTED_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
  return 'overwrite_all';