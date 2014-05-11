/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

// Register a templates definition set named "default".
CKEDITOR.addTemplates( 'espanol_default',
{
	// The name of sub folder which hold the shortcut preview images of the
	// templates.
	imagesPath : CKEDITOR.getUrl( '../ckconfig/tpl_images/' ),

	// The templates definitions.
	templates :
		[
			{
				title: 'Imagen y Título',
				image: 'template1.gif',
				description: 'Una imagen principal con un título y el texto que rodean la imagen',
				html:
					'<h3>' +
						'<img style="width: 100px; height: 100px; margin-right: 10px; float: left;" alt=""/>' +
						'Escriba el título aquí'+
					'</h3>' +
					'<p>' +
						'Escriba el texto aquí' +
					'</p>' +
					'<div class="clear">&nbsp;</div>'
			},
			{
				title: 'Las columnas de plantilla',
				image: 'template2.gif',
				description: 'Una plantilla que define dos columnas, cada una con un título, y algo de texto.',
				html:
					'<table style="width:100%">' +
						'<tr>' +
							'<td style="width:50%">' +
								'<h3>Título 1</h3>' +
							'</td>' +
							'<td></td>' +
							'<td style="width:50%">' +
								'<h3>Título 2</h3>' +
							'</td>' +
						'</tr>' +
						'<tr>' +
							'<td>' +
								'Texto 1' +
							'</td>' +
							'<td></td>' +
							'<td>' +
								'Texto 1' +
							'</td>' +
						'</tr>' +
					'</table>' +
					'<p>' +
						'Más de texto va aquí.' +
					'</p>' +
					'<div class="clear">&nbsp;</div>'
			},
			{
				title: 'Texto en tabla',
				image: 'template3.gif',
				description: 'Un libro con texto y una tabla.',
				html:
					'<div style="width: 80%">' +
						'<h3>' +
							'Aquí va el título' +
						'</h3>' +
						'<table style="width:150px;float: right" border="1">' +
							'<caption style="border:solid 1px black">' +
								'<strong>Tabla título</strong>' +
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
							'Escriba el texto aquí' +
						'</p>' +
					'</div>' +
					'<div class="clear">&nbsp;</div>'
			}
		]
});
