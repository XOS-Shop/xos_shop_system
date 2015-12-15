<?php 
  $javascript = '<script type="text/javascript" src="' . DIR_WS_ADMIN . 'includes/general.js"></script>' . "\n" .
                '<script type="text/javascript">' . "\n" .
                '/* <![CDATA[ */' . "\n\n" .
                
                'function adjustHeight() {' . "\n" . 
                '  var agent = navigator.userAgent.toLowerCase();' . "\n" .              
                '  if (window.innerHeight) {' . "\n" .
                '    document.getElementById("main-div").style.height = window.innerHeight + "px";' . "\n" .
                '  } else if (document.documentElement && document.documentElement.clientHeight) {' . "\n" .  
                '    document.getElementById("main-div").style.height = document.documentElement.clientHeight + "px";' . "\n" . 
                '    if (agent.indexOf("MSIE 5".toLowerCase())>-1 || agent.indexOf("MSIE 6".toLowerCase())>-1 || agent.indexOf("MSIE 7".toLowerCase())>-1) {' . "\n" .  
                '      document.getElementById("inner-div").style.width = document.documentElement.clientWidth-20 + "px";' . "\n" . 
                '    }' . "\n" .
                '  }' . "\n" .                
                '}' . "\n\n" .

                'window.onresize = function(){adjustHeight();}' . "\n\n" .
                   
                '/* ]]> */' . "\n" .
                '</script>' . "\n"; 
                
  if ($messageStack->size('header') > 0) {
    $smarty->assign('message_stack_output', $messageStack->output('header'));
  } 
//  return 'overwrite_all';
?>