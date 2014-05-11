<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : german.php
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
//              filename: german.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on Unix/Linux system try 'de_DE.UTF8'
// on Windows environment try 'deu' or 'german' or 'German_Germany.1252'
@setlocale(LC_TIME, 'de_DE.UTF8');

define('DATE_FORMAT_SHORT', '%d.%m.%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A, %d. %B %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd.m.Y');  // this is used for strftime()
define('PHP_DATE_TIME_FORMAT', 'd.m.Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S'); // this is used for strftime()

// this array is used for function xos_date_format()
$day_month_names = array(
		   'day_0' => 'Sonntag',
		   'day_1' => 'Montag',
		   'day_2' => 'Dienstag',
		   'day_3' => 'Mittwoch',
		   'day_4' => 'Donnerstag',
		   'day_5' => 'Freitag',
		   'day_6' => 'Samstag',

		   'day_short_0' => 'So',
		   'day_short_1' => 'Mo',
		   'day_short_2' => 'Di',
		   'day_short_3' => 'Mi',
		   'day_short_4' => 'Do',
		   'day_short_5' => 'Fr',
		   'day_short_6' => 'Sa',

		   'month_01' => 'Januar',
		   'month_02' => 'Februar',
		   'month_03' => 'März',
		   'month_04' => 'April',
		   'month_05' => 'Mai ', //The spaces at the end of (Mai ) is very important
		   'month_06' => 'Juni',
		   'month_07' => 'Juli',
		   'month_08' => 'August',
		   'month_09' => 'September',
		   'month_10' => 'Oktober',
		   'month_11' => 'November',
		   'month_12' => 'Dezember',

		   'month_short_01' => 'Jan',
		   'month_short_02' => 'Feb',
		   'month_short_03' => 'Mär',
		   'month_short_04' => 'Apr',
		   'month_short_05' => 'Mai',
		   'month_short_06' => 'Jun',
		   'month_short_07' => 'Jul',
		   'month_short_08' => 'Aug',
		   'month_short_09' => 'Sep',
		   'month_short_10' => 'Okt',
		   'month_short_11' => 'Nov',
		   'month_short_12' => 'Dez');

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function xos_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 0, 2) . substr($date, 3, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
  }
}

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="de"');

// language attribute for the <html> tag
define('XHTML_LANG','de');

// charset for web pages and emails
define('CHARSET', 'UTF-8');

// Admin Account
define('BOX_HEADING_MY_ACCOUNT', 'Mein Konto');

// configuration box text in includes/boxes/menubox_administrator.php
define('BOX_HEADING_ADMINISTRATOR', 'Administrator');
define('BOX_ADMINISTRATOR_MEMBERS', 'Admin Mitglieder');
define('BOX_ADMINISTRATOR_MEMBER', 'Mitglieder');
define('BOX_ADMINISTRATOR_GROUPS', 'Admin Gruppen');
define('BOX_ADMINISTRATOR_GROUP', 'Gruppen');
define('BOX_ADMINISTRATOR_BOXES', 'Gruppen/Mitglieder');

// images
define('IMAGE_FILE_PERMISSION', 'Datei Rechte');
define('IMAGE_GROUPS', 'Gruppen Liste');
define('IMAGE_INSERT_FILE', 'Datei einfügen');
define('IMAGE_MEMBERS', 'Mitglieder Liste');
define('IMAGE_NEXT', 'Weiter');

// constants for use in xos_prev_next_display function
define('TEXT_DISPLAY_NUMBER_OF_FILENAMES', 'Zeige <b>%d</b> - <b>%d</b> (von <b>%d</b> Dateien)');
define('TEXT_DISPLAY_NUMBER_OF_MEMBERS', 'Zeige <b>%d</b> - <b>%d</b> (von <b>%d</b> Mitgliedern)');

// text for gender
define('MALE', 'Herr');
define('FEMALE', 'Frau');

// configuration box text in includes/boxes/menubox_configuration.php
define('BOX_HEADING_CONFIGURATION', 'Konfiguration');
define('BOX_CONFIGURATION_MYSTORE', 'Mein Shop');
define('BOX_CONFIGURATION_LOGGING', 'Protokollierung');
define('BOX_CONFIGURATION_SMARTY_TEMPLATE', 'Smarty&nbsp;Template');
define('BOX_CONFIGURATION_1', 'Mein Shop');
define('BOX_CONFIGURATION_2', 'Minimum-Werte');
define('BOX_CONFIGURATION_3', 'Maximum-Werte'); 
define('BOX_CONFIGURATION_4', 'Bilder');
define('BOX_CONFIGURATION_5', 'Kunden-Details');
define('BOX_CONFIGURATION_6', 'Module Optionen');
define('BOX_CONFIGURATION_7', 'Versand/Verpackung');
define('BOX_CONFIGURATION_8', 'Produktliste A');
define('BOX_CONFIGURATION_9', 'Produktliste B');
define('BOX_CONFIGURATION_10', 'Lager'); 
define('BOX_CONFIGURATION_11', 'Protokollierung'); 
define('BOX_CONFIGURATION_12', 'Smarty&nbsp;Template'); 
define('BOX_CONFIGURATION_13', 'eMail');
define('BOX_CONFIGURATION_14', 'Download');
define('BOX_CONFIGURATION_15', 'GZip-Kompression');
define('BOX_CONFIGURATION_16', 'Sessions');
define('BOX_CONFIGURATION_17', 'Website-Abschaltung');

// modules box heading text in includes/boxes/menubox_modules.php
define('BOX_HEADING_MODULES', 'Module');
define('BOX_MODULES_PAYMENT', 'Zahlungsweise');
define('BOX_MODULES_SHIPPING', 'Versandart');

// categories box text in includes/boxes/menubox_catalog.php
define('BOX_HEADING_CATALOG', 'Katalog');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Kategorien / Artikel');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Produktmerkmale');
define('BOX_CATALOG_MANUFACTURERS', 'Hersteller');
define('BOX_CATALOG_REVIEWS', 'Produktbewertungen');
define('BOX_CATALOG_SPECIALS', 'Sonderangebote');
define('BOX_CATALOG_UPDATE_PRODUCTS_PRICES', 'Preise aktualisieren');
define('BOX_CATALOG_XSELL_PRODUCTS', 'Cross Marketing');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'erwartete Artikel');

// customers box text in includes/boxes/menubox_customers.php
define('BOX_HEADING_CUSTOMERS', 'Kunden');
define('BOX_CUSTOMERS_CUSTOMERS', 'Kunden');
define('BOX_CUSTOMERS_ORDERS', 'Bestellungen');
define('BOX_CUSTOMERS_GROUPS', 'Kundengruppen');

// taxes box text in includes/boxes/menubox_taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Land / Steuer');
define('BOX_TAXES_COUNTRIES', 'Land');
define('BOX_TAXES_ZONES', 'Kantone/Bundesländer');
define('BOX_TAXES_GEO_ZONES', 'Steuerzonen');
define('BOX_TAXES_TAX_CLASSES', 'Steuerklassen');
define('BOX_TAXES_TAX_RATES', 'Steuersätze');

// reports box text in includes/boxes/menubox_reports.php
define('BOX_HEADING_REPORTS', 'Berichte');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'besuchte Artikel');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'gekaufte Artikel');
define('BOX_REPORTS_ORDERS_TOTAL', 'Kunden-Bestellstatistik');
define('BOX_REPORTS_CREDITS', 'Kunden Gutschein-Guthaben');

// tools text in includes/boxes/menubox_tools.php
define('BOX_HEADING_TOOLS', 'Hilfsprogramme');
define('BOX_TOOLS_ACTION_RECORDER', 'Aktionen-Rekorder');
define('BOX_TOOLS_BACKUP', 'Datenbanksicherung');
define('BOX_TOOLS_BANNER_MANAGER', 'Banner Manager');
define('BOX_TOOLS_SMARTY_CACHE', 'Smarty Cache Kontrolle');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Sprachen definieren');
define('BOX_TOOLS_FILE_MANAGER', 'Datei-Manager');
define('BOX_TOOLS_IMAGE_PROCESSING', 'Bilder-Generierung');
define('BOX_TOOLS_MAIL', 'eMail versenden');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Rundschreiben Manager');
define('BOX_TOOLS_SERVER_INFO', 'Server Info');
define('BOX_TOOLS_WHOS_ONLINE', 'Wer ist Online');

// localizaion box text in includes/boxes/menubox_localization.php
define('BOX_HEADING_LOCALIZATION', 'Sprachen/Währungen');
define('BOX_LOCALIZATION_CURRENCIES', 'Währungen');
define('BOX_LOCALIZATION_LANGUAGES', 'Sprachen');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Bestellstatus');

// gv_admin box text in includes/boxes/menubox_gv_admin.php
define('BOX_HEADING_GV_ADMIN', 'Gutscheine/Kupons');
define('BOX_GV_ADMIN_QUEUE', 'Gutschein Queue');
define('BOX_GV_ADMIN_MAIL', 'Gutschein eMail');
define('BOX_GV_ADMIN_SENT', 'Gutscheine versandt');
define('BOX_COUPON_ADMIN','Kupon Administrator');

// content_manager box text in includes/boxes/menubox_content_manager.php
define('BOX_HEADING_CONTENT_MANAGER', 'Inhalts-Manager');
define('BOX_CONTENT_MANAGER_PAGES', 'Seiten in Menüstruktur');
define('BOX_CONTENT_MANAGER_INFO_PAGES', 'Infoseiten');

// javascript messages
define('JS_ERROR', 'Während der Eingabe sind Fehler aufgetreten!\nBitte korrigieren Sie folgendes:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* Sie müssen diesem Wert einen Preis zuordnen\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Sie müssen ein Vorzeichen für den Preis angeben (+/-)\n');

define('JS_PRODUCTS_NAME', '* Der neue Artikel muss einen Namen haben\n');
define('JS_PRODUCTS_DESCRIPTION', '* Der neue Artikel muss eine Beschreibung haben\n');
define('JS_PRODUCTS_PRICE', '* Der neue Artikel muss einen Preis haben\n');
define('JS_PRODUCTS_WEIGHT', '* Der neue Artikel muss eine Gewichtsangabe haben\n');
define('JS_PRODUCTS_QUANTITY', '* Sie müssen dem neuen Artikel eine verfügbare Anzahl zuordnen\n');
define('JS_PRODUCTS_MODEL', '* Sie müssen dem neuen Artikel eine Artikel-Nr. zuordnen\n');
define('JS_PRODUCTS_IMAGE', '* Sie müssen dem Artikel ein Bild zuordnen\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Es muss ein neuer Preis für diesen Artikel festgelegt werden\n');

define('JS_GENDER', '* Die \'Anrede\' muss ausgewählt werden.\n');
define('JS_FIRST_NAME', '* Der \'Vorname\' muss mindestens aus ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_LAST_NAME', '* Der \'Nachname\' muss mindestens aus ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_DOB', '* Das \'Geburtsdatum\' muss folgendes Format haben: xx.xx.xxxx (Tag.Monat.Jahr).\n');
define('JS_EMAIL_ADDRESS', '* Die \'eMail-Adresse\' muss mindestens aus ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_ADDRESS', '* Die \'Strasse\' muss mindestens aus ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_POST_CODE', '* Die \'Postleitzahl\' muss mindestens aus ' . ENTRY_POSTCODE_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_CITY', '* Die \'Stadt\' muss mindestens aus ' . ENTRY_CITY_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_STATE', '* Das \'Bundesland\' muss ausgewählt werden.\n');
define('JS_STATE_SELECT', '-- Wählen Sie oberhalb --');
define('JS_ZONE', '* Das \'Bundesland\' muss aus der Liste für dieses Land ausgewählt werden.');
define('JS_COUNTRY', '* Das \'Land\' muss ausgewählt werden.\n');
define('JS_TELEPHONE', '* Die \'Telefonnummer\' muss aus mindestens ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_PASSWORD', '* Das \'Passwort\' sowie die \'Passwortbestätigung\' müssen übereinstimmen und aus mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen bestehen.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Auftragsnummer %s existiert nicht!');

define('JS_CONFIRM_SAVE', 'Speichern?');
define('JS_CONFIRM_UPDATE', 'Aktualisieren?');
define('JS_CONFIRM_INSERT', 'Einfügen?');
define('JS_THIS_PROCESS_MAY_TAKE_SOME_TIME', 'Dieser Vorgang kann einige Zeit in Anspruch nehmen und darf nicht unterbrochen werden!');
define('JS_ARE_YOU_SURE', 'Sind Sie sicher?');

define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">notwendige Eingabe</span>');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Buchstaben</span>');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Buchstaben</span>');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(z.B. 21.05.1970)</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Buchstaben</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">ungültige eMail-Adresse!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Diese eMail-Adresse existiert schon!</span>');
define('ENTRY_COMPANY_TAX_ID_ERROR', '');
define('ENTRY_CUSTOMERS_GROUP_RA_NO', 'Alarm aus');
define('ENTRY_CUSTOMERS_GROUP_RA_YES', 'Alarm ein');
define('ENTRY_CUSTOMERS_GROUP_RA_ERROR', '');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Buchstaben</span>');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_POSTCODE_MIN_LENGTH . ' Zahlen</span>');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_CITY_MIN_LENGTH . ' Buchstaben</span>');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">notwendige Eingabe</font></small>');
define('ENTRY_COUNTRY_ERROR', 'Bitte wählen Sie ein Land aus der Liste.');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zahlen</span>');
define('ENTRY_NEWSLETTER_YES', 'abonniert');
define('ENTRY_NEWSLETTER_NO', 'nicht abonniert');
define('ENTRY_CUSTOMERS_GROUP_NAME_ERROR', '');

// button texts
define('BUTTON_TEXT_ANI_SEND_EMAIL', 'eMail senden');
define('BUTTON_TEXT_BACK', 'Zurück');
define('BUTTON_TEXT_BACK_TO_OVERVIEW', 'Zurück zur Übersicht');
define('BUTTON_TEXT_BACKUP', 'Sichern');
define('BUTTON_TEXT_CANCEL', 'Abbrechen');
define('BUTTON_TEXT_CONFIRM', 'Bestätigen');
define('BUTTON_TEXT_COPY', 'Kopieren');
define('BUTTON_TEXT_COPY_TO', 'Kopieren nach');
define('BUTTON_TEXT_DETAILS', 'Details');
define('BUTTON_TEXT_DELETE', 'Löschen');
define('BUTTON_TEXT_EDIT', 'Bearbeiten');
define('BUTTON_TEXT_EMAIL', 'eMail');
define('BUTTON_TEXT_FILE_MANAGER', 'Datei-Manager');
define('BUTTON_TEXT_FILE_PERMISSION', 'Datei Rechte');
define('BUTTON_TEXT_INSERT', 'Einfügen');
define('BUTTON_TEXT_LOCK', 'Sperren');
define('BUTTON_TEXT_MODULE_INSTALL', 'Installieren');
define('BUTTON_TEXT_MODULE_REMOVE', 'Entfernen');
define('BUTTON_TEXT_MOVE', 'Verschieben');
define('BUTTON_TEXT_NEW_BANNER', 'Neuer Banner');
define('BUTTON_TEXT_NEW_CATEGORY', 'Neue Kategorie');
define('BUTTON_TEXT_NEW_COUNTRY', 'Neues Land');
define('BUTTON_TEXT_NEW_CURRENCY', 'Neue Währung');
define('BUTTON_TEXT_NEW_FILE', 'Neue Datei');
define('BUTTON_TEXT_NEW_FOLDER', 'Neues Verzeichnis');
define('BUTTON_TEXT_NEW_LANGUAGE', 'Neue Sprache');
define('BUTTON_TEXT_NEW_NEWSLETTER', 'Neues Rundschreiben');
define('BUTTON_TEXT_NEW_PAGE', 'Neue Seite in:');
define('BUTTON_TEXT_NEW_PRODUCT', 'Neues Produkt');
define('BUTTON_TEXT_SORT_PRODUCT', 'Artikel sortieren');
define('BUTTON_TEXT_NEW_TAX_CLASS', 'Neue Steuerklasse');
define('BUTTON_TEXT_NEW_TAX_RATE', 'Neuer Steuersatz');
define('BUTTON_TEXT_NEW_TAX_ZONE', 'Neue Steuerzone');
define('BUTTON_TEXT_NEW_ZONE', 'Neues Bundesland');
define('BUTTON_TEXT_ORDERS', 'Bestellungen');
define('BUTTON_TEXT_ORDERS_INVOICE', 'Rechnung');
define('BUTTON_TEXT_ORDERS_PACKINGSLIP', 'Lieferschein');
define('BUTTON_TEXT_PREVIEW', 'Vorschau');
define('BUTTON_TEXT_PRODUCTS_ATTRIBUTES', 'Artikelmerkmale');
define('BUTTON_TEXT_REPORT', 'Report');
define('BUTTON_TEXT_RESET', 'Zurücksetzen');
define('BUTTON_TEXT_RESTORE', 'Wiederherstellen');
define('BUTTON_TEXT_REAL_IMAGE', 'Realbild anzeigen');
define('BUTTON_TEXT_SAVE', 'Sichern');
define('BUTTON_TEXT_SEARCH', 'Suchen');
define('BUTTON_TEXT_SELECT', 'Auswählen');
define('BUTTON_TEXT_SELECT_FOR_LIGHTBOX', 'Auswählen (für Lightbox oder Tabs)');
define('BUTTON_TEXT_SEND', 'Versenden');
define('BUTTON_TEXT_SEND_EMAIL', 'eMail senden');
define('BUTTON_TEXT_UNLOCK', 'Entsperren');
define('BUTTON_TEXT_UPDATE', 'Aktualisieren');
define('BUTTON_TEXT_UPDATE_CURRENCIES', 'Währungen aktualisieren');
define('BUTTON_TEXT_UPLOAD', 'Hochladen');

// button titles
define('BUTTON_TITLE_ANI_SEND_EMAIL', 'eMail versenden');
define('BUTTON_TITLE_BACK', 'Zurück');
define('BUTTON_TITLE_BACK_TO_OVERVIEW', 'Zurück zur Übersicht');
define('BUTTON_TITLE_BACKUP', 'Datensicherung');
define('BUTTON_TITLE_CANCEL', 'Abbruch');
define('BUTTON_TITLE_CONFIRM', 'Bestätigen');
define('BUTTON_TITLE_COPY', 'Kopieren');
define('BUTTON_TITLE_COPY_TO', 'Kopieren nach');
define('BUTTON_TITLE_DETAILS', 'Details');
define('BUTTON_TITLE_DELETE', 'Löschen');
define('BUTTON_TITLE_EDIT', 'Bearbeiten');
define('BUTTON_TITLE_EMAIL', 'eMail');
define('BUTTON_TITLE_FILE_MANAGER', 'Datei-Manager');
define('BUTTON_TITLE_FILE_PERMISSION', 'Datei Rechte');
define('BUTTON_TITLE_INSERT', 'Einfügen');
define('BUTTON_TITLE_LOCK', 'Sperren');
define('BUTTON_TITLE_MODULE_INSTALL', 'Module Installieren');
define('BUTTON_TITLE_MODULE_REMOVE', 'Module Entfernen');
define('BUTTON_TITLE_MOVE', 'Verschieben');
define('BUTTON_TITLE_NEW_BANNER', 'Neuen Banner aufnehmen');
define('BUTTON_TITLE_NEW_CATEGORY', 'Neue Kategorie erstellen');
define('BUTTON_TITLE_NEW_COUNTRY', 'Neues Land aufnehmen');
define('BUTTON_TITLE_NEW_CURRENCY', 'Neue Währung einfügen');
define('BUTTON_TITLE_NEW_FILE', 'Neue Datei');
define('BUTTON_TITLE_NEW_FOLDER', 'Neues Verzeichnis');
define('BUTTON_TITLE_NEW_LANGUAGE', 'Neue Sprache anlegen');
define('BUTTON_TITLE_NEW_NEWSLETTER', 'Neues Rundschreiben');
define('BUTTON_TITLE_NEW_PAGE', 'Neue Seite erstellen in:');
define('BUTTON_TITLE_NEW_PRODUCT', 'Neuen Artikel aufnehmen');
define('BUTTON_TITLE_SORT_PRODUCT', 'Artikel sortieren');
define('BUTTON_TITLE_NEW_TAX_CLASS', 'Neue Steuerklasse erstellen');
define('BUTTON_TITLE_NEW_TAX_RATE', 'Neuen Steuersatz anlegen');
define('BUTTON_TITLE_NEW_TAX_ZONE', 'Neue Steuerzone erstellen');
define('BUTTON_TITLE_NEW_ZONE', 'Neues Bundesland einfügen');
define('BUTTON_TITLE_ORDERS', 'Bestellungen');
define('BUTTON_TITLE_ORDERS_INVOICE', 'Rechnung');
define('BUTTON_TITLE_ORDERS_PACKINGSLIP', 'Lieferschein');
define('BUTTON_TITLE_PREVIEW', 'Vorschau');
define('BUTTON_TITLE_PRODUCTS_ATTRIBUTES', 'Artikelmerkmale');
define('BUTTON_TITLE_REPORT', 'Report');
define('BUTTON_TITLE_RESET', 'Zurücksetzen');
define('BUTTON_TITLE_RESTORE', 'Zurücksichern');
define('BUTTON_TITLE_REAL_IMAGE', 'Realbild anzeigen');
define('BUTTON_TITLE_SAVE', 'Speichern');
define('BUTTON_TITLE_SEARCH', 'Suchen');
define('BUTTON_TITLE_SELECT', 'Auswählen');
define('BUTTON_TITLE_SELECT_FOR_LIGHTBOX', 'Auswählen (für Lightbox oder Tabs)');
define('BUTTON_TITLE_SEND', 'Versenden');
define('BUTTON_TITLE_SEND_EMAIL', 'eMail versenden');
define('BUTTON_TITLE_UNLOCK', 'Entsperren');
define('BUTTON_TITLE_UPDATE', 'Aktualisieren');
define('BUTTON_TITLE_UPDATE_CURRENCIES', 'Wechselkurse aktualisieren');
define('BUTTON_TITLE_UPLOAD', 'Hochladen');

//icon titles
define('ICON_TITLE_STATUS_GREEN', 'aktiv');
define('ICON_TITLE_STATUS_GREEN_LIGHT', 'aktivieren');
define('ICON_TITLE_STATUS_RED', 'inaktiv');
define('ICON_TITLE_STATUS_RED_LIGHT', 'deaktivieren');  
define('ICON_TITLE_CURRENT_FOLDER', 'aktueller Ordner');
define('ICON_TITLE_ERROR', 'Fehler');
define('ICON_TITLE_FILE', 'Datei');
define('ICON_TITLE_FILE_DOWNLOAD', 'Herunterladen');
define('ICON_TITLE_FOLDER', 'Ordner');
define('ICON_TITLE_LOCKED_CLICK_TO_UNLOCK', 'Gesperrt, klicken Sie zum entsperren');
define('ICON_TITLE_PREVIOUS_LEVEL', 'Vorherige Ebene');
define('ICON_TITLE_SUCCESS', 'Erfolg');
define('ICON_TITLE_UNLOCKED', 'Entsperrt');
define('ICON_TITLE_UNLOCKED_CLICK_TO_LOCK', 'Entsperrt, klicken Sie zum sperren');
define('ICON_TITLE_WARNING', 'Warnung');
define('ICON_TITLE_IC_UP_TEXT_SORT', 'Sortierung nach');
define('ICON_TITLE_IC_DOWN_TEXT_SORT', 'Sortierung nach');
define('ICON_TITLE_IC_UP_TEXT_FROM_TOP_ABC', '--> A-B-C von oben');
define('ICON_TITLE_IC_DOWN_TEXT_FROM_TOP_ZYX', '--> Z-Y-X von oben');
define('ICON_TITLE_ROW_IS_NOT_UPDATED', 'Diese Zeile ist neu und wurde bisher nicht aktualisiert'); 

// constants for use in xos_prev_next_display function
define('TEXT_RESULT_PAGE', 'Seite %s von %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Bannern)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Ländern)');
define('TEXT_DISPLAY_NUMBER_OF_COUPONS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Kupons)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Kunden)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Währungen)');
define('TEXT_DISPLAY_NUMBER_OF_ENTRIES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Einträgen)');
define('TEXT_DISPLAY_NUMBER_OF_GIFT_VOUCHERS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Gutscheinen)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Sprachen)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Herstellern)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Rundschreiben)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Bestellungen)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Bestellstatus)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Artikeln)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> erwarteten Artikeln)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Bewertungen)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Sonderangeboten)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Steuerklassen)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Steuerzonen)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Steuersätzen)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Kantonen/Bundesländern)');

define('PREVNEXT_BUTTON_PREV', '<strong>&lt;&lt;</strong>');
define('PREVNEXT_BUTTON_NEXT', '<strong>&gt;&gt;</strong>');

define('TEXT_DEFAULT', 'Standard');
define('TEXT_SET_DEFAULT', 'als Standard definieren');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* erforderlich</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Fehler: Es wurde keine Standardwährung definiert. Bitte definieren Sie unter Adminstration -> Sprachen/Währungen -> Währungen eine Standardwährung.');
define('ERROR_NO_DEFAULT_LANGUAGE_DEFINED', 'Fehler: Es wurde keine Sprache definiert. Bitte definieren Sie unter Adminstration -> Sprachen/Währungen -> Sprachen eine Standardsprache.');

define('TEXT_CACHE_CATEGORIES', 'Kategorien Box');
define('TEXT_CACHE_MANUFACTURERS', 'Hersteller Box');
define('TEXT_CACHE_ALSO_PURCHASED', 'Modul für ebenfalls gekaufte Artikel');

define('TEXT_ALL_LANGUAGES', 'alle Sprachen');
define('TEXT_ALL', '--alle--');
define('TEXT_NONE', '--keine--');
define('TEXT_TOP', 'Top');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Fehler: Ziel-Verzeichnis existiert nicht.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Fehler: Ziel-Verzeichnis ist schreibgeschützt.');
define('ERROR_FILE_NOT_SAVED', 'Fehler: Datei wurde nicht gespeichert.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Fehler: Dateityp unbekannt.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Erfolg: Datei wurde sicher hochgeladen und gespeichert.');
define('WARNING_NO_FILE_UPLOADED', 'Warnung: Keine Datei hochgeladen.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Warnung: Das Hochladen von Dateien ist in der Konfigurationsdatei (php.ini) abgeschaltet.');
define('WARNING_SITE_IS_OFFLINE', 'Warnung: Die Website ist zurzeit offline!');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Warnung: Das Installationverzeichnis ist noch vorhanden auf: ' . DIR_FS_DOCUMENT_ROOT . 'install. Bitte löschen Sie das Verzeichnis aus Gründen der Sicherheit!');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Warnung: XOS-Shop kann in die Konfigurationsdatei schreiben: ' . DIR_FS_CATALOG . 'includes/configure.php. Das stellt ein mögliches Sicherheitsrisiko dar - bitte korrigieren Sie die Benutzerberechtigungen zu dieser Datei!');
define('WARNING_ADMIN_CONFIG_FILE_WRITEABLE', 'Warnung: XOS-Shop kann in die Konfigurationsdatei schreiben: ' . DIR_FS_ADMIN . 'includes/configure.php. Das stellt ein mögliches Sicherheitsrisiko dar - bitte korrigieren Sie die Benutzerberechtigungen zu dieser Datei!');

define('ERROR_PHPMAILER', 'Mailer Fehler: %s (E-mail wurde nicht gesendet)');

define('TEXT_IMAGE_NONEXISTENT', 'BILD EXISTIERT NICHT');
?>
