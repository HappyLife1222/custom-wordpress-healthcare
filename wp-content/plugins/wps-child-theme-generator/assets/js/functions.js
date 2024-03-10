(function ($) {
    "use strict";

    var fileFrame = null;
    var metaBox = $("div[id^='thumb_info_']"),
        addImgLink = metaBox.find('.upload-custom-img'),
        imgContainer = metaBox.find( '.custom-img-container'),
        imgID = metaBox.find( '.b7ectg_img_id' );

    $(function() {
        $(".upload-custom-img").on("click", showMediaUploader);
        $(".wps-capture").on("click", showMediaUploader);

        // hack for added fields
        $('.input_fields_wrap').on('click', '.upload-custom-img.new', showMediaUploader);
    });

    function showMediaUploader(e) {
        e.preventDefault();
        var self = this;

            fileFrame = wp.media.frames.file_frame = wp.media({
                title: screenHelp.title,
                button: {
                    text: screenHelp.buttomText
                },
                library: {
                    type: 'image' // limits the frame to show only images
                },
                multiple: false  // Set to true to allow multiple files to be selected
            });

           // fileFrame.state().get('selection').toJSON();
            fileFrame.on("select", function() {

                setCustomImage(self);
                fileFrame.close();
            });

            fileFrame.open();
    }

    function setCustomImage(btn) {

        var attachment = fileFrame.state().get("selection").first().toJSON();

        $(btn).prev().val(attachment.url);
        $(btn).siblings( '.b7ectg_img_id' ).val(attachment.id);

        $( '.custom-img-container' ).attr('src', attachment.url);
        $( '.custom-img-container' ).removeClass('hidden').addClass('visible');

        $(btn).val(screenHelp.uploadButtonText);

    }


})(jQuery);

jQuery(document).ready(function ($) {

    $('#b7ectg_admin_post_thumb_col').on('click', function() {
        var checkBoxes = $("input[name=b7ectg_admin_post_thumb_col_post]");
        checkBoxes.attr("checked", !checkBoxes.attr("checked"));

        var checkBoxes = $("input[name=b7ectg_admin_post_thumb_col_page]");
        checkBoxes.attr("checked", !checkBoxes.attr("checked"));
    });

    $('#b7ectg_admin_post_id_col').on('click', function() {
        var checkBoxes = $("input[name=b7ectg_admin_post_id_col_post]");
        checkBoxes.attr("checked", !checkBoxes.attr("checked"));

        var checkBoxes = $("input[name=b7ectg_admin_post_id_col_page]");
        checkBoxes.attr("checked", !checkBoxes.attr("checked"));
    });

    var myTextArea = document.getElementById("b7ectg_add_css");
    var myCodeMirror = CodeMirror(myTextArea);

    $('.btn-wps-add-options').click( function () {
        $('.options_block').toggle();
        var checkBoxes = $("input[name=b7ectg_options]");
        checkBoxes.attr("checked", !checkBoxes.attr("checked"));
    });

    $('.b7ectg_supports_block').on('change', function () {
        $('.support_block').toggle($(this).is(':checked'));
    });

    $('.support_block').on('click', 'a', function () {
        $('.b7ectg_supports_block').prop('checked', false);
        $('.support_block').hide();
        return false;
    });

    var max_fields = 15; //maximum input boxes allowed
    var wrapper = $(".input_img_sizes_fields_wrap"); //Fields wrapper
    var add_button = $(".add_img_sizes_button"); //Add button ID

    var x = 0; //initial text box count
    $(add_button).click(function (e) { //on add input button click
        e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div id="image_sizes_info_' + x + '" class="bloc-thumb-info newbloc">' +
                '<a class="remove_field" style="float: right;" href="#"><i class="fal fa-window-close fa-3x"></i></a>' +
            '<div class="wps_row"><div class="wps_input">'    + screenHelp.image_size_name  + '<br/><input type="text" name="b7ectg_new_img_size[' + x + '][name]" size="25"/></div>' +
            '<div class="wps_input">' + screenHelp.image_size_slug  + '<br/><input type="text" name="b7ectg_new_img_size[' + x + '][slug]" size="15"/> <input type="checkbox" name="b7ectg_new_img_size[\' + x + \'][crop]"/> Crop</div></div>' +
            '<div class="wps_row"><div class="wps_input">' + screenHelp.image_weight  + '<br/><input type="text" name="b7ectg_new_img_size[' + x + '][width]" value="" size="5"> <code>' + screenHelp.default_px + '</code></div>' +
            '<div class="wps_input">' + screenHelp.image_height  + '<br/><input type="text" name="b7ectg_new_img_size[' + x + '][height]" value="" size="5"> <code>' + screenHelp.default_px + '</code></div></div>' +
            '<hr/></div>');
        }
        var target = $('#image_sizes_info_' + x);
        $('html, body').animate({
            scrollTop: target.offset().top - 60
        }, 1000);

    });

    $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
    $(wrapper).on("click", ".remove_img", function (e) { //user click on remove text
        e.preventDefault();
        $('.custom-img-container').toggleClass('visible', 'hidden');
        $('.custom-img-container').attr('src', '');
        $('.remove_img').html();
    })
});
