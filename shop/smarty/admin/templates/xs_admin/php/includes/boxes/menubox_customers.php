<?php
  $menu_box_contents = array();
  if ($_SESSION['selected_box'] == 'customers' || EXPAND_MENUBOX_CUSTOMERS == 'true') {
    if (xos_admin_check_files(FILENAME_CUSTOMERS)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_CUSTOMERS, 'selected_box=customers'), 'selected' => $_SESSION['selected_box'] == 'customers' && FILENAME_CUSTOMERS == $_SERVER['BASENAME_PHP_SELF'] ? true : false, 'name' => BOX_CUSTOMERS_CUSTOMERS);
    if (xos_admin_check_files(FILENAME_ORDERS)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_ORDERS, 'selected_box=customers'), 'selected' => $_SESSION['selected_box'] == 'customers' && FILENAME_ORDERS == $_SERVER['BASENAME_PHP_SELF'] ? true : false, 'name' => BOX_CUSTOMERS_ORDERS);
    if (xos_admin_check_files(FILENAME_CUSTOMERS_GROUPS)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_CUSTOMERS_GROUPS, 'selected_box=customers'), 'selected' => $_SESSION['selected_box'] == 'customers' && FILENAME_CUSTOMERS_GROUPS == $_SERVER['BASENAME_PHP_SELF'] ? true : false, 'name' => BOX_CUSTOMERS_GROUPS);
    
    $smarty->assign('menu_box_contents', $menu_box_contents);                                   		
  }
  
  $smarty->assign(array('menu_box_heading_link' => xos_href_link(FILENAME_CUSTOMERS, 'selected_box=customers'),
                        'menu_box_selected' => $_SESSION['selected_box'] == 'customers' ? true : false,
                        'menu_box_heading_name' => BOX_HEADING_CUSTOMERS));
                          
  $output_menubox_customers = $smarty->fetch(ADMIN_TPL . '/includes/boxes/menubox_customers.tpl');
  $smarty->clearAssign(array('menu_box_contents',
                             'menu_box_heading_link',
                             'menu_box_selected',                               
                             'menu_box_heading_name'));
                                                    
  $smarty->assign('menubox_customers', $output_menubox_customers);  
  return 'overwrite_all';
?>