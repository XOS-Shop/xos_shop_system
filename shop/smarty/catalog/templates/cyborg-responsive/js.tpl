[@{*
********************************************************************************
* project    : XOS-Shop, open source e-commerce system
*              http://www.xos-shop.com
*
* template   : cyborg-responsive
* version    : 1.0.7 for XOS-Shop version 1.0 rc7x
* descrip    : xos-shop template built with Bootstrap3 and theme cyborg                                                                    
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
jQuery("body").attr("class","jq-no-conflict-with-colorbox");
jQuery(document).ready(function($) {

      function getWindowWidth() {
        $('body, html').css('overflow', 'hidden');
        var wW = $(window).width();
        $('body, html').css('overflow', 'auto');
        return wW;     
      }

      if (document.all && !document.addEventListener) { // is IE8 or older
    
        $('#cssmenu > a').removeClass('hidden-xs');
  
      } else {

        $('#cssmenu li.has-sub>span.holder').on('click', function(e){
          if (getWindowWidth() < 768) {
		var element = $(this).parent('li');
		if (element.hasClass('open')) {
			element.removeClass('open');
			element.find('li').removeClass('open');
			element.find('ul').slideUp();
		}
		else {
			element.addClass('open');
			element.children('ul').slideDown();
			element.siblings('li').children('ul').slideUp();
			element.siblings('li').removeClass('open');
			element.siblings('li').find('li').removeClass('open');
			element.siblings('li').find('ul').slideUp();
		}
	  }	
	});
 
              $('.cat-tree-title').find('ul').css('display','none');
              $('.cat-tree-title').mouseenter(function(){
                if (getWindowWidth() > 767) { 
//                  $(".holder").remove();
                  $(this).find('li').removeClass('open');
                  $(this).find('ul').css('display','none');               
                  $(this).children('ul').fadeIn();
                }   
              }).mouseleave(function(){
                if (getWindowWidth() > 767) {
                  $(this).children('ul').css('display','none');
                }  
              });              
              
              $('.main-cat').mouseenter(function(){
                if (getWindowWidth() > 767) {               
                  $(this).children('ul').fadeIn();
                }
              }).mouseleave(function(){
                if (getWindowWidth() > 767) {
                  $(this).children('ul').css('display','none');
                } 
              });
              
              $('.main-cat-selected').mouseenter(function(){
                if (getWindowWidth() > 767) {              
                  $(this).children('ul').fadeIn();
                }
              }).mouseleave(function(){
                if (getWindowWidth() > 767) {
                  $(this).children('ul').css('display','none');
                } 
              });              
                                       
              $('.sub-cat-level1').mouseenter(function(){
                if (getWindowWidth() > 767) {              
                  $(this).children('ul').fadeIn();
                }
              }).mouseleave(function(){
                if (getWindowWidth() > 767) {
                  $(this).children('ul').css('display','none');
                } 
              });
              
              $('.sub-cat-level1-selected').mouseenter(function(){
                if (getWindowWidth() > 767) {               
                  $(this).children('ul').fadeIn();
                }
              }).mouseleave(function(){
                if (getWindowWidth() > 767) {
                  $(this).children('ul').css('display','none');
                } 
              });              
                                                                                                        
              $('.sub-cat-level2').mouseenter(function(){
                if (getWindowWidth() > 767) {             
                  $(this).children('ul').fadeIn();
                }
              }).mouseleave(function(){
                if (getWindowWidth() > 767) {
                  $(this).children('ul').css('display','none');
                } 
              });
              
              $('.sub-cat-level2-selected').mouseenter(function(){
                if (getWindowWidth() > 767) {             
                  $(this).children('ul').fadeIn();
                }
              }).mouseleave(function(){
                if (getWindowWidth() > 767) {
                  $(this).children('ul').css('display','none');
                } 
              });              
              
              $('.sub-cat-level3').mouseenter(function(){
                if (getWindowWidth() > 767) {               
                  $(this).children('ul').fadeIn();
                }
              }).mouseleave(function(){
                if (getWindowWidth() > 767) {
                  $(this).children('ul').css('display','none');
                } 
              });
              
              $('.sub-cat-level3-selected').mouseenter(function(){
                if (getWindowWidth() > 767) {        
                  $(this).children('ul').fadeIn();
                }
              }).mouseleave(function(){
                if (getWindowWidth() > 767) {
                  $(this).children('ul').css('display','none');
                } 
              });                              
      }
            

  if (!$(".jq-no-conflict-with-colorbox").length > 0) {
/*  
    $(".lightbox-system-popup").colorbox();
*/    
    $(".lightbox-system-popup").on("click", function(){
       var url = $(this).attr("href"),
//           titleText = $(this).attr("title"),
           outerWidth = false,
           outerHeight = false,
           width = $(this).attr("class").toLowerCase().slice($(this).attr("class").toLowerCase().indexOf("width")).split(" ")[0].replace("width=","").replace("width","").replace("px","").replace("p","%"),
           height = $(this).attr("class").toLowerCase().slice($(this).attr("class").toLowerCase().indexOf("height")).split(" ")[0].replace("height=","").replace("height","").replace("px","").replace("p","%");
          
       if(isNaN(width.replace("%","")) || width.replace("%","").length < 1){
         if (getWindowWidth() < 768) {
           width = '90%';
         } else {
           width = 700;
         }
       } else if (!isNaN(width)) {
         width = Math.round(width);
       } else {
         outerWidth = width;
         width = false;
       }  
     
       if(isNaN(height.replace("%","")) || height.replace("%","").length < 1){
         height = '80%';
       } else if (!isNaN(height)) {
         height = Math.round(height);
       } else {
         outerHeight = height;
         height = false;
       }          
     
       $.colorbox({
         href: url, 
         width:outerWidth,
         height:outerHeight, 
         innerWidth:width,
         innerHeight:height,
//         title:titleText,
         iframe:true  
       });
       return false;
    });     
  
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
//           titleText = $(this).attr("title"),
           outerWidth = false,
           outerHeight = false,
           width = $(this).attr("class").toLowerCase().slice($(this).attr("class").toLowerCase().indexOf("width")).split(" ")[0].replace("width=","").replace("width","").replace("px","").replace("p","%"),
           height = $(this).attr("class").toLowerCase().slice($(this).attr("class").toLowerCase().indexOf("height")).split(" ")[0].replace("height=","").replace("height","").replace("px","").replace("p","%");
          
       if(isNaN(width.replace("%","")) || width.replace("%","").length < 1){
         width = '10%';
       } else if (!isNaN(width)) {
         width = Math.round(width);
       } else {
         outerWidth = width;
         width = false;
       } 
     
       if(isNaN(height.replace("%","")) || height.replace("%","").length < 1){
         height = '10%';
       } else if (!isNaN(height)) {
         height = Math.round(height);
       } else {
         outerHeight = height;
         height = false;
       }         
     
       $.colorbox({
         href: url,
         width:outerWidth,
         height:outerHeight, 
         innerWidth:width,
         innerHeight:height,
//         title:titleText,
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
  }
}); 

/* Put here your javascript code */