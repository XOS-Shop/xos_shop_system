[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : black-tabs-cbox
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
    
  $(".lightbox-system-popup").colorbox(); 
  
  $(".lightbox,.lightbox-ajax").colorbox();

  $(".lightbox-inline").colorbox({
    onLoad: function() { $("#inline").css({'text-align':'left'}); },
    inline: true  
  });
  
  $(".lightbox-image").colorbox({
    maxWidth:'90%',
    maxHeight:'90%',
    photo:true
  });
  
  $(".lightbox-iframe,.lightbox-swf").on("click", function(){
     var url = $(this).attr("href"),
//         titleText = $(this).attr("title"),
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
     
     $.colorbox({
       href: url, 
       innerWidth:width,
       innerHeight:height,
//       title:titleText,
       iframe:true  
     });
     return false;
  });
    
  $(document).bind("cbox_complete", function(){
    if($("#cboxTitle").height() > 20){ 
      $("#cboxTitle").hide(); 
      $("#cboxLoadedContent").append('<div style="color:'+$("#cboxTitle").css("color")+';">'+$("#cboxTitle").html()+'</div>'); 
      $(this).colorbox.resize(); 
    }
  });            		
});

/* Put here your javascript code */