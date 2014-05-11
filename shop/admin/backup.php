<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : backup.php
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
//              filename: backup.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');
if (!((@include DIR_FS_SMARTY . 'admin/templates/' . ADMIN_TPL . '/php/' . FILENAME_BACKUP) == 'overwrite_all')) :
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (xos_not_null($action)) {
    switch ($action) {
      case 'forget':
        xos_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'DB_LAST_RESTORE'");

        $messageStack->add_session('header', SUCCESS_LAST_RESTORE_CLEARED, 'success');

        xos_redirect(xos_href_link(FILENAME_BACKUP));
        break;
      case 'backupnow':
        xos_set_time_limit(0);
        $backup_file = 'db_' . DB_DATABASE . '-' . date('YmdHis') . '.sql';
        $fp = fopen(DIR_FS_BACKUP . $backup_file, 'w');

        $schema = '# XOS-Shop, open source e-commerce system' . "\n" .
                  '# Project Version: ' . PROJECT_VERSION . "\n" .        
                  '# http://www.xos-shop.com' . "\n" .
                  '#' . "\n" .
                  '# Database Backup For ' . STORE_NAME . "\n" .
                  '# Copyright (c) ' . date('Y') . ' ' . STORE_OWNER . "\n" .
                  '#' . "\n" .
                  '# Database Name: ' . DB_DATABASE . "\n" .
                  '# Database Server: ' . DB_SERVER . "\n" .
                  '#' . "\n" .                                      
                  '# Configuration Values:' . "\n" .              
                  '#     HTTP Server: ' . HTTP_SERVER . "\n" .
                  '#     HTTPS Server: ' . HTTPS_SERVER . "\n" .
                  '#     HTTP Cookie Domain: ' . COOKIE_DOMAIN . "\n" .
                  '#     HTTP Cookie Path: ' . COOKIE_PATH . "\n" .
                  '#     HTTP Catalog Directory: ' . DIR_WS_CATALOG . "\n" .
                  '#     Webserver Root Directory: ' . DIR_FS_DOCUMENT_ROOT . "\n" .                                    
                  '#' . "\n" .
                  '# Backup Date: ' . date(PHP_DATE_TIME_FORMAT) . "\n\n";
        fputs($fp, $schema);

        $tables_query = xos_db_query('show tables');
        while ($tables = xos_db_fetch_array($tables_query)) {
          list(,$table) = each($tables);

          $schema = 'drop table if exists ' . $table . ';' . "\n" .
                    'create table ' . $table . ' (' . "\n";

          $table_list = array();
          $fields_query = xos_db_query("show fields from " . $table);
          while ($fields = xos_db_fetch_array($fields_query)) {
            $table_list[] = $fields['Field'];

            $schema .= '  ' . $fields['Field'] . ' ' . $fields['Type'];

            if (strlen($fields['Default']) > 0) $schema .= ' default \'' . $fields['Default'] . '\'';

            if ($fields['Null'] != 'YES') $schema .= ' not null';

            if (isset($fields['Extra'])) $schema .= ' ' . $fields['Extra'];

            $schema .= ',' . "\n";
          }

          $schema = preg_replace("/,\n$/", '', $schema);

// add the keys
          $index = array();
          $keys_query = xos_db_query("show keys from " . $table);
          while ($keys = xos_db_fetch_array($keys_query)) {
            $kname = $keys['Key_name'];

            if (!isset($index[$kname])) {
              $index[$kname] = array('unique' => !$keys['Non_unique'],
                                     'fulltext' => ($keys['Index_type'] == 'FULLTEXT' ? '1' : '0'),
                                     'columns' => array());
            }

            $index[$kname]['columns'][] = $keys['Column_name'];
          }

          while (list($kname, $info) = each($index)) {
            $schema .= ',' . "\n";

            $columns = implode($info['columns'], ', ');

            if ($kname == 'PRIMARY') {
              $schema .= '  PRIMARY KEY (' . $columns . ')';
            } elseif ( $info['fulltext'] == '1' ) {  
              $schema .= '  FULLTEXT ' . $kname . ' (' . $columns . ')';
            } elseif ($info['unique']) {
              $schema .= '  UNIQUE ' . $kname . ' (' . $columns . ')';
            } else {
              $schema .= '  KEY ' . $kname . ' (' . $columns . ')';
            }
          }

          $schema .= "\n" . ');' . "\n\n";
          fputs($fp, $schema);

// dump the data
          if ( ($table != TABLE_SESSIONS ) && ($table != TABLE_WHOS_ONLINE) ) {
            $rows_query = xos_db_query("select " . implode(',', $table_list) . " from " . $table);
            while ($rows = xos_db_fetch_array($rows_query)) {
              $schema = 'insert into ' . $table . ' (' . implode(', ', $table_list) . ') values (';

              reset($table_list);
              while (list(,$i) = each($table_list)) {
                if (!isset($rows[$i])) {
                  $schema .= 'NULL, ';
                } elseif (xos_not_null($rows[$i])) {
                  $row = addslashes($rows[$i]);
                  $row = preg_replace("/\n#/", "\n".'\#', $row);

                  $schema .= '\'' . $row . '\', ';
                } else {
                  $schema .= '\'\', ';
                }
              }

              $schema = preg_replace('/, $/', '', $schema) . ');' . "\n";
              fputs($fp, $schema);
            }
          }
        }

        fclose($fp);

        if (isset($_POST['download']) && ($_POST['download'] == 'yes')) {
        
          if ($_POST['compress'] == 'gzip') {                    
            $data = implode("", file(DIR_FS_BACKUP . $backup_file));
            $gzdata = gzencode($data, 9);
            $fp = fopen(DIR_FS_BACKUP . $backup_file . '.gz', 'w');
            fwrite($fp, $gzdata);
            fclose($fp);
            @unlink(DIR_FS_BACKUP . $backup_file);  
            $backup_file .= '.gz';
          }   
          
          header_remove();
          header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
          header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); 
          header('Cache-Control: no-store, no-cache, must-revalidate');
          header('Cache-Control: post-check=0, pre-check=0', false);
          header('Pragma: no-cache');        
          header('Content-Type: application/octet-stream');
          header('Content-Length: ' . @filesize(DIR_FS_BACKUP . $backup_file));        
          header('Content-Disposition: attachment; filename="' . $backup_file . '"');                

          @readfile(DIR_FS_BACKUP . $backup_file);
          @unlink(DIR_FS_BACKUP . $backup_file);

          exit;
        } else {
        
          if ($_POST['compress'] == 'gzip') {            
            $data = implode("", file(DIR_FS_BACKUP . $backup_file));
            $gzdata = gzencode($data, 9);
            $fp = fopen(DIR_FS_BACKUP . $backup_file . '.gz', 'w');
            fwrite($fp, $gzdata);
            fclose($fp);
            @unlink(DIR_FS_BACKUP . $backup_file);
          }

          $messageStack->add_session('header', SUCCESS_DATABASE_SAVED, 'success');
        }

        xos_redirect(xos_href_link(FILENAME_BACKUP));
        break;
      case 'restorenow':
      case 'restorelocalnow':
        xos_set_time_limit(0);

        if ($action == 'restorenow') {
          $read_from = $_GET['file'];

          if (file_exists(DIR_FS_BACKUP . $_GET['file'])) {
            $restore_file = DIR_FS_BACKUP . $_GET['file'];
            $extension = substr($_GET['file'], -3);

            if ( ($extension == 'sql') || ($extension == '.gz') ) {
              switch ($extension) {
                case 'sql': 
                                                   
                  if (file_exists($restore_file) && (filesize($restore_file) > 15000)) {
                    $fd = fopen($restore_file, 'rb');
                    $restore_query = fread($fd, filesize($restore_file));
                    fclose($fd);
                  }   
                                                   
                  break;
                case '.gz': 
                                 
                  if (extension_loaded('zlib') && file_exists($restore_file) && (filesize($restore_file) > 5000)) {                  
                    $fd = fopen($restore_file, 'rb');
                    fseek($fd, -4, SEEK_END);
                    $buf = fread($fd, 4);
                    $filesize_uncompressed = end(unpack('V', $buf));
                    fclose($fd);                                    
                    $fdgz = gzopen($restore_file, 'rb');
                    $restore_query = gzread($fdgz, $filesize_uncompressed);
                    gzclose($fdgz);
                  }  
                                       
              }
            }
          }
        } elseif ($action == 'restorelocalnow') {
          $sql_file = new upload('sql_file', '', '', array('sql','gz'));          
          $sql_file->parse();
          
          $extension = substr($sql_file->filename, -3);
          
          if ( ($extension == 'sql') || ($extension == '.gz') ) {
            switch ($extension) {
              case 'sql': 
                       
                $restore_query = fread(fopen($sql_file->tmp_filename, 'r'), filesize($sql_file->tmp_filename));
                $read_from = $sql_file->filename;
                
                break;
              case '.gz': 
              
                if (extension_loaded('zlib')) {
                  $fd = fopen($sql_file->tmp_filename, 'rb');
                  fseek($fd, -4, SEEK_END);
                  $buf = fread($fd, 4);
                  $filesize_uncompressed = end(unpack('V', $buf));
                  fclose($fd);                                                 
                  $restore_query = gzread(gzopen($sql_file->tmp_filename, 'rb'), $filesize_uncompressed);
                  $read_from = $sql_file->filename;
                }  
                                                           
            }            
          }                  
        }

        if (isset($restore_query)) {
// the catalog directory name will be replaced in database dump if necessary        
          $hcd_pos = strpos($restore_query, 'HTTP Catalog Directory:') + 23;        
          $hcd_dir = trim(substr($restore_query, $hcd_pos, strpos($restore_query, "\n", $hcd_pos) - $hcd_pos));          
          if ($hcd_dir != DIR_WS_CATALOG) {
            $restore_query = str_replace('\"' . $hcd_dir, '\"' . DIR_WS_CATALOG, $restore_query);
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

          xos_db_query('drop table if exists ' . implode(', ', $drop_table_names));

          for ($i=0, $n=sizeof($sql_array); $i<$n; $i++) {
            xos_db_query($sql_array[$i]);
          }
          
          session_write_close();
          
          xos_db_query("delete from " . TABLE_WHOS_ONLINE);
          xos_db_query("delete from " . TABLE_SESSIONS);
          xos_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'DB_LAST_RESTORE'");
          xos_db_query("insert into " . TABLE_CONFIGURATION . " values (null, 'DB_LAST_RESTORE', '" . $read_from . "', '6', '0', null, now(), '', '')");

          $messageStack->add_session('header', SUCCESS_DATABASE_RESTORED, 'success');
        }
        
        $smarty_cache_control->clearAllCache();
        
        xos_redirect(xos_href_link(FILENAME_BACKUP));
        break;
      case 'download':
        $extension = substr($_GET['file'], -3);

        if ( ($extension == '.gz') || ($extension == 'sql') ) {
          header_remove();
          header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
          header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); 
          header('Cache-Control: no-store, no-cache, must-revalidate');
          header('Cache-Control: post-check=0, pre-check=0', false);
          header('Pragma: no-cache');        
          header('Content-Type: application/octet-stream');            
          header('Content-Length: ' . @filesize(DIR_FS_BACKUP . urldecode($_GET['file'])));                               
          header('Content-Disposition: attachment; filename="' . urldecode($_GET['file']) . '"'); 
          @readfile(DIR_FS_BACKUP . urldecode($_GET['file']));
          exit;
        } else {
          $messageStack->add('header', ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE, 'error');
        }
        break;
      case 'deleteconfirm':
        if (strstr($_GET['file'], '..')) xos_redirect(xos_href_link(FILENAME_BACKUP));

        xos_remove(DIR_FS_BACKUP . '/' . $_GET['file']);

        if (!$xos_remove_error) {
          $messageStack->add_session('header', SUCCESS_BACKUP_DELETED, 'success');

          xos_redirect(xos_href_link(FILENAME_BACKUP));
        }
        break;
    }
  }

// check if the backup directory exists
  $dir_ok = false;
  if (is_dir(DIR_FS_BACKUP)) {
    if (is_writable(DIR_FS_BACKUP)) {
      $dir_ok = true;
    } else {
      $messageStack->add('header', ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE, 'error');
    }
  } else {
    $messageStack->add('header', ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST, 'error');
  }

  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n";
  
  require(DIR_WS_INCLUDES . 'html_header.php');
  require(DIR_WS_INCLUDES . 'header.php');
  require(DIR_WS_INCLUDES . 'column_left.php');      
  require(DIR_WS_INCLUDES . 'footer.php');   

  if ($dir_ok == true) {
    $dir = dir(DIR_FS_BACKUP);
    $contents = array();
    while ($file = $dir->read()) {
      if (!is_dir(DIR_FS_BACKUP . $file) && in_array(substr($file, -3), array('sql', '.gz'))) {
        $contents[] = $file;
      }
    }
    sort($contents);

    $backups_array = array();
    for ($i=0, $n=sizeof($contents); $i<$n; $i++) {
      $entry = $contents[$i];

      $check = 0;

      if ((!isset($_GET['file']) || (isset($_GET['file']) && ($_GET['file'] == $entry))) && !isset($buInfo) && ($action != 'backup') && ($action != 'restorelocal')) {
        $file_array['file'] = $entry;
        $file_array['date'] = date(PHP_DATE_TIME_FORMAT, filemtime(DIR_FS_BACKUP . $entry));
        $file_array['size'] = number_format(filesize(DIR_FS_BACKUP . $entry)) . ' bytes';
        switch (substr($entry, -3)) {
          case 'zip': $file_array['compression'] = 'ZIP'; break;
          case '.gz': $file_array['compression'] = 'GZIP'; break;
          default: $file_array['compression'] = TEXT_NO_EXTENSION; break;
        }

        $buInfo = new objectInfo($file_array);
      }

      $selected = false;

      if (isset($buInfo) && is_object($buInfo) && ($entry == $buInfo->file)) {
        $selected = true;
        $onclick_link = 'file=' . $buInfo->file . '&action=restore';
      } else {
        $onclick_link = 'file=' . $entry;
      }

      $backups_array[]=array('selected' => $selected,
                             'file_name' => $entry,
                             'file_size' => number_format(filesize(DIR_FS_BACKUP . $entry)),
                             'file_date' => date(PHP_DATE_TIME_FORMAT, filemtime(DIR_FS_BACKUP . $entry)),
                             'link_filename_backup_action' => xos_href_link(FILENAME_BACKUP, 'action=download&file=' . $entry),
                             'link_filename_backup_onclick' => xos_href_link(FILENAME_BACKUP, $onclick_link),                      
                             'link_filename_backup_file' => xos_href_link(FILENAME_BACKUP, 'file=' . $entry));




    }
    $dir->close();
    
    $smarty->assign('backups', $backups_array);
  }

  if ( ($action != 'backup') && (isset($dir)) ) {
    $smarty->assign('link_filename_backup_action_backup', xos_href_link(FILENAME_BACKUP, 'action=backup'));
  }
       
  if ( ($action != 'restorelocal') && isset($dir) ) {
    $smarty->assign('link_filename_backup_action_restorelocal', xos_href_link(FILENAME_BACKUP, 'action=restorelocal'));
  }

  if (defined('DB_LAST_RESTORE')) {
    $smarty->assign(array('db_last_restore' => DB_LAST_RESTORE,
                          'link_filename_backup_action_forget' => xos_href_link(FILENAME_BACKUP, 'action=forget')));
  }
  
  $smarty->assign('backup_directory', DIR_FS_BACKUP);  

  require(DIR_WS_BOXES . 'infobox_backup.php');
 
  $smarty->configLoad('languages/' . $_SESSION['language'] . '.conf', 'backup');
  $output_backup = $smarty->fetch(ADMIN_TPL . '/backup.tpl');
  
  $smarty->assign('central_contents', $output_backup);
  
  $smarty->display(ADMIN_TPL . '/frame.tpl');

  require(DIR_WS_INCLUDES . 'application_bottom.php');
endif;  
?>
