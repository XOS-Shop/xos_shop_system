<?php
  $contents = array();
  switch ($action) {
    case 'edit':
      $keys = '';
      reset($mInfo->keys);
      foreach($mInfo->keys as $key => $value) {
        $keys .= '<b>' . $value['title'] . '</b><br />' . $value['description'] . '<br />';

        if ($value['set_function']) {
          eval('$keys .= ' . $value['set_function'] . "'" . $value['value'] . "', '" . $key . "');");
        } else {
          $keys .= xos_draw_input_field('configuration[' . $key . ']', $value['value']);
        }
        $keys .= '<br /><br />';
      }
      $keys = substr($keys, 0, strrpos($keys, '<br /><br />'));

      $heading_title = '<b>' . $mInfo->title . '</b>';

      $form_tag = xos_draw_form('modules', FILENAME_MODULES, 'set=' . $set . '&module=' . $_GET['module'] . '&action=save');
      $contents[] = array('text' => $keys);
      $contents[] = array('text' => '<br /><a href="" onclick="modules.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_UPDATE . ' "><span>' . BUTTON_TEXT_UPDATE . '</span></a><a href="' . xos_href_link(FILENAME_MODULES, 'set=' . $set . '&module=' . $_GET['module']) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
      break;
    default:
      $heading_title = '<b>' . $mInfo->title . '</b>';

      if ($mInfo->status == '1') {
        $keys = '';
        reset($mInfo->keys);
        foreach($mInfo->keys as $value) {
          $keys .= '<b>' . $value['title'] . '</b><br />';
          if ($value['use_function']) {
            $use_function = $value['use_function'];
            if (preg_match('/->/', $use_function)) {
              $class_method = explode('->', $use_function);
              if (!is_object(${$class_method[0]})) {
                include(DIR_WS_CLASSES . $class_method[0] . '.php');
                ${$class_method[0]} = new $class_method[0]();
              }
              $keys .= xos_call_function($class_method[1], $value['value'], ${$class_method[0]});
            } else {
              $keys .= xos_call_function($use_function, $value['value']);
            }
          } else {
            $keys .= xos_cfg_get_val_to_txt($value['value']);
          }
          $keys .= '<br /><br />';
        }
        $keys = substr($keys, 0, strrpos($keys, '<br /><br />'));

        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_MODULES, 'set=' . $set . '&module=' . $mInfo->code . '&action=remove') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_MODULE_REMOVE . ' "><span>' . BUTTON_TEXT_MODULE_REMOVE . '</span></a><a href="' . xos_href_link(FILENAME_MODULES, 'set=' . $set . (isset($_GET['module']) ? '&module=' . $_GET['module'] : '') . '&action=edit') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a>');
        $contents[] = array('text' => '<br />' . $mInfo->description);
        $contents[] = array('text' => '<br />' . $keys);
      } else {
        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_MODULES, 'set=' . $set . '&module=' . $mInfo->code . '&action=install') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_MODULE_INSTALL . ' "><span>' . BUTTON_TEXT_MODULE_INSTALL . '</span></a>');
        $contents[] = array('text' => '<br />' . $mInfo->description);
      }
      break;
  }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                           
  $output_infobox_modules = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_modules.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_form_tag', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_modules', $output_infobox_modules); 
  return 'overwrite_all';
?>