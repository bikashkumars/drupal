/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - http://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document, undefined) {


// Place your code here.
Drupal.behaviors.fileValidateAutoAttach = {
  attach: function (context, settings) {
    if (settings.file && settings.file.elements) {
      $.each(settings.file.elements, function(selector) {
        var extensions = settings.file.elements[selector];
        $(selector, context).unbind('change', {extensions: extensions}, Drupal.file.validateExtension);
      });
    }
  }
};




 $(document).ready(function() {
 
	
   // put all your jQuery goodness in here.
   $('<div><input type="button" id="upload-btn1" value="'+Drupal.t("Upload")+'">'+Drupal.t("Hello world!")+'</div>').appendTo('body');
   
    if ($("#edit-submitted-image-upload .file").length > 0){
		$('<input type="file" id="edit-submitted-image-upload-upload" name="files[submitted_image_upload]" size="22" class="form-file">').appendTo('#edit-submitted-image-upload');
    }
	
	$('#upload-btn1').click(function(e){
        e.preventDefault();
        $('#edit-submitted-image-upload-upload').click();
		}
	);
	
	$('#edit-submitted-image-upload-upload').change(function() {
	   $('#edit-submitted-fake1').val($('#edit-submitted-image-upload-upload').val());
	});

 });

})(jQuery, Drupal, this, this.document);
