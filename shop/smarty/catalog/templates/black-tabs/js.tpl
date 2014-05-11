[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : black-tabs
* version    : 1.0.7 for XOS-Shop version 1.0 rc7s
* descrip    : xos-shop default template with tabs navigation
*              and popup windows as lightboxes and div/css layout                                                                     
* filename   : js.tpl
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
jQuery(document).ready(function($) {
            if(!(typeof document.body.style.maxHeight === 'undefined') && !(navigator.userAgent.toLowerCase().indexOf('konqueror') > -1)) {  // is not IE6 and not Konqueror
              $('.sub-cat-level1').children('ul').css('display','none');
              $('.sub-cat-level2').children('ul').css('display','none');
              $('.sub-cat-level3').children('ul').css('display','none');
              $('.sub-cat-level1').mouseenter(function(){                
                $(this).children('ul').css({'box-shadow' : '3px 3px 7px #333333', '-moz-box-shadow' : '3px 3px 7px #333333', '-webkit-box-shadow' : '3px 3px 7px #333333'}).show(200); 
              }).mouseleave(function(){
                $(this).children('ul').css('display','none');
              });
                                                                                                        
              $('.sub-cat-level2').mouseenter(function(){                
                $(this).children('ul').css({'box-shadow' : '3px 3px 7px #333333', '-moz-box-shadow' : '3px 3px 7px #333333', '-webkit-box-shadow' : '3px 3px 7px #333333'}).show(200); 
              }).mouseleave(function(){
                $(this).children('ul').css('display','none');
              });
              
              $('.sub-cat-level3').mouseenter(function(){                
                $(this).children('ul').css({'box-shadow' : '3px 3px 7px #333333', '-moz-box-shadow' : '3px 3px 7px #333333', '-webkit-box-shadow' : '3px 3px 7px #333333'}).show(200); 
              }).mouseleave(function(){
                $(this).children('ul').css('display','none');
              });              
            }; 

    if(!(typeof document.body.style.maxHeight === 'undefined') && !(navigator.userAgent.toLowerCase().indexOf('konqueror') > -1)) {  // is not IE6 and not Konqueror
      $('.tab-main-cat').children('ul').css('display','none');
      $('.tab-main-cat-selected').children('ul').css('display','none');
      $('.tab-sub-cat-level1').children('ul').css('display','none');
      $('.tab-sub-cat-level1-selected').children('ul').css('display','none');
      $('.tab-sub-cat-level2').children('ul').css('display','none');
      $('.tab-sub-cat-level2-selected').children('ul').css('display','none');
      $('.tab-sub-cat-level3').children('ul').css('display','none');
      $('.tab-sub-cat-level3-selected').children('ul').css('display','none');      
      $('.tab-main-cat').mouseenter(function(){                
        $(this).children('ul').css({'box-shadow' : '3px 3px 7px #333333', '-moz-box-shadow' : '3px 3px 7px #333333', '-webkit-box-shadow' : '3px 3px 7px #333333'}).show(200); 
      }).mouseleave(function(){
        $(this).children('ul').css('display','none');
      });
                                                                          
      $('.tab-main-cat-selected').mouseenter(function(){                
        $(this).children('ul').css({'box-shadow' : '3px 3px 7px #333333', '-moz-box-shadow' : '3px 3px 7px #333333', '-webkit-box-shadow' : '3px 3px 7px #333333'}).show(200); 
      }).mouseleave(function(){
        $(this).children('ul').css('display','none');
      }); 
                  
      $('.tab-sub-cat-level1').mouseenter(function(){                
        $(this).children('ul').css({'box-shadow' : '3px 3px 7px #333333', '-moz-box-shadow' : '3px 3px 7px #333333', '-webkit-box-shadow' : '3px 3px 7px #333333'}).show(200); 
      }).mouseleave(function(){
        $(this).children('ul').css('display','none');
      });
      
      $('.tab-sub-cat-level1-selected').mouseenter(function(){                
        $(this).children('ul').css({'box-shadow' : '3px 3px 7px #333333', '-moz-box-shadow' : '3px 3px 7px #333333', '-webkit-box-shadow' : '3px 3px 7px #333333'}).show(200); 
      }).mouseleave(function(){
        $(this).children('ul').css('display','none');
      });      
                  
      $('.tab-sub-cat-level2').mouseenter(function(){                
        $(this).children('ul').css({'box-shadow' : '3px 3px 7px #333333', '-moz-box-shadow' : '3px 3px 7px #333333', '-webkit-box-shadow' : '3px 3px 7px #333333'}).show(200); 
      }).mouseleave(function(){
        $(this).children('ul').css('display','none');
      });
      
      $('.tab-sub-cat-level2-selected').mouseenter(function(){                
        $(this).children('ul').css({'box-shadow' : '3px 3px 7px #333333', '-moz-box-shadow' : '3px 3px 7px #333333', '-webkit-box-shadow' : '3px 3px 7px #333333'}).show(200); 
      }).mouseleave(function(){
        $(this).children('ul').css('display','none');
      });
      
      $('.tab-sub-cat-level3').mouseenter(function(){                
        $(this).children('ul').css({'box-shadow' : '3px 3px 7px #333333', '-moz-box-shadow' : '3px 3px 7px #333333', '-webkit-box-shadow' : '3px 3px 7px #333333'}).show(200); 
      }).mouseleave(function(){
        $(this).children('ul').css('display','none');
      });
      
      $('.tab-sub-cat-level3-selected').mouseenter(function(){                
        $(this).children('ul').css({'box-shadow' : '3px 3px 7px #333333', '-moz-box-shadow' : '3px 3px 7px #333333', '-webkit-box-shadow' : '3px 3px 7px #333333'}).show(200); 
      }).mouseleave(function(){
        $(this).children('ul').css('display','none');
      });            
    };
/*    
  $(".lightbox-system-popup").fancybox({
    'transitionIn':'fade',
    'transitionOut':'fade',
    'padding':4,
    'titleFormat':function(title) { return '<span style="white-space: nowrap; color: #fff; font-size: 16px; font-weight: bold; display: block;">' + title + '</span>'; },
    'onStart':function() { $("#fancybox-content").css({'text-align':'left','border-color':'#b2b2b2'}); },
    'onClosed':function() { $("#fancybox-content").css({'border-color':'#fff'}); }
  });
*/
  $(".lightbox-system-popup").on("click", function(){
     var url = $(this).attr("href"),
         width = $(this).attr("class").toLowerCase().slice($(this).attr("class").toLowerCase().indexOf("width")).split(" ")[0].replace("width=","").replace("width","").replace("px","").replace("p","%"),
         height = $(this).attr("class").toLowerCase().slice($(this).attr("class").toLowerCase().indexOf("height")).split(" ")[0].replace("height=","").replace("height","").replace("px","").replace("p","%");
          
     if(isNaN(width.replace("%","")) || width.replace("%","").length < 1){
       width = 700;
     } else if (!isNaN(width)) {
       width = Math.round(width);
     } 
     
     if(isNaN(height.replace("%","")) || height.replace("%","").length < 1){
       height = '90%';
     } else if (!isNaN(height)) {
       height = Math.round(height);
     }          
     
     $.fancybox({
       'href':url, 
       'width':width,
       'height':height,
       'autoScale':false,
       'transitionIn':'fade',
       'transitionOut':'fade',
       'padding':4,
       'titleFormat':function(title) { return '<span style="white-space: nowrap; color: #fff; font-size: 16px; font-weight: bold; display: block;">' + title + '</span>'; },    
       'onStart':function() { $("#fancybox-content").css({'text-align':'left','border-color':'#b2b2b2'}); },
       'onClosed':function() { $("#fancybox-content").css({'border-color':'#fff'}); },    
       'type':'iframe' 
     });
     return false;
  });    
  
  $(".lightbox,.lightbox-ajax,.lightbox-inline").fancybox({
    'transitionIn':'fade',
    'transitionOut':'fade',
    'padding':4,
    'titleFormat':function(title, currentArray, currentIndex, currentOpts) { return currentArray.length > 1 ? '<span style="white-space: nowrap; color: #fff; font-size: 16px; font-weight: bold; display: block;">' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length > 0 ? ' | ' : '') + title + '</span>' : '<span style="white-space: nowrap; color: #fff; font-size: 16px; font-weight: bold; display: block;">' + title + '</span>' ; }, 
    'onStart':function() { $("#fancybox-content").css({'text-align':'left','border-color':'#b2b2b2'}); },
    'onClosed':function() { $("#fancybox-content").css({'border-color':'#fff'}); }
  });  
  
  $(".lightbox-image").fancybox({
    'transitionIn':'elastic',
    'transitionOut':'elastic',
    'padding':4,
    'titleFormat':function(title, currentArray, currentIndex, currentOpts) { return currentArray.length > 1 ? '<span style="white-space: nowrap; color: #fff; font-size: 16px; font-weight: bold; display: block;">' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length > 0 ? ' | ' : '') + title + '</span>' : '<span style="white-space: nowrap; color: #fff; font-size: 16px; font-weight: bold; display: block;">' + title + '</span>' ; }, 
    'onStart':function() { $("#fancybox-content").css({'text-align':'left','border-color':'#b2b2b2'}); },
    'onClosed':function() { $("#fancybox-content").css({'border-color':'#fff'}); }
  });  

  $(".lightbox-iframe").on("click", function(){
     var url = $(this).attr("href"),
         width = $(this).attr("class").toLowerCase().slice($(this).attr("class").toLowerCase().indexOf("width")).split(" ")[0].replace("width=","").replace("width","").replace("px","").replace("p","%"),
         height = $(this).attr("class").toLowerCase().slice($(this).attr("class").toLowerCase().indexOf("height")).split(" ")[0].replace("height=","").replace("height","").replace("px","").replace("p","%");
          
     if(isNaN(width.replace("%","")) || width.replace("%","").length < 1){
       width = '10%';
     } else if (!isNaN(width)) {
       width = Math.round(width);
     } 
     
     if(isNaN(height.replace("%","")) || height.replace("%","").length < 1){
       height = '10%';
     } else if (!isNaN(height)) {
       height = Math.round(height);
     }          
     
     $.fancybox({
       'href':url, 
       'width':width,
       'height':height,
       'autoScale':false,
       'transitionIn':'fade',
       'transitionOut':'fade',
       'padding':4,
       'titleFormat':function(title) { return '<span style="white-space: nowrap; color: #fff; font-size: 16px; font-weight: bold; display: block;">' + title + '</span>'; },    
       'onStart':function() { $("#fancybox-content").css({'text-align':'left','border-color':'#b2b2b2'}); },
       'onClosed':function() { $("#fancybox-content").css({'border-color':'#fff'}); },    
       'type':'iframe' 
     });
     return false;
  });
  
  $(".lightbox-swf").fancybox({
    'autoScale':false,
    'transitionIn':'fade',
    'transitionOut':'none',
    'padding':4,
    'titleFormat':function(title, currentArray, currentIndex, currentOpts) { return currentArray.length > 1 ? '<span style="white-space: nowrap; color: #fff; font-size: 16px; font-weight: bold; display: block;">' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length > 0 ? ' | ' : '') + title + '</span>' : '<span style="white-space: nowrap; color: #fff; font-size: 16px; font-weight: bold; display: block;">' + title + '</span>' ; },     
    'onStart':function() { $("#fancybox-content").css({'text-align':'left','border-color':'#b2b2b2'}); $("#fancybox-left,#fancybox-right").css({'bottom':'40%','width':'20%','height':'20%'}); },
    'onCleanup':function() { $("#fancybox-left,#fancybox-right").css({'bottom':'0px','width':'35%','height':'100%'}); },	
    'onClosed':function() { $("#fancybox-content").css({'border-color':'#fff'}); }	
  });              		
});

/* Put here your javascript code */