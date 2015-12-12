<?php
  $menu_box_contents = array();
  if ($_SESSION['selected_box'] == 'taxes' || EXPAND_MENUBOX_TAXES == 'true') {
    if (xos_admin_check_files(FILENAME_COUNTRIES)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_COUNTRIES, 'selected_box=taxes'), 'selected' => $_SESSION['selected_box'] == 'taxes' && FILENAME_COUNTRIES == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_TAXES_COUNTRIES);
    if (xos_admin_check_files(FILENAME_ZONES)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_ZONES, 'selected_box=taxes'), 'selected' => $_SESSION['selected_box'] == 'taxes' && FILENAME_ZONES == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_TAXES_ZONES);                                   
    if (xos_admin_check_files(FILENAME_GEO_ZONES)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_GEO_ZONES, 'selected_box=taxes'), 'selected' => $_SESSION['selected_box'] == 'taxes' && FILENAME_GEO_ZONES == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_TAXES_GEO_ZONES);
    if (xos_admin_check_files(FILENAME_TAX_CLASSES)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_TAX_CLASSES, 'selected_box=taxes'), 'selected' => $_SESSION['selected_box'] == 'taxes' && FILENAME_TAX_CLASSES == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_TAXES_TAX_CLASSES);
    if (xos_admin_check_files(FILENAME_TAX_RATES)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_TAX_RATES, 'selected_box=taxes'), 'selected' => $_SESSION['selected_box'] == 'taxes' && FILENAME_TAX_RATES == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_TAXES_TAX_RATES);
    
    $smarty->assign('menu_box_contents', $menu_box_contents);                                                                    
  }

  $smarty->assign(array('menu_box_heading_link' => xos_href_link(FILENAME_COUNTRIES, 'selected_box=taxes'),
                        'menu_box_selected' => $_SESSION['selected_box'] == 'taxes' ? true : false,  
                        'menu_box_heading_name' => BOX_HEADING_LOCATION_AND_TAXES));
                          
  $output_menubox_taxes = $smarty->fetch(ADMIN_TPL . '/includes/boxes/menubox_taxes.tpl');
  $smarty->clearAssign(array('menu_box_contents',
                             'menu_box_heading_link',
                             'menu_box_selected',                               
                             'menu_box_heading_name'));
                                                    
  $smarty->assign('menubox_taxes', $output_menubox_taxes);
  return 'overwrite_all';
?>