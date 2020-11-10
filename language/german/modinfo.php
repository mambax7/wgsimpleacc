<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgSimpleAcc module for xoops
 *
 * @copyright      2020 XOOPS Project (https://xooops.org)
 * @license        GPL 2.0 or later
 * @package        wgsimpleacc
 * @since          1.0
 * @min_xoops      2.5.10
 * @author         XOOPS Development Team - Email:<webmaster@wedega.com> - Website:<https://xoops.wedega.com>
 */

require_once 'common.php';

// ---------------- Admin Main ----------------
\define('_MI_WGSIMPLEACC_NAME', 'wgSimpleAcc');
\define('_MI_WGSIMPLEACC_DESC', 'wgSimpleAcc ist ein Tool für die Einnahmen-Ausgaben-Rechnung von Vereinen');
// ---------------- Admin Menu ----------------
\define('_MI_WGSIMPLEACC_ADMENU1', 'Übersicht');
\define('_MI_WGSIMPLEACC_ADMENU2', 'Transaktionen');
\define('_MI_WGSIMPLEACC_ADMENU3', 'Dateien');
\define('_MI_WGSIMPLEACC_ADMENU4', 'Vermögenswerte');
\define('_MI_WGSIMPLEACC_ADMENU5', 'Konten');
\define('_MI_WGSIMPLEACC_ADMENU6', 'Zuordnungen');
\define('_MI_WGSIMPLEACC_ADMENU7', 'Währungen');
\define('_MI_WGSIMPLEACC_ADMENU8', 'Steuerarten');
\define('_MI_WGSIMPLEACC_ADMENU9', 'Abschlüsse');
\define('_MI_WGSIMPLEACC_ADMENU10', 'Vorlagen Transaktion');
\define('_MI_WGSIMPLEACC_ADMENU11', 'Vorlagen Ausgabe');
\define('_MI_WGSIMPLEACC_ADMENU12', 'Berechtigungen');
\define('_MI_WGSIMPLEACC_ADMENU13', 'Feedback');
\define('_MI_WGSIMPLEACC_ABOUT', 'Über');
// ---------------- Admin Nav ----------------
\define('_MI_WGSIMPLEACC_ADMIN_PAGER', 'Listen Admin');
\define('_MI_WGSIMPLEACC_ADMIN_PAGER_DESC', 'Anzahl Einträge in Listen im Adminbereich');
// User
\define('_MI_WGSIMPLEACC_USER_PAGER', 'Listen User');
\define('_MI_WGSIMPLEACC_USER_PAGER_DESC', 'Anzahl Einträge in Listen im Userbereich');
// Config
\define('_MI_WGSIMPLEACC_EDITOR_ADMIN', 'Editor Admin');
\define('_MI_WGSIMPLEACC_EDITOR_ADMIN_DESC', 'Bitte den zu verwendenden Editor für den Admin-Bereich wählen');
\define('_MI_WGSIMPLEACC_EDITOR_USER', 'Editor User');
\define('_MI_WGSIMPLEACC_EDITOR_USER_DESC', 'Bitte den zu verwendenden Editor für den User-Bereich wählen');
\define('_MI_WGSIMPLEACC_EDITOR_MAXCHAR', 'Maximale Zeichen Text');
\define('_MI_WGSIMPLEACC_EDITOR_MAXCHAR_DESC', 'Maximale Anzahl an Zeichen für die Anzeige von Texten in Listen im Admin-Bereich');
\define('_MI_WGSIMPLEACC_KEYWORDS', 'Schlüsselworter');
\define('_MI_WGSIMPLEACC_KEYWORDS_DESC', 'Bitte Schlüsselwörter angeben (getrennt durch ein Komma)');
\define('_MI_WGSIMPLEACC_SIZE_MB', 'MB');
\define('_MI_WGSIMPLEACC_MAXWIDTH_IMAGE', 'Maximale Breite für große Bilder');
\define('_MI_WGSIMPLEACC_MAXWIDTH_IMAGE_DESC', 'Definieren Sie die maximale Breite, auf die die hochgeladenen Bilder automatisch verkleinert werden sollen (in pixel)<br>0 bedeutet, dass Bilder die Originalgröße behalten. <br>Wenn ein Bild kleiner ist als die angegebenen Maximalwerte, so wird das Bild nicht vergrößert, sondern es wird in Originalgröße abgespeichert');
\define('_MI_WGSIMPLEACC_MAXHEIGHT_IMAGE', 'Maximale Höhe für große Bilder');
\define('_MI_WGSIMPLEACC_MAXHEIGHT_IMAGE_DESC', 'Definieren Sie die maximale Höhe, auf die die hochgeladenen Bilder automatisch verkleinert werden sollen (in pixel)<br>0 bedeutet, dass Bilder die Originalgröße behalten. <br>Wenn ein Bild kleiner ist als die angegebenen Maximalwerte, so wird das Bild nicht vergrößert, sondern es wird in Originalgröße abgespeichert');
\define('_MI_WGSIMPLEACC_MAXSIZE_FILE', 'Maximale Dateigröße');
\define('_MI_WGSIMPLEACC_MAXSIZE_FILE_DESC', 'Bitte die für den Upload von Dateien maximal zulässige Dateigröße definieren');
\define('_MI_WGSIMPLEACC_MIMETYPES_FILE', 'Zulässige Dateierweiterungen');
\define('_MI_WGSIMPLEACC_MIMETYPES_FILE_DESC', 'Bitte die für den Upload von Dateien zulässigen Dateierweiterungen definieren');
\define('_MI_WGSIMPLEACC_UPLOAD_BY_APP', 'Upload-App verwenden');
\define('_MI_WGSIMPLEACC_UPLOAD_BY_APP_DESC', "Wenn Sie eine App zum Hochladen von Dateien (z.B. Project Camera) verwenden wollen, dann wählen Sie 'Ja'");
\define('_MI_WGSIMPLEACC_ADVERTISE', 'Code Werbung');
\define('_MI_WGSIMPLEACC_ADVERTISE_DESC', 'Bitte Code für Werbungen eingeben');
\define('_MI_WGSIMPLEACC_MAINTAINEDBY', 'Unterstützt durch');
\define('_MI_WGSIMPLEACC_MAINTAINEDBY_DESC', 'Bitte Url für Support oder zur Community angeben');
\define('_MI_WGSIMPLEACC_SEP_COMMA', 'Komma-Zeichen');
\define('_MI_WGSIMPLEACC_SEP_COMMA_DESC', 'Bitte das Zeichen für Komma definieren');
\define('_MI_WGSIMPLEACC_SEP_THSD', 'Tausender-Trennzeichen');
\define('_MI_WGSIMPLEACC_SEP_THSD_DESC', 'Bitte das Trennzeichen für Tausender definieren');
\define('_MI_WGSIMPLEACC_USE_CURRENCIES', 'Währungen verwenden');
\define('_MI_WGSIMPLEACC_USE_CURRENCIES_DESC', 'Bitte definieren Sie, ob Sie Währungen verwenden wollen');
\define('_MI_WGSIMPLEACC_USE_TAXES', 'Steuerarten verwenden');
\define('_MI_WGSIMPLEACC_USE_TAXES_DESC', 'Bitte definieren Sie, ob Sie Steuerarten verwenden wollen');
\define('_MI_WGSIMPLEACC_USE_FILES', 'Dateisystem verwenden');
\define('_MI_WGSIMPLEACC_USE_FILES_DESC', 'Bitte definieren Sie, ob Sie die Möglichkeit zum Hinzufügen von Dateien zu Transaktionen verwenden wollen');
\define('_MI_WGSIMPLEACC_BALANCE_PERIOD', 'Zeitraum Abschlüsse');
\define('_MI_WGSIMPLEACC_BALANCE_PERIOD_DESC', 'Definieren Sie den Zeitraum für die Durchführung von Abschlüssen');
\define('_MI_WGSIMPLEACC_BALANCE_FILTER_PYEARLY', 'Jahr');
\define('_MI_WGSIMPLEACC_BALANCE_FILTER_PMONTHLY', 'Monatsweise');
\define('_MI_WGSIMPLEACC_BALANCE_PERIOD_FROM', 'Von');
\define('_MI_WGSIMPLEACC_BALANCE_PERIOD_FROM_DESC', "Bitte bei Zeitraum 'Monatsweise' wählen, ansonsten ignorieren");
\define('_MI_WGSIMPLEACC_BALANCE_PERIOD_TO', 'Bis');
\define('_MI_WGSIMPLEACC_JANUARY', 'Januar');
\define('_MI_WGSIMPLEACC_FEBRUARY', 'Februar');
\define('_MI_WGSIMPLEACC_MARCH', 'März');
\define('_MI_WGSIMPLEACC_APRIL', 'April');
\define('_MI_WGSIMPLEACC_MAY', 'Mai');
\define('_MI_WGSIMPLEACC_JUNE', 'Juni');
\define('_MI_WGSIMPLEACC_JULY', 'Juli');
\define('_MI_WGSIMPLEACC_AUGUST', 'August');
\define('_MI_WGSIMPLEACC_SEPTEMBER', 'September');
\define('_MI_WGSIMPLEACC_OCTOBER', 'Oktober');
\define('_MI_WGSIMPLEACC_NOVEMBER', 'November');
\define('_MI_WGSIMPLEACC_DECEMBER', 'Dezember');
\define('_MI_WGSIMPLEACC_INDEXHEADER', 'Index Kopfzeile');
\define('_MI_WGSIMPLEACC_INDEXHEADER_DESC', 'Diesen Text als Überschrift in der Indexseite anzeigen');
\define('_MI_WGSIMPLEACC_OTPL_SENDER', 'Standardabsender für Ausgabe');
\define('_MI_WGSIMPLEACC_OTPL_SENDER_DESC', 'Absender, der bei Ausgabevorlagen standardmäßig verwendet werden soll');
\define('_MI_WGSIMPLEACC_SHOWBCRUMBS', 'Brotkrumen-Navigation (breadcrumbs) anzeigen');
\define('_MI_WGSIMPLEACC_SHOWBCRUMBS_DESC', 'Eine Brotkrumen-Navigation zeigt den aktuellen Seitenstand innerhalb der Websitestruktur');
\define('_MI_WGSIMPLEACC_SHOWCOPYRIGHT', 'Copyright anzeigen');
\define('_MI_WGSIMPLEACC_SHOWCOPYRIGHT_DESC', 'Sie können das Copyright bei der wgSimpleAcc-Ansicht entfernen, jedoch wird ersucht, an einer beliebigen Stelle einen Backlink auf www.wedega.com anzubringen');
// Global notifications
\define('_MI_WGSIMPLEACC_NOTIFY_GLOBAL', 'Globale Benachrichtigungen');
\define('_MI_WGSIMPLEACC_NOTIFY_GLOBAL_NEW', 'Alle neuen Einträge');
\define('_MI_WGSIMPLEACC_NOTIFY_GLOBAL_NEW_CAPTION', 'Benachrichtige mich über alle neuen Einträge');
\define('_MI_WGSIMPLEACC_NOTIFY_GLOBAL_NEW_SUBJECT', 'Benachrichtigung über neuen Eintrag');
\define('_MI_WGSIMPLEACC_NOTIFY_GLOBAL_MODIFY', 'Alle Änderungen Einträge');
\define('_MI_WGSIMPLEACC_NOTIFY_GLOBAL_MODIFY_CAPTION', 'Benachrichtige mich über alle Änderungen von Einträgen');
\define('_MI_WGSIMPLEACC_NOTIFY_GLOBAL_MODIFY_SUBJECT', 'Benachrichtigung über Änderung Eintrag');
\define('_MI_WGSIMPLEACC_NOTIFY_GLOBAL_DELETE', 'Alle neuen Einträg');
\define('_MI_WGSIMPLEACC_NOTIFY_GLOBAL_DELETE_CAPTION', 'Benachrichtige mich über alle Löschungen von Einträge');
\define('_MI_WGSIMPLEACC_NOTIFY_GLOBAL_DELETE_SUBJECT', 'Benachrichtigung über Löschung Eintrag');
\define('_MI_WGSIMPLEACC_NOTIFY_GLOBAL_APPROVE', 'Alle auf Freigabe wartende Einträge');
\define('_MI_WGSIMPLEACC_NOTIFY_GLOBAL_APPROVE_CAPTION', 'Benachrichtige mich über alle auf Freigabe wartende Einträge');
\define('_MI_WGSIMPLEACC_NOTIFY_GLOBAL_APPROVE_SUBJECT', 'Benachrichtigung über auf Freigabe wartenden Eintrag');
\define('_MI_WGSIMPLEACC_NOTIFY_GLOBAL_COMMENT', 'Alle Kommentare');
\define('_MI_WGSIMPLEACC_NOTIFY_GLOBAL_COMMENT_CAPTION', 'Benachrichtige mich über alle Kommentare');
\define('_MI_WGSIMPLEACC_NOTIFY_GLOBAL_COMMENT_SUBJECT', 'Benachrichtigung über Kommentare');
// Transaction notifications
\define('_MI_WGSIMPLEACC_NOTIFY_TRANSACTION', 'Benachrichtigungen Transaktionen');
\define('_MI_WGSIMPLEACC_NOTIFY_TRANSACTION_MODIFY', 'Änderung Transaktion');
\define('_MI_WGSIMPLEACC_NOTIFY_TRANSACTION_MODIFY_CAPTION', 'Benachrichtige mich über Änderungen zu dieser Transaktion');
\define('_MI_WGSIMPLEACC_NOTIFY_TRANSACTION_MODIFY_SUBJECT', 'Benachrichtigung über Änderung Transaktion');
\define('_MI_WGSIMPLEACC_NOTIFY_TRANSACTION_DELETE', 'Löschen Transaktionen');
\define('_MI_WGSIMPLEACC_NOTIFY_TRANSACTION_DELETE_CAPTION', 'Benachrichtige mich über das Löschen dieser Transaktion');
\define('_MI_WGSIMPLEACC_NOTIFY_TRANSACTION_DELETE_SUBJECT', 'Benachrichtigung über Löschen Transaktion');
\define('_MI_WGSIMPLEACC_NOTIFY_TRANSACTION_COMMENT', 'Transaction comment');
\define('_MI_WGSIMPLEACC_NOTIFY_TRANSACTION_COMMENT_CAPTION', 'Notify me about comments for transaction');
\define('_MI_WGSIMPLEACC_NOTIFY_TRANSACTION_COMMENT_SUBJECT', 'Notification about comments for transaction');
// ---------------- End ----------------