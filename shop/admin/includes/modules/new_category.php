<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : new_category.php
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

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/modules/new_category.php') == 'overwrite_all')) :    
    $parameters = array('categories_or_pages_id' => '',
                        'category_name' => '',
                        'categories_image' => '',
                        'product_list_b' => '',
                        'sort_order' => '',                        
                        'categories_or_pages_status' => '');

    $cInfo = new objectInfo($parameters);
    
    if (isset($_GET['cpID']) && $reload != true) {
    
      $cpID = xos_db_prepare_input($_GET['cpID']);
             
      $category_query = xos_db_query("select c.categories_or_pages_id, cpd.categories_or_pages_name as category_name, c.categories_image, c.product_list_b, c.sort_order, c.categories_or_pages_status from " . TABLE_CATEGORIES_OR_PAGES . " c, " . TABLE_CATEGORIES_OR_PAGES_DATA . " cpd where c.categories_or_pages_id = '" . (int)$cpID . "' and c.categories_or_pages_id = cpd.categories_or_pages_id and cpd.language_id = '" . (int)$_SESSION['used_lng_id'] . "'");    
      $category = xos_db_fetch_array($category_query);
      $cInfo->objectInfo($category);      
    } elseif (xos_not_null($_POST)) {
      $cInfo->objectInfo($_POST);   
    }        

    if (WYSIWYG_FOR_CATEGORY == 'true') {
      $smarty->assign(array('wysiwyg' => true,
                            'link_filename_popup_file_manager_link_selection' => str_replace('&amp;', '&', xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=link_entrence&goto=' . DIR_FS_DOCUMENT_ROOT . 'contents')),
                            'link_filename_popup_file_manager_image' => str_replace('&amp;', '&', xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=no_link_entrence&goto=' . DIR_FS_DOCUMENT_ROOT . 'contents/image')),
                            'link_filename_popup_file_manager_flash' => str_replace('&amp;', '&', xos_href_link(FILENAME_POPUP_FILE_MANAGER, 'action=no_link_entrence&goto=' . DIR_FS_DOCUMENT_ROOT . 'contents/flash')),
                            'category_config' => DIR_WS_ADMIN . 'includes/ckconfig/' .ADMIN_TPL . '/category_config.js',
                            'lang_code' => xos_get_languages_code()));
    }

    $languages = xos_get_languages();
    $contents_data_array = array(); 
          
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
    
      $category_data_query = xos_db_query("select categories_or_pages_name, categories_or_pages_heading_title, categories_or_pages_content from " . TABLE_CATEGORIES_OR_PAGES_DATA . " where categories_or_pages_id = '" . (int)$cInfo->categories_or_pages_id . "' and language_id = '" . (int)$languages[$i]['id'] . "'");    
      $category_data = xos_db_fetch_array($category_data_query);

      $categories_data_array[]=array('languages_image' => xos_image(DIR_WS_CATALOG_IMAGES . 'catalog/templates/' . DEFAULT_TPL . '/' . $languages[$i]['directory'] . '/' . $languages[$i]['image'], $languages[$i]['name']),
                                     'input_name' => xos_draw_input_field('categories_or_pages_name[' . $languages[$i]['id'] . ']', (isset($cInfo->categories_or_pages_name[$languages[$i]['id']]) ? stripslashes(htmlspecialchars($cInfo->categories_or_pages_name[$languages[$i]['id']])) : htmlspecialchars($category_data['categories_or_pages_name'])), 'maxlength="64" size="30"', true),
                                     'input_heading_title' => xos_draw_input_field('categories_or_pages_heading_title[' . $languages[$i]['id'] . ']', (isset($cInfo->categories_or_pages_heading_title[$languages[$i]['id']]) ? stripslashes($cInfo->categories_or_pages_heading_title[$languages[$i]['id']]) : $category_data['categories_or_pages_heading_title']), 'maxlength="255" size="80"'),
                                     'category_description' => 'categories_or_pages_content[' . $languages[$i]['id'] . ']',
                                     'category_template_file' => DIR_WS_ADMIN . 'includes/ckconfig/' .ADMIN_TPL . '/templates/' . $languages[$i]['directory'] . '/category_template.js',
                                     'category_template_lang' => $languages[$i]['directory'] . '_default',
                                     'category_textarea' => xos_draw_textarea_field('categories_or_pages_content[' . $languages[$i]['id'] . ']', '130', '25', (isset($cInfo->categories_or_pages_content[$languages[$i]['id']]) ? stripslashes($cInfo->categories_or_pages_content[$languages[$i]['id']]) : $category_data['categories_or_pages_content'])));      
    }          

    $smarty->assign(array('update' => isset($_GET['cpID']) ? true : false,
                          'form_begin' => isset($_GET['cpID']) ? xos_draw_form('update_category', FILENAME_CATEGORIES, 'action=update_category&cPath=' . $cPath . '&cpID=' . $_GET['cpID'], 'post', 'onsubmit="return confirm(\'' . JS_CONFIRM_UPDATE . '\')" enctype="multipart/form-data"') . xos_draw_hidden_field('categories_or_pages_id', $cInfo->categories_or_pages_id) : xos_draw_form('insert_category', FILENAME_CATEGORIES, 'action=insert_category&cPath=' . $cPath, 'post', 'onsubmit="return confirm(\'' . JS_CONFIRM_INSERT . '\')" enctype="multipart/form-data"'),
                          'hidden_fields' => xos_draw_hidden_field('current_category_image', (isset($cInfo->current_category_image) ? stripslashes($cInfo->current_category_image) : $cInfo->categories_image)) . xos_draw_hidden_field('category_name', $cInfo->category_name) . xos_draw_hidden_field('current_categories_or_pages_status', $cInfo->categories_or_pages_status),
                          'categories_data' => $categories_data_array,
                          'category_image' => (xos_not_null($cInfo->current_category_image) || xos_not_null($cInfo->categories_image) ? xos_image(DIR_WS_CATALOG_IMAGES .'categories/medium/' . (isset($cInfo->current_category_image) ? stripslashes($cInfo->current_category_image) : $cInfo->categories_image), $cInfo->category_name) : ''),
                          'selection_delete_image' => xos_draw_selection_field('delete_category_image', 'checkbox', 'true'),
                          'image_file_name' => (isset($cInfo->current_category_image) ? stripslashes($cInfo->current_category_image) : $cInfo->categories_image),
                          'input_upload_image' => xos_draw_file_field('categories_image'),                          
                          'radio_product_list_b_0' => xos_draw_radio_field('product_list_b', '0', $cInfo->product_list_b == 1 ? false : true),   
                          'radio_product_list_b_1' => xos_draw_radio_field('product_list_b', '1', $cInfo->product_list_b == 1 ? true : false),                         
                          'radio_status_0' => xos_draw_radio_field('categories_or_pages_status', '0', $cInfo->categories_or_pages_status == 1 ? false : true),   
                          'radio_status_1' => xos_draw_radio_field('categories_or_pages_status', '1', $cInfo->categories_or_pages_status == 1 ? true : false),                          
                          'input_sort_order' => xos_draw_input_field('sort_order', $cInfo->sort_order, 'maxlength="5" size="3"'),                                                  
                          'text_new_category' => sprintf(TEXT_NEW_CATEGORY_3, (!isset($_GET['cpID']) ? TEXT_NEW_CATEGORY_1 : TEXT_NEW_CATEGORY_2), xos_output_generated_category_path($current_category_id)),                                                    
                          'link_filename_categories' => xos_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . (isset($_GET['cpID']) ? '&cpID=' . (int)$_GET['cpID'] : '')),                          
                          'form_end' => '</form>'));
        
    $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'categories');
    $output_new_category = $smarty->fetch(ADMIN_TPL . '/includes/modules/new_category.tpl');
endif;
?>
