<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : admin_members.php
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
//              Copyright (c) 2002 osCommerce
//              filename: admin_members.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

if ($_GET['gID']) {
  define('HEADING_TITLE', 'Administrator-Gruppen');
} elseif ($_GET['gPath']) {
  define('HEADING_TITLE', 'Gruppe definieren');
} else {
  define('HEADING_TITLE', 'Administrator-Mitglieder');
}

define('TABLE_HEADING_PASSWORD', 'Kennwort');
define('TABLE_HEADING_CONFIRM', 'Bestätigen Sie das Kennwort');
define('TABLE_HEADING_CREATED', 'Konto erzeugt');
define('TABLE_HEADING_MODIFIED', 'Konto bearbeitet');
define('TABLE_HEADING_LOGDATE', 'Letzte Anmeldung');
define('TABLE_HEADING_LOG_NUM', 'Anzahl Anmeldungen:');

define('TABLE_HEADING_GROUPS_GROUP', 'Level');
define('TABLE_HEADING_GROUPS_CATEGORIES', 'Kategorien-Rechte');


define('TEXT_INFO_HEADING_DEFAULT', 'Administrator-Mitglied ');
define('TEXT_INFO_HEADING_DELETE', 'Lösch-Recht ');
define('TEXT_INFO_HEADING_EDIT', 'Kategorie bearbeiten / ');
define('TEXT_INFO_HEADING_NEW', 'Neues Administrator-Mitglied ');

define('TEXT_INFO_DEFAULT_INTRO', 'Mitgliedsgruppe');
define('TEXT_INFO_DELETE_INTRO', 'Entfernen Sie <b>%s</b> von den Administrator-Gruppe?');
define('TEXT_INFO_DELETE_INTRO_NOT', 'Sie können nicht %s Gruppe löschen!');
define('TEXT_INFO_EDIT_INTRO', 'Zugriffsrechte hier definieren: ');

define('TEXT_INFO_FULLNAME', 'Name: ');
define('TEXT_INFO_FIRSTNAME', 'Vorname: ');
define('TEXT_INFO_LASTNAME', 'Nachname: ');
define('TEXT_INFO_EMAIL', 'eMail Adresse: ');
define('TEXT_INFO_PASSWORD', 'Kennwort: ');
define('TEXT_INFO_PASSWORD_HIDDEN', '-Versteckt-');
define('TEXT_INFO_CONFIRM', 'Kennwort bestätigen: ');
define('TEXT_INFO_CREATED', 'Konto erstellt: ');
define('TEXT_INFO_MODIFIED', 'Konto geändert: ');
define('TEXT_INFO_LOGDATE', 'Letzter Login: ');
define('TEXT_INFO_LOGNUM', 'Anzahl Anmeldungen: ');
define('TEXT_INFO_GROUP', 'Gruppe: ');
define('TEXT_INFO_ERROR_EMAIL_USED', '<font color="red">Die eMail Adresse ist bereits vergeben! Bitte erneut versuchen!</font>');
define('TEXT_INFO_ERROR_EMAIL_NOT_VALID', '<font color="red">Die eMail Adresse scheint nicht gültig zu sein - bitte korrigieren.</font>');

define('JS_ALERT_FIRSTNAME', '- Erforderlich: Vorname \n');
define('JS_ALERT_LASTNAME', '- Erforderlich: Nachname \n');
define('JS_ALERT_EMAIL', '- Erforderlich: eMail Adresse \n');
define('JS_ALERT_FIRSTNAME_LENGTH', '- Der Vorname sollte mindestens ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Zeichen enthalten.');
define('JS_ALERT_LASTNAME_LENGTH',  '- Der Nachname sollte mindestens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Zeichen enthalten.');
define('JS_ALERT_EMAIL_LENGTH',     '- Die eMail Adresse sollte mindestens ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen enthalten.');

define('ADMIN_EMAIL_SUBJECT', 'Neues Administrator Mitglied');
define('ADMIN_EMAIL_TEXT', 'Hallo %s,' . "\n\n" . 'Das Administrator-Pannel kann mit dem folgenden Kennwort geöffnet werden. Bitte Kennwort sofort ändern!' . "\n\n" . 'Website: %s' . "\n" . 'Email-Adresse: %s' . "\n" . 'Kennwort: %s' . "\n\n" . 'Danke!' . "\n" . '%s' . "\n\n" . 'Das ist eine automatische Nachricht!, bitte nicht antworten.');
define('ADMIN_EMAIL_EDIT_SUBJECT', 'Profil des Administrator wurde bearbeitet');
define('ADMIN_EMAIL_EDIT_TEXT', 'Hallo %s,' . "\n\n" . 'Ihre persönlichen Informationen sind von einem Administrator aktualisiert worden.' . "\n\n" . 'Website: %s' . "\n" . 'Email-Adresse: %s' . "\n" . 'Kennwort: %s' . "\n\n" . 'Danke!' . "\n" . '%s' . "\n\n" . 'Dieses ist eine automatissche Nachricht, bitte nicht antworten!');
define('NOTICE_EMAIL_SENT_TO', 'Hinweis: eMail wurde versendet an: %s');

define('TEXT_INFO_HEADING_DEFAULT_GROUPS', 'Administrator-Gruppe ');
define('TEXT_INFO_HEADING_DELETE_GROUPS', 'Gruppe löschen ');

define('TEXT_INFO_DEFAULT_GROUPS_INTRO', '<b>ANMERKUNG:</b><br /><br /><b>Bearbeiten:</b><br />Bearbeitung von Gruppennamen.<br /><br /><b>Löschen:</b><br />Gruppe löschen.<br /><br /><b>Rechte bearbeiten:</b><br />Bearbeiten der Gruppen-Zugriffsrechte.');
define('TEXT_INFO_DELETE_GROUPS_INTRO', 'Das löscht alle Mitglieder der Gruppe. Sind Sie sicher, dass Sie <b>%s</b> löschen möchten?');
define('TEXT_INFO_DELETE_GROUPS_INTRO_NOT', 'Gruppe kann nicht gelöscht werden!');
define('TEXT_INFO_GROUPS_INTRO', 'Gruppennamen eingeben.');
define('TEXT_INFO_EDIT_GROUPS_INTRO', 'Gruppennamen eingeben.');

define('TEXT_INFO_HEADING_EDIT_GROUP', 'Administrator-Gruppe');
define('TEXT_INFO_HEADING_GROUPS', 'Neue Gruppe');
define('TEXT_INFO_GROUPS_NAME', ' <b>Gruppenname:</b><br />Gruppennnamen eingeben.<br />');
define('TEXT_INFO_GROUPS_NAME_FALSE', '<font color="red"><b>Achtung:</b> Der Gruppenname muß mehr als 5 Buchstaben haben!</font>');
define('TEXT_INFO_GROUPS_NAME_USED', '<font color="red"><b>Achtung:</b> Der Gruppenname existiert bereits!</font>');
define('TEXT_INFO_GROUPS_LEVEL', 'Gruppe: ');
define('TEXT_INFO_GROUPS_BOXES', '<b>Ordner-Zugriff:</b><br />Zugang zu ausgewählten Ordnern definieren.');
define('TEXT_INFO_GROUPS_BOXES_INCLUDE', 'Dateien im Ordner einbeziehen: ');

define('TEXT_INFO_HEADING_DEFINE', 'Gruppe definieren');
if ($_GET['gPath'] == 1) {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br />Sie können den Datei-Zugriff dieses Ordners nicht ändern.<br /><br />');
} else {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br />Zugriffsrechte ändern, indem Dateien und Ordner markiert werden.<br /><br />');
}

// BOF: KategorienAdmin / OLISWISS
define('TEXT_INFO_CATEGORIEACCESS','Kategoriezugriff:');
define('TEXT_RIGHTS_CNEW','Kategorie erstellen');
define('TEXT_RIGHTS_CEDIT','Kategorie bearbeiten');
define('TEXT_RIGHTS_CMOVE','Kategorie verschieben');
define('TEXT_RIGHTS_CDELETE','Kategorie löschen');
define('TEXT_RIGHTS_PNEW','Produkt erstellen');
define('TEXT_RIGHTS_PEDIT','Produkt bearbeiten');
define('TEXT_RIGHTS_PMOVE','Produkt verschieben');
define('TEXT_RIGHTS_PCOPY','Produkt kopieren');
define('TEXT_RIGHTS_PDELETE','Produkt löschen');
// EOF: KategorienAdmin / OLISWISS

?>
