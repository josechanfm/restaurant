$(function() {
        $('textarea.texteditor').ckeditor({
                language: 'zh',
                extraPlugins : 'placeholder,youtube', 
                toolbar: [
                ['Source','-','Save','NewPage','Preview','-','Templates'],
	  	['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
		['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
		['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
		'/',
		['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
		['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
		['Link','Unlink','Anchor','Youtube'],
		['Image','Flash','Table','HorizontalRule','Hhs','Smiley','SpecialChar','PageBreak'],
		'/',
		['Styles','Format','Font','FontSize'],
		['TextColor','BGColor'],
		['Maximize', 'ShowBlocks','-','About','CreatePlaceholder']
	       
        ],
                //this code below for kcfinder           
                filebrowserBrowseUrl:           base_url+'assets/grocery_crud/texteditor/ckeditor/kcfinder/browse.php?opener=ckeditor&type=files',
                filebrowserImageBrowseUrl:      base_url+'assets/grocery_crud/texteditor/ckeditor/kcfinder/browse.php?opener=ckeditor&type=images',
                filebrowserFlashBrowseUrl:      base_url+'assets/grocery_crud/texteditor/ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash',
                filebrowserUploadUrl:           base_url+'assets/grocery_crud/texteditor/ckeditor/kcfinder/upload.php?opener=ckeditor&type=files',
                filebrowserImageUploadUrl:      base_url+'assets/grocery_crud/texteditor/ckeditor/kcfinder/upload.php?opener=ckeditor&type=images',
                filebrowserFlashUploadUrl:      base_url+'assets/grocery_crud/texteditor/ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash'
                
       
                
        });
        $('textarea.mini-texteditor').ckeditor({
                language: 'zh',
                toolbar: 'Basic',
                width: 700
        });
        
});