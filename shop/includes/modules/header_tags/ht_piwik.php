<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : ht_piwik.php
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
//              Copyright (c) 2010 osCommerce
//              filename: ht_piwik.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  class ht_piwik {
    var $code = 'ht_piwik';
    var $group = 'header_tags';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function ht_piwik() {
      $this->title = MODULE_HEADER_TAGS_PIWIK_TITLE;
      $this->description = MODULE_HEADER_TAGS_PIWIK_DESCRIPTION;

      if ( defined('MODULE_HEADER_TAGS_PIWIK_STATUS') ) {
        $this->sort_order = MODULE_HEADER_TAGS_PIWIK_SORT_ORDER;
        $this->enabled = (MODULE_HEADER_TAGS_PIWIK_STATUS == 'true');
      }
    }

    function execute() {
      global $templateIntegration, $current_category_id, $request_type;

      if (xos_not_null(MODULE_HEADER_TAGS_PIWIK_ID)) {
        if (MODULE_HEADER_TAGS_PIWIK_JS_PLACEMENT != '1') {
          $this->group = 'footer_scripts';
        }

        $piwikCode = '<!-- Piwik -->' . "\n" .
                     '<script type="text/javascript">' . "\n" .
                     '/* <![CDATA[ */' . "\n" .
                     ' var _paq = _paq || [];' . "\n" .  
                     '  _paq.push([\'trackPageView\']);' . "\n" .  
                     '  _paq.push([\'enableLinkTracking\']);' . "\n";

        if ( (MODULE_HEADER_TAGS_PIWIK_EC_TRACKING == 'true') && (basename($_SERVER['PHP_SELF']) == FILENAME_DEFAULT) && isset($current_category_id) && $current_category_id > 0 ) {
          $categories_query = xos_db_query("select cd.categories_or_pages_name from " . TABLE_CATEGORIES_OR_PAGES_DATA . " cd, " . TABLE_LANGUAGES . " l where categories_or_pages_id = '" . (int)$current_category_id . "' and l.code = '" . xos_db_input(DEFAULT_LANGUAGE) . "' and l.languages_id = cd.language_id");
	        $categories = xos_db_fetch_array($categories_query);
			
	        if ($categories['categories_or_pages_name'] != '') {	
            $piwikCode .= '  _paq.push([\'setEcommerceView\',productSku = false,productName = false,category = "' . xos_output_string($categories['categories_or_pages_name']) . '"]);' . "\n";
	        }			
        }

        if ( (MODULE_HEADER_TAGS_PIWIK_EC_TRACKING == 'true') && (basename($_SERVER['PHP_SELF']) == FILENAME_PRODUCT_INFO) && ($_GET['products_id'] != '') ) {
          $products_query = xos_db_query("select p.products_id, pd.products_name, cd.categories_or_pages_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, ". TABLE_CATEGORIES_OR_PAGES_DATA ." cd, " . TABLE_LANGUAGES . " l WHERE p.products_id = pd.products_id and p2c.categories_or_pages_id = cd.categories_or_pages_id and p.products_id = " . (int)$_GET['products_id'] . " and l.code = '" . xos_db_input(DEFAULT_LANGUAGE) . "' and l.languages_id = cd.language_id and l.languages_id = pd.language_id");
	        $products = xos_db_fetch_array($products_query);	

          $piwikCode .= '  _paq.push([\'setEcommerceView\',"' . (int)$products['products_id'] . '","' . xos_output_string($products['products_name']) . '","' . xos_output_string($products['categories_or_pages_name']) . '"]);' . "\n";
        }

        if ( (MODULE_HEADER_TAGS_PIWIK_EC_TRACKING == 'true') && (basename($_SERVER['PHP_SELF']) == FILENAME_SHOPPING_CART) ) {
          $products = $_SESSION['cart']->get_products();
          
	        if ($_SESSION['cart']->count_contents() > 0) {
	          for ($i=0, $n=sizeof($products); $i<$n; $i++) {
		          $categories_query = xos_db_query("select pd.products_name, cd.categories_or_pages_name from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_CATEGORIES_OR_PAGES_DATA ." cd, ". TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_LANGUAGES . " l WHERE cd.categories_or_pages_id = p2c.categories_or_pages_id and p2c.products_id = " . (int)$products[$i]['id'] . " and p2c.products_id = pd.products_id and l.code = '" . xos_db_input(DEFAULT_LANGUAGE) . "' and l.languages_id = cd.language_id and l.languages_id = pd.language_id");
			        $categories = xos_db_fetch_array($categories_query);	
 
              $piwikCode .= '  _paq.push([\'addEcommerceItem\',"' . (int)$products[$i]['id'] . '","' . xos_output_string($categories['products_name']) . '","' . xos_output_string($categories['categories_or_pages_name']) . '",' . $this->format_raw($products[$i]['final_price']) . ',' . (int)$products[$i]['quantity'] . ']);' . "\n";  
            }
   
            $piwikCode .= '  _paq.push([\'trackEcommerceCartUpdate\',' . $this->format_raw($_SESSION['cart']->show_total()) . ']);' . "\n";
          }  
        }

        if ( (MODULE_HEADER_TAGS_PIWIK_EC_TRACKING == 'true') && (basename($_SERVER['PHP_SELF']) == FILENAME_CHECKOUT_SUCCESS) && isset($_SESSION['customer_id']) ) {
          $order_query = xos_db_query("select orders_id, currency_value from " . TABLE_ORDERS . " where customers_id = '" . (int)$_SESSION['customer_id'] . "' order by date_purchased desc limit 1");

          if (xos_db_num_rows($order_query) == 1) {
            $order = xos_db_fetch_array($order_query);
            $totals = array();
            $order_totals_query = xos_db_query("select value, class from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . (int)$order['orders_id'] . "'");
            while ($order_totals = xos_db_fetch_array($order_totals_query)) {
              if ($order_totals['value'] >= 0) {
                $totals[$order_totals['class']] = (isset($totals[$order_totals['class']]) && $totals[$order_totals['class']] > 0)  ? $totals[$order_totals['class']] + $order_totals['value'] : $order_totals['value'];
              } elseif ($order_totals['value'] < -1) {
                $totals['ot_discount'] = $order_totals['value'];
              }                 
            }

            $order_products_query = xos_db_query("select op.products_id, pd.products_name, op.final_price, op.products_quantity from " . TABLE_ORDERS_PRODUCTS . " op, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_LANGUAGES . " l where op.orders_id = '" . (int)$order['orders_id'] . "' and op.products_id = pd.products_id and l.code = '" . xos_db_input(DEFAULT_LANGUAGE) . "' and l.languages_id = pd.language_id");
            while ($order_products = xos_db_fetch_array($order_products_query)) {				
              $category_query = xos_db_query("select cd.categories_or_pages_name from " . TABLE_CATEGORIES_OR_PAGES_DATA . " cd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_LANGUAGES . " l where p2c.products_id = '" . (int)$order_products['products_id'] . "' and p2c.categories_or_pages_id = cd.categories_or_pages_id and l.code = '" . xos_db_input(DEFAULT_LANGUAGE) . "' and l.languages_id = cd.language_id limit 1");
              $category = xos_db_fetch_array($category_query);
              
              $piwikCode .= '  _paq.push([\'addEcommerceItem\',"' . (int)$order_products['products_id'] . '","' . xos_output_string($order_products['products_name']) . '","' . xos_output_string($category['categories_or_pages_name']) . '",' . $this->format_raw($order_products['final_price'] / (($order['currency_value'] > 0) ? $order['currency_value'] : 1)) . ',' . (int)$order_products['products_quantity'] . ']);' . "\n"; 
            }
                     
//            $piwikCode .= '  _paq.push([\'trackEcommerceOrder\',"' . (int)$order['orders_id'] . '",' . (isset($totals['ot_total']) ? $this->format_raw($totals['ot_total'] / (($order['currency_value'] > 0) ? $order['currency_value'] : 1)) : 0) . ',' . (isset($totals['ot_subtotal']) ? $this->format_raw($totals['ot_subtotal'] / (($order['currency_value'] > 0) ? $order['currency_value'] : 1)) : 0) . ','.(isset($totals['ot_tax']) ? $this->format_raw($totals['ot_tax'] / (($order['currency_value'] > 0) ? $order['currency_value'] : 1)) : 0) . ',' . (isset($totals['ot_shipping']) ? $this->format_raw($totals['ot_shipping'] / (($order['currency_value'] > 0) ? $order['currency_value'] : 1)) : 0) . ',' . (isset($totals['ot_discount']) ? $this->format_raw($totals['ot_discount'] / (($order['currency_value'] > 0) ? $order['currency_value'] : 1)) : 'false') . ']);' . "\n";
            $piwikCode .= '  _paq.push([\'trackEcommerceOrder\',"' . (int)$order['orders_id'] . '",' . (isset($totals['ot_total']) ? $this->format_raw($totals['ot_total'] / (($order['currency_value'] > 0) ? $order['currency_value'] : 1)) : 0) . ',' . (isset($totals['ot_subtotal']) ? $this->format_raw($totals['ot_subtotal'] / (($order['currency_value'] > 0) ? $order['currency_value'] : 1)) : 0) . ','.(isset($totals['ot_tax']) ? $this->format_raw($totals['ot_tax'] / (($order['currency_value'] > 0) ? $order['currency_value'] : 1)) : 0) . ',' . (isset($totals['ot_shipping']) ? $this->format_raw($totals['ot_shipping'] / (($order['currency_value'] > 0) ? $order['currency_value'] : 1)) : 0) . ',' . (isset($totals['ot_discount']) ? $this->format_raw($totals['ot_discount'] / (($order['currency_value'] > 0) ? $order['currency_value'] : 1)) : 0) . ']);' . "\n"; 
          }
        }
 
        $piwikCode .= '  (function() {' . "\n" .  
                      '    var u=(("https:" == document.location.protocol) ? "' . xos_output_string(MODULE_HEADER_TAGS_PIWIK_HTTPS_URL) . '" : "' . xos_output_string(MODULE_HEADER_TAGS_PIWIK_HTTP_URL) . '");' . "\n" .  
                      '    _paq.push([\'setTrackerUrl\', u+\'piwik.php\']);' . "\n" .  
                      '    _paq.push([\'setSiteId\', ' . (int)MODULE_HEADER_TAGS_PIWIK_ID . ']);' . "\n" .  
                      '    var d=document, g=d.createElement(\'script\'), s=d.getElementsByTagName(\'script\')[0]; g.type=\'text/javascript\';' . "\n" .  
                      '    g.defer=true; g.async=true; g.src=u+\'piwik.js\'; s.parentNode.insertBefore(g,s);' . "\n" .  
                      '  })();' . "\n" .                                                                                   
                      '/* ]]> */' . "\n" .
                      '</script>' . "\n";
                      
        if (MODULE_HEADER_TAGS_PIWIK_JS_PLACEMENT == '2') {
                      
          $piwikCode .= '<noscript><p><img src="' . ($request_type == 'SSL' ? xos_output_string(MODULE_HEADER_TAGS_PIWIK_HTTPS_URL) : xos_output_string(MODULE_HEADER_TAGS_PIWIK_HTTP_URL)) . 'piwik.php?idsite=' . (int)MODULE_HEADER_TAGS_PIWIK_ID . '&amp;rec=1&amp;action_name=' . rawurlencode(STORE_NAME . ' | (noscript image tracking)') . '" style="border:0" alt="" /></p></noscript>' . "\n";
        }
          
        $piwikCode .= '<!-- End Piwik Code --> ' . "\n"; 

        $templateIntegration->addBlock($piwikCode, $this->group);
      }
    }

    function format_raw($number) {      
      return number_format($number, 2, '.', '');
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_HEADER_TAGS_PIWIK_STATUS');
    }

    function install() {
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_HEADER_TAGS_PIWIK_STATUS', 'true', '6', '1', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_HEADER_TAGS_PIWIK_HTTP_URL', '', '6', '0', now())");      
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_HEADER_TAGS_PIWIK_HTTPS_URL', '', '6', '0', now())");      
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_HEADER_TAGS_PIWIK_ID', '', '6', '0', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_HEADER_TAGS_PIWIK_EC_TRACKING', 'true', '6', '0', 'xos_cfg_select_option(array(\'true\', \'false\'), ', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_HEADER_TAGS_PIWIK_JS_PLACEMENT', '2', '6', '0', 'xos_cfg_select_option(array(\'1\', \'2\'), ', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_HEADER_TAGS_PIWIK_SORT_ORDER', '0', '6', '0', now())");
    }

    function remove() {
      xos_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_HEADER_TAGS_PIWIK_STATUS', 'MODULE_HEADER_TAGS_PIWIK_HTTP_URL', 'MODULE_HEADER_TAGS_PIWIK_HTTPS_URL', 'MODULE_HEADER_TAGS_PIWIK_ID', 'MODULE_HEADER_TAGS_PIWIK_EC_TRACKING', 'MODULE_HEADER_TAGS_PIWIK_JS_PLACEMENT', 'MODULE_HEADER_TAGS_PIWIK_SORT_ORDER');
    }
  }
?>
