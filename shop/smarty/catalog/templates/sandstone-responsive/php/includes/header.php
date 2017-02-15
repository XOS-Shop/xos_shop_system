<?php
  if ($banner_logo = xos_banner_exists('dynamic', 'logo')) {
    $banner = array(); 
    $banner = xos_display_banner('static', $banner_logo);
    eval(" ?>" . $banner['banner_php_source'] . "<?php ");
    $smarty->assign('header_banner_logo', $banner['banner_string']);
  }
//  return 'overwrite_all';