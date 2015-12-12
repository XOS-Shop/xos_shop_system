<?php
//xos_session_destroy();
  unset($_SESSION['login_id']);
  unset($_SESSION['login_firstname']);
  unset($_SESSION['login_groups_id']);
  unset($_SESSION['selected_box']);

  $javascript = '<script type="text/javascript">' . "\n" .   
                '/* <![CDATA[ */' . "\n" .
                'function center() {' . "\n" .
                '  var height = document.getElementById("text").offsetHeight;' . "\n" .
                '  var marg = (height / 2);' . "\n" .
                '  document.getElementById("spacer").style.margin = "-" + marg + "px" + " 0px" + " 0px" + " 0px";' . "\n" .
                '}' . "\n" .                   
                '/* ]]> */' . "\n" .
                '</script>' . "\n";                                  

  require(DIR_WS_INCLUDES . 'html_header_with_special_stylesheet.php'); 
  require(DIR_WS_INCLUDES . 'footer.php');

  $smarty->assign(array('link_filename_default' => xos_href_link(FILENAME_DEFAULT),
                        'link_catalog' => xos_catalog_href_link(),
                        'link_filename_login' => xos_href_link(FILENAME_LOGIN)));

  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'logoff');

  $smarty->display(ADMIN_TPL . '/logoff.tpl');
  
  unset($_SESSION['language']);
  unset($_SESSION['languages_id']);
  unset($_SESSION['used_lng_id']);
  return 'overwrite_all';
?>