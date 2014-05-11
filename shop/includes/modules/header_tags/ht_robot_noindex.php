<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : ht_robot_noindex.php
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
//              Copyright (c) 2012 osCommerce
//              filename: ht_robot_noindex.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  class ht_robot_noindex {
    var $code = 'ht_robot_noindex';
    var $group = 'header_tags';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function ht_robot_noindex() {
      $this->title = MODULE_HEADER_TAGS_ROBOT_NOINDEX_TITLE;
      $this->description = MODULE_HEADER_TAGS_ROBOT_NOINDEX_DESCRIPTION;

      if ( defined('MODULE_HEADER_TAGS_ROBOT_NOINDEX_STATUS') ) {
        $this->sort_order = MODULE_HEADER_TAGS_ROBOT_NOINDEX_SORT_ORDER;
        $this->enabled = (MODULE_HEADER_TAGS_ROBOT_NOINDEX_STATUS == 'true');
      }
    }

    function execute() {
      global $templateIntegration;

      if (xos_not_null(MODULE_HEADER_TAGS_ROBOT_NOINDEX_PAGES)) {
        $pages_array = array();

        foreach (explode(';', MODULE_HEADER_TAGS_ROBOT_NOINDEX_PAGES) as $page) {
          $page = trim($page);

          if (!empty($page)) {
            $pages_array[] = $page;
          }
        }

        if (in_array(basename($_SERVER['PHP_SELF']), $pages_array)) {
          $templateIntegration->addBlock('<meta name="robots" content="noindex,follow" />' . "\n", $this->group);
        }
      }
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_HEADER_TAGS_ROBOT_NOINDEX_STATUS');
    }

    function install() {
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_HEADER_TAGS_ROBOT_NOINDEX_STATUS', 'true', '6', '1', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) values ('MODULE_HEADER_TAGS_ROBOT_NOINDEX_PAGES', '" . implode(';', $this->get_default_pages()) . "', '6', '0', 'ht_robot_noindex_show_pages', 'ht_robot_noindex_edit_pages(', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_HEADER_TAGS_ROBOT_NOINDEX_SORT_ORDER', '0', '6', '0', now())");
    }

    function remove() {
      xos_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_HEADER_TAGS_ROBOT_NOINDEX_STATUS', 'MODULE_HEADER_TAGS_ROBOT_NOINDEX_PAGES', 'MODULE_HEADER_TAGS_ROBOT_NOINDEX_SORT_ORDER');
    }

    function get_default_pages() {
      return array('account.php',
                   'account_edit.php',
                   'account_history.php',
                   'account_history_info.php',
                   'account_newsletters.php',
                   'account_notifications.php',
                   'account_password.php',
                   'address_book.php',
                   'address_book_process.php',
                   'captcha.php',
                   'checkout_confirmation.php',
                   'checkout_payment.php',
                   'checkout_payment_address.php',
                   'checkout_process.php',
                   'checkout_shipping.php',
                   'checkout_shipping_address.php',
                   'checkout_success.php',
                   'contact_us.php',
                   'cookie_usage.php',
                   'create_account.php',
                   'create_account_success.php',
                   'css.php',
                   'download.php',
                   'images_window.php',
                   'js.php',
                   'login.php',
                   'logoff.php',
                   'newsletter_subscribe.php',
                   'offline.php',
                   'options_window.php',
                   'password_forgotten.php',
                   'product_reviews_write.php',
                   'quick_search_suggest.php',
                   'redirect.php',
                   'shopping_cart.php',
                   'ssl_check.php',
                   'tell_a_friend.php',
                   'test.php',
                   'update_options.php');
    }
  }

  function ht_robot_noindex_show_pages($text) {
    return nl2br(implode("\n", explode(';', $text)));
  }

  function ht_robot_noindex_edit_pages($values, $key) {

    $file_extension = substr(basename($_SERVER['PHP_SELF']), strrpos(basename($_SERVER['PHP_SELF']), '.'));
    $files_array = array();
	  if ($dir = @dir(DIR_FS_CATALOG)) {
	    while ($file = $dir->read()) {
	      if (!is_dir(DIR_FS_CATALOG . $file)) {
	        if (substr($file, strrpos($file, '.')) == $file_extension) {
            $files_array[] = $file;
          }
        }
      }
      sort($files_array);
      $dir->close();
    }

    $values_array = explode(';', $values);

    $output = '';
    foreach ($files_array as $file) {
      $output .= xos_draw_checkbox_field('ht_robot_noindex_file[]', $file, in_array($file, $values_array)) . '&nbsp;' . xos_output_string($file) . '<br />';
    }

    if (!empty($output)) {
      $output = '<br />' . substr($output, 0, -6);
    }

    $output .= xos_draw_hidden_field('configuration[' . $key . ']', '', 'id="htrn_files"');

    $output .= '
                <script type="text/javascript">
                /* <![CDATA[ */
                function htrn_update_cfg_value() {
                  var htrn_selected_files = \'\';

                  if ($(\'input[name="ht_robot_noindex_file[]"]\').length > 0) {
                    $(\'input[name="ht_robot_noindex_file[]"]:checked\').each(function() {
                      htrn_selected_files += $(this).attr(\'value\') + \';\';
                    });

                    if (htrn_selected_files.length > 0) {
                      htrn_selected_files = htrn_selected_files.substring(0, htrn_selected_files.length - 1);
                    }
                  }

                  $(\'#htrn_files\').val(htrn_selected_files);
                }

                $(function() {
                  htrn_update_cfg_value();

                  if ($(\'input[name="ht_robot_noindex_file[]"]\').length > 0) {
                    $(\'input[name="ht_robot_noindex_file[]"]\').change(function() {
                      htrn_update_cfg_value();
                    });
                  }
                });
                /* ]]> */
                </script>' . "\n";

    return $output;
  }
?>
