<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : restore_process.php
// author     : Hanspeter Zeller <hpz@xos-shop.com>
// copyright  : Copyright (c) 2016 Hanspeter Zeller
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
////////////////////////////////////////////////////////////////////////////////

// Set the level of error reporting
//  ini_set('display_errors', true);
//  error_reporting(E_ALL & ~E_NOTICE);
  error_reporting(0);
  
  set_time_limit(0);
          
  $language = $_POST['language'];    
  $iteration = (int)$_POST['iteration'];
  $iterations = (int)$_POST['iterations'];
  $hcd_dir = $_POST['hcd_dir'];
  $read_from = $_POST['read_from'];  

// Set the local configuration parameters - mainly for developers
  if (file_exists('includes/local/configure.php')) include('includes/local/configure.php');
  
// Include application configuration parameters
  require('../includes/configure.php');  
  
// include the list of project filenames
  require(DIR_WS_INCLUDES . 'filenames.php');

// include the list of project database tables
  require(DIR_WS_INCLUDES . 'database_tables.php');

// include the database functions "mysqli" and make a connection to the database
  require(DIR_WS_FUNCTIONS . 'database_mysqli.php');
  xos_db_connect();
  
// include the language translations
  require(DIR_FS_SMARTY . 'admin/languages/' . $language . '.php');
  if (file_exists(DIR_FS_SMARTY . 'admin/languages/' . $language . '/backup.php')) {
    include(DIR_FS_SMARTY . 'admin/languages/' . $language . '/backup.php');
  }       
                      
  $restore_query = file_get_contents(DIR_FS_TMP . $read_from . '.' . $iteration . '.tmp');
  
  if ($restore_query === false) {

    $script = '<script type="text/javascript">' . "\n" .    
              '/* <![CDATA[ */' . "\n" .
              '  $( "#button-ok" ).show();' . "\n" .
              '  $( "#process-spin" ).hide();' . "\n" .
              '/* ]]> */' . "\n" .
              '</script>' . "\n";
              
    die(ERROR_DATABASE_NOT_RESTORED . $script);                 
  }     

  if ($hcd_dir != DIR_WS_CATALOG) {
    $restore_query = preg_replace(array('#href=\\\"' . $hcd_dir . '([a-zA-Z0-9\-_])([^\"]*)\"#', '#src=\\\"' . $hcd_dir . '([a-zA-Z0-9\-_])([^\"]*)\"#'), array('href=\"' . DIR_WS_CATALOG . '$1$2"', 'src=\"' . DIR_WS_CATALOG . '$1$2"'),  $restore_query);
  }          
  $sql_array = array();
  $drop_table_names = array();
  $sql_length = strlen($restore_query);
  $pos = strpos($restore_query, ';');
  for ($i=$pos; $i<$sql_length; $i++) {
    if ($restore_query[0] == '#') {
      $restore_query = ltrim(substr($restore_query, strpos($restore_query, "\n")));
      $sql_length = strlen($restore_query);
      $i = strpos($restore_query, ';')-1;
      continue;
    }
    if ($restore_query[($i+1)] == "\n") {
      for ($j=($i+2); $j<$sql_length; $j++) {
        if (trim($restore_query[$j]) != '') {
          $next = substr($restore_query, $j, 6);
          if ($next[0] == '#') {
// find out where the break position is so we can remove this line (#comment line)
            for ($k=$j; $k<$sql_length; $k++) {
              if ($restore_query[$k] == "\n") break;
            }
            $query = substr($restore_query, 0, $i+1);
            $restore_query = substr($restore_query, $k);
// join the query before the comment appeared, with the rest of the dump
            $restore_query = $query . $restore_query;
            $sql_length = strlen($restore_query);
            $i = strpos($restore_query, ';')-1;
            continue 2;
          }
          break;
        }
      }
      if ($next == '') { // get the last insert query
        $next = 'insert';
      }
      if ( (preg_match('/create/i', $next)) || (preg_match('/insert/i', $next)) || (preg_match('/drop t/i', $next)) ) {              
        $query = substr($restore_query, 0, $i);
      
        $next = '';
        $sql_array[] = $query;
        $restore_query = ltrim(substr($restore_query, $i+1));
        $sql_length = strlen($restore_query);
        $i = strpos($restore_query, ';')-1;
        
        if (preg_match('/^create*/i', $query)) { 
          $table_name = trim(substr($query, stripos($query, 'table ')+6)); 
          $table_name = substr($table_name, 0, strpos($table_name, ' ')); 

          $drop_table_names[] = $table_name; 
        }                 
      }
    }
  }
  
  $drop_table_names_str = implode(', ', $drop_table_names);

  if ($drop_table_names_str != '') xos_db_query('drop table if exists ' . $drop_table_names_str);

  for ($i=0, $n=sizeof($sql_array); $i<$n; $i++) {
    xos_db_query($sql_array[$i]);
  }
  
  @unlink(DIR_FS_TMP . $read_from . '.' . $iteration . '.tmp');
  
  if ($iterations > $iteration) {                      
    $script = '<script type="text/javascript">' . "\n" .    
              '/* <![CDATA[ */' . "\n" .
              '  $( "#restoreProcessInfo" ).load( "' . DIR_WS_ADMIN . 'restore_process.php", { iteration : ' . ($iteration + 1) . ', iterations : ' . $iterations . ', hcd_dir : "' . $hcd_dir . '", read_from : "' . $read_from . '", language : "' . $language . '" } );' . "\n" .
              '/* ]]> */' . "\n" .
              '</script>' . "\n";                                

    die(TEXT_PLEASE_WAIT . '&nbsp;|&nbsp;' . TEXT_RUN . '&nbsp;' . ($iteration + 1) . '&nbsp;' . TEXT_OF . '&nbsp;' . $iterations . $script);                      
  } else {
  
    $script = '<script type="text/javascript">' . "\n" .    
              '/* <![CDATA[ */' . "\n" .
              '  $( "#button-ok" ).show();' . "\n" .
              '  $( "#process-spin" ).hide();' . "\n" .
              '/* ]]> */' . "\n" .
              '</script>' . "\n"; 
                        
    echo SUCCESS_DATABASE_RESTORED . $script;
  }

  xos_db_query("delete from " . TABLE_WHOS_ONLINE);
  xos_db_query("delete from " . TABLE_SESSIONS);
  xos_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'DB_LAST_RESTORE'");
  xos_db_query("insert into " . TABLE_CONFIGURATION . " values (null, 'DB_LAST_RESTORE', '" . $read_from . "', '6', '0', null, now(), '', '')");      
?>