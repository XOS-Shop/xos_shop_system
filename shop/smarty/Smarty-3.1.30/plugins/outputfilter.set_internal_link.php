<?php 
 /*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     outputfilter.set_internal_link.php
 * Type:     outputfilter
 * Name:     set_internal_link
 * Purpose:  Sets internal links from database contents
 * -------------------------------------------------------------
 */
function smarty_outputfilter_set_internal_link($source, Smarty_Internal_Template $smarty)
{
    return preg_replace_callback('#\[@\{link(.*)\}@\]#siU', create_function('$match', 'return eval("return ".$match[1].";");'), $source);
}
/*
function smarty_outputfilter_set_internal_link($source, Smarty_Internal_Template $smarty)
{
    return preg_replace_callback('#\[@\{link(.*)\}@\]#siU', 'set_internal_link', $source);
}

function set_internal_link($match) 
{   
    return eval('return '.$match[1].';');
}
*/
?>