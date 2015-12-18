<?php
  if ($banner_footer_bottom = xos_banner_exists('dynamic', 'footer_bottom')) {
    $banner = array(); 
    $banner = xos_display_banner('static', $banner_footer_bottom);
    eval(' ?>' . $banner['banner_php_source'] . '<?php ');
    $smarty->assign('footer_banner_footer_bottom', $banner['banner_string']);
  }
//  return 'overwrite_all';
?>