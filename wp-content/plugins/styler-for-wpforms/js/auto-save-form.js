(function ($) {
    wp.customize.bind('ready', function () {
        var waitforformsubmit;
        var intialBtnVal = $('form #customize-header-actions #save').val();

        wp.customize.previewer.bind('ready', function() {
            var sfwfFormSelectionStatus = $('#customize-control-sfwf_hidden_field_for_form_id').length;
            wp.customize.previewer.send('sfwfFormSelectionStatus', sfwfFormSelectionStatus);
        });

        //change select form dropdown to -1 value
        $('body').on('click', '#accordion-section-sfwf_select_form_section h3.accordion-section-title', function () {
            if ($('#customize-control-sfwf_hidden_field_for_form_id').length) {
                $('#customize-control-sfwf_select_form_id select').val(-1);
            }
        });


        //hide all the selection fields if no form selected
        $('body').on('click', '#accordion-panel-sfwf_panel', function () {
            if ($('#customize-control-sfwf_hidden_field_for_form_id').length) {
                $('#accordion-section-sfwf_form_id_form_wrapper').hide();
                $('#accordion-section-sfwf_form_id_form_header').hide();
                $('#accordion-section-sfwf_form_id_form_title_description').hide();
                $('#accordion-section-sfwf_form_id_submit_button').hide();
                $('#accordion-section-sfwf_form_id_field_labels').hide();
                $('#accordion-section-sfwf_form_id_field_descriptions').hide();
                $('#accordion-section-sfwf_form_id_text_fields').hide();
                $('#accordion-section-sfwf_form_id_dropdown_fields').hide();
                $('#accordion-section-sfwf_form_id_radio_inputs').hide();
                $('#accordion-section-sfwf_form_id_checkbox_inputs').hide();
                $('#accordion-section-sfwf_form_id_paragraph_textarea').hide();
                $('#accordion-section-sfwf_form_id_section_break_title_description').hide();
                $('#accordion-section-sfwf_form_id_confirmation_message').hide();
                $('#accordion-section-sfwf_form_id_error_message').hide();
                $('#accordion-section-sfwf_form_id_addons').hide();
                $('#accordion-section-sfwf_form_id_field_sub_labels').hide();
                $('#accordion-section-sfwf_form_id_general_settings').hide();
                $('#accordion-section-sfwf_form_id_list_field').hide();
                $('#accordion-section-sfwf_form_id_placeholders').hide();
            }

        });

        //append form id in url and refresh the page
        $('body').on('change', '#customize-control-sfwf_select_form_id select', function () {

            alert('Saving Form Selection. Start Styling after page refresh !!!');
            $('form #customize-header-actions #save').click();
            $('#customize-preview').removeClass('iframe-ready');
            $('#customize-preview iframe').hide();
            waitforformsubmit = setInterval(check_button_disabled, 1000);
        });

        function check_button_disabled() {

            if (!$('body.wp-customizer').hasClass('saving')) {

                clearInterval(waitforformsubmit);
                var reload_url_key = 'autofocus[panel]';
                var reload_url_value = 'sfwf_panel';
                reload_url_key = encodeURIComponent(reload_url_key);
                reload_url_value = encodeURIComponent(reload_url_value);
                //get the search query from url, it starts after ?
                var kvp = document.location.search.substr(1).split('&');

                //check if the search query already contains autofocus link 

                // var focusUrl =$.inArray('autofocus[panel]=sfwf_panel',kvp);

                // //add autofocus query if not present
                // if(focusUrl == -1){
                //     kvp[kvp.length]='autofocus[panel]=sfwf_panel';

                // }
                if (kvp == '') {
                    document.location.search = '?' + reload_url_key + '=' + reload_url_value;
                } else {

                    var i = kvp.length;

                    var x;
                    while (i--) {

                        x = kvp[i].split('=');

                        if (x[0] == reload_url_key) {
                            x[1] = reload_url_value;
                            kvp[i] = x.join('=');
                            break;
                        }
                    }

                    if (i < 0) {
                        kvp[kvp.length] = [reload_url_key, reload_url_value].join('=');
                    }

                    //this will reload the page, it's likely better to store this until finished
                    document.location.search = kvp.join('&');
                }

            }
        }


        //Auto save and refresh on reset style button      
        $('body').on('click', '.sfwf-reset-style-button', function () {

            alert(' Resetting Style !!!');
            $('form #customize-header-actions #save').click();
            $('#customize-preview').removeClass('iframe-ready');
            $('#customize-preview iframe').hide();
            waitforformsubmit = setInterval(check_button_disabled, 2000);

        });
        //to add focus
        wp.customize.previewer.bind('sfwf-focus-control', function (data) {
            var form_id = data.form_id;

            switch (data.control_type) {
                case 'text-input':
                    var control = wp.customize.control('sfwf_form_id_' + form_id + '[text-fields][max-width]');
                    break;
                case 'paragraph-textarea':
                    var control = wp.customize.control('sfwf_form_id_' + form_id + '[paragraph-textarea][max-width]');
                    break;
                case 'dropdown':
                    var control = wp.customize.control('sfwf_form_id_' + form_id + '[dropdown-fields][width]');
                    break;
                case 'field-labels':
                    var control = wp.customize.control('sfwf_form_id_' + form_id + '[field-labels][display]');
                    break;
                case 'radio-inputs':
                    var control = wp.customize.control('sfwf_form_id_' + form_id + '[radio-inputs][max-width]');
                    break;
                case 'checkbox-inputs':
                    var control = wp.customize.control('sfwf_form_id_' + form_id + '[checkbox-inputs][max-width]');
                    break;
                case 'dropdown-fields':
                    var control = wp.customize.control('sfwf_form_id_' + form_id + '[dropdown-fields][max-width]');
                    break;
                case 'section-break-title':
                    var control = wp.customize.control('sfwf_form_id_' + form_id + '[section-break-title][font-size]');
                    break;
                case 'form-wrapper':
                    var control = wp.customize.control('sfwf_form_id_' + form_id + '[form-wrapper][max-width]');
                    break;
                case 'form-header':
                    var control = wp.customize.control('sfwf_form_id_' + form_id + '[form-header][border-size]');
                    break;
                case 'form-title':
                    var control = wp.customize.control('sfwf_form_id_' + form_id + '[form-title][font-size]');
                    break;
                case 'form-description':
                    var control = wp.customize.control('sfwf_form_id_' + form_id + '[form-description][font-size]');
                    break;
                case 'field-sub-labels':
                    var control = wp.customize.control('sfwf_form_id_' + form_id + '[field-sub-labels][font-size]');
                    break;
                case 'field-descriptions':
                    var control = wp.customize.control('sfwf_form_id_' + form_id + '[field-descriptions][font-size]');
                    break;
                case 'section-break-description':
                    var control = wp.customize.control('sfwf_form_id_' + form_id + '[section-break-description][font-size]');
                    break;

                case 'list-field-table':
                    var control = wp.customize.control('sfwf_form_id_' + form_id + '[list-field-table][background-color]');
                    break;

                case 'list-field-heading':
                    var control = wp.customize.control('sfwf_form_id_' + form_id + '[list-field-heading][font-size]');
                    break;

                case 'list-field-cell':
                    var control = wp.customize.control('sfwf_form_id_' + form_id + '[list-field-cell][font-size]');
                    break;

                case 'submit-button':
                    var control = wp.customize.control('sfwf_form_id_' + form_id + '[submit-button][button-align]');
                    break;

            }
            control.focus();
        });


    });
})(jQuery);