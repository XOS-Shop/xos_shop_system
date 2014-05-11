<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : ot_cod_fee.php
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
//              filename: ot_loworderfee.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  class ot_cod_fee {
    var $title, $output;

    function ot_cod_fee() {
      $this->code = 'ot_cod_fee';
      $this->title = MODULE_ORDER_TOTAL_COD_FEE_TITLE;
      $this->description = MODULE_ORDER_TOTAL_COD_FEE_DESCRIPTION;
      $this->enabled = ((MODULE_ORDER_TOTAL_COD_FEE_STATUS == 'true') ? true : false);
      $this->sort_order = MODULE_ORDER_TOTAL_COD_FEE_SORT_ORDER;

      $this->output = array();
    }

    function process() {
      global $order, $currencies;
      
      $cod_country = false;
      if ($_SESSION['payment'] == 'cod') {

        if ($_SESSION['shipping']['id'] == 'flat_flat') $cod_zones = preg_split("/[:,]/", MODULE_ORDER_TOTAL_COD_FEE_FLAT);
        if ($_SESSION['shipping']['id'] == 'item_item') $cod_zones = preg_split("/[:,]/", MODULE_ORDER_TOTAL_COD_FEE_ITEM);
        if ($_SESSION['shipping']['id'] == 'table_table') $cod_zones = preg_split("/[:,]/", MODULE_ORDER_TOTAL_COD_FEE_TABLE);
        if ($_SESSION['shipping']['id'] == 'usps_usps') $cod_zones = preg_split("/[:,]/", MODULE_ORDER_TOTAL_COD_FEE_USPS); 
        if ($_SESSION['shipping']['id'] == 'zones_zones') $cod_zones = preg_split("/[:,]/", MODULE_ORDER_TOTAL_COD_FEE_ZONES);
        if ($_SESSION['shipping']['id'] == 'free_free') $cod_zones = preg_split("/[:,]/", MODULE_ORDER_TOTAL_COD_FEE_FREE);
         
        for ($i = 0; $i < count($cod_zones); $i++) {           
          if ($cod_zones[$i] == $order->delivery['country']['iso_code_2']) {
            $cod_cost = $cod_zones[$i + 1];
            $cod_country = true;
            break;
          } elseif ($cod_zones[$i] == '00') {
            $cod_cost = $cod_zones[$i + 1];
            $cod_country = true;
          }
            $i++;
        }
      }       
       
      if ($cod_country) {
        $tax = xos_get_tax_rate(MODULE_ORDER_TOTAL_COD_FEE_TAX_CLASS, $order->delivery['country']['id'], $order->delivery['zone_id']);
        $tax_description = xos_get_tax_description(MODULE_ORDER_TOTAL_COD_FEE_TAX_CLASS, $order->delivery['country']['id'], $order->delivery['zone_id']);
        $tax_value = round($order->info['currency_value'] * xos_calculate_tax($cod_cost, $tax), $currencies->currencies[$_SESSION['currency']]['decimal_places']);

        $order->info['tax'] += $tax_value;
        $order->info['tax_groups']["$tax_description"] += $tax_value;
        $order->info['total'] += round($order->info['currency_value'] * $cod_cost, $currencies->currencies[$_SESSION['currency']]['decimal_places']) + $tax_value;
          
        $this->output[] = array('title' => $this->title . ':',
                                'text' => $currencies->format(xos_add_tax($cod_cost, $tax), $order->info['currency_value']),
                                'value' => round(xos_add_tax($cod_cost, $tax) * $order->info['currency_value'], $currencies->currencies[$_SESSION['currency']]['decimal_places']),
                                'tax' => xos_display_tax_value($tax));
      }    
    }
    
    function check() {
      if (!isset($this->_check)) {
        $check_query = xos_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_COD_FEE_STATUS'");
        $this->_check = xos_db_num_rows($check_query);
      }

      return $this->_check;
    }

    function keys() {
      return array('MODULE_ORDER_TOTAL_COD_FEE_STATUS', 'MODULE_ORDER_TOTAL_COD_FEE_SORT_ORDER', 'MODULE_ORDER_TOTAL_COD_FEE_FLAT', 'MODULE_ORDER_TOTAL_COD_FEE_ITEM', 'MODULE_ORDER_TOTAL_COD_FEE_TABLE', 'MODULE_ORDER_TOTAL_COD_FEE_USPS', 'MODULE_ORDER_TOTAL_COD_FEE_ZONES', 'MODULE_ORDER_TOTAL_COD_FEE_FREE', 'MODULE_ORDER_TOTAL_COD_FEE_TAX_CLASS');
    }
    
    function install() {
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_ORDER_TOTAL_COD_FEE_STATUS', 'true', '6', '1','xos_cfg_select_option(array(\'true\', \'false\'), ', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_ORDER_TOTAL_COD_FEE_SORT_ORDER', '2', '6', '2', now())");                 
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_ORDER_TOTAL_COD_FEE_FLAT', 'CH:4.00,AT:3.00,DE:3.58,00:9.99', '6', '3', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_ORDER_TOTAL_COD_FEE_ITEM', 'CH:4.00,AT:3.00,DE:3.58,00:9.99', '6', '4', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_ORDER_TOTAL_COD_FEE_TABLE', 'CH:4.00,AT:3.00,DE:3.58,00:9.99', '6', '5', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_ORDER_TOTAL_COD_FEE_USPS', 'CA:4.50,US:3.00,00:9.99', '6', '6', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_ORDER_TOTAL_COD_FEE_ZONES', 'CH:4.00,AT:3.00,DE:3.58,00:9.99', '6', '7', now())");
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_ORDER_TOTAL_COD_FEE_FREE', 'CH:4.00,AT:3.00,DE:3.58,00:9.99', '6', '8', now())");     
      xos_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) values ('MODULE_ORDER_TOTAL_COD_FEE_TAX_CLASS', '0', '6', '9', 'xos_get_tax_class_title', 'xos_cfg_pull_down_tax_classes(', now())");
    }
    
    function remove() {
      xos_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }
  }
?>
