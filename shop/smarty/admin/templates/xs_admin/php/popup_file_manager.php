<?php
  if ($messageStack->size('header') > 0) {
    $smarty->assign('message_stack_output', $messageStack->output('header'));
  } 
//  return 'overwrite_all';
?>