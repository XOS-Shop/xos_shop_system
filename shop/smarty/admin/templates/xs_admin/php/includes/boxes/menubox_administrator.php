<?php
  $menu_box_contents = array();
  if ($_SESSION['selected_box'] == 'administrator' || EXPAND_MENUBOX_ADMINISTRATOR == 'true') {                              
    if (xos_admin_check_files(FILENAME_ADMIN_MEMBERS)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_ADMIN_MEMBERS, 'selected_box=administrator'), 'selected' => ($_SESSION['selected_box'] == 'administrator' && FILENAME_ADMIN_MEMBERS == $_SERVER['BASENAME_PHP_SELF'] && (!isset($_GET['gID']) && !isset($_GET['gPath']))) ? true : false, 'name' => BOX_ADMINISTRATOR_MEMBERS);
    if (xos_admin_check_files(FILENAME_ADMIN_MEMBERS)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_ADMIN_MEMBERS, 'selected_box=administrator&gID=groups'), 'selected' => ($_SESSION['selected_box'] == 'administrator' && FILENAME_ADMIN_MEMBERS == $_SERVER['BASENAME_PHP_SELF'] && (isset($_GET['gID']) || isset($_GET['gPath']))) ? true : false, 'name' => BOX_ADMINISTRATOR_GROUPS);
    
    $smarty->assign('menu_box_contents', $menu_box_contents);                                   
  }

  $smarty->assign(array('menu_box_heading_link' => xos_href_link(FILENAME_ADMIN_MEMBERS, 'selected_box=administrator'),
                        'menu_box_selected' => $_SESSION['selected_box'] == 'administrator' ? true : false,    
                        'menu_box_heading_name' => BOX_HEADING_ADMINISTRATOR));
                          
  $output_menubox_administrator = $smarty->fetch(ADMIN_TPL . '/includes/boxes/menubox_administrator.tpl');
  $smarty->clearAssign(array('menu_box_contents',
                             'menu_box_heading_link',
                             'menu_box_selected',                               
                             'menu_box_heading_name'));
                                                    
  $smarty->assign('menubox_administrator', $output_menubox_administrator);
  return 'overwrite_all';
?>