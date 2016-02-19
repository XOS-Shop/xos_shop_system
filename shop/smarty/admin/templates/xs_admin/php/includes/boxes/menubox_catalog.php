<?php
  $menu_box_contents = array();
  if ($_SESSION['selected_box'] == 'catalog' || EXPAND_MENUBOX_CATALOG == 'true') {
    if (xos_admin_check_files(FILENAME_CATEGORIES)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_CATEGORIES, 'selected_box=catalog'), 'selected' => $_SESSION['selected_box'] == 'catalog' && FILENAME_CATEGORIES == $_SERVER['BASENAME_PHP_SELF'] ? true : false, 'name' => BOX_CATALOG_CATEGORIES_PRODUCTS);
    if (xos_admin_check_files(FILENAME_PRODUCTS_ATTRIBUTES)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'selected_box=catalog&first_entrance=1'), 'selected' => $_SESSION['selected_box'] == 'catalog' && FILENAME_PRODUCTS_ATTRIBUTES == $_SERVER['BASENAME_PHP_SELF'] ? true : false, 'name' => BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES);
    if (xos_admin_check_files(FILENAME_MANUFACTURERS)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_MANUFACTURERS, 'selected_box=catalog'), 'selected' => $_SESSION['selected_box'] == 'catalog' && FILENAME_MANUFACTURERS == $_SERVER['BASENAME_PHP_SELF'] ? true : false, 'name' => BOX_CATALOG_MANUFACTURERS);
    if (xos_admin_check_files(FILENAME_DELIVERY_TIMES)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_DELIVERY_TIMES, 'selected_box=catalog'), 'selected' => $_SESSION['selected_box'] == 'catalog' && FILENAME_DELIVERY_TIMES == $_SERVER['BASENAME_PHP_SELF'] ? true : false, 'name' => BOX_CATALOG_DELIVERY_TIMES);
    if (xos_admin_check_files(FILENAME_REVIEWS)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_REVIEWS, 'selected_box=catalog'), 'selected' => $_SESSION['selected_box'] == 'catalog' && FILENAME_REVIEWS == $_SERVER['BASENAME_PHP_SELF'] ? true : false, 'name' => BOX_CATALOG_REVIEWS);  
    if (xos_admin_check_files(FILENAME_UPDATE_PRODUCTS_PRICES)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_UPDATE_PRODUCTS_PRICES, 'selected_box=catalog&first_entrance=1'), 'selected' => $_SESSION['selected_box'] == 'catalog' && FILENAME_UPDATE_PRODUCTS_PRICES == $_SERVER['BASENAME_PHP_SELF'] ? true : false, 'name' => BOX_CATALOG_UPDATE_PRODUCTS_PRICES);   
    if (xos_admin_check_files(FILENAME_XSELL_PRODUCTS)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_XSELL_PRODUCTS, 'selected_box=catalog&first_entrance=1'), 'selected' => $_SESSION['selected_box'] == 'catalog' && FILENAME_XSELL_PRODUCTS == $_SERVER['BASENAME_PHP_SELF'] ? true : false, 'name' => BOX_CATALOG_XSELL_PRODUCTS);
    if (xos_admin_check_files(FILENAME_PRODUCTS_EXPECTED)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_PRODUCTS_EXPECTED, 'selected_box=catalog'), 'selected' => $_SESSION['selected_box'] == 'catalog' && FILENAME_PRODUCTS_EXPECTED == $_SERVER['BASENAME_PHP_SELF'] ? true : false, 'name' => BOX_CATALOG_PRODUCTS_EXPECTED);
    
    $smarty->assign('menu_box_contents', $menu_box_contents);                                                                             
  }

  $smarty->assign(array('menu_box_heading_link' => xos_href_link(FILENAME_CATEGORIES, 'selected_box=catalog'),
                        'menu_box_selected' => $_SESSION['selected_box'] == 'catalog' ? true : false,  
                        'menu_box_heading_name' => BOX_HEADING_CATALOG));
                         
  $output_menubox_catalog = $smarty->fetch(ADMIN_TPL . '/includes/boxes/menubox_catalog.tpl');
  $smarty->clearAssign(array('menu_box_contents',
                             'menu_box_heading_link',
                             'menu_box_selected',                                
                             'menu_box_heading_name'));
                                                    
  $smarty->assign('menubox_catalog', $output_menubox_catalog);
  return 'overwrite_all';
?>