<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : product_preview.php
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
//              filename: categories.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/modules/product_preview.php') == 'overwrite_all')) :
  $product_query = xos_db_query("select p.products_id, pd.language_id, pd.products_name, pd.products_info, pd.products_description, pd.products_url, p.products_quantity, p.products_model, p.products_image, p.products_price, p.products_weight, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status, p.manufacturers_id  from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and p.products_id = '" . (int)$_GET['pID'] . "'");
  $product = xos_db_fetch_array($product_query);

  $pInfo = new objectInfo($product);
  $product_image = xos_get_product_images($pInfo->products_image);
  $products_prices = xos_get_product_prices($pInfo->products_price);
  $languages = xos_get_languages();
  $products_array = array();
  for ($i=0, $n=sizeof($languages); $i<$n; $i++) {    
    $pInfo->products_url = xos_get_products_url($pInfo->products_id, $languages[$i]['id']);

    if ($pInfo->products_date_available > date('Y-m-d')) {
      $date = sprintf(TEXT_PRODUCT_DATE_AVAILABLE, xos_date_long($pInfo->products_date_available));
    } else {
       $date = sprintf(TEXT_PRODUCT_DATE_ADDED, xos_date_long($pInfo->products_date_added));
    }

    $products_array[]=array('lang_image' => xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']),
                            'name' => xos_get_products_name($pInfo->products_id, $languages[$i]['id']),
                            'price' => $currencies->format($products_prices[0][0]['regular']),
                            'image' => ($product_image['name']) ? xos_image(DIR_WS_CATALOG_IMAGES . 'products/small/' . $product_image['name'], $pInfo->products_name, '','', 'align="right" hspace="5" vspace="5"') : '',                                                        
                            'info' => xos_get_products_info($pInfo->products_id, $languages[$i]['id']),
                            'description' => xos_get_products_description($pInfo->products_id, $languages[$i]['id']),
                            'info_url' => ($pInfo->products_url) ? sprintf(TEXT_PRODUCT_MORE_INFORMATION, $pInfo->products_url) : '',
                            'date_available_or_date_added' => $date);

  }
  
  if (isset($_GET['origin'])) {
    $pos_params = strpos($_GET['origin'], '?', 0);
    if ($pos_params != false) {
      $back_url = substr($_GET['origin'], 0, $pos_params);
      $back_url_params = substr($_GET['origin'], $pos_params + 1);
    } else {
      $back_url = $_GET['origin'];
      $back_url_params = '';
    }
  } else {
    $back_url = FILENAME_CATEGORIES;
    $back_url_params = 'cPath=' . $cPath . '&pID=' . $pInfo->products_id;
  }
  
  $smarty->assign(array('products' => $products_array,
                        'link_back' => xos_href_link($back_url, $back_url_params)));
  
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'categories');
  $output_product_preview = $smarty->fetch(ADMIN_TPL . '/includes/modules/product_preview.tpl');  
endif;
?>
