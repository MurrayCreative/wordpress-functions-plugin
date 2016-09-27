/**
*
* admin/js/wp-cbf-admin.js
*
**/
(function( $ ) {
    'use strict';

    $(function(){

         // Let's set up some variables for the image upload and removing the image
         var frame,
             imgUploadButton = $( '#upload_login_logo_button' ),
             imgContainer = $( '#upload_logo_preview' ),
             imgIdInput = $( '#login_logo_id' ),
             imgPreview = $('#upload_logo_preview'),
             imgDelButton = $('#studio-manager-delete_logo_button'),
             $showChild = $('.show-child-if-checked'),
             $showNewHardCrop = $('.new-images-size-crop'),
             $showNewHardCropPositions = $('.new-hard-crop-positions'),
             $showExistingHardCrop = $('.existing-images-size-crop'),
             $showExistingHardCropPositions = $('.existing-hard-crop-positions');


        // wp.media add Image
         imgUploadButton.on( 'click', function( event ){

         	console.log('Logo button clicked');

            event.preventDefault();
            
            // If the media frame already exists, reopen it.
            if ( frame ) {
              frame.open();
              return;
            }
            
            // Create a new media frame
            frame = wp.media({
              title: 'Select or Upload Media for your Login Logo',
              button: {
                text: 'Use as Login page Logo'
              },
              multiple: false  // Set to true to allow multiple files to be selected
            });
            // When an image is selected in the media frame...
            frame.on( 'select', function() {
              
              // Get media attachment details from the frame state
              var attachment = frame.state().get('selection').first().toJSON();    

              // console.log(attachment);

              // Send the attachment URL to our custom image input field.
              imgPreview.find( 'img' ).attr( 'src', attachment.sizes.thumbnail.url );

              // Send the attachment id to our hidden input
              imgIdInput.val( attachment.id );

              // Unhide the remove image link
              imgPreview.removeClass( 'hidden' );
            });

            // Finally, open the modal on click
            frame.open();
        });


        // Erase image url and age preview
        imgDelButton.on('click', function(e){
            e.preventDefault();
            imgIdInput.val('');
            imgPreview.find( 'img' ).attr( 'src', '' );
            imgPreview.addClass('hidden');
        });


		// Fields showing after parent is checked
		$showChild.on('change', function() {
			if($(this).is(':checked')) {
				$(this).parent().next('fieldset').removeClass('hidden');
			}else{
				$(this).parent().next('fieldset').addClass('hidden');
			}
		});


		// Show / hide the hard crop options for new image sizes
		$showNewHardCrop.on('change', function() {
			// console.log( $(this).parent().find('.new-hard-crop-positions') );
			if($(this).is(':checked')) {
				$(this).parent().find('.new-hard-crop-positions').removeClass('hidden');
			}else{
				$(this).parent().find('.new-hard-crop-positions').addClass('hidden');
			}
		});


		// Show / hide the hard crop options for existing image sizes
		$showExistingHardCrop.on('change', function() {
			if($(this).is(':checked')) {
				$(this).parent().find('.existing-hard-crop-positions').removeClass('hidden');
			}else{
				$(this).parent().find('.existing-hard-crop-positions').addClass('hidden');
			}
		});


		// Loop through each existing size and remove hidden class if cropping is checked
		$.each($showExistingHardCrop, function() {
			if($(this).is(':checked')) {
				$(this).parent().find('.existing-hard-crop-positions').removeClass('hidden');
			}
		});


    }); // End of DOM Ready

})( jQuery );