<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : banner_statistics.php
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
//              filename: banner_statistics.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_BANNER_STATISTICS) == 'overwrite_all')) :
  $type = (isset($_GET['type']) ? $_GET['type'] : '');

  $banner_extension = xos_banner_image_extension();

// check if the graphs directory exists
  $dir_ok = false;
  if (function_exists('imagecreate') && xos_not_null($banner_extension)) {
    if (is_dir(DIR_WS_IMAGES . 'graphs')) {
      if (is_writable(DIR_WS_IMAGES . 'graphs')) {
        $dir_ok = true;
      } else {
        $messageStack->add('header', ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE, 'error');
      }
    } else {
      $messageStack->add('header', ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST, 'error');
    }
  }

  $banner_query = xos_db_query("select banners_title from " . TABLE_BANNERS_CONTENT . " where banners_id = '" . (int)$_GET['bID'] . "' and language_id = '" . (int)$_SESSION['used_lng_id'] . "'");
  $banner = xos_db_fetch_array($banner_query);

  $years_array = array();
  $years_query = xos_db_query("select distinct year(banners_history_date) as banner_year from " . TABLE_BANNERS_HISTORY . " where banners_id = '" . (int)$_GET['bID'] . "'");
  while ($years = xos_db_fetch_array($years_query)) {
    $years_array[] = array('id' => $years['banner_year'],
                           'text' => $years['banner_year']);
  }

  $months_array = array();
  for ($i=1; $i<13; $i++) {
    $months_array[] = array('id' => $i,
                            'text' => xos_date_format('%B', mktime(0,0,0,$i)));
  }

  $type_array = array(array('id' => 'daily',
                            'text' => STATISTICS_TYPE_DAILY),
                      array('id' => 'monthly',
                            'text' => STATISTICS_TYPE_MONTHLY),
                      array('id' => 'yearly',
                            'text' => STATISTICS_TYPE_YEARLY));
                            
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');                            

  $smarty->assign(array('link_filename_banner_manager' => xos_href_link(FILENAME_BANNER_MANAGER, 'page=' . $_GET['page'] . '&bID=' . $_GET['bID']),
                        'form_begin' => xos_draw_form('year', FILENAME_BANNER_STATISTICS, '', 'get'),
                        'pull_down_type' => xos_draw_pull_down_menu('type', $type_array, (xos_not_null($type) ? $type : 'daily'), 'onchange="this.form.submit();"'),
                        'pull_down_year' => xos_draw_pull_down_menu('year', $years_array, (isset($_GET['year']) ? $_GET['year'] : date('Y')), 'onchange="this.form.submit();"'),
                        'pull_down_month' => xos_draw_pull_down_menu('month', $months_array, (isset($_GET['month']) ? $_GET['month'] : date('n')), 'onchange="this.form.submit();"'),
                        'hidden_field_page' => xos_draw_hidden_field('page', $_GET['page']),
                        'hidden_field_bid' => xos_draw_hidden_field('bID', $_GET['bID'])));
  
  if (SID) {
    $smarty->assign('hidden_field_session', xos_draw_hidden_field(xos_session_name(), xos_session_id()));
  }  
    
  $smarty->assign('form_end', '</form>');
  
  switch ($type) {
    case 'yearly': break;
    case 'monthly':
      $smarty->assign('case_monthly', true);
      break;
    default:
    case 'daily':
      $smarty->assign('case_daily', true);
      break;
  }

  if (function_exists('imagecreate') && ($dir_ok == true) && xos_not_null($banner_extension)) { 
    $smarty->assign('function_exists_imagecreate', true);
    $banner_id = (int)$_GET['bID'];

    switch ($type) {
      case 'yearly':
        include(DIR_WS_INCLUDES . 'graphs/banner_yearly.php');
        $smarty->assign('banner_graph', xos_image(DIR_WS_IMAGES . 'graphs/banner_yearly-' . $banner_id . '.' . $banner_extension));
        break;
      case 'monthly':
        include(DIR_WS_INCLUDES . 'graphs/banner_monthly.php');
        $javascript = "\n" . '<script type="text/javascript">' . "\n" .
                      '/* <![CDATA[ */' . "\n" .               
                      '  document.images.banner_monthly.src="' . DIR_WS_IMAGES . 'graphs/banner_monthly-' . $banner_id . '.' . $banner_extension . '?" + new Date().getTime();' . "\n" .                   
                      '/* ]]> */' . "\n" .
                      '</script>' . "\n";
        $smarty->assign(array('banner_graph' => xos_image(DIR_WS_IMAGES . 'graphs/banner_monthly-' . $banner_id . '.' . $banner_extension, '', '', '', 'name="banner_monthly"'),
                              'javascript' => $javascript));         
        break;
      default:
      case 'daily':
        include(DIR_WS_INCLUDES . 'graphs/banner_daily.php');
        $javascript = "\n" . '<script type="text/javascript">' . "\n" .
                      '/* <![CDATA[ */' . "\n" .               
                      '  document.images.banner_daily.src="' . DIR_WS_IMAGES . 'graphs/banner_daily-' . $banner_id . '.' . $banner_extension . '?" + new Date().getTime();' . "\n" .                   
                      '/* ]]> */' . "\n" .
                      '</script>' . "\n";
        $smarty->assign(array('banner_graph' => xos_image(DIR_WS_IMAGES . 'graphs/banner_daily-' . $banner_id . '.' . $banner_extension, '', '', '', 'name="banner_daily"'),
                              'javascript' => $javascript)); 
        break;
    }

    $stat_values_array = array();
    for ($i=0, $n=sizeof($stats); $i<$n; $i++) {
           
      $stat_values_array[]=array('source' => utf8_encode($stats[$i][0]),
                                 'views' => number_format($stats[$i][1]),
                                 'clicks' => number_format($stats[$i][2]));           
           
    }
    
    $smarty->assign('stat_values', $stat_values_array);

  } else {
    include(DIR_WS_FUNCTIONS . 'html_graphs.php');

    switch ($type) {
      case 'yearly':
        $smarty->assign('html_banner_graph', xos_banner_graph_yearly($_GET['bID']));
        break;
      case 'monthly':
        $smarty->assign('html_banner_graph', xos_banner_graph_monthly($_GET['bID']));
        break;
      default:
      case 'daily':
        $smarty->assign('html_banner_graph', xos_banner_graph_daily($_GET['bID']));
        break;
    }
  }

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'banner_statistics');
  $output_banner_statistics = $smarty->fetch(ADMIN_TPL . '/banner_statistics.tpl');
  
  $smarty->assign('central_contents', $output_banner_statistics);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
