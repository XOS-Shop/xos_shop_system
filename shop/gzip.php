<?php
//turn off all error reporting
error_reporting(0);
  
$allowed = array('css','js','svg','ttf'); //set array of allowed file types to prevent abuse
  
//check for request variable existence and that file type is allowed
if(isset($_GET['file']) && isset($_GET['type']) && in_array(substr($_GET['file'],strrpos($_GET['file'],'.')+1), $allowed)){
    $data = file_get_contents(dirname(__FILE__).'/'.$_GET['file']); // grab the file contents
  
    $etag = '"'.md5($data).'"'; // generate a file Etag
    header('Etag: '.$etag); // output the Etag in the header
  
    // output the content-type header for each file type
    switch ($_GET['type']) {
        case 'css':       
            header ("Content-Type: text/css; charset=UTF-8");
        break;
  
        case 'js':       
            header ("Content-Type: text/javascript; charset=UTF-8");
        break;

        case 'svg':
            header ("Content-Type: image/svg+xml");
        break;

        case 'ttf':        
            header ("Content-Type: application/x-font-ttf");
        break;
    }
  
    header('Cache-Control: max-age=604800, must-revalidate'); //output the cache-control header
    $offset = 60 * 60 * 24 * 7;
    $expires = 'Expires: ' . gmdate('D, d M Y H:i:s',time() + $offset) . ' GMT'; // set the expires header to be 1 hour in the future
    header($expires); // output the expires header
  
    // check the Etag the browser already has for the file and only serve the file if it is different
    if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && $etag == stripslashes($_SERVER['HTTP_IF_NONE_MATCH'])) {
        header('HTTP/1.1 304 Not Modified');
        header('Content-Length: 0');
    } else {
        header ("Content-Encoding: gzip");
        echo gzencode($data, 9);
    }
}
?>