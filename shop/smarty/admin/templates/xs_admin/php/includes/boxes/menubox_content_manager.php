<?php
  $menu_box_contents = array();
  if ($_SESSION['selected_box'] == 'content_manager' || EXPAND_MENUBOX_CONTENT_MANAGER == 'true') {
    if (xos_admin_check_files(FILENAME_PAGES)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_PAGES, 'selected_box=content_manager'), 'selected' => $_SESSION['selected_box'] == 'content_manager' && FILENAME_PAGES == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_CONTENT_MANAGER_PAGES);
    if (xos_admin_check_files(FILENAME_INFO_PAGES)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_INFO_PAGES, 'selected_box=content_manager'), 'selected' => $_SESSION['selected_box'] == 'content_manager' && FILENAME_INFO_PAGES == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_CONTENT_MANAGER_INFO_PAGES);
    
    $smarty->assign('menu_box_contents', $menu_box_contents);                                                                             
  }

  $smarty->assign(array('menu_box_heading_link' => xos_href_link(FILENAME_PAGES, 'selected_box=content_manager'),
                        'menu_box_selected' => $_SESSION['selected_box'] == 'content_manager' ? true : false,  
                        'menu_box_heading_name' => BOX_HEADING_CONTENT_MANAGER));
                         
  $output_menubox_content_manager = $smarty->fetch(ADMIN_TPL . '/includes/boxes/menubox_content_manager.tpl');
  $smarty->clearAssign(array('menu_box_contents',
                             'menu_box_heading_link',
                             'menu_box_selected',                                
                             'menu_box_heading_name'));
                                                    
  $smarty->assign('menubox_content_manager', $output_menubox_content_manager);
  return 'overwrite_all';
?>