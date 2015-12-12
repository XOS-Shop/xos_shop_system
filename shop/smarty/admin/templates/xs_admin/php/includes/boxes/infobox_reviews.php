<?php
    $contents = array();
    switch ($action) {
      case 'delete':
        $heading_title = '<b>' . TEXT_INFO_HEADING_DELETE_REVIEW . '</b>';

        $form_tag = xos_draw_form('reviews', FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $rInfo->reviews_id . '&action=deleteconfirm');
        $contents[] = array('text' => TEXT_INFO_DELETE_REVIEW_INTRO);
        $contents[] = array('text' => '<br /><b>' . $rInfo->products_name . '</b>');
        $contents[] = array('text' => '<br /><a href="" onclick="reviews.submit(); return false" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a><a href="' . xos_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $rInfo->reviews_id) . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_CANCEL . ' "><span>' . BUTTON_TEXT_CANCEL . '</span></a><br />&nbsp;');
        break;
      default:
      if (isset($rInfo) && is_object($rInfo)) {
      
        $product_image = xos_get_product_images($rInfo->products_image);
              
        $heading_title = '<b>' . $rInfo->products_name . '</b>';

        $contents[] = array('text' => '<a href="' . xos_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $rInfo->reviews_id . '&action=edit') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_EDIT . ' "><span>' . BUTTON_TEXT_EDIT . '</span></a><a href="' . xos_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $rInfo->reviews_id . '&action=delete') . '" class="button-default" style="margin-right: 5px; float: left" title=" ' . BUTTON_TITLE_DELETE . ' "><span>' . BUTTON_TEXT_DELETE . '</span></a>');
        $contents[] = array('text' => '<br />' . TEXT_INFO_DATE_ADDED . ' ' . xos_date_short($rInfo->date_added));
        if (xos_not_null($rInfo->last_modified)) $contents[] = array('text' => TEXT_INFO_LAST_MODIFIED . ' ' . xos_date_short($rInfo->last_modified));
        $contents[] = array('text' => '<br />' . xos_info_image('products/small/' . $product_image['name'], $rInfo->products_name));
        $contents[] = array('text' => '<br />' . TEXT_INFO_REVIEW_AUTHOR . ' ' . $rInfo->customers_name);
        $contents[] = array('text' => TEXT_INFO_REVIEW_RATING . ' ' . xos_image(DIR_WS_ADMIN_IMAGES . ADMIN_TPL . '/stars_' . $rInfo->reviews_rating . '.gif'));
        $contents[] = array('text' => TEXT_INFO_REVIEW_READ . ' ' . $rInfo->reviews_read);
        $contents[] = array('text' => '<br />' . TEXT_INFO_REVIEW_SIZE . ' ' . $rInfo->reviews_text_size . ' bytes');
        $contents[] = array('text' => '<br />' . TEXT_INFO_PRODUCTS_AVERAGE_RATING . ' ' . number_format($rInfo->average_rating, 2) . '%');
      }
        break;
    }

  $smarty->assign(array('info_box_heading_title' => $heading_title,
                        'info_box_form_tag' => $form_tag,
                        'info_box_contents' => $contents));
                          
  $output_infobox_reviews = $smarty->fetch(ADMIN_TPL . '/includes/boxes/infobox_reviews.tpl');
  $smarty->clearAssign(array('info_box_heading_title',
                              'info_box_form_tag', 
                              'info_box_contents'));  
                                                    
  $smarty->assign('infobox_reviews', $output_infobox_reviews);
  return 'overwrite_all';
?>