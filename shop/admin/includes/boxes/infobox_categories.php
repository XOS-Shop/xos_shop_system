<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : infobox_categories.php
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

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/infobox_categories.php') == 'overwrite_all')) :
     function xos_get_category_tree_for_movings($parent_id = '0', $spacing = '', $category_tree_array = '', $move_product = false) {

      if (!is_array($category_tree_array)) $category_tree_array = array();
      if (sizeof($category_tree_array) < 1) $category_tree_array[] = $move_product ? array('id' => '0', 'text' => TEXT_TOP, 'params' => 'style="color: grey;" disabled="disabled"') : array('id' => '0', 'text' => TEXT_TOP);

      $categories_query = xos_db_query("select c.categories_or_pages_id, cpd.categories_or_pages_name, c.parent_id, c.categories_or_pages_status from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.categories_or_pages_id = cpd.categories_or_pages_id and c.is_page = 'false' and cpd.language_id = '" . (int)$_SESSION['used_lng_id'] . "' and c.parent_id = '" . (int)$parent_id . "' order by c.sort_order, cpd.categories_or_pages_name");
      while ($categories = xos_db_fetch_array($categories_query)) {
        if ((xos_children_in_category_count($categories['categories_or_pages_id']) > 0 && $move_product) || (xos_children_in_category_count($categories['categories_or_pages_id']) == 0 && xos_products_in_category_count($categories['categories_or_pages_id'], true) > 0 && !$move_product)) {
          $category_tree_array[] = array('id' => $categories['categories_or_pages_id'], 'text' => $spacing . $categories['categories_or_pages_name'], 'params' => 'style="color: grey;" disabled="disabled"');
        } else {
          $category_tree_array[] = array('id' => $categories['categories_or_pages_id'], 'text' => $spacing . $categories['categories_or_pages_name'], 'params' => (($categories['categories_or_pages_status'] == 0) ? 'style="color: red;"' : ''));
        }
        $category_tree_array = xos_get_category_tree_for_movings($categories['categories_or_pages_id'], $spacing . '&nbsp;&nbsp;&nbsp;', $category_tree_array, $move_product);
      }

      return $category_tree_array;
    } 

    $contents = array();
    switch ($action) {
      case 'delete_category':
        $heading_title = '<b>' . TEXT_INFO_HEADING_DELETE_CATEGORY . '</b>';

        $form_tag = xos_draw_form('categories', FILENAME_CATEGORIES, 'action=delete_category_confirm&cPath=' . $cPath) . xos_draw_hidden_field('categories_or_pages_id', $cInfo->categories_or_pages_id);
        $contents[] = array('text' => TEXT_DELETE_CATEGORY_INTRO);
        $contents[] = array('text' => '<br /><b>' . $cInfo->categories_or_pages_name . '</b>');
        if ($cInfo->children_count > 0) $contents[] = array('text' => '<br />' . sprintf(TEXT_DELETE_WARNING_CHILDREN, $cInfo->children_count));
        if ($cInfo->products_count > 0) $contents[] = array('text' => '<br />' . sprintf(TEXT_DELETE_WARNING_PRODUCTS, $cInfo->products_count));
        $contents[] = array('text' => '<br /><a href="" onclick="categories.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cpID=' . $cInfo->categories_or_pages_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
        break;
      case 'move_category':
        $heading_title = '<b>' . TEXT_INFO_HEADING_MOVE_CATEGORY . '</b>';

        $form_tag = xos_draw_form('categories', FILENAME_CATEGORIES, 'action=move_category_confirm&cPath=' . $cPath) . xos_draw_hidden_field('categories_or_pages_id', $cInfo->categories_or_pages_id);
        $contents[] = array('text' => sprintf(TEXT_MOVE_CATEGORIES_INTRO, $cInfo->categories_or_pages_name));
        $contents[] = array('text' => '<br />' . sprintf(TEXT_MOVE, $cInfo->categories_or_pages_name) . '<br />' . xos_draw_pull_down_menu('move_to_category_id', xos_get_category_tree_for_movings(), $current_category_id));
        $contents[] = array('text' => '<br /><a href="" onclick="categories.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_MOVE . ' "><span>' . BUTTON_TEXT_MOVE . '</span></a><a href="' . xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cpID=' . $cInfo->categories_or_pages_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
        break;
      case 'delete_product':
        $heading_title = '<b>' . TEXT_INFO_HEADING_DELETE_PRODUCT . '</b>';

        $form_tag = xos_draw_form('products', FILENAME_CATEGORIES, 'action=delete_product_confirm&cPath=' . $cPath) . xos_draw_hidden_field('products_id', $pInfo->products_id);
        $contents[] = array('text' => TEXT_DELETE_PRODUCT_INTRO);
        $contents[] = array('text' => '<br /><b>' . $pInfo->products_name . '</b>');

        $product_categories_string = '';
        $product_categories = xos_generate_category_path($pInfo->products_id, 'product');
        for ($i = 0, $n = sizeof($product_categories); $i < $n; $i++) {
          $category_path = '';
          for ($j = 0, $k = sizeof($product_categories[$i]); $j < $k; $j++) {
            $category_path .= $product_categories[$i][$j]['text'] . '&nbsp;&gt;&nbsp;';
          }
          $category_path = substr($category_path, 0, -16);
          $product_categories_string .= xos_draw_checkbox_field('product_categories[]', $product_categories[$i][sizeof($product_categories[$i])-1]['id'], true) . '&nbsp;' . $category_path . '<br />';
        }
        $product_categories_string = substr($product_categories_string, 0, -6);

        $contents[] = array('text' => '<br />' . $product_categories_string);
        $contents[] = array('text' => '<br /><a href="" onclick="products.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
        break;
      case 'move_product':
        $heading_title = '<b>' . TEXT_INFO_HEADING_MOVE_PRODUCT . '</b>';

        $form_tag = xos_draw_form('products', FILENAME_CATEGORIES, 'action=move_product_confirm&cPath=' . $cPath) . xos_draw_hidden_field('products_id', $pInfo->products_id);
        $contents[] = array('text' => sprintf(TEXT_MOVE_PRODUCTS_INTRO, $pInfo->products_name));
        $contents[] = array('text' => '<br />' . TEXT_INFO_CURRENT_CATEGORIES . '<br /><b>' . xos_output_generated_category_path($pInfo->products_id, 'product') . '</b>');
        $contents[] = array('text' => '<br />' . sprintf(TEXT_MOVE, $pInfo->products_name) . '<br />' . xos_draw_pull_down_menu('move_to_category_id', xos_get_category_tree_for_movings(0, '', '', true), $current_category_id));
        $contents[] = array('text' => '<br /><a href="" onclick="products.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_MOVE . ' "><span>' . BUTTON_TEXT_MOVE . '</span></a><a href="' . xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
        break;
      case 'copy_to':
        $heading_title = '<b>' . TEXT_INFO_HEADING_COPY_TO . '</b>';

        $form_tag = xos_draw_form('copy_to', FILENAME_CATEGORIES, 'action=copy_to_confirm&cPath=' . $cPath) . xos_draw_hidden_field('products_id', $pInfo->products_id);
        $contents[] = array('text' => TEXT_INFO_COPY_TO_INTRO);
        $contents[] = array('text' => '<br />' . TEXT_INFO_CURRENT_CATEGORIES . '<br /><b>' . xos_output_generated_category_path($pInfo->products_id, 'product') . '</b>');
        $contents[] = array('text' => '<br />' . TEXT_CATEGORIES . '<br />' . xos_draw_pull_down_menu('categories_or_pages_id', xos_get_category_tree_for_movings(0, '', '', true), $current_category_id));
        $contents[] = array('text' => '<br />' . TEXT_HOW_TO_COPY . '<br />' . xos_draw_radio_field('copy_as', 'link', true) . ' ' . TEXT_COPY_AS_LINK . '<br />' . xos_draw_radio_field('copy_as', 'duplicate') . ' ' . TEXT_COPY_AS_DUPLICATE);
        $contents[] = array('text' => '<br /><a href="" onclick="copy_to.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_COPY . ' "><span>' . BUTTON_TEXT_COPY . '</span></a><a href="' . xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
        break;
      default:
        if ($rows > 0) {
          if (isset($cInfo) && is_object($cInfo)) { // category info box contents
            $category_path_string = ''; 
            $category_path = xos_generate_category_path($cInfo->categories_or_pages_id);
            for ($i=(sizeof($category_path[0])-1); $i>0; $i--) { 
              $category_path_string .= $category_path[0][$i]['id'] . '_'; 
            } 
            $category_path_string = substr($category_path_string, 0, -1); 
          
            $heading_title = '<b>' . $cInfo->categories_or_pages_name . '</b>';
            
            $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $category_path_string . '&cpID=' . $cInfo->categories_or_pages_id . '&action=new_category') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a><a href="' . xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $category_path_string . '&cpID=' . $cInfo->categories_or_pages_id . '&action=delete_category') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $category_path_string . '&cpID=' . $cInfo->categories_or_pages_id . '&action=move_category') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_MOVE . ' "><span>' . BUTTON_TEXT_MOVE . '</span></a>');
            $contents[] = array('text' => '<br />' . TEXT_DATE_ADDED . ' ' . xos_date_short($cInfo->date_added));
            if (xos_not_null($cInfo->last_modified)) $contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . xos_date_short($cInfo->last_modified));
            $contents[] = array('text' => '<br />' . xos_info_image('categories/small/' . $cInfo->categories_image, $cInfo->categories_or_pages_name) . '<br />' . $cInfo->categories_image);
            $contents[] = array('text' => '<br />' . TEXT_SUBCATEGORIES . ' ' . $cInfo->children_count . '<br />' . TEXT_PRODUCTS . ' ' . $cInfo->products_count);
          } elseif (isset($pInfo) && is_object($pInfo)) { // product info box contents
            $category_path_string = ''; 
            $category_path = xos_generate_category_path($pInfo->products_id, 'product');      
            for ($i=0, $n=sizeof($category_path[0]); $i<$n; $i++) {
              $category_path_string .= $category_path[0][$i]['id'] . '_'; 
            } 
            $category_path_string = substr($category_path_string, 0, -1);
   
            $product_image = xos_get_product_images($pInfo->products_image);
            $products_prices = xos_get_product_prices($pInfo->products_price);
         
            $heading_title = '<b>' . xos_get_products_name($pInfo->products_id, $_SESSION['used_lng_id']) . '</b>';

            $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $category_path_string . '&pID=' . $pInfo->products_id . '&action=new_product') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a><a href="' . xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $category_path_string . '&pID=' . $pInfo->products_id . '&action=delete_product') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $category_path_string . '&pID=' . $pInfo->products_id . '&action=move_product') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_MOVE . ' "><span>' . BUTTON_TEXT_MOVE . '</span></a><a href="' . xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $category_path_string . '&pID=' . $pInfo->products_id . '&action=copy_to') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_COPY_TO . ' "><span>' . BUTTON_TEXT_COPY_TO . '</span></a><a href="' . xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'cPath=' . $category_path_string . '&pID=' . $pInfo->products_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_PRODUCTS_ATTRIBUTES . ' "><span>' . BUTTON_TEXT_PRODUCTS_ATTRIBUTES . '</span></a>');
            $contents[] = array('text' => '<br />' . TEXT_DATE_ADDED . ' ' . xos_date_short($pInfo->products_date_added));
            if (xos_not_null($pInfo->products_last_modified)) $contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . xos_date_short($pInfo->products_last_modified));
            if (date('Y-m-d') < $pInfo->products_date_available) $contents[] = array('text' => TEXT_DATE_AVAILABLE . ' ' . xos_date_short($pInfo->products_date_available));
            $contents[] = array('text' => '<br />' . xos_info_image('products/small/' . $product_image['name'], $pInfo->products_name) . '<br />' . $product_image['name']);
            $contents[] = array('text' => '<br />' . TEXT_PRODUCTS_PRICE_INFO . ' ' . $currencies->format($products_prices[0][0]['regular']) . '<br />' . TEXT_PRODUCTS_QUANTITY_INFO . ' ' . $pInfo->products_quantity);
            $contents[] = array('text' => '<br />' . TEXT_PRODUCTS_AVERAGE_RATING . ' ' . number_format($pInfo->average_rating, 2) . '%');
          }
        } else {
          $heading_title = '<b>' . EMPTY_CATEGORY . '</b>';

          $contents[] = array('text' => TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS);
        }
        break;
    }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                            
  $output_infobox_categories = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_categories.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_form_tag', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_categories', $output_infobox_categories);
endif;
?>
