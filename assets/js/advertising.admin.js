jQuery(function($){

    // Set all variables to be used in scope
    var frame,
        metaBox = $('#advertising-meta-box.postbox'),
        addImgLink = metaBox.find('.ads-made-simple-banner-select'),
        delImgLink = metaBox.find('.ads-made-simple-banner-remove')

    var button;

    // ADD IMAGE LINK
    addImgLink.on( 'click', function( event ){
        event.preventDefault();

        button = $(this);

        // If the media frame already exists, reopen it.
        if ( frame ) {
            frame.open();
            return;
        }

        // Create a new media frame
        frame = wp.media({
            title: 'Select or Upload Media Of Your Chosen Persuasion',
            button: {
                text: 'Use this media'
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });


        // When an image is selected in the media frame...
        frame.on( 'select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            var imgSrcInput = button.prev();
            var imgIdInput = button.prev().prev();
            var imgDisplay = button.prev().prev().prev();

            imgIdInput.val( attachment.id );
            imgSrcInput.val( attachment.sizes.full.url );
            imgDisplay.attr('src', attachment.sizes.full.url);
        });

        // Finally, open the modal on click
        frame.open();
    });

    // DELETE IMAGE LINK
    delImgLink.on( 'click', function( event ){
        event.preventDefault();
        button = $(this);
        var imgSrcInput = button.prev().prev();
        var imgIdInput = button.prev().prev().prev();
        var imgDisplay = button.prev().prev().prev().prev();
        imgIdInput.val('');
        imgSrcInput.val('');
        imgDisplay.attr('src', '');
    });
});