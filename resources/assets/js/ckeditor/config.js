/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	config.uploadUrl = '/ckfinder/connector?command=QuickUpload&type=Files&responseType=json';
    filebrowserBrowseUrl = '/ckfinder/browser';
    config.filebrowserImageBrowseUrl = '/ckfinder/browser?type=Images';
    config.filebrowserUploadUrl = '/ckfinder/connector?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl = '/ckfinder/connector?command=QuickUpload&type=Images';
    
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
};
