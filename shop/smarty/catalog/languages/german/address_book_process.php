<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                                                                                      
// filename   : address_book_process.php
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
//------------------------------------------------------------------------------
// this file is based on: 
//              osCommerce, Open Source E-Commerce Solutions
//              http://www.oscommerce.com
//              Copyright (c) 2003 osCommerce
//              filename: address_book_process.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('NAVBAR_TITLE_1', 'Ihr Konto');
define('NAVBAR_TITLE_2', 'Adressbuch');

define('NAVBAR_TITLE_ADD_ENTRY', 'Neuer Eintrag');
define('NAVBAR_TITLE_MODIFY_ENTRY', 'Eintrag ändern');
define('NAVBAR_TITLE_DELETE_ENTRY', 'Eintrag löschen');

define('EMAIL_SUBJECT_TAX_ID_ADDED', 'Steuernummer hinzugefügt');
define('EMAIL_TEXT_TAX_ID_ADDED', '%s %s der Firma %s hat seinem Adressbuch eine Steuernummer hinzugefügt.');

define('SUCCESS_ADDRESS_BOOK_ENTRY_DELETED', 'Der ausgewählte Eintrag wurde erflogreich gelöscht.');
define('SUCCESS_ADDRESS_BOOK_ENTRY_UPDATED', 'Ihr Adressbuch wurde erfolgreich aktualisiert!');

define('WARNING_PRIMARY_ADDRESS_DELETION', 'Die Standardadresse kann nicht gelöscht werden. Bitte erst eine andere Standardadresse wählen. Danach kann der Eintrag gelöscht werden.');

define('ERROR_NONEXISTING_ADDRESS_BOOK_ENTRY', 'Dieser Adressbucheintrag ist nicht vorhanden.');
define('ERROR_ADDRESS_BOOK_FULL', 'Ihr Adressbuch kann keine weiteren Adressen aufnehmen. Bitte löschen Sie eine nicht mehr benötigte Adresse. Danach können Sie einen neuen Eintrag speichern.');
?>
