<?php
  if ($messageStack->size('header') > 0) {
    $smarty->assign('message_stack_output', $messageStack->output('header'));
  }
  
  $smarty->assign(array('link_filename_default' => xos_href_link(FILENAME_DEFAULT),
                        'link_filename_admin_account' => xos_href_link(FILENAME_ADMIN_ACCOUNT, 'selected_box=0'),
                        'link_catalog' => xos_catalog_href_link(),
                        'link_filename_logoff' => xos_href_link(FILENAME_LOGOFF)));
 
  $output_header = $smarty->fetch(ADMIN_TPL . '/includes/header.tpl');
  $smarty->clearAssign(array('message_stack_output',
                              'link_filename_default',
                              'link_filename_admin_account',
                              'link_catalog',
                              'link_filename_logoff'));  

  $smarty->assign('header', $output_header);
  return 'overwrite_all';
?>