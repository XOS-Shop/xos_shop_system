<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : infobox_coupon_admin.php
// author     : Hanspeter Zeller <hpz@xos-shop.com>
// copyright  : Copyright (c) 2010 Hanspeter Zeller
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
//              filename: coupon_admin.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/includes/boxes/infobox_coupon_admin.php') == 'overwrite_all')) :
  $contents = array();
  switch ($action) {
    case 'voucherreport':
        
      $coupon_description_query = xos_db_query("select coupon_name from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . (int)$coupon_id . "' and language_id = '" . $_SESSION['languages_id'] . "'");
      $coupon_desc = xos_db_fetch_array($coupon_description_query);
      $count_customers = xos_db_query("select * from " . TABLE_COUPON_REDEEM_TRACK . " where coupon_id = '" . (int)$coupon_id . "' and customer_id = '" . $cInfo->customer_id . "'");
       
      $heading_title = '<b>[' . $_GET['cid'] . ']' . COUPON_NAME . ' ' . $coupon_desc['coupon_name'] . '</b>';
      $contents[] = array('text' => '<b>' . TEXT_REDEMPTIONS . '</b>');
      $contents[] = array('text' => TEXT_REDEMPTIONS_TOTAL . '&nbsp;:&nbsp;' . xos_db_num_rows($cc_query));
      $contents[] = array('text' => TEXT_REDEMPTIONS_CUSTOMER . '&nbsp;:&nbsp;' . xos_db_num_rows($count_customers));
      $contents[] = array('text' => '');    
          
      break;
    default:
//      if (isset($cInfo) && is_object($cInfo)) {
      
        $heading_title = '['.$cInfo->coupon_id.']  '.$cInfo->coupon_code;
        $amount = $cInfo->coupon_amount;
        if ($cInfo->coupon_type == 'P') {
          // not floating point value, don't display decimal info
          $amount = (($amount == round($amount)) ? number_format($amount) : number_format($amount, 2)) . '%';
        } else {
          $amount = $currencies->format($amount);
        }
        $coupon_min_order = $currencies->format($cInfo->coupon_minimum_order);
        if ($action == 'voucherdelete') {
          $contents[] = array('text'=> TEXT_CONFIRM_DELETE);
          $contents[] = array('text' => '<br /><a href="'.xos_href_link(FILENAME_COUPON_ADMIN,'action=confirmdelete&status=' . $status . (($_GET['page'] > 1) ? '&page=' . $_GET['page']: '') . '&cid='.$_GET['cid']).'" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="'.xos_href_link(FILENAME_COUPON_ADMIN,'cid='.$cInfo->coupon_id).'" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');        
        } else {
          $prod_details = NONE;
          if ($cInfo->restrict_to_products) {
            $prod_details = '<a href="listproducts.php?cid=' . $cInfo->coupon_id . '" target="_blank" onclick="window.open(\'listproducts.php?cid=' . $cInfo->coupon_id . '\', \'Valid_Categories\', \'scrollbars=yes,resizable=yes,menubar=yes,width=600,height=600\'); return false">View</A>';
          }
          $cat_details = NONE;
          if ($cInfo->restrict_to_categories) {
            $cat_details = '<a href="listcategories.php?cid=' . $cInfo->coupon_id . '" target="_blank" onclick="window.open(\'listcategories.php?cid=' . $cInfo->coupon_id . '\', \'Valid_Categories\', \'scrollbars=yes,resizable=yes,menubar=yes,width=600,height=600\'); return false">View</A>';
          }
          $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_COUPON_ADMIN, 'action=voucheredit&cid=' . $cInfo->coupon_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a><a href="' . xos_href_link(FILENAME_COUPON_ADMIN, 'action=voucherdelete&status=' . $status . (($_GET['page'] > 1) ? '&page=' . $_GET['page']: '') . '&cid=' . $cInfo->coupon_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_COUPON_ADMIN, 'action=voucherreport&cid=' . $cInfo->coupon_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_REPORT . ' "><span>' . BUTTON_TEXT_REPORT . '</span></a><a href="' . xos_href_link(FILENAME_COUPON_ADMIN, 'action=email&cid=' . $cInfo->coupon_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EMAIL . ' "><span>' . BUTTON_TEXT_EMAIL . '</span></a>');         

          $coupon_name_query = xos_db_query("select coupon_name from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $cInfo->coupon_id . "' and language_id = '" . $_SESSION['languages_id'] . "'");
          $coupon_name = xos_db_fetch_array($coupon_name_query);

          $contents[] = array('text' => '<br />' . COUPON_NAME . '&nbsp;:&nbsp;' . $coupon_name['coupon_name']);
          $contents[] = array('text' => COUPON_AMOUNT . '&nbsp;:&nbsp;' . $amount);
          $contents[] = array('text' => REDEEM_DATE_LAST . '&nbsp;:&nbsp;' . ((isset($rInfo->redeem_date)) ? xos_date_short($rInfo->redeem_date) : ''));
          $contents[] = array('text' => COUPON_MIN_ORDER . '&nbsp;:&nbsp;' . $coupon_min_order);
          $contents[] = array('text' => COUPON_STARTDATE . '&nbsp;:&nbsp;' . xos_date_short($cInfo->coupon_start_date));
          $contents[] = array('text' => COUPON_FINISHDATE . '&nbsp;:&nbsp;' . xos_date_short($cInfo->coupon_expire_date));
          $contents[] = array('text' => COUPON_USES_COUPON . '&nbsp;:&nbsp;' . $cInfo->uses_per_coupon);
          $contents[] = array('text' => COUPON_USES_USER . '&nbsp;:&nbsp;' . $cInfo->uses_per_user);
          $contents[] = array('text' => COUPON_PRODUCTS . '&nbsp;:&nbsp;' . $prod_details);
          $contents[] = array('text' => COUPON_CATEGORIES . '&nbsp;:&nbsp;' . $cat_details);
          $contents[] = array('text' => DATE_CREATED . '&nbsp;:&nbsp;' . xos_date_short($cInfo->date_created));
          $contents[] = array('text' => DATE_MODIFIED . '&nbsp;:&nbsp;' . xos_date_short($cInfo->date_modified) . '<br />&nbsp;<br />');           
        }        
//      }
      break;
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_contents' => $contents));
                            
  $output_infobox_coupon_admin = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_coupon_admin.tpl');
  $smarty->clearAssign(array('info_box_heading_title', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_coupon_admin', $output_infobox_coupon_admin);
endif;
?>
