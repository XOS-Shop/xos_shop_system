<?php
  $menu_box_contents = array();
  if ($_SESSION['selected_box'] == 'tools' || EXPAND_MENUBOX_TOOLS == 'true') {
    if (xos_admin_check_files(FILENAME_ACTION_RECORDER)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_ACTION_RECORDER, 'selected_box=tools'), 'selected' => $_SESSION['selected_box'] == 'tools' && FILENAME_ACTION_RECORDER == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_TOOLS_ACTION_RECORDER);
    if (xos_admin_check_files(FILENAME_BACKUP)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_BACKUP, 'selected_box=tools'), 'selected' => $_SESSION['selected_box'] == 'tools' && FILENAME_BACKUP == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_TOOLS_BACKUP);
    if (xos_admin_check_files(FILENAME_IMAGE_PROCESSING)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_IMAGE_PROCESSING, 'selected_box=tools'), 'selected' => $_SESSION['selected_box'] == 'tools' && FILENAME_IMAGE_PROCESSING == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_TOOLS_IMAGE_PROCESSING);                                   
    if (xos_admin_check_files(FILENAME_BANNER_MANAGER)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_BANNER_MANAGER, 'selected_box=tools'), 'selected' => $_SESSION['selected_box'] == 'tools' && (FILENAME_BANNER_MANAGER == basename($_SERVER['PHP_SELF']) || FILENAME_BANNER_STATISTICS == basename($_SERVER['PHP_SELF'])) ? true : false, 'name' => BOX_TOOLS_BANNER_MANAGER);
    if (xos_admin_check_files(FILENAME_CACHE)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_CACHE, 'selected_box=tools'), 'selected' => $_SESSION['selected_box'] == 'tools' && FILENAME_CACHE == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_TOOLS_SMARTY_CACHE);
    if (xos_admin_check_files(FILENAME_DEFINE_LANGUAGE)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_DEFINE_LANGUAGE, 'selected_box=tools'), 'selected' => $_SESSION['selected_box'] == 'tools' && FILENAME_DEFINE_LANGUAGE == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_TOOLS_DEFINE_LANGUAGE);                                   
    if (xos_admin_check_files(FILENAME_FILE_MANAGER)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_FILE_MANAGER, 'selected_box=tools&action=reset'), 'selected' => $_SESSION['selected_box'] == 'tools' && FILENAME_FILE_MANAGER == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_TOOLS_FILE_MANAGER);
    if (SEND_EMAILS == 'true' && xos_admin_check_files(FILENAME_MAIL)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_MAIL, 'selected_box=tools'), 'selected' => $_SESSION['selected_box'] == 'tools' && FILENAME_MAIL == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_TOOLS_MAIL);                                   
    if ((NEWSLETTER_ENABLED == 'true' || PRODUCT_NOTIFICATION_ENABLED == 'true') && xos_admin_check_files(FILENAME_NEWSLETTERS)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_NEWSLETTERS, 'selected_box=tools'), 'selected' => $_SESSION['selected_box'] == 'tools' && FILENAME_NEWSLETTERS == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_TOOLS_NEWSLETTER_MANAGER);
    if (xos_admin_check_files(FILENAME_SERVER_INFO)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_SERVER_INFO, 'selected_box=tools'), 'selected' => $_SESSION['selected_box'] == 'tools' && FILENAME_SERVER_INFO == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_TOOLS_SERVER_INFO);
    if (xos_admin_check_files(FILENAME_WHOS_ONLINE)) $menu_box_contents[] = array('link' => xos_href_link(FILENAME_WHOS_ONLINE, 'selected_box=tools'), 'selected' => $_SESSION['selected_box'] == 'tools' && FILENAME_WHOS_ONLINE == basename($_SERVER['PHP_SELF']) ? true : false, 'name' => BOX_TOOLS_WHOS_ONLINE);
    
    $smarty->assign('menu_box_contents', $menu_box_contents);                                                                     
  }

  $smarty->assign(array('menu_box_heading_link' => xos_href_link(FILENAME_ACTION_RECORDER, 'selected_box=tools'),
                        'menu_box_selected' => $_SESSION['selected_box'] == 'tools' ? true : false,  
                        'menu_box_heading_name' => BOX_HEADING_TOOLS));
                        
  $output_menubox_tools = $smarty->fetch(ADMIN_TPL . '/includes/boxes/menubox_tools.tpl');
  $smarty->clearAssign(array('menu_box_contents',
                             'menu_box_heading_link',
                             'menu_box_selected',                               
                             'menu_box_heading_name'));
                                                    
  $smarty->assign('menubox_tools', $output_menubox_tools);
  return 'overwrite_all';
?>