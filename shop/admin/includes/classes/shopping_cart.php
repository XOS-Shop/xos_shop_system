<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : shopping_cart.php
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
//              filename: shopping_cart.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  class shoppingCart {
    var $contents, $total, $content_type;

    function shoppingCart() {
      $this->reset();
    }

    function count_contents() {  // get total number of items in cart 
      $total_items = 0;
      if (is_array($this->contents)) {
        reset($this->contents);
        while (list($products_id, ) = each($this->contents)) {
          $total_items += $this->get_quantity($products_id);
        }
      }

      return $total_items;
    }
    
    function get_quantity($products_id) {
      if (isset($this->contents[$products_id])) {
        return $this->contents[$products_id]['qty'];
      } else {
        return 0;
      }
    }    

    function get_content_type() {
      $this->content_type = false;

      if ( (DOWNLOAD_ENABLED == 'true') && ($this->count_contents() > 0) ) {
        reset($this->contents);
        while (list($products_id, ) = each($this->contents)) {
          if (isset($this->contents[$products_id]['attributes'])) {
            reset($this->contents[$products_id]['attributes']);
            while (list(, $value) = each($this->contents[$products_id]['attributes'])) {
              $virtual_check_query = xos_db_query("select count(*) as total from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad where pa.products_id = '" . (int)$products_id . "' and pa.options_values_id = '" . (int)$value . "' and pa.products_attributes_id = pad.products_attributes_id");
              $virtual_check = xos_db_fetch_array($virtual_check_query);

              if ($virtual_check['total'] > 0) {
                switch ($this->content_type) {
                  case 'physical':
                    $this->content_type = 'mixed';

                    return $this->content_type;
                    break;
                  default:
                    $this->content_type = 'virtual';
                    break;
                }
              } else {
                switch ($this->content_type) {
                  case 'virtual':
                    $this->content_type = 'mixed';

                    return $this->content_type;
                    break;
                  default:
                    $this->content_type = 'physical';
                    break;
                }
              }
            }
          } else {
            switch ($this->content_type) {
              case 'virtual':
                $this->content_type = 'mixed';

                return $this->content_type;
                break;
              default:
                $this->content_type = 'physical';
                break;
            }
          }
        }
      } else {
        $this->content_type = 'physical';
      }

      return $this->content_type;
    }

    function calculate($crrency_value = 1) {
      $this->total = 0;
      if (!is_array($this->contents)) return 0; 

      $tax_address_query = xos_db_query("select ab.entry_country_id, ab.entry_zone_id from " . TABLE_ADDRESS_BOOK . " ab left join " . TABLE_ZONES . " z on (ab.entry_zone_id = z.zone_id) where ab.customers_id = '" . (int)$_SESSION['customer_id'] . "' and ab.address_book_id = '" . (int)($this->get_content_type() == 'virtual' ? $_SESSION['billto'] : $_SESSION['sendto']) . "'");
      $tax_address = xos_db_fetch_array($tax_address_query);

      reset($this->contents);
      while (list($products_id, ) = each($this->contents)) {
        $qty = $this->contents[$products_id]['qty'];

// products price
        $product_query = xos_db_query("select products_id, products_price, products_tax_class_id from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
        if ($product = xos_db_fetch_array($product_query)) {
          $prid = $product['products_id'];
          $products_tax = $this->get_tax_rate($product['products_tax_class_id'], $tax_address['entry_country_id'], $tax_address['entry_zone_id']);
                             
          $products_prices = xos_get_product_prices($product['products_price']);          
          if(isset($products_prices[$_SESSION['sppc_customer_group_id']][0])) {            
            $products_prices[$_SESSION['sppc_customer_group_id']]['special_status'] == 1 && $products_prices[$_SESSION['sppc_customer_group_id']][0]['special'] > 0 ? $products_price = $products_prices[$_SESSION['sppc_customer_group_id']][0]['special'] : $products_price = $products_prices[$_SESSION['sppc_customer_group_id']][0]['regular'];                                   
            $sizeof = count($products_prices[$_SESSION['sppc_customer_group_id']]);
            if ($sizeof > 2) {
              $array_keys = array_keys($products_prices[$_SESSION['sppc_customer_group_id']]);
              for ($count=2, $n=$sizeof; $count<$n; $count++) {
                $quantity = $array_keys[$count];
                if ($this->contents[$products_id]['qty'] >= $quantity) {                  
                  $products_prices[$_SESSION['sppc_customer_group_id']]['special_status'] == 1 && $products_prices[$_SESSION['sppc_customer_group_id']][$quantity]['special'] > 0 ? $products_price = $products_prices[$_SESSION['sppc_customer_group_id']][$quantity]['special'] : $products_price = $products_prices[$_SESSION['sppc_customer_group_id']][$quantity]['regular'];                  
                }   
              }       
            }                                    
          } else {            
            $products_prices[0]['special_status'] == 1 && $products_prices[0][0]['special'] > 0 ? $products_price = $products_prices[0][0]['special'] : $products_price = $products_prices[0][0]['regular'];                                    
            $sizeof = count($products_prices[0]);
            if ($sizeof > 2) {
              $array_keys = array_keys($products_prices[0]);
              for ($count=2, $n=$sizeof; $count<$n; $count++) {
                $quantity = $array_keys[$count];
                if ($this->contents[$products_id]['qty'] >= $quantity) {                 
                  $products_prices[0]['special_status'] == 1 && $products_prices[0][$quantity]['special'] > 0 ? $products_price = $products_prices[0][$quantity]['special'] : $products_price = $products_prices[0][$quantity]['regular'];                  
                }   
              }       
            }                                                
          }  

          $this->total += $this->add_tax($crrency_value * $products_price, $products_tax) * $qty;
        }

// attributes price
        if (isset($this->contents[$products_id]['attributes'])) {
          reset($this->contents[$products_id]['attributes']);
          while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
            $attribute_price_query = xos_db_query("select options_values_price, price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$prid . "' and options_id = '" . (int)$option . "' and options_values_id = '" . (int)$value . "'");
            $attribute_price = xos_db_fetch_array($attribute_price_query);
            if ($attribute_price['price_prefix'] == '+') {
              $this->total += $qty * $this->add_tax($crrency_value * $attribute_price['options_values_price'], $products_tax);
            } else {
              $this->total -= $qty * $this->add_tax($crrency_value * $attribute_price['options_values_price'], $products_tax);
            }
          }
        }
      }
      
      $discount_query = xos_db_query("select customers_group_discount from " .  TABLE_CUSTOMERS_GROUPS . " where customers_group_id = '" . $_SESSION['sppc_customer_group_id'] . "'");   
      $discount = xos_db_fetch_array($discount_query);
      if ($discount['customers_group_discount'] > 0) {
        $this->total -= $this->total / 100 * $discount['customers_group_discount'];
      }        
    }

    function get_products() {

      if (!is_array($this->contents)) return 0;      
      
      $products_array = array();
      reset($this->contents);
      while (list($products_id, ) = each($this->contents)) {
        $products_query = xos_db_query("select p.products_id, pd.products_name, p.products_model, p.products_price, p.products_weight, p.products_tax_class_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id='" . (int)xos_get_prid($products_id) . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$_SESSION['costom_lang_id'] . "'");
        if ($products = xos_db_fetch_array($products_query)) {

          $products_array[] = array('id' => $products_id,
                                    'name' => $products['products_name'],
                                    'quantity' => $this->contents[$products_id]['qty']);

        }
      }
      return $products_array;
    }

    function show_total($crrency_value = 1) {
      $this->calculate($crrency_value);

      return $this->total;
    }

    function get_customer_group_show_tax() {
      if(!isset($_SESSION['sppc_customer_group_show_tax'])) {
        return 1;
      }
      return $_SESSION['sppc_customer_group_show_tax'];
    }

    function get_customer_group_tax_exempt() {
      if(!isset($_SESSION['sppc_customer_group_tax_exempt'])) {
        return 0;
      }
      return $_SESSION['sppc_customer_group_tax_exempt'];
    }

// Returns the tax rate for a zone / class
// TABLES: tax_rates, zones_to_geo_zones
    function get_tax_rate($class_id, $country_id = '', $zone_id = '') {

      $customer_group_tax_exempt = $this->get_customer_group_tax_exempt();

      if ($customer_group_tax_exempt == '1') {
        return 0;
      }

      if ( ($country_id == '') && ($zone_id == '') ) {
        if (!isset($_SESSION['customer_id'])) {
          $country_id = STORE_COUNTRY;
          $zone_id = STORE_ZONE;
        } else {
          $country_id = $_SESSION['customer_country_id'];
          $zone_id = $_SESSION['customer_zone_id'];
        }
      }

      $tax_query = xos_db_query("select sum(tax_rate) as tax_rate from " . TABLE_TAX_RATES . " tr left join " . TABLE_ZONES_TO_GEO_ZONES . " za on (tr.tax_zone_id = za.geo_zone_id) left join " . TABLE_GEO_ZONES . " tz on (tz.geo_zone_id = tr.tax_zone_id) where (za.zone_country_id is null or za.zone_country_id = '0' or za.zone_country_id = '" . (int)$country_id . "') and (za.zone_id is null or za.zone_id = '0' or za.zone_id = '" . (int)$zone_id . "') and tr.tax_class_id = '" . (int)$class_id . "' group by tr.tax_priority");
      if (xos_db_num_rows($tax_query)) {
        $tax_multiplier = 1.0;
        while ($tax = xos_db_fetch_array($tax_query)) {
          $tax_multiplier *= 1.0 + ($tax['tax_rate'] / 100);
        }
        return ($tax_multiplier - 1.0) * 100;
      } else {
        return 0;
      }
    }
  
////
// Add tax to a products price
    function add_tax($price, $tax) {
      global $currencies;

      $customer_group_show_tax = $this->get_customer_group_show_tax();

      if (($tax > 0) && ($customer_group_show_tax == '1')) {
        return round($price, $currencies->currencies[$_SESSION['currency']]['decimal_places']) + $this->calculate_tax($price, $tax);
      } else {
        return round($price, $currencies->currencies[$_SESSION['currency']]['decimal_places']);
      }
    }

// Calculates Tax rounding the result
    function calculate_tax($price, $tax) {
      global $currencies;

      return round($price * $tax / 100, $currencies->currencies[$_SESSION['currency']]['decimal_places']);
    }    
  }
?>
