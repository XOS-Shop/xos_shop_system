<?php
  if ($messageStack->size('header') > 0) {    
    $smarty->assign('message_stack_header', $messageStack->output('header'));
    $smarty->assign('message_stack_header_error', $messageStack->output('header', 'error'));
    $smarty->assign('message_stack_header_warning', $messageStack->output('header', 'warning')); 
    $smarty->assign('message_stack_header_success', $messageStack->output('header', 'success'));    
  }
  
  $account_info_query = xos_db_query ("select a.admin_firstname, a.admin_lastname, a.admin_created, g.admin_groups_name from " . TABLE_ADMIN . " a, " . TABLE_ADMIN_GROUPS . " g where a.admin_id = " . $_SESSION['login_id'] . " and g.admin_groups_id = a.admin_groups_id");
  $account_info = xos_db_fetch_array($account_info_query);  
  
  $smarty->assign(array('admin_firstname' => $account_info['admin_firstname'],
                        'admin_lastname' => $account_info['admin_lastname'],
                        'admin_groups_name' => $account_info['admin_groups_name'],
                        'admin_created' => $account_info['admin_created'],
                        'link_filename_default' => xos_href_link(FILENAME_DEFAULT),
                        'link_filename_admin_account' => xos_href_link(FILENAME_ADMIN_ACCOUNT, 'selected_box=0'),
                        'link_catalog' => xos_catalog_href_link(),
                        'link_filename_logoff' => xos_href_link(FILENAME_LOGOFF)));
 
  $output_header = $smarty->fetch(ADMIN_TPL . '/includes/header.tpl');
  $smarty->clearAssign(array('admin_firstname',
                             'admin_lastname',
                             'admin_groups_name',
                             'admin_created',  
                             'link_filename_default',
                             'link_filename_admin_account',
                             'link_catalog',
                             'link_filename_logoff'));  

  $smarty->assign('header', $output_header);
  return 'overwrite_all';
?>