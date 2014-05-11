////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : toggle_xmlhttp.js
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
////////////////////////////////////////////////////////////////////////////////


var http_request = false;

function dbImport(url, params) {

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
    alert("Ende : Kann keine XMLHTTP-Instanz erzeugen");
    return false;
  }
  http_request.onreadystatechange = response_processing;
  http_request.open("POST", url, true);
  http_request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  http_request.send(params);

}

function response_processing() {

  if (http_request.readyState == 4) {
    if (http_request.status == 200) {
      document.getElementById("infoSend").innerHTML = http_request.responseText;
    } else {
      alert("Bei dem Request ist ein Problem aufgetreten.");
    }
  }
}

function toggleBox(szDivID) {

  var obj = document.getElementById(szDivID);
  var objSD = document.getElementById(szDivID+"SD");

  if (obj.style.visibility == 'visible') {
    obj.style.visibility = "hidden";
    obj.style.display = "none";
    objSD.style.fontWeight = "normal";
    objSD.style.fontSize = "9px";
  } else {
    obj.style.visibility = "visible";
    obj.style.display = "inline";
    objSD.style.fontWeight = "bold";
    objSD.style.fontSize = "11px";
  }
}
