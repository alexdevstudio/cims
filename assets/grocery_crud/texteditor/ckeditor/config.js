/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
      config.extraPlugins = '';
      config.entities_latin = false;
      config.htmlEncodeOutput = false;
      config.entities = false;
      config.uploadUrl = 'https://www.akupunkturskole.dk/admin/media/upload';
      config.allowedContent = true;
      config.extraPlugins = 'iframe,widget,image2,imagebrowser,btgrid,youtube,codemirror';
      config.imageBrowser_listUrl = "https://www.akupunkturskole.dk/admin/media/feed";
      config.startupOutlineBlocks = true;
      config.contentsCss = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css';
  //    config.extraPlugins = 'image2';


};
