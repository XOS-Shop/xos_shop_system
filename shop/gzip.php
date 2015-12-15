<?php
// turn off all error reporting
error_reporting(0);
  
$allowed = array('css','js','svg','ttf'); //set array of allowed file types to prevent abuse
  
// check for request variable existence and that file type is allowed
if (isset($_GET['file']) && isset($_GET['type']) && in_array(substr($_GET['file'],strrpos($_GET['file'],'.')+1), $allowed)){
    $data = file_get_contents(dirname(__FILE__).'/'.$_GET['file']); // grab the file contents
    $last_modified = filemtime(dirname(__FILE__).'/'.$_GET['file']); // get the last-modified-date of the file  
    $etag = '"' . md5($last_modified . $data) . '"'; // generate a file Etag 
    
    header('Etag: ' . $etag); // output the Etag in the header
    header('Vary: Accept-Encoding'); // make sure proxy's store both a compressed and uncompressed version of the file 
    
    // check if file has changed. If not, send 304 and exit  
    if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && $etag == trim($_SERVER['HTTP_IF_NONE_MATCH'])) {  
        header('HTTP/1.1 304 Not Modified');
        exit;
    }    
    
    // output the content-type header for each file type
    switch ($_GET['type']) {
        case 'css':       
            header('Content-Type: text/css');
            header('Cache-Control: max-age=604800, public'); // if 'Cache-Control' is needed
        break;
  
        case 'js':       
            header('Content-Type: text/javascript');
            header('Cache-Control: max-age=216000, private'); // if 'Cache-Control' is needed
        break;

        case 'svg':
            header('Content-Type: image/svg+xml');
            header('Cache-Control: max-age=2592000, public'); // if 'Cache-Control' is needed
        break;

        case 'ttf':        
            header('Content-Type: application/x-font-ttf');
            header('Cache-Control: max-age=2592000, public'); // if 'Cache-Control' is needed
        break;
    }

    header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $last_modified) . ' GMT'); // set last-modified header   
    header('Content-Encoding: gzip'); 
    
    echo gzencode($data, 9);
}
?>