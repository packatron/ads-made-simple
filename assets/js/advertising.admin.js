
$(document).ready(function() {
    if (!$('.ads-made-simple-banner-select').length) { return; }
    if (typeof wp == 'undefined' || !wp.media || !wp.media.editor) { return; }

    $(document).on('click', '.ads-made-simple-banner-select', function(e) {
        e.preventDefault();
        var button = $(this);
        var id = button.prev();
        var img = id.prev();

        wp.media.editor.send.attachment = function(props, attachment) {
            img.attr('src', attachment.sizes.full.url);
            id.val(attachment.id);
            return attachment
        };

        wp.media.editor.open(button);

        return false;
    });

    $(document).on('click', '.ads-made-simple-banner-remove', function(e) {
        e.preventDefault();
        var button = $(this);
        var id = button.prev().prev();
        var img = id.prev();

        id.val('');
        img.attr('src', '');

        return false;
    });
});
