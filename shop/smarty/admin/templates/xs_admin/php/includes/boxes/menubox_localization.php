<?php
  $menu_box_contents = array();
  if ($_SESSION['selected_box'] == 'localization' || EXPAND_MENUBOX_LOCALIZATION == 'true') {                                   
    if (xos_admin_check_files(FILENAME_CURRENCIES)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_CURRENCIES, 'selected_box=localization'), 'selected' => $_SESSION['selected_box'] == 'localization' && FILENAME_CURRENCIES == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_LOCALIZATION_CURRENCIES);
    if (xos_admin_check_files(FILENAME_LANGUAGES)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_LANGUAGES, 'selected_box=localization'), 'selected' => $_SESSION['selected_box'] == 'localization' && FILENAME_LANGUAGES == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_LOCALIZATION_LANGUAGES);
    if (xos_admin_check_files(FILENAME_ORDERS_STATUS)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_ORDERS_STATUS, 'selected_box=localization'), 'selected' => $_SESSION['selected_box'] == 'localization' && FILENAME_ORDERS_STATUS == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_LOCALIZATION_ORDERS_STATUS);
    
    $smarty->assign('menu_box_contents', $menu_box_contents);                                                                    
  }

  $smarty->assign(array('menu_box_heading_link' => xos_href_link(FILENAME_CURRENCIES, 'selected_box=localization'),
                        'menu_box_selected' => $_SESSION['selected_box'] == 'localization' ? true : false,  
                        'menu_box_heading_name' => BOX_HEADING_LOCALIZATION));
                          
  $output_menubox_localization = $smarty->fetch(ADMIN_TPL . '/includes/boxes/menubox_localization.tpl');
  $smarty->clearAssign(array('menu_box_contents',
                             'menu_box_heading_link',
                             'menu_box_selected',                               
                             'menu_box_heading_name'));
                                                    
  $smarty->assign('menubox_localization', $output_menubox_localization);
  return 'overwrite_all';
?>