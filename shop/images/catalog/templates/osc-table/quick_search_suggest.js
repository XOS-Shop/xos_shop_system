////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//
// template   : osc-table
// version    : 1.0.7 for XOS-Shop version 1.0 rc7s
// descrip    : oscommerce default template with css-buttons and tables for layout                                                                 
// filename   : quick_search_suggest.js
// author     : Hanspeter Zeller <hpz@xos-shop.com>
// copyright  : Copyright (c) 2009 Hanspeter Zeller
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
////////////////////////////////////////////////////////////////////////////////


function quick_search_suggest(input_id, output_id, url) {

    var input_element = document.getElementById(input_id);  
    var output_element = document.getElementById(output_id);

    String.prototype.trim = function() {
      return this.replace(/^\s+|\s+$/g,"");
    }
    
    request_suggest = function() {
      
      url_data = encodeURI(url + input_element.value.trim());  
      http_request = false; 
      
      if (window.XMLHttpRequest) { // Mozilla, Safari,...
        http_request = new XMLHttpRequest();
        if (http_request.overrideMimeType) {
          http_request.overrideMimeType("text/html");
        }
      } else if (window.ActiveXObject) { // IE
        try {
          http_request = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
          try {
            http_request = new ActiveXObject("Microsoft.XMLHTTP");
          } catch (e) {}
        }
      }

      if (!http_request) {
//        alert("Ende : Kann keine XMLHTTP-Instanz erzeugen");  // for debugging
        return false;
      }     
     
      http_request.onreadystatechange = response_processing;
      http_request.open('GET', url_data, true);
      http_request.send(null);
    };
       
    function response_processing() {
      if (http_request.readyState == 4) {
        if (http_request.status == 200) {
          output_element.innerHTML = http_request.responseText;
          output_element.style.visibility = 'visible';
        } else {
//          alert("Bei dem Request ist ein Problem aufgetreten.");  // for debugging
        }
      }
    }    

    input_element.onkeyup = function(e) {
      if(input_element.value.trim().length > 2) {
        request_suggest();
      } else {
        output_element.style.visibility = 'hidden'
      }
    }; 
    
    input_element.onblur = function(e) {
      setTimeout(function() {
        output_element.style.visibility = 'hidden';
      }, 500);
    };
    
    input_element.onfocus = function(e) {
      if(input_element.value.trim().length > 2) {
//        request_suggest();
        output_element.style.visibility = 'visible';
      }
    };
};