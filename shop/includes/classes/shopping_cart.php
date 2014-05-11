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
    var $contents, $total, $weight, $content_type;

    function shoppingCart() {
      $this->reset();
    }

    function restore_contents() {

      if (!isset($_SESSION['customer_id'])) return false;

// insert current cart contents in database
      if (is_array($this->contents)) {
        reset($this->contents);
        while (list($products_id, ) = each($this->contents)) {
          $qty = $this->contents[$products_id]['qty'];
          $product_query = xos_db_query("select products_id from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$_SESSION['customer_id'] . "' and products_id = '" . xos_db_input($products_id) . "'");
          if (!xos_db_num_rows($product_query)) {
            xos_db_query("insert into " . TABLE_CUSTOMERS_BASKET . " (customers_id, products_id, customers_basket_quantity, customers_basket_date_added) values ('" . (int)$_SESSION['customer_id'] . "', '" . xos_db_input($products_id) . "', '" . $qty . "', '" . date('Ymd') . "')");
          } else {
            xos_db_query("update " . TABLE_CUSTOMERS_BASKET . " set customers_basket_quantity = '" . $qty . "' where customers_id = '" . (int)$_SESSION['customer_id'] . "' and products_id = '" . xos_db_input($products_id) . "'");
          }
        }
      }

// reset per-session cart contents, but not the database contents
      $this->reset(false);

      $products_query = xos_db_query("select products_id, customers_basket_quantity from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$_SESSION['customer_id'] . "' order by customers_basket_id ");
      while ($products = xos_db_fetch_array($products_query)) {
        $this->contents[$products['products_id']] = array('qty' => $products['customers_basket_quantity']);
       // attributes
        if (strpos($products['products_id'], '-') !== false) {
          list($prid, $attributes_sting) = explode('-', $products['products_id']);
          $attributes_values = explode('_', $attributes_sting);         
          for ($i=0, $n=sizeof($attributes_values); $i<$n; $i++) {
            list($key, $value) = explode(',', $attributes_values[$i]);
            if (is_numeric($key) && is_numeric($value)) {
              $this->contents[$products['products_id']]['attributes'][$key] = $value;
            }            
          }           
        }
      }
      
      if (isset($_SESSION['customer_id'])) {
        xos_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$_SESSION['customer_id'] . "'");
      }
// basket und cart auf Basis des Produktangebots aktualisieren (begin)     
      if (is_array($this->contents)) {
        reset($this->contents);
        while (list($products_id, ) = each($this->contents)) {
          $check_basket = false;
          $qty = $this->contents[$products_id]['qty'];        
          $product_check_query = xos_db_query("select p.products_id, p.attributes_quantity, p.attributes_combinations from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c on p.products_id = p2c.products_id left join " . TABLE_CATEGORIES_OR_PAGES . " c on p2c.categories_or_pages_id = c.categories_or_pages_id where c.categories_or_pages_status = '1' and p.products_status = '1' and p.products_id = '" . xos_db_input(xos_get_prid($products_id)) . "'"); 
          if (xos_db_num_rows($product_check_query) > 0) {
            $product_check = xos_db_fetch_array($product_check_query);      
            $check_basket = true;                                             
            if (isset($this->contents[$products_id]['attributes'])) {
              reset($this->contents[$products_id]['attributes']);
              while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {            
                $attributes_check_query = xos_db_query("select count(*) as total from " . TABLE_PRODUCTS_ATTRIBUTES . " where options_id = '" . (int)$option . "' and options_values_id = '" . (int)$value . "' and products_id = '" . xos_db_input(xos_get_prid($products_id)) . "'"); 
                $attributes_check = xos_db_fetch_array($attributes_check_query);
                if ($attributes_check['total'] > 0) {                                       
                  if (xos_not_null($product_check['attributes_combinations']) && strpos($products_id, '-') !== false) {
                    list($prid, $attributes_sting) = explode('-', $products_id);
                    $combinations = explode('|', $product_check['attributes_combinations']);
                    if (!in_array($attributes_sting, $combinations)) {
                      $check_basket = false;
                    } elseif (STOCK_CHECK == 'true' && STOCK_ALLOW_CHECKOUT == 'false') {
                      $attributes_quantity = xos_get_attributes_quantity($product_check['attributes_quantity']);
                      if ($attributes_quantity[$attributes_sting] < 1) {
                        $check_basket = false;
                      }                     
                    }
                  }
                } else {   
                  $check_basket = false;  
                }                              
              }
            } elseif (xos_has_product_attributes($products_id)) {
              $check_basket = false;
            }                                   
          }          
          if ($check_basket == true) {  
            xos_db_query("insert into " . TABLE_CUSTOMERS_BASKET . " (customers_id, products_id, customers_basket_quantity, customers_basket_date_added) values ('" . (int)$_SESSION['customer_id'] . "', '" . xos_db_input($products_id) . "', '" . $qty . "', '" . date('Ymd') . "')");         
          }                 
        }
      }
              
// reset per-session cart contents, but not the database contents
      $this->reset(false);
      
      $products_query = xos_db_query("select products_id, customers_basket_quantity from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$_SESSION['customer_id'] . "' order by customers_basket_id ");
      while ($products = xos_db_fetch_array($products_query)) {
        $this->contents[$products['products_id']] = array('qty' => $products['customers_basket_quantity']);
        // attributes
        if (strpos($products['products_id'], '-') !== false) {
          list($prid, $attributes_sting) = explode('-', $products['products_id']);
          $attributes_values = explode('_', $attributes_sting);         
          for ($i=0, $n=sizeof($attributes_values); $i<$n; $i++) {
            list($key1, $value1) = explode(',', $attributes_values[$i]);
            if (is_numeric($key1) && is_numeric($value1)) {
              $this->contents[$products['products_id']]['attributes'][$key1] = $value1;
            }            
          }           
        }
      } 
// basket und cart auf Basis des Produktangebots aktualisieren (end)      
      $this->cleanup();
      
// assign a temporary unique ID to the order contents to prevent hack attempts during the checkout procedure
      $this->cartID = $this->generate_cart_id();     
    }

    function reset($reset_database = false) {

      $this->contents = array();
      $this->total = 0;
      $this->weight = 0;
      $this->content_type = false;

      if (isset($_SESSION['customer_id']) && ($reset_database == true)) {
        xos_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$_SESSION['customer_id'] . "'");
      }

      unset($this->cartID);
      if (isset($_SESSION['cartID'])) unset($_SESSION['cartID']);
    }

    function add_cart($products_id, $qty = '1', $attributes = '', $notify = true) {

      $products_id_string = xos_get_uprid($products_id, $attributes);
      $products_id = xos_get_prid($products_id_string);
      $qty = min((int)$qty, 10000);
      
      if (is_numeric($products_id) && $qty > 0) {
        $check_product_query = xos_db_query("select products_status from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
        $check_product = xos_db_fetch_array($check_product_query);

        if (($check_product !== false) && ($check_product['products_status'] == '1')) {
          if ($notify == true) {
            $_SESSION['new_products_id_in_cart'] = $products_id_string;
          }

          if ($this->in_cart($products_id_string)) {
            $this->update_quantity($products_id_string, $qty, $attributes);
          } else {
            $this->contents[$products_id_string] = array('qty' => $qty);
// insert into database
            if (isset($_SESSION['customer_id'])) xos_db_query("insert into " . TABLE_CUSTOMERS_BASKET . " (customers_id, products_id, customers_basket_quantity, customers_basket_date_added) values ('" . (int)$_SESSION['customer_id'] . "', '" . xos_db_input($products_id_string) . "', '" . (int)$qty . "', '" . date('Ymd') . "')");

            if (is_array($attributes)) {
              reset($attributes);
              while (list($option, $value) = each($attributes)) {
                $this->contents[$products_id_string]['attributes'][$option] = $value;
              }
            }
          }

          $this->cleanup();

// assign a temporary unique ID to the order contents to prevent hack attempts during the checkout procedure
          $this->cartID = $this->generate_cart_id();
        }
      }
    }

    function update_quantity($products_id, $quantity = '', $attributes = '') {

      $products_id_string = xos_get_uprid($products_id, $attributes);
      $products_id = xos_get_prid($products_id_string);

      if (is_numeric($products_id) && isset($this->contents[$products_id_string]) && is_numeric($quantity)) {
        $this->contents[$products_id_string] = array('qty' => $quantity);
// update database
        if (isset($_SESSION['customer_id'])) xos_db_query("update " . TABLE_CUSTOMERS_BASKET . " set customers_basket_quantity = '" . (int)$quantity . "' where customers_id = '" . (int)$_SESSION['customer_id'] . "' and products_id = '" . xos_db_input($products_id_string) . "'");

        if (is_array($attributes)) {
          reset($attributes);
          while (list($option, $value) = each($attributes)) {
            $this->contents[$products_id_string]['attributes'][$option] = $value;
          }
        }
      }
    }

    function cleanup() {

      reset($this->contents);
      while (list($key,) = each($this->contents)) {
        if ($this->contents[$key]['qty'] < 1) {
          unset($this->contents[$key]);
// remove from database
          if (isset($_SESSION['customer_id'])) {
            xos_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$_SESSION['customer_id'] . "' and products_id = '" . xos_db_input($key) . "'");
          }
        }
      }
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

    function in_cart($products_id) {
      if (isset($this->contents[$products_id])) {
        return true;
      } else {
        return false;
      }
    }

    function remove($products_id) {

      unset($this->contents[$products_id]);
// remove from database
      if (isset($_SESSION['customer_id'])) {
        xos_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$_SESSION['customer_id'] . "' and products_id = '" . xos_db_input($products_id) . "'");
      }

// assign a temporary unique ID to the order contents to prevent hack attempts during the checkout procedure
      $this->cartID = $this->generate_cart_id();
    }

    function remove_all() {
      $this->reset();
    }

    function get_product_id_list() {
      $product_id_list = '';
      if (is_array($this->contents)) {
        reset($this->contents);
        while (list($products_id, ) = each($this->contents)) {
          $product_id_list .= ', ' . $products_id;
        }
      }

      return substr($product_id_list, 2);
    }

    function calculate($crrency_value = 1) {
      global $customer_group_id, $currencies;
    
      $this->total = 0;
      $this->discount = 0;      
      $this->weight = 0;
      $this->tax_groups = array();
      if (!is_array($this->contents)) return 0;
      
      $tax_address_query = xos_db_query("select ab.entry_country_id, ab.entry_zone_id from " . TABLE_ADDRESS_BOOK . " ab left join " . TABLE_ZONES . " z on (ab.entry_zone_id = z.zone_id) where ab.customers_id = '" . (int)$_SESSION['customer_id'] . "' and ab.address_book_id = '" . (int)($this->get_content_type() == 'virtual' ? $_SESSION['billto'] : $_SESSION['sendto']) . "'");
      $tax_address = xos_db_fetch_array($tax_address_query);      

      reset($this->contents);
      while (list($products_id, ) = each($this->contents)) {
        $shown_price = 0;
        $shown_product_price = 0;
        $shown_attribute_price = 0;
        $qty = $this->contents[$products_id]['qty'];

// products price
        $product_query = xos_db_query("select products_id, products_price, products_tax_class_id, products_weight from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
        if ($product = xos_db_fetch_array($product_query)) {
          $prid = $product['products_id'];
          $products_tax = xos_get_tax_rate($product['products_tax_class_id'], $tax_address['entry_country_id'], $tax_address['entry_zone_id']);
          $tax_description = xos_get_tax_description($product['products_tax_class_id'], $tax_address['entry_country_id'], $tax_address['entry_zone_id']);
          $products_weight = $product['products_weight'];
          
          $products_prices = xos_get_product_prices($product['products_price']);          
          if(isset($products_prices[$customer_group_id][0])) {            
            $products_prices[$customer_group_id]['special_status'] == 1 && $products_prices[$customer_group_id][0]['special'] > 0 ? $products_price = $products_prices[$customer_group_id][0]['special'] : $products_price = $products_prices[$customer_group_id][0]['regular'];                                     
            $sizeof = count($products_prices[$customer_group_id]);
            if ($sizeof > 2) {
              $array_keys = array_keys($products_prices[$customer_group_id]);
              for ($count=2, $n=$sizeof; $count<$n; $count++) {
                $quantity = $array_keys[$count];
                if ($this->contents[$products_id]['qty'] >= $quantity) {                  
                  $products_prices[$customer_group_id]['special_status'] == 1 && $products_prices[$customer_group_id][$quantity]['special'] > 0 ? $products_price = $products_prices[$customer_group_id][$quantity]['special'] : $products_price = $products_prices[$customer_group_id][$quantity]['regular'];                  
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

          $this->total += $shown_product_price = (xos_add_tax($crrency_value * $products_price, $products_tax) * $qty);
          $this->weight += ($qty * $products_weight);
        }

// attributes price
        if (isset($this->contents[$products_id]['attributes'])) {
          reset($this->contents[$products_id]['attributes']);
          while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
            $attribute_price_query = xos_db_query("select options_values_price, price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$prid . "' and options_id = '" . (int)$option . "' and options_values_id = '" . (int)$value . "'");
            $attribute_price = xos_db_fetch_array($attribute_price_query);
            if ($attribute_price['price_prefix'] == '+') {
              $shown_attribute_price += $qty * xos_add_tax($crrency_value * $attribute_price['options_values_price'], $products_tax);
            } else {
              $shown_attribute_price -= $qty * xos_add_tax($crrency_value * $attribute_price['options_values_price'], $products_tax);
            }
          }
          $this->total += $shown_attribute_price;      
        }
        
        $shown_price = $shown_product_price + $shown_attribute_price;
       
        if ($_SESSION['sppc_customer_group_show_tax'] == '1') {
          if (isset($this->tax_groups["$tax_description"])) {
            $this->tax_groups["$tax_description"] += round($shown_price - ($shown_price / (($products_tax < 10) ? "1.0" . str_replace('.', '', $products_tax) : "1." . str_replace('.', '', $products_tax))), $currencies->currencies[$_SESSION['currency']]['decimal_places']);          
          } else {
            $this->tax_groups["$tax_description"] = round($shown_price - ($shown_price / (($products_tax < 10) ? "1.0" . str_replace('.', '', $products_tax) : "1." . str_replace('.', '', $products_tax))), $currencies->currencies[$_SESSION['currency']]['decimal_places']);
          }
        } else {
          if (isset($this->tax_groups["$tax_description"])) {
            $this->tax_groups["$tax_description"] += round(($products_tax / 100) * $shown_price, $currencies->currencies[$_SESSION['currency']]['decimal_places']);
          } else {
            $this->tax_groups["$tax_description"] = round(($products_tax / 100) * $shown_price, $currencies->currencies[$_SESSION['currency']]['decimal_places']);
          }
        }                
      }
      
      if ($_SESSION['sppc_customer_group_discount'] > 0) {
        $this->total -= $this->discount = $this->total / 100 * $_SESSION['sppc_customer_group_discount'];
        $this->discount = 0 - $this->discount;
        reset($this->tax_groups);
        while (list($key, $value) = each($this->tax_groups)) {
          if ($value > 0) {
            $this->tax_groups["$key"] -= round($value / 100 * $_SESSION['sppc_customer_group_discount'], $currencies->currencies[$_SESSION['currency']]['decimal_places']);
          }
        }      
      }     
    }

    function attributes_price($products_id, $crrency_value = 1, $products_tax = 1) {
      $attributes_price = 0;

      if (isset($this->contents[$products_id]['attributes'])) {
        reset($this->contents[$products_id]['attributes']);
        while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
          $attribute_price_query = xos_db_query("select options_values_price, price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$products_id . "' and options_id = '" . (int)$option . "' and options_values_id = '" . (int)$value . "'");
          $attribute_price = xos_db_fetch_array($attribute_price_query);
          if ($attribute_price['price_prefix'] == '+') {
            $attributes_price += xos_add_tax($crrency_value * $attribute_price['options_values_price'], $products_tax);
          } else {
            $attributes_price -= xos_add_tax($crrency_value * $attribute_price['options_values_price'], $products_tax);
          }
        }
      }

      return $attributes_price;
    }

    function get_products($crrency_value = 1) {
      global $customer_group_id;

      if (!is_array($this->contents)) return false;

      $tax_address_query = xos_db_query("select ab.entry_country_id, ab.entry_zone_id from " . TABLE_ADDRESS_BOOK . " ab left join " . TABLE_ZONES . " z on (ab.entry_zone_id = z.zone_id) where ab.customers_id = '" . (int)$_SESSION['customer_id'] . "' and ab.address_book_id = '" . (int)($this->get_content_type() == 'virtual' ? $_SESSION['billto'] : $_SESSION['sendto']) . "'");
      $tax_address = xos_db_fetch_array($tax_address_query);

      $products_array = array();
      reset($this->contents);
      while (list($products_id, ) = each($this->contents)) {
        $products_query = xos_db_query("select p.products_id, pd.products_name, pd.products_p_unit, p.products_model, p.products_image, p.products_price, p.products_weight, p.products_tax_class_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = '" . (int)$products_id . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'");
        if ($products = xos_db_fetch_array($products_query)) {
          $prid = $products['products_id'];
          $products_tax = xos_get_tax_rate($products['products_tax_class_id'], $tax_address['entry_country_id'], $tax_address['entry_zone_id']);
                    
          $products_prices = xos_get_product_prices($products['products_price']);
          if(isset($products_prices[$customer_group_id][0])) {            
            $products_prices[$customer_group_id]['special_status'] == 1 && $products_prices[$customer_group_id][0]['special'] > 0 ? $products_price = $products_prices[$customer_group_id][0]['special'] : $products_price = $products_prices[$customer_group_id][0]['regular'];                                    
            $sizeof = count($products_prices[$customer_group_id]);
            if ($sizeof > 2) {
              $array_keys = array_keys($products_prices[$customer_group_id]);
              for ($count=2, $n=$sizeof; $count<$n; $count++) {
                $qty = $array_keys[$count];
                if ($this->contents[$products_id]['qty'] >= $qty) {                  
                  $products_prices[$customer_group_id]['special_status'] == 1 && $products_prices[$customer_group_id][$qty]['special'] > 0 ? $products_price = $products_prices[$customer_group_id][$qty]['special'] : $products_price = $products_prices[$customer_group_id][$qty]['regular'];                  
                }   
              }       
            }                                    
          } else {            
            $products_prices[0]['special_status'] == 1 && $products_prices[0][0]['special'] > 0 ? $products_price = $products_prices[0][0]['special'] : $products_price = $products_prices[0][0]['regular'];                                    
            $sizeof = count($products_prices[0]);
            if ($sizeof > 2) {
              $array_keys = array_keys($products_prices[0]);
              for ($count=2, $n=$sizeof; $count<$n; $count++) {
                $qty = $array_keys[$count];
                if ($this->contents[$products_id]['qty'] >= $qty) {                  
                  $products_prices[0]['special_status'] == 1 && $products_prices[0][$qty]['special'] > 0 ? $products_price = $products_prices[0][$qty]['special'] : $products_price = $products_prices[0][$qty]['regular'];                  
                }   
              }       
            }                                                
          }       

          $products_array[] = array('id' => $products_id,
                                    'name' => $products['products_name'],
                                    'packaging_unit' => $products['products_p_unit'],
                                    'model' => $products['products_model'],
                                    'image' => $products['products_image'],
                                    'price' => xos_add_tax($crrency_value * $products_price, $products_tax),
                                    'quantity' => $this->contents[$products_id]['qty'],
                                    'weight' => $products['products_weight'],
                                    'final_price' => (xos_add_tax($crrency_value * $products_price, $products_tax) + $this->attributes_price($products_id, $crrency_value, $products_tax)),
                                    'tax_class_id' => $products['products_tax_class_id'],
                                    'attributes' => (isset($this->contents[$products_id]['attributes']) ? $this->contents[$products_id]['attributes'] : ''));
        }
      }

      return $products_array;
    }

    function show_total($crrency_value = 1) {
      $this->calculate($crrency_value);

      return $this->total;
    }

    function show_discount($crrency_value = 1) {
      $this->calculate($crrency_value);

      return $this->discount;
    } 
    
    function show_weight() {
      $this->calculate();

      return $this->weight;
    }

    function show_tax_groups($crrency_value = 1) {
      $this->calculate($crrency_value);

      return $this->tax_groups;
    } 

    function generate_cart_id($length = 5) {
      return xos_create_random_value($length, 'digits');
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

  }
?>
