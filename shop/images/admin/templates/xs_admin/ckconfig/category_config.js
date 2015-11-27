/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.config.allowedContent = true;

CKEDITOR.editorConfig = function( config )
{ 

    config.toolbar_CategoryToolbar =
    [
	{ name: 'document', items : [ 'Source','-','NewPage','Preview','Print','-','Templates' ] },
	{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
	{ name: 'editing', items : [ 'Find','Replace','-','SelectAll' ] },
  { name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] },
	'/',
	{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },  
	{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
	{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','SpecialChar','Iframe' ] },  
	'/',
	{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },  
	{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
	{ name: 'colors', items : [ 'TextColor','BGColor' ] }
    ];
    
    config.toolbar = 'CategoryToolbar'; 
    config.width = '700';
    config.height = '300';
    config.uiColor = '#9AB8F3';

    config.entities = false;
    config.entities_latin = false;
    config.entities_greek = false;
    
    config.filebrowserWindowWidth = '1150';
		
};

CKEDITOR.on( 'dialogDefinition', function( ev )	{				
				var dialogName = ev.data.name;
				var dialogDefinition = ev.data.definition;						
				if ( dialogName == 'table' ){
					var infoTab = dialogDefinition.getContents( 'info' );
          infoTab.get('txtBorder')['default'] = '';
          infoTab.get('txtCellSpace')['default'] = '';
          infoTab.get('txtCellPad')['default'] = '';
/*          infoTab.get('txtWidth')['default'] = '';     */     
				}
}	);