[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : hero-responsive
* version    : 1.0.7 for XOS-Shop version 1.0.2
* descrip    : xos-shop template built with Bootstrap3 and theme superhero                                                                    
* filename   : newsletter_email_html.tpl
* author     : Hanspeter Zeller <hpz@xos-shop.com>
* copyright  : Copyright (c) 2007 Hanspeter Zeller
* license    : This file is part of XOS-Shop.
*
*              XOS-Shop is free software: you can redistribute it and/or modify
*              it under the terms of the GNU General Public License as published
*              by the Free Software Foundation, either version 3 of the License,
*              or (at your option) any later version.
*
*              XOS-Shop is distributed in the hope that it will be useful,
*              but WITHOUT ANY WARRANTY; without even the implied warranty of
*              MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*              GNU General Public License for more details.
*
*              You should have received a copy of the GNU General Public License
*              along with XOS-Shop.  If not, see <http://www.gnu.org/licenses/>. 
********************************************************************************
*}@]
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="[@{$html_lang}@]" xml:lang="[@{$html_lang}@]">
<head>
<meta http-equiv="content-type" content="text/html; charset=[@{$charset}@]" />
<meta http-equiv="content-language" content="[@{$html_lang}@]" />
<meta http-equiv="content-style-type" content="text/css" />
<meta name="generator" content="XOS-Shop version 1.0.2, open source e-commerce system" />
[@{if $base_href}@]
<base href="[@{$base_href}@]" />
[@{/if}@]
<title></title>
</head>
<body>
[@{$content_text_htlm}@]
<div style="font-family: Verdana, Arial, sans-serif; font-size: 12px;">&nbsp;<br />&nbsp;</div>
<div style="font-size: 1px; line-height: 1px; height: 1px; width: 100%; border-top: 1px solid black;">&nbsp;</div>
<div style="font-family: Verdana, Arial, sans-serif; font-size: 12px;">&nbsp;</div>
<div style="font-family: Verdana, Arial, sans-serif; font-size: 11px;">
[@{#html_email_text_newsletter_unsubscribe#}@]<br />
