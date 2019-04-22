$(function(){
	$( 'textarea.texteditor' ).ckeditor({
		toolbar:'Full',
		filebrowserUploadUrl: "/admin/media/upload"

	});
	$( 'textarea.mini-texteditor' ).ckeditor({toolbar:'Basic',width:700});
});
