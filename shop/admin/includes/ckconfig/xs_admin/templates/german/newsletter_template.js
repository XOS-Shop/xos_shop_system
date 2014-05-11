/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

// Register a templates definition set named "default".
CKEDITOR.addTemplates( 'german_default',
{
	// The name of sub folder which hold the shortcut preview images of the
	// templates.
	imagesPath : CKEDITOR.getUrl( '../ckconfig/tpl_images/' ),

	// The templates definitions.
	templates :
		[
			{
				title: 'Bild mit Titel',
				image: 'template1.gif',
				description: 'Ein Bild mit Titel umgeben von Text.',
				html:
					'<h3>' +
						'<img style="width: 100px; height: 100px; margin-right: 10px; float: left;" alt=""/>' +
						'Titel hier eingeben'+
					'</h3>' +
					'<p>' +
						'Text hier eingeben' +
					'</p>'
			},
			{
				title: 'Spalten Vorlage',
				image: 'template2.gif',
				description: 'Eine Vorlage mit zwei Spalten jede mit einem Titel und etwas Text.',
				html:
					'<table style="width:100%">' +
						'<tr>' +
							'<td style="width:50%">' +
								'<h3>Titel 1</h3>' +
							'</td>' +
							'<td></td>' +
							'<td style="width:50%">' +
								'<h3>Titel 2</h3>' +
							'</td>' +
						'</tr>' +
						'<tr>' +
							'<td>' +
								'Text 1' +
							'</td>' +
							'<td></td>' +
							'<td>' +
								'Text 2' +
							'</td>' +
						'</tr>' +
					'</table>' +
					'<p>' +
						'Mehr Text hier einfügen.' +
					'</p>'
			},
			{
				title: 'Text mit Tabelle',
				image: 'template3.gif',
				description: 'Ein Titel mit etwas Text und einer Tabelle.',
				html:
					'<div style="width: 80%">' +
						'<h3>' +
							'Titel hier einfügen' +
						'</h3>' +
						'<table style="width:150px;float: right" border="1">' +
							'<caption style="border:solid 1px black">' +
								'<strong>Tabellen-Titel</strong>' +
							'</caption>' +
							'</tr>' +
							'<tr>' +
								'<td>&nbsp;</td>' +
								'<td>&nbsp;</td>' +
								'<td>&nbsp;</td>' +
							'</tr>' +
							'<tr>' +
								'<td>&nbsp;</td>' +
								'<td>&nbsp;</td>' +
								'<td>&nbsp;</td>' +
							'</tr>' +
							'<tr>' +
								'<td>&nbsp;</td>' +
								'<td>&nbsp;</td>' +
								'<td>&nbsp;</td>' +
							'</tr>' +
						'</table>' +
						'<p>' +
							'Hier den Text eingeben' +
						'</p>' +
					'</div>'
			}
		]
});
