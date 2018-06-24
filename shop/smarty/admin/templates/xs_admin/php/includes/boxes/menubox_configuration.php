<?php
  $menu_box_contents = array();  
  if ($_SESSION['selected_box'] == 'configuration' || EXPAND_MENUBOX_CONFIGURATION == 'true') {    
    for ($i=1;$i<=17;$i++) {
      if ($i != 6) {
        $menu_box_contents[] = array('link' => xos_href_link(FILENAME_CONFIGURATION, 'gID=' . $i . '&selected_box=configuration'),
                                     'selected' => $_SESSION['selected_box'] == 'configuration' && $i == $_GET['gID'] ? true : false,
                                     'name' => constant('BOX_CONFIGURATION_' . $i));
      }                                    
    }
    
    $smarty->assign('menu_box_contents', $menu_box_contents);
  }

  $smarty->assign(array('menu_box_heading_link' => xos_href_link(FILENAME_CONFIGURATION, 'gID=1&selected_box=configuration'),
                        'menu_box_selected' => $_SESSION['selected_box'] == 'configuration' ? true : false,
                        'menu_box_heading_name' => BOX_HEADING_CONFIGURATION));
                        
  $output_menubox_configuration = $smarty->fetch(ADMIN_TPL . '/includes/boxes/menubox_configuration.tpl');
  $smarty->clearAssign(array('menu_box_contents',
                             'menu_box_heading_link',
                             'menu_box_selected', 
                             'menu_box_heading_name'));
                        
  $smarty->assign('menubox_configuration', $output_menubox_configuration);
  return 'overwrite_all';
?>