<?php
  $menu_box_contents = array();
  if ($_SESSION['selected_box'] == 'modules' || EXPAND_MENUBOX_MODULES == 'true') {
   
    foreach ($cfgModules->getAll() as $m) {
      $menu_box_contents[] = array('link' => xos_href_link(FILENAME_MODULES, 'set=' . $m['code'] . '&selected_box=modules'), 'selected' => ($_SESSION['selected_box'] == 'modules' && FILENAME_MODULES == $_SERVER['BASENAME_PHP_SELF'] && $_GET['set'] == $m['code']) ? true : false, 'name' => $m['box_name']);    
    }  
    
    $smarty->assign('menu_box_contents', $menu_box_contents);                                   
  }

  $smarty->assign(array('menu_box_heading_link' => xos_href_link(FILENAME_MODULES, 'set=action_recorder&selected_box=modules'),
                        'menu_box_selected' => $_SESSION['selected_box'] == 'modules' ? true : false,  
                        'menu_box_heading_name' => BOX_HEADING_MODULES));
                          
  $output_menubox_modules = $smarty->fetch(ADMIN_TPL . '/includes/boxes/menubox_modules.tpl');
  $smarty->clearAssign(array('menu_box_contents',
                             'menu_box_heading_link',
                             'menu_box_selected',                               
                             'menu_box_heading_name'));
                                                    
  $smarty->assign('menubox_modules', $output_menubox_modules);
  return 'overwrite_all';
?>