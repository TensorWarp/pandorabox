'use strict';

$(function () {
    var pagination = ['v-pills-setup-tab', 'v-pills-document-tab', 'v-pills-code-tab', 'v-pills-image-tab', 'v-pills-bad-word-tab', 'v-pills-voiceover-tab', 'v-pills-speech-tab', 'v-pills-access-tab'];

    if (typeof dynamic_page !== 'undefined') {
        pagination = ['v-pills-setup-tab'];
        for (const value of dynamic_page) {
            pagination.push(`v-pills-${value}-tab`)
        }
    }
    
    if ($('#image_create_using').val() == 'Openai') {
        setVarient($('#image_create_using').val());
    }

    function setVarient(value) {
        $('#varient').empty();
        for (const key in openAIPreferenceSizes) {
            if (value == 'Openai' || value == 'openAI') {
                $('#varient').append(`
                <option value="${openAIPreferenceSizes[1]}" selected>${openAIPreferenceSizes[1]}</option>
                `)
                return false;
            } else {
                $('#varient').append(`
                <option value="${key}" selected>${key}</option>
                `)
            }
           
        }
    }

    function tabTitle(id) {
        var title = $('#' + id).attr('data-id');
        $('#theme-title').html(title);
    }

    $(document).on("click", '.tab-name', function () {
        var id = $(this).attr('data-id');

        $('#theme-title').html(id);
    });

    $(document).on('click', 'button.switch-tab', function (e) {
        $('#' + $(this).attr('data-id')).tab('show');
        var titleName = $(this).attr('data-id');

        tabTitle(titleName);

        $('.tab-pane[aria-labelledby="home-tab"').addClass('show active')
        $('#' + $(this).attr('id')).addClass('active').attr('aria-selected', true)
    })

    $(".package-submit-button, .package-feature-submit-button").on("click", function () {
        setTimeout(() => {
            for (const data of pagination) {
                if ($('#' + data.replace('-tab', '')).find(".error").length) {
                    var target = $('#' + data.replace('-tab', '')).attr("aria-labelledby");
                    $('#' + target).tab('show');
                    tabTitle(target);
                    break;
                }
            }
        }, 100);
    });
    
    function setResolution(parent) {
        if (parent == 'Stablediffusion') {
            parent = $('#stable_diffusion_engine').val();
        } else if (parent == 'Openai') {
            parent = 'openAI';
        }
        var resolutions = openAI.size[parent]; 
        $('#resolutions').empty();
        
        for (const key in resolutions) {
            $('#resolutions').append(`
                <option value="${key}" selected>${key}</option>
            `)
        }  
    }
    
    $('#image_create_using').on('change', function() {
        setResolution($(this).val());
        setVarient($(this).val());
    })
    
    $('#stable_diffusion_engine').on('change', function() {
        setResolution($(this).val());
        setVarient($(this).val());
    })

})
