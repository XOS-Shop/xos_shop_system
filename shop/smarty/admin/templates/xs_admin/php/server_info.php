<?php
  $style = '<style type="text/css">' . "\n" .
           '/* <![CDATA[ */' . "\n" .
           '.center {font-family: sans-serif; font-size: 10px;}' . "\n" .                
           '.p {text-align: left;}' . "\n" .
           '.e {background-color: #ccccff; font-weight: bold;}' . "\n" .
           '.h {background-color: #9999cc; font-weight: bold;}' . "\n" .
           '.v {background-color: #cccccc;}' . "\n" .
           'i {color: #666666;}' . "\n" .
           'hr {display: none;}' . "\n" .
           '/* ]]> */' . "\n" .
           '</style>' . "\n";

  $javascript = '';
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');   

  ob_start();
  phpinfo();
  $phpinfo = ob_get_contents();
  ob_end_clean();
  $phpinfo = str_replace('border: 1px', '', $phpinfo);
  preg_match('!<body>(.*)</body>!is', $phpinfo, $regs);
  
  $smarty->assign(array('system' => xos_get_system_information(),
                        'phpinfo' => $regs[1],
                        'project_version' => PROJECT_VERSION));    

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'server_info');
  $output_server_info = $smarty->fetch(ADMIN_TPL . '/server_info.tpl');
  
  $smarty->assign('central_contents', $output_server_info);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
  return 'overwrite_all';
?>