<?php
  $menu_box_contents = array();
  if ($_SESSION['selected_box'] == 'gv_admin' || EXPAND_MENUBOX_GV_ADMIN == 'true') {
    if (xos_admin_check_files(FILENAME_COUPON_ADMIN)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_COUPON_ADMIN, 'selected_box=gv_admin'), 'selected' => $_SESSION['selected_box'] == 'gv_admin' && FILENAME_COUPON_ADMIN == $_SERVER['BASENAME_PHP_SELF'] ? true : false, 'name' => BOX_COUPON_ADMIN);
    if (xos_admin_check_files(FILENAME_GV_QUEUE)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_GV_QUEUE, 'selected_box=gv_admin'), 'selected' => $_SESSION['selected_box'] == 'gv_admin' && FILENAME_GV_QUEUE == $_SERVER['BASENAME_PHP_SELF'] ? true : false, 'name' => BOX_GV_ADMIN_QUEUE);
    if (SEND_EMAILS == 'true' && xos_admin_check_files(FILENAME_GV_MAIL)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_GV_MAIL, 'selected_box=gv_admin'), 'selected' => $_SESSION['selected_box'] == 'gv_admin' && FILENAME_GV_MAIL == $_SERVER['BASENAME_PHP_SELF'] ? true : false, 'name' => BOX_GV_ADMIN_MAIL);
    if (xos_admin_check_files(FILENAME_GV_SENT)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_GV_SENT, 'selected_box=gv_admin'), 'selected' => $_SESSION['selected_box'] == 'gv_admin' && FILENAME_GV_SENT == $_SERVER['BASENAME_PHP_SELF'] ? true : false, 'name' => BOX_GV_ADMIN_SENT);
    
    $smarty->assign('menu_box_contents', $menu_box_contents);                                   		
  }
  
  $smarty->assign(array('menu_box_heading_link' => xos_href_link(FILENAME_COUPON_ADMIN, 'selected_box=gv_admin'),
                        'menu_box_selected' => $_SESSION['selected_box'] == 'gv_admin' ? true : false,  
                        'menu_box_heading_name' => BOX_HEADING_GV_ADMIN));
                          
  $output_menubox_gv_admin = $smarty->fetch(ADMIN_TPL . '/includes/boxes/menubox_gv_admin.tpl');
  $smarty->clearAssign(array('menu_box_contents',
                             'menu_box_heading_link',
                             'menu_box_selected',                               
                             'menu_box_heading_name'));
                                                    
  $smarty->assign('menubox_gv_admin', $output_menubox_gv_admin);  
  return 'overwrite_all';
?>