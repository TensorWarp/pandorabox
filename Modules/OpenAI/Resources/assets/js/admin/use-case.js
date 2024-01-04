"use strict";

const slugify = (str) => str.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');

$(() => {
    $(".ajax_category").select2({
        ajax: {
            url: (typeof searchCategoryUrl === "undefined") ? '' : searchCategoryUrl,
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                };
            },
            processResults: function (jsonResponse, params) {
                return {
                    results: jsonResponse.data,
                };
            },
            cache: true,
        },
        placeholder: jsLang("Search categories"),
        allowClear: true,
        minimumInputLength: 0,
    });

    $(".ajax_users_filter_select2").select2({
        ajax: {
            url: (typeof searchURI === "undefined") ? '' : searchURI,
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                };
            },
            processResults: function (jsonResponse, params) {
                return {
                    results: jsonResponse.data,
                };
            },
            cache: true,
        },
        placeholder: jsLang("Search creator"),
        allowClear: true,
        minimumInputLength: 3,
    });

    $("#name").on("input", (e) => {
        if (e.target.value.length > 0) {
            $("#slug-span").text(slugify(e.target.value));
        } else {
            $("#slug-span").text('(auto-generated)');
        }
    });
});

function formValidation() {

    let ids = ['#name', '#description', '#input_template'];

    let status = validateCheck(ids);

    if (status === false) {
        return false;
    }

    $('#btnSubmit').text(jsLang('Updating')).append(`<div class="spinner-border spinner-border-sm ml-2" role="status"></div>`).addClass('disabled-btn');

    return true;
}


let count = $('#optionId').val();

function addFields(e) {
    var fieldContainer = $("#field-container");

    if ($(fieldContainer).find('div.row').last().length > 0) {
        var elementsContainer = $(fieldContainer).find('div.row').last();
    } else {
        var elementsContainer = $(e).closest('div.row');
    }
    
    var nameInput = elementsContainer.find('input[name="names[]"]').first();
    var placeholderInput = elementsContainer.find('input[name="descriptions[]"]').first();
    var type = elementsContainer.find('select[name="type[]"]').first();
    let ids = [];

    if (nameInput.val().trim() === "" || placeholderInput.val().trim() === "" || type.val().trim() === "") {
        validateCheck(ids);
        return false;
    }

    var id = "input-field-"+ count;

    let button = '<span onclick="insertText(this)" id="' + id +'-button" class="btn btn-primary mr-4 mb-2">' + id + '</span>';
    $("#field-button").append(button);

    const add_field = `<div class="row mt-3">
                            <div class="col-xl-4 col-md-6 col-12">
                                <input type="text" class="form-control inputFieldDesign new-field" name="names[]" id="input-field-${count}" placeholder="${jsLang('Label Name')}" maxlength="191" oninput="addButton(this)" oninvalid="this.setCustomValidity('${jsLang('This field is required.')}')" required>
                                <input type="hidden" name="variable_names[]">
                            </div>
                            <div class="col-xl-4 col-md-6 col-12 mt-2 mt-md-0">
                                <input type="text" class="form-control inputFieldDesign new-field" placeholder="${jsLang('Placeholder Description')}" id="description-${count}" maxlength="191" name="descriptions[]" oninvalid="this.setCustomValidity('${jsLang('This field is required.')}')" required>
                            </div>
                            <div class="col-xl-3 col-md-6 col-12 mt-2 mt-xl-0">
                                <select class="form-select form-control inputFieldDesign new-field sl_common_bx" id="type-${count}" name="type[]">
                                    <option value="" selected> ${jsLang('Select One')} </option>
                                    <option value="text"> ${jsLang('Input Field')} </option>
                                    <option value="textarea"> ${jsLang('Textarea Field')} </option>
                                </select>
                            </div>
                            <span onclick="removeFields(this)" class="input-group-text bg-transparent cursor_pointer rounded h-40 col-xl-1 col-md-6 col-12 w-auto mt-2 mt-xl-0 ms-2">
                                <i class="feather icon-trash-2"></i>
                            </span>
                        </div>`;

    count++;

    fieldContainer.append(add_field);
}

function addButton(e) {

    var elementsContainer = $(e).closest('div.row');
    var nameInput = elementsContainer.find('input[name="names[]"]').first();

    $(nameInput).next().val(nameInput.prop('id'));
}

function removeFields(e){

    const closestDiv = $('#field-container').find('div.row');
    const fieldContainer = $("#field-container").closest('div.col-sm-10').find('div.dynamic_field').first();

    if ( ( fieldContainer.length == 1  && closestDiv.length >= 1 ) || ( closestDiv.length > 1 ) ) {

        const nameInput = $(e).closest('div.row').find('input[name="names[]"]').first();

        let button = document.getElementById(nameInput.prop('id') + '-button');

        if (button) {
            button.remove();

            if ( $(e.parentElement).hasClass('row') ) {
                $(e.parentElement.nextElementSibling?.firstElementChild).removeClass('mt-3').addClass('top');
            }

            if ( $(e.parentElement).hasClass('row top') ) {
                $(e.parentElement.nextElementSibling).removeClass('mt-3').addClass('top'); 
            }
        
            let replaceValue =" [[" + nameInput.prop('id') + "]] ";
        
            let x = $("#input_template").val();
        
            let parts = x.split(replaceValue.trim());
            $("#input_template").val(parts.join(''));

        }
        
        e.parentElement.remove();
    }
}

function insertText(value) {
    var text = " [[" + value.innerHTML.trim() + "]] ";
    var position = document.getElementById("input_template").selectionStart;
    let x = $("#input_template").val();
    $("#input_template").val(x.slice(0, position) + text + x.slice(position));
    $("#input_template").focus();
}

function validateCheck(ids) {

    let status = true;
    let inputElements = document.querySelectorAll('.new-field');

    inputElements.forEach(element => {
        element.addEventListener('input', () => {
            const value = element.value.trim();
            
            const parentDiv = element.closest('div'); 
            const errorElement = parentDiv.querySelector('.error');
            
            if (errorElement) { 
                value !== '' ? errorElement.style.display = 'none' : errorElement.style.display = 'block';
            }
        });

        ids.push('#' + element.id);
    })

    for (const key in ids) {
        if ($(ids[key]).val().length == '' && $(ids[key]).siblings('.error').length == 0) {
            $(ids[key]).parent().append(`<label class="error">${jsLang('This field is required.')}</label>`);
            status = false;
        } else if ($(ids[key]).val().length == '') {
            status = false;
        }
    }

    return status;
}