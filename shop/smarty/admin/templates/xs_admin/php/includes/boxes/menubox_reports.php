<?php
  $menu_box_contents = array();
  if ($_SESSION['selected_box'] == 'reports' || EXPAND_MENUBOX_REPORTS == 'true') {
    if (xos_admin_check_files(FILENAME_STATS_PRODUCTS_VIEWED)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_STATS_PRODUCTS_VIEWED, 'selected_box=reports'), 'selected' => $_SESSION['selected_box'] == 'reports' && FILENAME_STATS_PRODUCTS_VIEWED == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_REPORTS_PRODUCTS_VIEWED);
    if (xos_admin_check_files(FILENAME_STATS_PRODUCTS_PURCHASED)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_STATS_PRODUCTS_PURCHASED, 'selected_box=reports'), 'selected' => $_SESSION['selected_box'] == 'reports' && FILENAME_STATS_PRODUCTS_PURCHASED == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_REPORTS_PRODUCTS_PURCHASED);
    if (xos_admin_check_files(FILENAME_STATS_CUSTOMERS)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_STATS_CUSTOMERS, 'selected_box=reports'), 'selected' => $_SESSION['selected_box'] == 'reports' && FILENAME_STATS_CUSTOMERS == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_REPORTS_ORDERS_TOTAL);
// naechste zeile einkommentieren wenn gutscheine fertig
//    if (xos_admin_check_files(FILENAME_STATS_CREDITS)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_STATS_CREDITS, 'selected_box=reports'), 'selected' => $_SESSION['selected_box'] == 'reports' && FILENAME_STATS_CREDITS == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_REPORTS_CREDITS);
    
    $smarty->assign('menu_box_contents', $menu_box_contents);                                
  }

  $smarty->assign(array('menu_box_heading_link' => xos_href_link(FILENAME_STATS_PRODUCTS_VIEWED, 'selected_box=reports'),
                        'menu_box_selected' => $_SESSION['selected_box'] == 'reports' ? true : false,  
                        'menu_box_heading_name' => BOX_HEADING_REPORTS));
                         
  $output_menubox_reports = $smarty->fetch(ADMIN_TPL . '/includes/boxes/menubox_reports.tpl');
  $smarty->clearAssign(array('menu_box_contents',
                             'menu_box_heading_link',
                             'menu_box_selected',                               
                             'menu_box_heading_name'));
                                                    
  $smarty->assign('menubox_reports', $output_menubox_reports);
  return 'overwrite_all';
?>