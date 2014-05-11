<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : xml_sitemap_generator.php
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
//              Copyright (c) 2005 osCommerce
//              filename: google_sitemap.php
//              author: Raphael Vullriede (osc@rvdesign.de)                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

  // XML-Specification: http://www.sitemaps.org/protocol.php

  require('includes/application_top.php');

  define('CHANGEFREQ_CONTENTS', 'weekly'); // Valid values are "always", "hourly", "daily", "weekly", "monthly", "yearly" and "never".
  define('CHANGEFREQ_CATEGORIES', 'weekly');  // Valid values are "always", "hourly", "daily", "weekly", "monthly", "yearly" and "never".
  define('CHANGEFREQ_PRODUCTS', 'daily'); // Valid values are "always", "hourly", "daily", "weekly", "monthly", "yearly" and "never".

  define('PRIORITY_CONTENTS', '1.0');
  define('PRIORITY_CATEGORIES', '1.0');
  define('PRIORITY_PRODUCTS', '0.5');

  define('MAX_ENTRYS', 50000);
  define('MAX_SIZE', 10485760);


  define('SITEMAPINDEX_HEADER', "<?xml version='1.0' encoding='UTF-8'?>"."\n".
                                '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"'."\n".
                                'xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"'."\n".
                                'xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9'."\n".
                                'http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd">'."\n");
                                
  define('SITEMAPINDEX_ENTRY', '  <sitemap>'."\n".
                               '    <loc>%s</loc>'."\n".
                               '    <lastmod>%s</lastmod>'."\n".
                               '  </sitemap>'."\n");

  define('SITEMAPINDEX_FOOTER', '</sitemapindex>');




  define('SITEMAP_HEADER', "<?xml version='1.0' encoding='UTF-8'?>"."\n".
                           '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"'."\n".
                           'xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"'."\n".
                           'xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9'."\n".
                           'http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'."\n");
		
  define('SITEMAP_ENTRY', '  <url>'."\n".
                          '    <loc>%s</loc>'."\n".
                          '    <priority>%s</priority>'."\n".
                          '    <lastmod>%s</lastmod>'."\n".
                          '    <changefreq>%s</changefreq>'."\n".
                          '  </url>'."\n");

  define('SITEMAP_FOOTER', '</urlset>');
  
  
  $usegzip            = false;
  $autogenerate       = false;
  $output_to_doc_root = false;
  $notify_google      = false;
  $notify_url         = '';

  // request over http or command line?
  if (!isset($_SERVER['SERVER_PROTOCOL'])) {

    if (count($_SERVER['argv'] > 1)) {
      
      // option p ist only possible of min 1 more option isset
      if ( (strlen($_SERVER['argv'][1]) >= 2) && strpos($_SERVER['argv'][1], 'p') !== false) {
        $notify_google = true;
        $_SERVER['argv'][1] = str_replace('p', '', $_SERVER['argv'][1]);
      }
      
      switch($_SERVER['argv'][1]) {
      
        // dump to file
        case '-f':
          break;
          
        // dump to compressed file
        case '-zf':
          $usegzip        = true;
          break;
          
        // autogenerate sitemaps. useful for sites with more the 500000 Urls
        case '-a':
          $autogenerate = true;
          break;
          
        // autogenerate sitemaps and use gzip
        case '-za':
          $autogenerate   = true;
          $usegzip        = true;
          break;
      }
    }
  } else {

    if (count($_GET) > 0) {
        
      // use gzip
      $usegzip = (isset($_GET['gzip']) && $_GET['gzip'] == true) ? true : false;
      
      // autogenerate sitemaps
      $autogenerate = (isset($_GET['auto']) && $_GET['auto'] == true) ? true : false;
      
      // notify google
      $notify_google = (isset($_GET['ping']) && $_GET['ping'] == true) ? true : false;
    }
  }

  // use gz... functions for compressed files
  if (extension_loaded('zlib') && $usegzip) {
    $function_open  = 'gzopen';
    $function_close = 'gzclose';
    $function_write = 'gzwrite';
    
    $file_extension = '.xml.gz';
  } else {
    $function_open  = 'fopen';
    $function_close = 'fclose';
    $function_write = 'fwrite';
    
    $file_extension = '.xml';
  }

  // < PHP5
  function iso8601_date($timestamp) {
  
    if (!function_exists('version_compare') || version_compare(PHP_VERSION, '5.0.0', '<')) {
       $tzd = date('O',$timestamp);
       $tzd = substr(chunk_split($tzd, 3, ':'),0,6);
       return date('Y-m-d\TH:i:s', $timestamp) . $tzd;
    } else {
      return date('c', $timestamp);
    }
  }

  // generates cPath with helper array
  function rv_get_path($cat_id, $code) {
    global $cat_array;
    
    $my_cat_array = array($cat_id);
    
    while($cat_array[$cat_id][$code]['parent_id'] != 0) {
      $my_cat_array[] = $cat_array[$cat_id][$code]['parent_id'];
      $cat_id = $cat_array[$cat_id][$code]['parent_id'];
    }
    
    return 'cPath='.implode('_', array_reverse($my_cat_array));
  }

  // The location link wrapper function
  function xos_loc_link($page = '', $parameters = '', $connection = 'NONSSL', $search_engine_safe = true) {
    
    $add_parameter = false;
  
    if ($connection == 'NONSSL') {
      $link = HTTP_SERVER . DIR_WS_CATALOG;
    } elseif ($connection == 'SSL') {
      if (ENABLE_SSL == true) {
        $link = HTTPS_SERVER . DIR_WS_CATALOG;
      } else {
        $link = HTTP_SERVER . DIR_WS_CATALOG;
      }
    }
      
    if (xos_not_null($parameters)) {
      if ( (SEARCH_ENGINE_FRIENDLY_URLS == 'true') && ($search_engine_safe == true) ) $parameters = str_replace(array('%2F', '%5C'), array('_.~', '~._'), $parameters);
      $link .= $page . '?' . xos_output_string($parameters);
      $add_parameter = true;
      $separator = '&';
    } else {
      $link .= $page;
      $separator = '?';
    }

    while ( (substr($link, -1) == '&') || (substr($link, -1) == '?') ) $link = substr($link, 0, -1);

    if ( (SEARCH_ENGINE_FRIENDLY_URLS == 'true') && ($search_engine_safe == true) ) {
    
      while (strstr($link, '=%20')) $link = str_replace('=%20', '=', $link);

      $link = str_replace('&&', '&', $link);
      $link = str_replace('=&', '/^/', $link);
      $link = str_replace('?', '/', $link);
      $link = str_replace('&', '/', $link);
      $link = str_replace('=', '/', $link);
      
      if ($add_parameter) $link = $link . '/';

    } else {
    
      $link = str_replace(array('&amp;', '&'), array('&', '&amp;'), $link);
    
    }

    return $link;
  }

  // check if the selected directory is writeable 
  if (!is_writeable($output_to_doc_root ? str_replace(DIR_WS_CATALOG, '/', DIR_FS_CATALOG) : DIR_FS_CATALOG)) die('<br /><br /><span style="color : #ff0000;"><b>Error!</b></span><br /><br />The <b>' . ($output_to_doc_root ? str_replace(DIR_WS_CATALOG, '/', DIR_FS_CATALOG) : DIR_FS_CATALOG) . '</b> directory is not writeable!<br /><br />');

  $c = 0;
  $i = 1;

  if ($autogenerate) {
    $fp = $function_open(($output_to_doc_root ? str_replace(DIR_WS_CATALOG, '/', DIR_FS_CATALOG) : DIR_FS_CATALOG).'sitemap'.$i.$file_extension, 'w');
    $notify_url = ($output_to_doc_root ? HTTP_SERVER.'/sitemap' : HTTP_SERVER.DIR_WS_CATALOG.'sitemap').$i.$file_extension;    
  } else {   
    $fp = $function_open(($output_to_doc_root ? str_replace(DIR_WS_CATALOG, '/', DIR_FS_CATALOG) : DIR_FS_CATALOG).'sitemap'.$file_extension, 'w');
    $notify_url = ($output_to_doc_root ? HTTP_SERVER.'/sitemap' : HTTP_SERVER.DIR_WS_CATALOG.'sitemap').$file_extension;      
  }


  $function_write($fp, SITEMAP_HEADER);
  $strlen = strlen(SITEMAP_HEADER);
  $string = '';

  $content_result = xos_db_query("
    SELECT
      c.content_id,
      cd.language_id,
      UNIX_TIMESTAMP(c.date_added) as date_added,
      UNIX_TIMESTAMP(c.last_modified) as last_modified,
      l.code
    FROM
      ".TABLE_CONTENTS." c, 
      ".TABLE_CONTENTS_DATA." cd,
      ".TABLE_LANGUAGES." l
    WHERE
      c.type = 'info' AND
      c.status = '1' AND
      c.content_id = cd.content_id AND
      cd.language_id = l.languages_id
    ORDER BY
      c.content_id
  ");

  if (xos_db_num_rows($content_result) > 0) {
    while($content_data = xos_db_fetch_array($content_result)) {
    
      $lang_param = '&language='.$content_data['code'];
      $date = ($content_data['last_modified'] != NULL) ? $content_data['last_modified'] : $content_data['date_added'];

      reset($currencies->currencies);
      while (list($key) = each($currencies->currencies)) {
      
        $string = sprintf(SITEMAP_ENTRY, xos_loc_link('content.php', 'content_id='.$content_data['content_id'].$lang_param.'&currency=' . $key) , PRIORITY_CONTENTS, iso8601_date($date), CHANGEFREQ_CONTENTS);
      
        $function_write($fp, $string);
        $strlen += strlen($string);
      
        $c++;
        if ($autogenerate) {
          // 500000 entrys or filesize > 10,485,760 - some space for the last entry
          if ( $c == MAX_ENTRYS || $strlen >= MAX_SIZE) {
            $function_write($fp, SITEMAP_FOOTER);
            $function_close($fp);
            $c = 0;
            $i++;
            $fp = $function_open(($output_to_doc_root ? str_replace(DIR_WS_CATALOG, '/', DIR_FS_CATALOG) : DIR_FS_CATALOG).'sitemap'.$i.$file_extension, 'w');          
            $function_write($fp, SITEMAP_HEADER);
            $strlen = strlen(SITEMAP_HEADER);
            $string = '';
          }
        }
      }
    }
  }


  $cat_result = xos_db_query("
    SELECT
      c.categories_id,
      c.parent_id,
      cd.language_id,
      UNIX_TIMESTAMP(c.date_added) as date_added,
      UNIX_TIMESTAMP(c.last_modified) as last_modified,
      l.code
    FROM 
      ".TABLE_CATEGORIES." c,
      ".TABLE_CATEGORIES_DESCRIPTION." cd,
      ".TABLE_LANGUAGES." l
    WHERE
      c.categories_status='1' AND
      c.categories_id = cd.categories_id AND
      cd.language_id = l.languages_id
    ORDER by 
      cd.categories_id
  ");

  $cat_array = array();
  if (xos_db_num_rows($cat_result) > 0) {
    while($cat_data = xos_db_fetch_array($cat_result)) {
      $cat_array[$cat_data['categories_id']][$cat_data['code']] = $cat_data;
    }
  }
  reset($cat_array);


  foreach($cat_array as $lang_array) {
    foreach($lang_array as $cat_id => $cat_data) {
    
      $lang_param = '&language='.$cat_data['code'];
      $date = ($cat_data['last_modified'] != NULL) ? $cat_data['last_modified'] : $cat_data['date_added'];

      reset($currencies->currencies);
      while (list($key) = each($currencies->currencies)) {
      
        $string = sprintf(SITEMAP_ENTRY, xos_loc_link('index.php', rv_get_path($cat_data['categories_id'], $cat_data['code']).$lang_param.'&currency=' . $key) ,PRIORITY_CATEGORIES, iso8601_date($date), CHANGEFREQ_CATEGORIES);
      
        $function_write($fp, $string);
        $strlen += strlen($string);
      
        $c++;
        if ($autogenerate) {
          // 500000 entrys or filesize > 10,485,760 - some space for the last entry
          if ( $c == MAX_ENTRYS || $strlen >= MAX_SIZE) {
            $function_write($fp, SITEMAP_FOOTER);
            $function_close($fp);
            $c = 0;
            $i++;
            $fp = $function_open(($output_to_doc_root ? str_replace(DIR_WS_CATALOG, '/', DIR_FS_CATALOG) : DIR_FS_CATALOG).'sitemap'.$i.$file_extension, 'w');          
            $function_write($fp, SITEMAP_HEADER);
            $strlen = strlen(SITEMAP_HEADER);
            $string = '';
          }
        }
      }
    }
  }


  $product_result = xos_db_query("
    SELECT 
      p.products_id,
      pd.language_id,
      UNIX_TIMESTAMP(p.products_date_added) as products_date_added,
      UNIX_TIMESTAMP(p.products_last_modified) as products_last_modified,
      l.code
    FROM 
      ".TABLE_PRODUCTS." p left join 
      ".TABLE_PRODUCTS_TO_CATEGORIES." p2c on p.products_id = p2c.products_id left join 
      ".TABLE_CATEGORIES." c on p2c.categories_id = c.categories_id, 
      ".TABLE_PRODUCTS_DESCRIPTION."  pd,
      ".TABLE_LANGUAGES." l 
    WHERE 
      c.categories_status = '1' and 
      p.products_status = '1' and
      pd.products_id = p.products_id and 
      pd.language_id = l.languages_id
    ORDER BY
      p.products_id
  ");

  if (xos_db_num_rows($product_result) > 0) {
    while($product_data = xos_db_fetch_array($product_result)) {
    
      $lang_param = '&language='.$product_data['code'];
      $date = ($product_data['products_last_modified'] != NULL) ? $product_data['products_last_modified'] : $product_data['products_date_added'];
      
      reset($currencies->currencies);
      while (list($key) = each($currencies->currencies)) {
      
        $string = sprintf(SITEMAP_ENTRY, xos_loc_link('product_info.php', 'products_id='.$product_data['products_id'].$lang_param.'&currency=' . $key) , PRIORITY_PRODUCTS, iso8601_date($date), CHANGEFREQ_PRODUCTS);
      
        $function_write($fp, $string);
        $strlen += strlen($string);
      
        $c++;
        if ($autogenerate) {
          // 500000 entrys or filesize > 10,485,760 - some space for the last entry
          if ( $c == MAX_ENTRYS || $strlen >= MAX_SIZE) {
            $function_write($fp, SITEMAP_FOOTER);
            $function_close($fp);
            $c = 0;
            $i++;
            $fp = $function_open(($output_to_doc_root ? str_replace(DIR_WS_CATALOG, '/', DIR_FS_CATALOG) : DIR_FS_CATALOG).'sitemap'.$i.$file_extension, 'w');          
            $function_write($fp, SITEMAP_HEADER);
            $strlen = strlen(SITEMAP_HEADER);
            $string = '';
          }
        }      
      }
    }
  }


  $function_write($fp, SITEMAP_FOOTER);
  $function_close($fp);
  
  if ($string == '') {
    if ($autogenerate) {
      @unlink(($output_to_doc_root ? str_replace(DIR_WS_CATALOG, '/', DIR_FS_CATALOG) : DIR_FS_CATALOG).'sitemap'.$i.$file_extension);
      $i--;
    } else {
      @unlink(($output_to_doc_root ? str_replace(DIR_WS_CATALOG, '/', DIR_FS_CATALOG) : DIR_FS_CATALOG).'sitemap'.$file_extension);
      $i--;      
    }
  }

  // generates sitemap-index file
  if ($autogenerate && $i > 0) {   
    $notify_url = ($output_to_doc_root ? HTTP_SERVER.'/sitemap_index' : HTTP_SERVER.DIR_WS_CATALOG.'sitemap_index').$file_extension;
    $fp = $function_open(($output_to_doc_root ? str_replace(DIR_WS_CATALOG, '/', DIR_FS_CATALOG) : DIR_FS_CATALOG).'sitemap_index'.$file_extension, 'w');    
    $function_write($fp, SITEMAPINDEX_HEADER);
    for($ii=1; $ii<=$i; $ii++) {   
      $function_write($fp, sprintf(SITEMAPINDEX_ENTRY, ($output_to_doc_root ? HTTP_SERVER.'/sitemap' : HTTP_SERVER.DIR_WS_CATALOG.'sitemap').$ii.$file_extension, iso8601_date(time())));
    }
    $function_write($fp, SITEMAPINDEX_FOOTER);
    $function_close($fp);
  } 
  
  if ($i > 0) {
    echo 'http://www.google.com/webmasters/sitemaps/ping?sitemap='.urlencode($notify_url).'<br /><br />';
    echo 'http://webmaster.live.com/webmaster/ping.aspx?siteMap='.urlencode($notify_url).'<br /><br />';
    echo 'http://submissions.ask.com/ping?sitemap='.urlencode($notify_url).'<br /><br />';
    echo 'http://search.yahooapis.com/SiteExplorerService/V1/updateNotification?appid=YahooDemo&url='.urlencode($notify_url).'<br /><br />';
    echo 'Sitemap: '.$notify_url;

//    if ($notify_google) {
//      fopen('http://www.google.com/webmasters/sitemaps/ping?sitemap='.urlencode($notify_url), 'r');
//    }
  } else {
    echo 'No XML Sitemap saved!';
  }
?>