"use strict";

$(document).on('keyup', '#name', function() {
    var str = this.value.replace(/[&\/\\#@,+()$~%.'":*?<>{}]/g, "");
    $('#slug').val(str.trim().toLowerCase().replace(/\s/g, "-"));
    $(this).siblings('.error').remove();
    $('#slug').siblings('.error').remove();
});

function formValidation() {
    let status = true;
    let ids = ['#name' , '#description', '#slug'];

    for (const key in ids) {
        if ($(ids[key]).val().length == '' && $(ids[key]).siblings('.error').length == 0) {
            $(ids[key]).parent().append(`<label class="error">${jsLang('This field is required.')}</label>`);
            status = false;
        } else if ($(ids[key]).val().length == '') {
            status = false;
        }
    }

   if (status == false) {
        return false;
    }

    $('#btnSubmit').text(jsLang('Creating')).append(`<div class="spinner-border spinner-border-sm ml-2" role="status"></div>`).addClass('disabled-btn');
    $('#btnUpdate').text(jsLang('Updating')).append(`<div class="spinner-border spinner-border-sm ml-2" role="status"></div>`).addClass('disabled-btn');

    return true;
}
