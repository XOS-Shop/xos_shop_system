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
// on Windows environment try 'deu' or 'german'
@setlocale(LC_TIME, 'de_DE.UTF8');

define('DATE_FORMAT_SHORT', '%d.%m.%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A, %d. %B %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd.m.Y');  // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S'); // this is used for strftime()

define('DATE_OF_BIRTH_FIELD_ORDER', 'DMY');
define('DATE_OF_BIRTH_FIELD_SEPARATOR', '.');
define('DATE_OF_BIRTH_ENTRY_TEXT_MONTH', 'Monat');
define('DATE_OF_BIRTH_ENTRY_TEXT_DAY', 'Tag');
define('DATE_OF_BIRTH_ENTRY_TEXT_YEAR', 'Jahr');

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
define('HTML_PARAMS','dir="LTR" lang="de"');

// language attribute for the <html> tag
define('XHTML_LANG','de');

// charset for web pages and emails
define('CHARSET', 'UTF-8');

// page title
define('TITLE', STORE_NAME); 

// separator for page title
define('PAGE_TITLE_TRAIL_SEPARATOR', ' » ');

// separator for breadcrumb trail
define('BREADCRUMB_TRAIL_SEPARATOR', ' » ');

// text for downloads in includes/modules/downloads.php
define('HEADER_TITLE_MY_ACCOUNT', 'Ihr Konto');

// header text in includes/application_top.php
define('HEADER_TITLE_TOP', 'Top');
define('HEADER_TITLE_HOME', 'Startseite');

// text for gender
define('MALE', 'Herr');
define('FEMALE', 'Frau');
define('MALE_ADDRESS', 'Herr');
define('FEMALE_ADDRESS', 'Frau');

// format string for advanced search
define('AS_FORMAT_STRING', 'tt.mm.jjjj');
define('AS_FORMAT_STRING_JS', 'dd.mm.yyyy');

// reviews box text in includes/boxes/reviews.php
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s von 5 Sternen!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Bitte wählen');
define('TYPE_BELOW', 'bitte unten eingeben');

// javascript messages
define('JS_ERROR', 'Notwendige Angaben fehlen!\nBitte richtig ausfüllen.\n\n');
define('JS_REVIEW_TEXT', 'Der Text muss mindestens aus ' . REVIEW_TEXT_MIN_LENGTH . ' Buchstaben bestehen.');
define('JS_REVIEW_RATING', 'Geben Sie Ihre Bewertung ein.');
define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Bitte wählen Sie eine Zahlungsweise für Ihre Bestellung.\n');
define('JS_ERROR_CONDITIONS_NOT_ACCEPTED', '* Bitte bestätigen Sie die Allgemeinen Geschäftsbedingungen.\n');
define('JS_ERROR_SUBMITTED', 'Diese Seite wurde bereits bestätigt. Betätigen Sie bitte OK und warten bis der Prozess durchgeführt wurde.');
define('JS_ERROR_KEYWORD_FIELD_EMPTY', 'Das Suchfeld darf nicht leer sein.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Bitte wählen Sie eine Zahlungsweise für Ihre Bestellung');
define('ERROR_CONDITIONS_NOT_ACCEPTED', 'Bitte bestätigen Sie die Allgemeinen Geschäftsbedingungen.');

define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_COMPANY_TAX_ID_ERROR', '');
define('ENTRY_COMPANY_TAX_ID_TEXT', '');
define('ENTRY_GENDER_ERROR', 'Bitte das Geschlecht angeben.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME_ERROR', 'Der Vorname sollte mindestens ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME_ERROR', 'Der Nachname sollte mindestens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Bitte geben Sie Ihr Geburtsdatum in folgendem Format ein: TT.MM.JJJJ (z.B. 21.05.1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', 'TT.MM.JJJJ (z.B. 21.05.1970) *');
define('ENTRY_DATE_OF_BIRTH_TEXT_1', '(TT.MM.JJJJ) *');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Die eMail Adresse sollte mindestens ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Die eMail Adresse scheint nicht gültig zu sein - bitte korrigieren.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Die eMail Adresse ist bereits gespeichert - bitte melden Sie sich mit dieser Adresse an oder eröffnen Sie ein neues Konto mit einer anderen Adresse.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS_ERROR', 'Die Strassenadresse sollte mindestens ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE_ERROR', 'Die Postleitzahl sollte mindestens ' . ENTRY_POSTCODE_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY_ERROR', 'Die Stadt sollte mindestens ' . ENTRY_CITY_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE_ERROR', 'Das Bundesland sollte mindestens ' . ENTRY_STATE_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_STATE_ERROR_SELECT', 'Bitte wählen Sie ein Bundesland aus der Liste.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY_ERROR', 'Bitte wählen Sie ein Land aus der Liste.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Die Telefonnummer sollte mindestens ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'abonniert');
define('ENTRY_NEWSLETTER_NO', 'nicht abonniert');
define('ENTRY_PASSWORD_ERROR', 'Das Passwort sollte mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Beide eingegebenen Passwörter müssen identisch sein.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Bestätigung:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Aktuelles Passwort:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_NEW', 'Neues Passwort:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Das neue Passwort sollte mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Die Passwort-Bestätigung muss mit Ihrem neuen Passwort übereinstimmen.');
define('PASSWORD_HIDDEN', '--VERSTECKT--');

// constants for use in xos_prev_next_display function
define('TEXT_RESULT_PAGE', 'Seiten:');
define('TEXT_RESULT_PAGE_IN_PULL_DOWN_MENU', 'Seite %s von %d');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'angezeigte Produkte: <b>%d</b> bis <b>%d</b> (von <b>%d</b> insgesamt)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'angezeigte Bestellungen: <b>%d</b> bis <b>%d</b> (von <b>%d</b> insgesamt)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'angezeigte Meinungen: <b>%d</b> bis <b>%d</b> (von <b>%d</b> insgesamt)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'angezeigte neue Produkte: <b>%d</b> bis <b>%d</b> (von <b>%d</b> insgesamt)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'angezeigte Angebote <b>%d</b> bis <b>%d</b> (von <b>%d</b> insgesamt)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'erste Seite');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'vorherige Seite');
define('PREVNEXT_TITLE_NEXT_PAGE', 'nächste Seite');
define('PREVNEXT_TITLE_LAST_PAGE', 'letzte Seite');
define('PREVNEXT_TITLE_PAGE_NO', 'Seite %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Vorhergehende %d Seiten');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Nächste %d Seiten');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;ERSTE');
define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');
define('PREVNEXT_BUTTON_LAST', 'LETZTE&gt;&gt;');

define('IMAGE_BUTTON_IN_CART', 'In den Warenkorb');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Benachrichtigungen');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Benachrichtigungen löschen');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Bewertung schreiben');

define('ICON_ARROW_RIGHT', 'Zeige mehr');
define('ICON_CART', 'In den Warenkorb');
define('ICON_ERROR', 'Fehler');
define('ICON_SUCCESS', 'Success');
define('ICON_WARNING', 'Warnung');

define('TEXT_GREETING_PERSONAL', 'Schön das Sie wieder da sind <span class="greet-user">%s!</span> Möchten Sie die <a href="%s"><span class="text-deco-underline">neue Produkte</span></a> ansehen?');
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>Wenn Sie nicht %s sind, melden Sie sich bitte <a href="%s"><span class="text-deco-underline">hier</span></a> mit Ihrem Kundenkonto an.</small>');
define('TEXT_GREETING_GUEST', 'Herzlich Willkommen <span class="greet-user">Gast!</span> Möchten Sie sich <a href="%s"><span class="text-deco-underline">anmelden</span></a>? Oder wollen Sie ein <a href="%s"><span class="text-deco-underline">Kundenkonto</span></a> eröffnen?');
define('BOX_TEXT_GREETING_PERSONAL', 'Schön Sie wiederzusehen<br /><span class="greet-user">%s</span>');
define('BOX_TEXT_GREETING_GUEST', 'Willkommen <span class="greet-user">Gast</span>');

define('TEXT_MAX_PRODUCTS', ' Produkte');
define('TEXT_SORT_PRODUCTS', 'Artikel ');
define('TEXT_DESCENDINGLY', 'absteigend sortieren');
define('TEXT_ASCENDINGLY', 'aufsteigend sortieren');
define('TEXT_BY', ' nach ');

define('TEXT_UNKNOWN_TAX_RATE', 'Unbekannter Steuersatz');
define('TEXT_TAX_INC_VAT', 'inkl.');
define('TEXT_TAX_PLUS_VAT', 'zzgl.');

define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Warnung: Das Verzeichnis für die Sessions existiert nicht: ' . xos_session_save_path() . '. Die Sessions werden nicht funktionieren bis das Verzeichnis erstellt wurde!');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Warnung: XOS-Shop kann nicht in das Sessions Verzeichnis schreiben: ' . xos_session_save_path() . '. Die Sessions werden nicht funktionieren bis die richtigen Benutzerberechtigungen gesetzt wurden!');
define('WARNING_SESSION_AUTO_START', 'Warnung: session.auto_start ist enabled - Bitte disablen Sie dieses PHP Feature in der php.ini und starten Sie den WEB-Server neu!');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Warnung: Das Verzeichnis für den Artikel Download existiert nicht: ' . DIR_FS_DOWNLOAD . '. Diese Funktion wird nicht funktionieren bis das Verzeichnis erstellt wurde!');
define('WARNING_SITE_IS_OFFLINE', 'Warnung: Die Website ist zurzeit offline!');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'Das "Gültig bis" Datum ist ungültig.<br />Bitte korrigieren Sie Ihre Angaben.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'Die "Kreditkartennummer", die Sie angegeben haben, ist ungültig.<br />Bitte korrigieren Sie Ihre Angaben.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'Die ersten 4 Ziffern Ihrer Kreditkarte sind: <b>%s</b><br />Wenn diese Angaben stimmen, wird dieser Kartentyp leider nicht akzeptiert.<br />Bitte korrigieren Sie Ihre Angaben gegebenfalls.');

define('ERROR_PHPMAILER', 'Mailer Fehler: %s (E-mail wurde nicht gesendet)');
?>
