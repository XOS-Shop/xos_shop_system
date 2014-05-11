<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                      
// filename   : configuration.php
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
//              filename: configuration.php                      
//
//              Released under the GNU General Public License 
////////////////////////////////////////////////////////////////////////////////

define('HEADING_TITLE_CONFIGURATION_GROUP_1', 'Mein Shop');
define('HEADING_TITLE_CONFIGURATION_GROUP_2', 'Minimum-Werte');
define('HEADING_TITLE_CONFIGURATION_GROUP_3', 'Maximum-Werte'); 
define('HEADING_TITLE_CONFIGURATION_GROUP_4', 'Bilder');
define('HEADING_TITLE_CONFIGURATION_GROUP_5', 'Kunden-Details');
define('HEADING_TITLE_CONFIGURATION_GROUP_6', 'Module Optionen');
define('HEADING_TITLE_CONFIGURATION_GROUP_7', 'Versand/Verpackung');
define('HEADING_TITLE_CONFIGURATION_GROUP_8', 'Produktliste A (Listenansicht)');
define('HEADING_TITLE_CONFIGURATION_GROUP_9', 'Produktliste B (Galerieansicht)');
define('HEADING_TITLE_CONFIGURATION_GROUP_10', 'Lager'); 
define('HEADING_TITLE_CONFIGURATION_GROUP_11', 'Protokollierung'); 
define('HEADING_TITLE_CONFIGURATION_GROUP_12', 'Smarty Template'); 
define('HEADING_TITLE_CONFIGURATION_GROUP_13', 'eMail');
define('HEADING_TITLE_CONFIGURATION_GROUP_14', 'Download');
define('HEADING_TITLE_CONFIGURATION_GROUP_15', 'GZip-Kompression');
define('HEADING_TITLE_CONFIGURATION_GROUP_16', 'Sessions');
define('HEADING_TITLE_CONFIGURATION_GROUP_17', 'Website-Abschaltung');

define('STORE_NAME_TITLE', 'Shopname');
define('STORE_OWNER_TITLE', 'Shopinhaber');
define('STORE_OWNER_EMAIL_ADDRESS_TITLE', 'eMail Adresse');
define('EMAIL_FROM_TITLE', 'eMail Adresse (Absender)'); 
define('STORE_COUNTRY_TITLE', 'Land');
define('STORE_ZONE_TITLE','Kanton/Bundesland'); 
define('EXPECTED_PRODUCTS_SORT_TITLE', 'Sortierreihenfolge (Erwartete Artikel)'); 
define('EXPECTED_PRODUCTS_FIELD_TITLE', 'Sortierkriterium (Erwartete Artikel)');
define('SEND_EXTRA_ORDER_EMAILS_TO_TITLE', 'Zusätzliche eMails bei Bestellung an'); 
define('DISPLAY_LINK_TO_ROOT_DIRECTORY_TITLE', 'Link zum Wurzelverzeichnis anzeigen');  
define('SEARCH_ENGINE_FRIENDLY_URLS_TITLE', 'Suchmaschinenfreundliche URLs nutzen');  
define('DISPLAY_CART_TITLE', 'Zeige Warenkorb nach Hinzufügen eines Artikels'); 
define('ALLOW_GUEST_TO_TELL_A_FRIEND_TITLE', 'Gästen das Weiterempfehlen erlauben');
define('NEWSLETTER_ENABLED_TITLE', 'Newsletter aktivieren');
define('PRODUCT_REVIEWS_ENABLED_TITLE', 'Produktbewertungen aktivieren');
define('PRODUCT_NOTIFICATION_ENABLED_TITLE', 'Produktbenachrichtigungen aktivieren');
define('ADVANCED_SEARCH_DEFAULT_OPERATOR_TITLE', 'Standard-Suchoperator'); 
define('STORE_NAME_ADDRESS_TITLE', 'Adresse und Telefonnummer des Shops');
define('DISPLAY_PRODUCT_LISTING_IN_PARENT_CATEGORY_TITLE', 'In übergeordneten Kategorien Produkte anzeigen');
define('SHOW_EMPTY_CATEGORIES_TITLE', 'Leere Kategorien anzeigen'); 
define('SHOW_COUNTS_TITLE', 'Zeige Artikelanzahl hinter Kategorien');
define('PRODUCT_LISTS_FOR_SEARCH_RESULTS_TITLE', 'Produktlisten-Typ für Suchergebnisse');
define('PRODUCT_LISTS_FOR_SPECIALS_TITLE', 'Produktlisten-Typ für Sonderangebote');
define('PRODUCT_LISTS_FOR_MANUFACTURERS_TITLE', 'Produktlisten-Typ für Hersteller');
define('PREV_NEXT_BAR_LOCATION_TITLE', 'Lage der Vor/Zurück-Navigation in Produktlisten');  
define('TAX_DECIMAL_PLACES_TITLE', 'Nachkommastellen bei den Steuern');
define('NEW_SIGNUP_GIFT_VOUCHER_AMOUNT_TITLE', 'To offer a gift voucher');
define('NEW_SIGNUP_DISCOUNT_COUPON_TITLE', 'To offer a discount coupon'); 

define('STORE_NAME_DESCRIPTION', 'Der Name des Online-Shops.');
define('STORE_OWNER_DESCRIPTION', 'Der Name des Shopinhabers.'); 
define('STORE_OWNER_EMAIL_ADDRESS_DESCRIPTION', 'Die eMail-Adresse des Shopinhabers.'); 
define('EMAIL_FROM_DESCRIPTION', 'Die eMail-Absenderadresse, die in ausgehenden eMails genutzt wird.'); 
define('STORE_COUNTRY_DESCRIPTION', 'Das Land, in dem der Online-Shop ansässig ist.<br /><br /><b>Hinweis: Bei einer Änderung bitte auch an die Aktualisierung des Kantons/Bundeslandes denken.</b>');
define('STORE_ZONE_DESCRIPTION', 'Kanton/Bundesland, in dem der Online-Shop ansässig ist.');
define('EXPECTED_PRODUCTS_SORT_DESCRIPTION', 'Die Sortierreihenfolge in der Box (Erwartete Artikel).'); 
define('EXPECTED_PRODUCTS_FIELD_DESCRIPTION', 'Die Spalte, nach der in der Box (Erwartete Artikel) sortiert wird.<br /><br />products_name = Produktname<br />date_expected = Erscheinungsdatum'); 
define('SEND_EXTRA_ORDER_EMAILS_TO_DESCRIPTION', 'Versand von zusätzlichen eMails bei Bestellungen an die folgenden Adressen im Format:<br />Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;'); 
define('DISPLAY_LINK_TO_ROOT_DIRECTORY_DESCRIPTION', 'In der Brotkrümelnavigation  einen Link zum Wurzelverzeichnis anzeigen.');
define('SEARCH_ENGINE_FRIENDLY_URLS_DESCRIPTION', 'Suchmaschinenfreudliche URLs für Links nutzen.');
define('DISPLAY_CART_DESCRIPTION', 'Den Warenkorb nach Hinzufügen eines Artikels anzeigen (oder zum Ausgangspunkt zurückkehren).'); 
define('ALLOW_GUEST_TO_TELL_A_FRIEND_DESCRIPTION', 'Gästen das Weiterempfehlen von Artikel erlauben.');
define('NEWSLETTER_ENABLED_DESCRIPTION', 'Aktiviert Newsletter');
define('PRODUCT_REVIEWS_ENABLED_DESCRIPTION', 'Aktiviert Produktbewertungen');
define('PRODUCT_NOTIFICATION_ENABLED_DESCRIPTION', 'Aktiviert Produktbenachrichtigungen'); 
define('ADVANCED_SEARCH_DEFAULT_OPERATOR_DESCRIPTION', 'Standard-Suchoperator festlegen.'); 
define('STORE_NAME_ADDRESS_DESCRIPTION', 'Der Name, die Adresse und die Telefonnummer des Shops für druckbare Dokumente und die Anzeige im Online-Shop.');
define('DISPLAY_PRODUCT_LISTING_IN_PARENT_CATEGORY_DESCRIPTION', 'In übergeordneten Kategorien Produkte untergeordneter Kategorien anstelle einer Auswahl neuer Produkte anzeigen.');
define('SHOW_EMPTY_CATEGORIES_DESCRIPTION', 'Zeigt auch leere Kategorien an');
define('SHOW_COUNTS_DESCRIPTION', 'Zählt rekursiv wieviele Artikel in jeder Kategorie vorhanden sind und zeigt sie in der Box (Kategorien) an.');
define('PRODUCT_LISTS_FOR_SEARCH_RESULTS_DESCRIPTION', 'Wählen Sie den Produktlisten-Typ für Suchergebnisse.<br /><b>A</b> (Listenansicht) oder <b>B</b> (Galerieansicht)');
define('PRODUCT_LISTS_FOR_SPECIALS_DESCRIPTION', 'Wählen Sie den Produktlisten-Typ für Sonderangebote.<br /><b>A</b> (Listenansicht) oder <b>B</b> (Galerieansicht)');
define('PRODUCT_LISTS_FOR_MANUFACTURERS_DESCRIPTION', 'Wählen Sie den Produktlisten-Typ für Hersteller.<br /><b>A</b> (Listenansicht) oder <b>B</b> (Galerieansicht)');
define('PREV_NEXT_BAR_LOCATION_DESCRIPTION', 'Zeigt die Vor/Zurück-Navigation in Produktlisten an.<br /><br />1 = oben<br />2 = unten<br />3 = oben und unten');
define('TAX_DECIMAL_PLACES_DESCRIPTION', 'Die Anzahl der Nachkommastellen bei der Anzeige der Steuern.');
define('NEW_SIGNUP_GIFT_VOUCHER_AMOUNT_DESCRIPTION', 'Please indicate the amount of the gift voucher which you want to offer a new customer.<br /><br />Put 0 if you do not want to offer gift voucher.');
define('NEW_SIGNUP_DISCOUNT_COUPON_DESCRIPTION', 'To offer a discount coupon to a new customer, enter the code of the coupon.<br /><br/>Leave empty if you do not want to offer discount coupon.');




define('ENTRY_FIRST_NAME_MIN_LENGTH_TITLE', 'Vorname');
define('ENTRY_LAST_NAME_MIN_LENGTH_TITLE', 'Nachname');
define('ENTRY_DOB_MIN_LENGTH_TITLE', 'Geburtsdatum');
define('ENTRY_EMAIL_ADDRESS_MIN_LENGTH_TITLE', 'eMail Addresse');
define('ENTRY_STREET_ADDRESS_MIN_LENGTH_TITLE', 'Strasse');
define('ENTRY_COMPANY_MIN_LENGTH_TITLE', 'Firma');
define('ENTRY_POSTCODE_MIN_LENGTH_TITLE', 'Postleitzahl');
define('ENTRY_CITY_MIN_LENGTH_TITLE', 'Stadt');
define('ENTRY_STATE_MIN_LENGTH_TITLE', 'Kanton/Bundesland');
define('ENTRY_TELEPHONE_MIN_LENGTH_TITLE', 'Telefonnummer');
define('ENTRY_PASSWORD_MIN_LENGTH_TITLE', 'Passwort');
define('CC_OWNER_MIN_LENGTH_TITLE', 'Name des Kreditkarteninhabers');
define('CC_NUMBER_MIN_LENGTH_TITLE', 'Kreditkartennummer');
define('REVIEW_TEXT_MIN_LENGTH_TITLE', 'Kundenmeinung');
define('MIN_DISPLAY_BESTSELLERS_TITLE', 'Bestseller');
define('MIN_DISPLAY_ALSO_PURCHASED_TITLE', 'Artikelempfehlungen');

define('ENTRY_FIRST_NAME_MIN_LENGTH_DESCRIPTION', 'Die Mindestlänge des Vornamens.');
define('ENTRY_LAST_NAME_MIN_LENGTH_DESCRIPTION', 'Die Mindestlänge des Nachnamens.');
define('ENTRY_DOB_MIN_LENGTH_DESCRIPTION', 'Die Mindestlänge des Geburtsdatums.');
define('ENTRY_EMAIL_ADDRESS_MIN_LENGTH_DESCRIPTION', 'Die Mindestlänge der eMail-Adresse.');
define('ENTRY_STREET_ADDRESS_MIN_LENGTH_DESCRIPTION', 'Die Mindestlänge des Strassennamens.');
define('ENTRY_COMPANY_MIN_LENGTH_DESCRIPTION', 'Die Mindestlänge des Firmennamens.');
define('ENTRY_POSTCODE_MIN_LENGTH_DESCRIPTION', 'Die Mindestlänge der Postleitzahl.');
define('ENTRY_CITY_MIN_LENGTH_DESCRIPTION', 'Die Mindestlänge des Stadtnamens.');
define('ENTRY_STATE_MIN_LENGTH_DESCRIPTION', 'Die Mindestlänge des Kantons-/Bundesland-Namens.');
define('ENTRY_TELEPHONE_MIN_LENGTH_DESCRIPTION', 'Die Mindestlänge der Telefonnummer.');
define('ENTRY_PASSWORD_MIN_LENGTH_DESCRIPTION', 'Die Mindestlänge des Passworts.');
define('CC_OWNER_MIN_LENGTH_DESCRIPTION', 'Die Mindestlänge des Kreditkarteninhaber-Namens.');
define('CC_NUMBER_MIN_LENGTH_DESCRIPTION', 'Die Mindestlänge der Kreditkartennummer.');
define('REVIEW_TEXT_MIN_LENGTH_DESCRIPTION', 'Die Mindestlänge der Kundenmeinung.');
define('MIN_DISPLAY_BESTSELLERS_DESCRIPTION', 'Die Mindestanzahl der angezeigten Bestseller.');
define('MIN_DISPLAY_ALSO_PURCHASED_DESCRIPTION', 'Die Mindestanzahl von angezeigten Artikeln in der Box (Kunden, die dieses Produkt gekauft haben ..).');




define('MAX_ADDRESS_BOOK_ENTRIES_TITLE', 'Adressbucheinträge');
define('MAX_DISPLAY_SEARCH_RESULTS_TITLE', 'Suchergebnisse');
define('MAX_DISPLAY_PRODUCTS_IN_CATEGORY_TITLE', 'Produkte einer Kategorie');
define('MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER_TITLE', 'Produkte eines Herstellers');
define('MAX_DISPLAY_PAGE_LINKS_TITLE', 'Seitenanzahl');
define('MAX_DISPLAY_SPECIAL_PRODUCTS_TITLE', 'Sonderangebote');
define('MAX_DISPLAY_NEW_PRODUCTS_TITLE', 'Neue Artikel');
define('MAX_DISPLAY_UPCOMING_PRODUCTS_TITLE', 'Erwartete Artikel');
define('MAX_DISPLAY_MANUFACTURERS_IN_A_LIST_TITLE', 'Herstellerliste');
define('MAX_MANUFACTURERS_LIST_TITLE', 'Grösse der Herstellerliste');
define('MAX_DISPLAY_MANUFACTURER_NAME_LEN_TITLE', 'Länge des Herstellernamens');
define('MAX_DISPLAY_NEW_REVIEWS_TITLE', 'Neue Produktbewertungen');
define('MAX_RANDOM_SELECT_REVIEWS_TITLE', 'Auswahl der Produktbewertungen');
define('MAX_RANDOM_SELECT_NEW_TITLE', 'Auswahl neue Artikel');
define('MAX_RANDOM_SELECT_SPECIALS_TITLE', 'Auswahl der Sonderangebote');
define('MAX_DISPLAY_CATEGORIES_PER_ROW_TITLE', 'Kategorieanzahl pro Zeile');
define('MAX_DISPLAY_PRODUCTS_NEW_TITLE', 'Auflistung neue Produkte');
define('MAX_DISPLAY_BESTSELLERS_TITLE', 'Bestseller');
define('MAX_DISPLAY_ALSO_PURCHASED_TITLE', 'Artikelempfehlungen');
define('MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX_TITLE', 'Box Bestellübersicht');
define('MAX_DISPLAY_ORDER_HISTORY_TITLE', 'Bestellhistorie');

define('MAX_ADDRESS_BOOK_ENTRIES_DESCRIPTION', 'Die maximale Anzahl von Adressbucheinträgen, die ein Kunde haben kann.');
define('MAX_DISPLAY_SEARCH_RESULTS_DESCRIPTION', 'Die Artikelanzahl in der Auflistung.');
define('MAX_DISPLAY_PRODUCTS_IN_CATEGORY_DESCRIPTION', 'Die Artikelanzahl in der Auflistung.');
define('MAX_DISPLAY_PRODUCTS_OF_MANUFACTURER_DESCRIPTION', 'Die Artikelanzahl in der Auflistung.');
define('MAX_DISPLAY_PAGE_LINKS_DESCRIPTION', 'Die Anzahl der Direktlinks bei mehreren Seiten.');
define('MAX_DISPLAY_SPECIAL_PRODUCTS_DESCRIPTION', 'Die maximale Anzahl der angezeigten Sonderangebote.');
define('MAX_DISPLAY_NEW_PRODUCTS_DESCRIPTION', 'Die maximale Anzahl der angezeigten neuen Artikel in der Kategorieansicht.');
define('MAX_DISPLAY_UPCOMING_PRODUCTS_DESCRIPTION', 'Die maximale Anzahl der angezeigten erwarteten Artikel.');
define('MAX_DISPLAY_MANUFACTURERS_IN_A_LIST_DESCRIPTION', 'Verwendung in der Box (Hersteller).<br />Wenn die Anzahl der Hersteller diesen Wert überschreitet, wird statt der Standardliste eine Drop-Down-Liste angezeigt.');
define('MAX_MANUFACTURERS_LIST_DESCRIPTION', 'Verwendung in der Box (Hersteller). Ist der Wert = 1, wird eine Drop-Down-Liste angezeigt. Ansonsten wird ein Listenfeld mit der angegebenen Zeilenanzahl angezeigt.');
define('MAX_DISPLAY_MANUFACTURER_NAME_LEN_DESCRIPTION', 'Verwendung in der Box (Hersteller). Maximale Länge des Herstellernamens.');
define('MAX_DISPLAY_NEW_REVIEWS_DESCRIPTION', 'Die maximale Anzahl der angezeigten neuen Produktbewertungen.');
define('MAX_RANDOM_SELECT_REVIEWS_DESCRIPTION', 'Aus wievielen Einträgen soll eine zufällige ausgewählte Produktbewertung ermittelt werden?');
define('MAX_RANDOM_SELECT_NEW_DESCRIPTION', 'Die Anzahl von Produkten, von denen ein neues Produkt nach Zufall ausgewählt wird.');
define('MAX_RANDOM_SELECT_SPECIALS_DESCRIPTION', 'Aus wievielen Einträgen soll ein zufällig ausgewähltes Sonderangebot ermittelt werden?');
define('MAX_DISPLAY_CATEGORIES_PER_ROW_DESCRIPTION', 'Wie viele Kategorien sollen pro Zeile angezeigt werden?');
define('MAX_DISPLAY_PRODUCTS_NEW_DESCRIPTION', 'Die maximale Anzahl der angezeigten Artikel auf der Seite der neuen Produkte.');
define('MAX_DISPLAY_BESTSELLERS_DESCRIPTION', 'Die maximale Anzahl der angezeigten Produkte in der Box (Bestseller).');
define('MAX_DISPLAY_ALSO_PURCHASED_DESCRIPTION', 'Die maximale Anzahl der angezeigten Artikel in der Box (Kunden, die dieses Produkt gekauft haben ..).');
define('MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX_DESCRIPTION', 'Die maximale Anzahl der angezeigten Produkte in der Box (Bestellübersicht).');
define('MAX_DISPLAY_ORDER_HISTORY_DESCRIPTION', 'Die maximale Anzahl der angezeigten Bestellungen in der Bestellhistorie.');




define('MAX_IMG_TITLE', 'Anzahl der Produktbilder');
define('IMAGE_QUALITY_TITLE', 'Bildqualität');
define('CONFIG_CALCULATE_IMAGE_SIZE_TITLE', 'Bildgrösse anpassen');
define('IMAGE_REQUIRED_TITLE', 'Bild erforderlich');
define('EXTRA_SMALL_PRODUCT_IMAGE_MAX_WIDTH_TITLE', 'Breite der Produkt-Bilder Extra small');
define('EXTRA_SMALL_PRODUCT_IMAGE_MAX_HEIGHT_TITLE', 'Höhe der Produkt-Bilder Extra small');
define('EXTRA_SMALL_PRODUCT_IMAGE_MERGE_TITLE', 'Produkt-Bilder Extra small: Mischen mit..');
define('SMALL_PRODUCT_IMAGE_MAX_WIDTH_TITLE', 'Breite der Produkt-Bilder Small');
define('SMALL_PRODUCT_IMAGE_MAX_HEIGHT_TITLE', 'Höhe der Produkt-Bilder Small');
define('SMALL_PRODUCT_IMAGE_MERGE_TITLE', 'Produkt-Bilder Small: Mischen mit..');
define('MEDIUM_PRODUCT_IMAGE_MAX_WIDTH_TITLE', 'Breite der Produkt-Bilder Medium');
define('MEDIUM_PRODUCT_IMAGE_MAX_HEIGHT_TITLE', 'Höhe der Produkt-Bilder Medium');
define('MEDIUM_PRODUCT_IMAGE_MERGE_TITLE', 'Produkt-Bilder Medium: Mischen mit..');
define('LARGE_PRODUCT_IMAGE_MAX_WIDTH_TITLE', 'Breite der Produkt-Bilder Large');
define('LARGE_PRODUCT_IMAGE_MAX_HEIGHT_TITLE', 'Höhe der Produkt-Bilder Large');
define('LARGE_PRODUCT_IMAGE_MERGE_TITLE', 'Produkt-Bilder Large: Mischen mit..');
define('SMALL_CATEGORY_IMAGE_MAX_WIDTH_TITLE', 'Breite der Kategorie-Bilder Small');
define('SMALL_CATEGORY_IMAGE_MAX_HEIGHT_TITLE', 'Höhe der Kategorie-Bilder Small');
define('MEDIUM_CATEGORY_IMAGE_MAX_WIDTH_TITLE', 'Breite der Kategorie-Bilder Medium');
define('MEDIUM_CATEGORY_IMAGE_MAX_HEIGHT_TITLE', 'Höhe der Kategorie-Bilder Medium'); 

define('MAX_IMG_DESCRIPTION', 'Anzahl der Bilder die Sie einem Produkt zuordnen können?');
define('IMAGE_QUALITY_DESCRIPTION', 'Bildqualität (10 = grösste Kompression, 100 = beste Qualität)');
define('CONFIG_CALCULATE_IMAGE_SIZE_DESCRIPTION', 'Soll die Bildgrösse berechnet werden?');
define('IMAGE_REQUIRED_DESCRIPTION', 'Die Anzeige von fehlenden Bildern aktivieren. Sinnvoll für die Entwicklung.');
define('EXTRA_SMALL_PRODUCT_IMAGE_MAX_WIDTH_DESCRIPTION', 'Die maximale Breite in Pixel der Produkt-Bilder Extra small.');
define('EXTRA_SMALL_PRODUCT_IMAGE_MAX_HEIGHT_DESCRIPTION', 'Die maximale Höhe in Pixel der Produkt-Bilder Extra small.');
define('EXTRA_SMALL_PRODUCT_IMAGE_MERGE_DESCRIPTION', 'Produkt-Bilder Extra small mit Wasserzeichen-Bild mischen.<br /><br />Wasserzeichen-Bild nach folgendem Schema unten eintragen:<br /><b><i>Bildname,<br />Abstand von rechts,<br />Abstand von unten,<br />Opazität</i></b><br /><br />Standard-Wert: overlay.gif,10,10,60');
define('SMALL_PRODUCT_IMAGE_MAX_WIDTH_DESCRIPTION', 'Die maximale Breite in Pixel der Produkt-Bilder Small.');
define('SMALL_PRODUCT_IMAGE_MAX_HEIGHT_DESCRIPTION', 'Die maximale Höhe in Pixel der Produkt-Bilder Small.');
define('SMALL_PRODUCT_IMAGE_MERGE_DESCRIPTION', 'Produkt-Bilder Small mit Wasserzeichen-Bild mischen.<br /><br />Wasserzeichen-Bild nach folgendem Schema unten eintragen:<br /><b><i>Bildname,<br />Abstand von rechts,<br />Abstand von unten,<br />Opazität</i></b><br /><br />Standard-Wert: overlay.gif,10,10,60');
define('MEDIUM_PRODUCT_IMAGE_MAX_WIDTH_DESCRIPTION', 'Die maximale Breite in Pixel der Produkt-Bilder Medium.');
define('MEDIUM_PRODUCT_IMAGE_MAX_HEIGHT_DESCRIPTION', 'Die maximale Höhe in Pixel der Produkt-Bilder Medium.');
define('MEDIUM_PRODUCT_IMAGE_MERGE_DESCRIPTION', 'Produkt-Bilder Medium mit Wasserzeichen-Bild mischen.<br /><br />Wasserzeichen-Bild nach folgendem Schema unten eintragen:<br /><b><i>Bildname,<br />Abstand von rechts,<br />Abstand von unten,<br />Opazität</i></b><br /><br />Standard-Wert: overlay.gif,10,10,60');
define('LARGE_PRODUCT_IMAGE_MAX_WIDTH_DESCRIPTION', 'Die maximale Breite in Pixel der Produkt-Bilder Large.');
define('LARGE_PRODUCT_IMAGE_MAX_HEIGHT_DESCRIPTION', 'Die maximale Höhe in Pixel der Produkt-Bilder Large.');
define('LARGE_PRODUCT_IMAGE_MERGE_DESCRIPTION', 'Produkt-Bilder Large mit Wasserzeichen-Bild mischen.<br /><br />Wasserzeichen-Bild nach folgendem Schema unten eintragen:<br /><b><i>Bildname,<br />Abstand von rechts,<br />Abstand von unten,<br />Opazität</i></b><br /><br />Standard-Wert: overlay.gif,10,10,60');
define('SMALL_CATEGORY_IMAGE_MAX_WIDTH_DESCRIPTION', 'Die maximale Breite in Pixel der Kategorie-Bilder Small.');
define('SMALL_CATEGORY_IMAGE_MAX_HEIGHT_DESCRIPTION', 'Die maximale Höhe in Pixel der Kategorie-Bilder Small.');
define('MEDIUM_CATEGORY_IMAGE_MAX_WIDTH_DESCRIPTION', 'Die maximale Breite in Pixel der Kategorie-Bilder Medium.');
define('MEDIUM_CATEGORY_IMAGE_MAX_HEIGHT_DESCRIPTION', 'Die maximale Höhe in Pixel der Kategorie-Bilder Medium.');




define('ACCOUNT_GENDER_TITLE', 'Geschlecht');
define('ACCOUNT_DOB_TITLE', 'Geburtsdatum');
define('ACCOUNT_COMPANY_TITLE', 'Firma');
define('ACCOUNT_SUBURB_TITLE', 'Stadtteil');
define('ACCOUNT_STATE_TITLE', 'Kanton/Bundesland');

define('ACCOUNT_GENDER_DESCRIPTION', 'Das Geschlecht im Kundenkonto anzeigen.');
define('ACCOUNT_DOB_DESCRIPTION', 'Das Geburtsdatum im Kundenkonto anzeigen.');
define('ACCOUNT_COMPANY_DESCRIPTION', 'Die Firma im Kundenkonto anzeigen.');
define('ACCOUNT_SUBURB_DESCRIPTION', 'Den Stadtteil im Kundenkonto anzeigen.');
define('ACCOUNT_STATE_DESCRIPTION', 'Kanton/Bundesland im Kundenkonto anzeigen.');




define('SHIPPING_ORIGIN_COUNTRY_TITLE', 'Herkunftsland');
define('SHIPPING_ORIGIN_ZIP_TITLE', 'Postleitzahl');
define('SHIPPING_MAX_WEIGHT_TITLE', 'Maximale Gewicht (das versandt werden kann)');
define('SHIPPING_BOX_WEIGHT_TITLE', 'Paketgewicht (Tara)');
define('SHIPPING_BOX_PADDING_TITLE', 'Prozentuale Erhöhung für Grosse Pakete');

define('SHIPPING_ORIGIN_COUNTRY_DESCRIPTION', 'Wählen Sie das Herkunftsland aus, das in den Versandangaben genutzt werden soll.');
define('SHIPPING_ORIGIN_ZIP_DESCRIPTION', 'Die Postleitzahl des Onlineshops für die Versandangaben.');
define('SHIPPING_MAX_WEIGHT_DESCRIPTION', 'Transportunternehmen haben ein Gewichtslimit für eine einzelne Sendung. Dies ist ein gemeinsamer Wert für alle.');
define('SHIPPING_BOX_WEIGHT_DESCRIPTION', 'Wie hoch ist das Gewicht einer typischen Verpackung (Tara) von kleinen bis mittleren Paketen?');
define('SHIPPING_BOX_PADDING_DESCRIPTION', 'Für "10%" wird "10" eingegeben.');




define('PRODUCT_LIST_A_IMAGE_TITLE', 'Produktbild anzeigen');
define('PRODUCT_LIST_A_MANUFACTURER_TITLE', 'Herstellername anzeigen');
define('PRODUCT_LIST_A_MODEL_TITLE', 'Artikelnummer anzeigen');
define('PRODUCT_LIST_A_NAME_TITLE', 'Artikelname anzeigen');
define('PRODUCT_LIST_A_INFO_TITLE', 'Artikel-Kurzbeschreibung anzeigen');
define('PRODUCT_LIST_A_PACKING_UNIT_TITLE', 'Verpackungseinheit (VPE) anzeigen');
define('PRODUCT_LIST_A_PRICE_TITLE', 'Artikelpreis anzeigen');
define('PRODUCT_LIST_A_QUANTITY_TITLE', 'Artikelmenge anzeigen');
define('PRODUCT_LIST_A_WEIGHT_TITLE', 'Artikelgewicht anzeigen');
define('PRODUCT_LIST_A_BUY_NOW_TITLE', 'Button <i>In den Korb</i> anzeigen');
define('PRODUCT_LIST_A_FILTER_TITLE', 'Kategorie/Hersteller-Filter anzeigen');

define('PRODUCT_LIST_A_IMAGE_DESCRIPTION', 'Möchten Sie das Produktbild anzeigen?<br /><br />leer = deaktiviert<br />0-9 = aktiviert an Position 0-9.<br /><i>Kleinere Zahl wird links angezeigt</i>.');
define('PRODUCT_LIST_A_MANUFACTURER_DESCRIPTION', 'Möchten Sie den Herstellername anzeigen?<br /><br />leer = deaktiviert<br />0-9 = aktiviert an Position 0-9.<br /><i>Kleinere Zahl wird links angezeigt</i>.');
define('PRODUCT_LIST_A_MODEL_DESCRIPTION', 'Möchten Sie die Artikelnummer anzeigen?<br /><br />leer = deaktiviert<br />0-9 = aktiviert an Position 0-9.<br /><i>Kleinere Zahl wird links angezeigt</i>.');
define('PRODUCT_LIST_A_NAME_DESCRIPTION', 'Möchten Sie den Artikelname anzeigen?<br /><br />leer = deaktiviert<br />0-9 = aktiviert an Position 0-9.<br /><i>Kleinere Zahl wird links angezeigt</i>.');
define('PRODUCT_LIST_A_INFO_DESCRIPTION', 'Möchten Sie die Artikel-Kurzbeschreibung anzeigen?<br /><br />leer = deaktiviert<br />0-9 = aktiviert an Position 0-9.<br /><i>Kleinere Zahl wird links angezeigt</i>.');
define('PRODUCT_LIST_A_PACKING_UNIT_DESCRIPTION', 'Möchten Sie die Verpackungseinheit (VPE) anzeigen?<br /><br />leer = deaktiviert<br />0-9 = aktiviert an Position 0-9.<br /><i>Kleinere Zahl wird links angezeigt</i>.');
define('PRODUCT_LIST_A_PRICE_DESCRIPTION', 'Möchten Sie den Artikelpreis anzeigen?<br /><br />leer = deaktiviert<br />0-9 = aktiviert an Position 0-9.<br /><i>Kleinere Zahl wird links angezeigt</i>.');
define('PRODUCT_LIST_A_QUANTITY_DESCRIPTION', 'Möchten Sie die verfügbare Artikelmenge anzeigen?<br /><br />leer = deaktiviert<br />0-9 = aktiviert an Position 0-9.<br /><i>Kleinere Zahl wird links angezeigt</i>.');
define('PRODUCT_LIST_A_WEIGHT_DESCRIPTION', 'Möchten Sie das Artikelgewicht anzeigen?<br /><br />leer = deaktiviert<br />0-9 = aktiviert an Position 0-9.<br /><i>Kleinere Zahl wird links angezeigt</i>.');
define('PRODUCT_LIST_A_BUY_NOW_DESCRIPTION', 'Möchten Sie den Button </i>In den Korb</i> anzeigen?<br /><br />leer = deaktiviert<br />0-9 = aktiviert an Position 0-9.<br /><i>Kleinere Zahl wird links angezeigt</i>.');
define('PRODUCT_LIST_A_FILTER_DESCRIPTION', 'Möchten Sie, dass der Kategorie/Hersteller-Filter angezeigt wird?<br /><br />0=deaktiviert<br />1=aktiviert');


define('PRODUCT_LIST_B_IMAGE_TITLE', 'Produktbild anzeigen');
define('PRODUCT_LIST_B_MANUFACTURER_TITLE', 'Herstellername anzeigen');
define('PRODUCT_LIST_B_MODEL_TITLE', 'Artikelnummer anzeigen');
define('PRODUCT_LIST_B_NAME_TITLE', 'Artikelname anzeigen');
define('PRODUCT_LIST_B_INFO_TITLE', 'Artikel-Kurzbeschreibung anzeigen');
define('PRODUCT_LIST_B_PACKING_UNIT_TITLE', 'Verpackungseinheit (VPE) anzeigen');
define('PRODUCT_LIST_B_PRICE_TITLE', 'Artikelpreis anzeigen');
define('PRODUCT_LIST_B_QUANTITY_TITLE', 'Artikelmenge anzeigen');
define('PRODUCT_LIST_B_WEIGHT_TITLE', 'Artikelgewicht anzeigen');
define('PRODUCT_LIST_B_BUY_NOW_TITLE', 'Button <i>In den Korb</i> anzeigen');
define('PRODUCT_LIST_B_FILTER_TITLE', 'Kategorie/Hersteller-Filter anzeigen');

define('PRODUCT_LIST_B_IMAGE_DESCRIPTION', 'Möchten Sie das Produktbild anzeigen?<br /><br />leer = deaktiviert<br />0-9 = aktiviert an Position 0-9.<br /><i>Kleinere Zahl wird oben angezeigt</i>.');
define('PRODUCT_LIST_B_MANUFACTURER_DESCRIPTION', 'Möchten Sie den Herstellername anzeigen?<br /><br />leer = deaktiviert<br />0-9 = aktiviert an Position 0-9.<br /><i>Kleinere Zahl wird oben angezeigt</i>.');
define('PRODUCT_LIST_B_MODEL_DESCRIPTION', 'Möchten Sie die Artikelnummer anzeigen?<br /><br />leer = deaktiviert<br />0-9 = aktiviert an Position 0-9.<br /><i>Kleinere Zahl wird oben angezeigt</i>.');
define('PRODUCT_LIST_B_NAME_DESCRIPTION', 'Möchten Sie den Artikelname anzeigen?<br /><br />leer = deaktiviert<br />0-9 = aktiviert an Position 0-9.<br /><i>Kleinere Zahl wird oben angezeigt</i>.');
define('PRODUCT_LIST_B_INFO_DESCRIPTION', 'Möchten Sie die Artikel-Kurzbeschreibung anzeigen?<br /><br />leer = deaktiviert<br />0-9 = aktiviert an Position 0-9.<br /><i>Kleinere Zahl wird oben angezeigt</i>.');
define('PRODUCT_LIST_B_PACKING_UNIT_DESCRIPTION', 'Möchten Sie die Verpackungseinheit (VPE) anzeigen?<br /><br />leer = deaktiviert<br />0-9 = aktiviert an Position 0-9.<br /><i>Kleinere Zahl wird oben angezeigt</i>.');
define('PRODUCT_LIST_B_PRICE_DESCRIPTION', 'Möchten Sie den Artikelpreis anzeigen?<br /><br />leer = deaktiviert<br />0-9 = aktiviert an Position 0-9.<br /><i>Kleinere Zahl wird oben angezeigt</i>.');
define('PRODUCT_LIST_B_QUANTITY_DESCRIPTION', 'Möchten Sie die verfügbare Artikelmenge anzeigen?<br /><br />leer = deaktiviert<br />0-9 = aktiviert an Position 0-9.<br /><i>Kleinere Zahl wird oben angezeigt</i>.');
define('PRODUCT_LIST_B_WEIGHT_DESCRIPTION', 'Möchten Sie das Artikelgewicht anzeigen?<br /><br />leer = deaktiviert<br />0-9 = aktiviert an Position 0-9.<br /><i>Kleinere Zahl wird oben angezeigt</i>.');
define('PRODUCT_LIST_B_BUY_NOW_DESCRIPTION', 'Möchten Sie den Button </i>Jetzt-Kaufen</i> anzeigen?<br /><br />leer = deaktiviert<br />0-9 = aktiviert an Position 0-9.<br /><i>Kleinere Zahl wird oben angezeigt</i>.');
define('PRODUCT_LIST_B_FILTER_DESCRIPTION', 'Möchten Sie, dass der Kategorie/Hersteller-Filter angezeigt wird?<br /><br />0=deaktiviert<br />1=aktiviert');

define('STOCK_CHECK_TITLE', 'Lagerbestand prüfen');
define('STOCK_LIMITED_TITLE', 'Lagerbestand aktualisieren');
define('STOCK_ALLOW_CHECKOUT_TITLE', 'Bestellvorgang erlauben');
define('STOCK_MARK_PRODUCT_OUT_OF_STOCK_TITLE', 'Markierung von nicht lieferbaren Produkten');
define('STOCK_REORDER_LEVEL_TITLE', 'Mindestlagerbestand');

define('STOCK_CHECK_DESCRIPTION', 'Soll geprüft werden, ob genügend Lagerbestand vorhanden ist?');
define('STOCK_LIMITED_DESCRIPTION', 'Soll der Lagerbestand bei Bestellungen aktualisiert werden?');
define('STOCK_ALLOW_CHECKOUT_DESCRIPTION', 'Soll dem Kunden das Bestellen auch dann ermöglicht werden, wenn der Lagerbestand nicht ausreichend ist?');
define('STOCK_MARK_PRODUCT_OUT_OF_STOCK_DESCRIPTION', 'Angezeigte Markierung für den Kunden auf dem Bildschirm, wenn ein Produkt nicht ausreichend vorrätig ist.');
define('STOCK_REORDER_LEVEL_DESCRIPTION', 'Der Mindestlagerbestand, ab dem ein Artikel nachbestellt werden soll.');




define('STORE_PAGE_PARSE_TIME_TITLE', 'Speicherung der Erstellungszeit');
define('STORE_PAGE_PARSE_TIME_LOG_TITLE', 'Logdatei-Verzeichnis');
define('STORE_PARSE_DATE_TIME_FORMAT_TITLE', 'Log-Datumsformat');
define('DISPLAY_PAGE_PARSE_TIME_TITLE', 'Erstellungszeit anzeigen');
define('STORE_DB_TRANSACTIONS_TITLE', 'Datenbankabfragen speichern');

define('STORE_PAGE_PARSE_TIME_DESCRIPTION', 'Die Zeit speichern, die zum Erstellen (Parsen) von Seiten benötigt wird.');
define('STORE_PAGE_PARSE_TIME_LOG_DESCRIPTION', 'Das Verzeichnis und der Dateiname zur Speicherung der Erstellungszeit.');
define('STORE_PARSE_DATE_TIME_FORMAT_DESCRIPTION', 'Das Datumsformat für die Logdaten');
define('DISPLAY_PAGE_PARSE_TIME_DESCRIPTION', 'Die Zeit anzeigen, die zum Erstellen (Parsen) von Seiten benötigt wird (Speicherung der Erstellungszeit muss aktiviert sein).');
define('STORE_DB_TRANSACTIONS_DESCRIPTION', 'Die Datenbankabfragen in der Logdatei speichern.');




define('CACHE_LEVEL_TITLE', 'Cache einschalten');
define('COMPILE_CHECK_TITLE', 'Kompilierte Vorlage (Template) prüfen');
define('ALLOW_VISITORS_TO_CHANGE_TEMPLATE_TITLE', 'Besuchern das wechseln der Vorlage (Template) erlauben');
define('DEFAULT_TPL_TITLE', 'Standard-Vorlage (Template)');
define('REGISTERED_TPLS_TITLE', 'Registrierte Vorlagen (Templates)');

define('CACHE_LEVEL_DESCRIPTION', 'Cache einschalten und Level wählen.<br />0 = No cache<br />1 = Level1 cache<br />2 = Level2 cache<br />3 = Level3 cache');
define('COMPILE_CHECK_DESCRIPTION', 'Überprüfen ob die kompilierte Vorlage (Template) noch aktuell ist.<br />Standard = "false"');
define('ALLOW_VISITORS_TO_CHANGE_TEMPLATE_DESCRIPTION', 'Wollen Sie Shop-Besuchern das wechseln der Vorlage erlauben.<br />Standard = "false"');
define('DEFAULT_TPL_DESCRIPTION', 'Wählen Sie eine Vorlage (Template) als Standard-Vorlage.<br />');
define('REGISTERED_TPLS_DESCRIPTION', 'Vorlagen (Templates) registrieren.<br />Die Vorlagen müssen sich in folgenden Verzeichnissen befinden:<br /><br />' . DIR_FS_SMARTY . '<br />catalog/templates/<br /><br />und<br /><br />' . DIR_FS_CATALOG_IMAGES . '<br />catalog/templates/<br />');




define('SEND_EMAILS_TITLE', 'eMails versenden');
define('EMAIL_USE_HTML_TITLE', 'MIME-HTML für den eMailversand nutzen');
define('EMAIL_SHOP_LOGO_TITLE', 'Shop-logo wenn MIME HTML benutzt wird');
define('ENTRY_EMAIL_ADDRESS_CHECK_TITLE', 'eMail-Addressen anhand DNS prüfen');
define('EMAIL_TRANSPORT_TITLE', 'eMail Versandart');
define('SENDMAIL_PATH_TITLE', 'Pfad zu sendmail');
define('SMTP_HOST_TITLE', 'Adressen der SMTP-Server');
define('SMTP_AUTH_TITLE', 'SMTP AUTH');
define('SMTP_SECURE_TITLE', 'SMTP-Verschlüsselungsverfahren');
define('SMTP_USERNAME_TITLE', 'SMTP-Benutzername');
define('SMTP_PASSWORD_TITLE', 'SMTP-Passwort');

define('SEND_EMAILS_DESCRIPTION', 'Sollen eMails versendet werden.');
define('EMAIL_USE_HTML_DESCRIPTION', 'eMails auch im HTML-Format senden.');
define('EMAIL_SHOP_LOGO_DESCRIPTION', 'Bitte geben Sie hier den Namen Ihres shop-logos ein.');
define('ENTRY_EMAIL_ADDRESS_CHECK_DESCRIPTION', 'Prüft die eMail-Adressen anhand eines DNS-Servers.');
define('EMAIL_TRANSPORT_DESCRIPTION', 'Dieser Wert definiert, ob Ihr Server eine lokale Verbindung zu sendmail benutzt oder eine SMTP-Verbindung via TCP/IP. Bei Windows- und MacOS-Servern auf SMTP einstellen.');
define('SENDMAIL_PATH_DESCRIPTION', 'Wenn Sie sendmail benutzen, geben Sie hier den richtigen Pfad zum Programm ein (Standard: /usr/bin/sendmail).');
define('SMTP_HOST_DESCRIPTION', 'Bitte geben Sie hier die Adresssen Ihrer SMTP-Server ein. Alle Adressen müssen mit einem Semikolon separiert werden. Sie können auch einen anderen Port für jeden Hostnamen spezifizieren, indem Sie dieses Format verwenden&nbsp;->&nbsp;[hostname:port].<br />Beispiel:<br />(smtp1.example.com:25;smtp2.example.com).');
define('SMTP_AUTH_DESCRIPTION', 'Erfordert der SMTP-Server eine sichere Authentifizierung?');
define('SMTP_SECURE_DESCRIPTION', 'Wählen Sie das Verfahren \'ssl oder tls\' zur eMail-Verschlüsselung, oder wählen Sie \'---\' für keine Verschlüsselung.');
define('SMTP_USERNAME_DESCRIPTION', 'Bitte geben Sie hier den Benutzernamen Ihres SMTP-Kontos ein.');
define('SMTP_PASSWORD_DESCRIPTION', 'Bitte geben Sie hier das Passwort Ihres SMTP-Kontos ein.');




define('DOWNLOAD_ENABLED_TITLE', 'Download aktivieren');
define('DOWNLOAD_BY_REDIRECT_TITLE', 'Download per Weiterleitung');
define('DOWNLOAD_MAX_DAYS_TITLE', 'Ablaufzeit (Tage)');
define('DOWNLOAD_MAX_COUNT_TITLE', 'Maximale Anzahl an Downloads');

define('DOWNLOAD_ENABLED_DESCRIPTION', 'Aktiviert die Download-Funktion bei Artikeln.');
define('DOWNLOAD_BY_REDIRECT_DESCRIPTION', 'Nutzt für den Download eine Browser-Weiterleitung (auf Nicht-Unixsystemen deaktivieren).');
define('DOWNLOAD_MAX_DAYS_DESCRIPTION', 'Die Anzahl der Tage bis zum Ablauf der Downloadmöglichkeit. 0 bedeutet kein Limit.');
define('DOWNLOAD_MAX_COUNT_DESCRIPTION', 'Maximal mögliche Anzahl von Downloads aktivieren. 0 bedeutet keine Autorisierung für Downloads erforderlich.');




define('GZIP_COMPRESSION_TITLE', 'GZip-Kompression aktivieren');
define('GZIP_LEVEL_TITLE', 'Kompressionsgrad');

define('GZIP_COMPRESSION_DESCRIPTION', 'Die HTTP-GZip-Kompression aktivieren.');
define('GZIP_LEVEL_DESCRIPTION', 'Die Stufe der Komprimierung.<br />Level 0 bis 9 (0 = geringe Komprimierung, 9 = hohe Komprimierung).');




define('SESSION_WRITE_DIRECTORY_TITLE', 'Session-Verzeichnis');
define('SESSION_FORCE_COOKIE_USE_TITLE', 'Benutzen von Cookies erzwingen');
define('SESSION_CHECK_SSL_SESSION_ID_TITLE', 'SSL-Session-ID überprüfen');
define('SESSION_CHECK_USER_AGENT_TITLE', 'User-Agent überprüfen');
define('SESSION_CHECK_IP_ADDRESS_TITLE', 'IP-Adresse überprüfen');
define('SESSION_BLOCK_SPIDERS_TITLE', 'Spider-Sessions verhindern');
define('SESSION_RECREATE_TITLE', 'Session erneuern');

define('SESSION_WRITE_DIRECTORY_DESCRIPTION', 'Die Sessions werden in dem angegebenen Verzeichnis gespeichert, sofern die Sessions dateibasiert laufen.');
define('SESSION_FORCE_COOKIE_USE_DESCRIPTION', 'Erzwingt die Benutzung von Cookies zum Speichern der Session-ID.');
define('SESSION_CHECK_SSL_SESSION_ID_DESCRIPTION', 'Überprüft bei jedem HTTPS-Seitenaufruf die Korrektheit der SSL-Session-ID.');
define('SESSION_CHECK_USER_AGENT_DESCRIPTION', 'Bei jedem Seitenaufruf den Browser-User-Agent überprüfen.');
define('SESSION_CHECK_IP_ADDRESS_DESCRIPTION', 'Überprüft bei jedem Seitenaufruf die IP-Adresse des Kunden.');
define('SESSION_BLOCK_SPIDERS_DESCRIPTION', 'Verhindert bei bekannten Suchmaschinen, dass diese eine Session starten.');
define('SESSION_RECREATE_DESCRIPTION', 'Die Sessiondaten werden erneuert und eine neue Session-Id wird erstellt, wenn ein Kunde sich anmeldet oder ein neues Kundenkonto eröffnet.');




define('SITE_OFFLINE_TITLE', 'Website abschalten');

define('SITE_OFFLINE_DESCRIPTION', 'Die Website für Besucher und Kunden abschalten.');

define('TEXT_INFO_EDIT_INTRO', 'Bitte führen Sie alle notwendigen Änderungen durch');
define('TEXT_INFO_DATE_ADDED', 'hinzugefügt am:');
define('TEXT_INFO_LAST_MODIFIED', 'letzte Änderung:');
?>
