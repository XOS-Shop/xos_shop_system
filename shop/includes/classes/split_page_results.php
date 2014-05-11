<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : split_page_results.php
// author     : Hanspeter Zeller <hpz@xos-shop.com>
// copyright  : Copyright (c) 2007 Hanspeter Zeller
// license    : This file is part of XOS-Shop.
//
//              XOS-Shop is free software: you can redistribute it and/or modify
//              it under the terms of the GNU General Public License as published
//              by the Free Software Foundation, either version 3 of the License,
//              or (at your option) any later version.
//
//              XOS-Shop is distributed in the hope that it will be useful,
//              but WITHOUT ANY WARRANTY; without even the implied warranty of
//              MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//              GNU General Public License for more details.
//
//              You should have received a copy of the GNU General Public License
//              along with XOS-Shop.  If not, see <http://www.gnu.org/licenses/>.   
//------------------------------------------------------------------------------
// this file is based on: 
//              osCommerce, Open Source E-Commerce Solutions
//              http://www.oscommerce.com
//              Copyright (c) 2003 osCommerce
//              filename: split_page_results.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  class splitPageResults {
    var $sql_query, $number_of_rows, $current_page_number, $number_of_pages, $number_of_rows_per_page, $page_name;

/* class constructor */
    function splitPageResults($query, $max_rows, $count_key = '*', $page_holder = 'page') {

      $this->sql_query = $query;
      $this->page_name = $page_holder;

      if (isset($_GET[$page_holder])) {
        $page = $_GET[$page_holder];
      } elseif (isset($_POST[$page_holder])) {
        $page = $_POST[$page_holder];
      } else {
        $page = '';
      }

      if (empty($page) || !is_numeric($page)) $page = 1;
      $this->current_page_number = $page;

      $this->number_of_rows_per_page = $max_rows;

      $pos_to = strlen($this->sql_query);
      $pos_from = strpos($this->sql_query, ' from', 0);

      $pos_group_by = strpos($this->sql_query, ' group by', $pos_from);
      if (($pos_group_by < $pos_to) && ($pos_group_by != false)) $pos_to = $pos_group_by;

      $pos_having = strpos($this->sql_query, ' having', $pos_from);
      if (($pos_having < $pos_to) && ($pos_having != false)) $pos_to = $pos_having;

      $pos_order_by = strpos($this->sql_query, ' order by', $pos_from);
      if (($pos_order_by < $pos_to) && ($pos_order_by != false)) $pos_to = $pos_order_by;

      if (strpos($this->sql_query, 'distinct') || strpos($this->sql_query, 'group by')) {
        $count_string = 'distinct ' . xos_db_input($count_key);
      } else {
        $count_string = xos_db_input($count_key);
      }

      $count_query = xos_db_query("select count(" . $count_string . ") as total " . substr($this->sql_query, $pos_from, ($pos_to - $pos_from)));
      $count = xos_db_fetch_array($count_query);

      $this->number_of_rows = $count['total'];

      $this->number_of_pages = ceil($this->number_of_rows / $this->number_of_rows_per_page);

      if ($this->current_page_number > $this->number_of_pages) {
        $this->current_page_number = $this->number_of_pages;
      }

      $offset = ($this->number_of_rows_per_page * ($this->current_page_number - 1));

      $this->sql_query .= " limit " . max($offset, 0) . ", " . $this->number_of_rows_per_page;
    }

/* class functions */

// display split-page-number-links
    function display_links($max_page_links, $parameters = '') {
      global $request_type;

      $display_links_string = '';

      $class = 'class="page-results"';

      if (xos_not_null($parameters) && (substr($parameters, -1) != '&')) $parameters .= '&';

// previous button
      if ($this->current_page_number > 1) {
        $display_links_string .= '&nbsp;<a href="' . xos_href_link(basename($_SERVER['PHP_SELF']), $parameters . $this->page_name . '=' . ($this->current_page_number - 1), $request_type) . '" class="page-results" title=" ' . PREVNEXT_TITLE_PREVIOUS_PAGE . ' "><span class="text-deco-underline">' . PREVNEXT_BUTTON_PREV . '</span></a>&nbsp;';
      } elseif ($this->number_of_pages != 1) {
        $display_links_string .= '&nbsp;' . PREVNEXT_BUTTON_PREV . '&nbsp;';
      }

// check if number_of_pages > $max_page_links
      $cur_window_num = intval($this->current_page_number / $max_page_links);
      if ($this->current_page_number % $max_page_links) $cur_window_num++;

      $max_window_num = intval($this->number_of_pages / $max_page_links);
      if ($this->number_of_pages % $max_page_links) $max_window_num++;

// previous window of pages
      if ($cur_window_num > 1) $display_links_string .= '&nbsp;<a href="' . xos_href_link(basename($_SERVER['PHP_SELF']), $parameters . $this->page_name . '=' . (($cur_window_num - 1) * $max_page_links), $request_type) . '" class="page-results" title=" ' . sprintf(PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE, $max_page_links) . ' "><span class="text-deco-underline">...</span></a>&nbsp;';

// page nn button
      for ($jump_to_page = 1 + (($cur_window_num - 1) * $max_page_links); ($jump_to_page <= ($cur_window_num * $max_page_links)) && ($jump_to_page <= $this->number_of_pages); $jump_to_page++) {
        if ($jump_to_page == $this->current_page_number) {
          $display_links_string .= '&nbsp;<b>' . $jump_to_page . '</b>&nbsp;';
        } else {
          $display_links_string .= '&nbsp;<a href="' . xos_href_link(basename($_SERVER['PHP_SELF']), $parameters . $this->page_name . '=' . $jump_to_page, $request_type) . '" class="page-results" title=" ' . sprintf(PREVNEXT_TITLE_PAGE_NO, $jump_to_page) . ' "><span class="text-deco-underline">' . $jump_to_page . '</span></a>&nbsp;';
        }
      }

// next window of pages
      if ($cur_window_num < $max_window_num) $display_links_string .= '&nbsp;<a href="' . xos_href_link(basename($_SERVER['PHP_SELF']), $parameters . $this->page_name . '=' . (($cur_window_num) * $max_page_links + 1), $request_type) . '" class="page-results" title=" ' . sprintf(PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE, $max_page_links) . ' "><span class="text-deco-underline">...</span></a>&nbsp;';

// next button
      if ($this->current_page_number < $this->number_of_pages) {
        $display_links_string .= '&nbsp;<a href="' . xos_href_link(basename($_SERVER['PHP_SELF']), $parameters . 'page=' . ($this->current_page_number + 1), $request_type) . '" class="page-results" title=" ' . PREVNEXT_TITLE_NEXT_PAGE . ' "><span class="text-deco-underline">' . PREVNEXT_BUTTON_NEXT . '</span></a>&nbsp;';
      } elseif ($this->number_of_pages != 1) {
        $display_links_string .= '&nbsp;' . PREVNEXT_BUTTON_NEXT . '&nbsp;';
      } 

      return $display_links_string;
    }

// display split-page-number-links in a pull-down-menu    
    function display_links_in_pull_down_menu($max_page_links, $parameters = '') {
      global $request_type;

      if ( xos_not_null($parameters) && (substr($parameters, -1) != '&') ) $parameters .= '&';

// calculate number of pages needing links
      $num_pages = ceil($this->number_of_rows / $this->number_of_rows_per_page);

      $pages_array = array();
      for ($i=1; $i<=$num_pages; $i++) {
        $pages_array[] = array('id' => $i, 'text' => $i);
      }

      if ($num_pages > 1) {
        $display_links = xos_draw_form('pages', xos_href_link(basename($_SERVER['PHP_SELF']), '', $request_type, false, true, false, false, false), 'get');

// previous button
        if ($this->current_page_number > 1) {
          $display_links .= '&nbsp;<a href="' . xos_href_link(basename($_SERVER['PHP_SELF']), $parameters . $this->page_name . '=' . ($this->current_page_number - 1), $request_type) . '" class="page-results" title=" ' . PREVNEXT_TITLE_PREVIOUS_PAGE . ' "><span class="text-deco-underline">' . PREVNEXT_BUTTON_PREV . '</span></a>&nbsp;';
        } elseif ($this->number_of_pages != 1) {
          $display_links .= '&nbsp;' . PREVNEXT_BUTTON_PREV . '&nbsp;';
        }

        $display_links .= sprintf(TEXT_RESULT_PAGE_IN_PULL_DOWN_MENU, xos_draw_pull_down_menu($this->page_name, $pages_array, $this->current_page_number, 'onchange="this.form.submit();"'), $num_pages);
        
// next button
        if ($this->current_page_number < $this->number_of_pages) {
          $display_links .= '&nbsp;<a href="' . xos_href_link(basename($_SERVER['PHP_SELF']), $parameters . 'page=' . ($this->current_page_number + 1), $request_type) . '" class="page-results" title=" ' . PREVNEXT_TITLE_NEXT_PAGE . ' "><span class="text-deco-underline">' . PREVNEXT_BUTTON_NEXT . '</span></a>&nbsp;';
        } elseif ($this->number_of_pages != 1) {
          $display_links .= '&nbsp;' . PREVNEXT_BUTTON_NEXT . '&nbsp;';
        }         

        if ($parameters != '') {
          if (substr($parameters, -1) == '&') $parameters = substr($parameters, 0, -1);
          $pairs = explode('&', $parameters);
          while (list(, $pair) = each($pairs)) {
            list($key,$value) = explode('=', $pair);
            $display_links .= xos_draw_hidden_field(rawurldecode($key), rawurldecode($value));
          }
        }

        $hidden_get_variables = '';
        if (!$session_started && xos_not_null($_GET['currency'])) {
          $hidden_get_variables .= xos_draw_hidden_field('currency', $_GET['currency']);
        }  

        if (!$session_started && xos_not_null($_GET['language'])) {
          $hidden_get_variables .= xos_draw_hidden_field('language', $_GET['language']);
         }
    
        if (!$session_started && xos_not_null($_GET['tpl'])) {
          $hidden_get_variables .= xos_draw_hidden_field('tpl', $_GET['tpl']);
        } 

        $display_links .= $hidden_get_variables . xos_hide_session_id();

        $display_links .= '</form>';
      } else {
        $display_links = sprintf(TEXT_RESULT_PAGE_IN_PULL_DOWN_MENU, $num_pages, $num_pages);
      }

      return $display_links;
    }    
    
// display number of total products found
    function display_count($text_output) {
      $to_num = ($this->number_of_rows_per_page * $this->current_page_number);
      if ($to_num > $this->number_of_rows) $to_num = $this->number_of_rows;

      $from_num = ($this->number_of_rows_per_page * ($this->current_page_number - 1));

      if ($to_num == 0) {
        $from_num = 0;
      } else {
        $from_num++;
      }

      return sprintf($text_output, $from_num, $to_num, $this->number_of_rows);
    }
  }
?>
