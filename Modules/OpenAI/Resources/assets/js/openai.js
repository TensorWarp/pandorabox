"use strict";

var firstValueOfDropedown;
$(document).ready(function () {
    var currentUrl = window.location.href.indexOf("content/edit") > -1;
    currentUrl ? $(".content-update").show() : $(".content-update").hide();

    if (window.location.href.includes("?prompt")) {

        var parts = window.location.href.split("?prompt=");

        if (parts.length > 1) {
          var promptValue = decodeURIComponent(parts[1]);
          $('.image-textarea').val(promptValue);
        }
    }

});

$(document).on("keyup", ".questions", function () {
    $(this).siblings(".character-count")
        .text($(this).val().length + "/" + $(this).attr("maxlength"));
});
/**
 * @param mixed url, which url hit this call
 * @param mixed params, paramters
 * @param mixed type, get, post
 * @param mixed dataType, json, html
 *
 * @return [type]
 */
function doAjaxprocess(url, params, type, dataType) {
    return $.ajax({
        data: params,
        url: url,
        type: type,
        dataType: dataType,
    });
}

$(document).on("click", ".content-update", function () {

    if(!tinymce.activeEditor.getContent({format : 'text'})) {
        toastMixin.fire({
            title: jsLang("Nothing To Update"),
            icon: "error",
        });
        return true;
    }
    
    var parts = window.location.href.split("/");
    $(".loader-update").removeClass("hidden");
    $('.content-update').addClass('cursor-not-allowed');
    
    doAjaxprocess(
        SITE_URL + "/user/update-content",
        {
                contentSlug: parts[parts.length-1],
                content: tinymce.activeEditor.getContent(),
                _token: CSRF_TOKEN
        },
        'post',
        'json'
    ).done(function(data) {
        $('.content-update').removeClass('cursor-not-allowed');
        $('.loader-update').addClass('hidden');
        toastMixin.fire({
            title: data.message,
            icon: data.status,
        });
    });
});

$(document).on("click", ".saved-content", function () {
    if ($(".partialContent-" + this.id).length) {
        return true;
    }
    $("#partial-history").html("");
    $(".loader-history").removeClass("hidden");
    $(".save-content-" + this.id).removeClass("border-design-3");
    $(".saved-content").removeClass("border-design-3-active");
    $(".save-content-" + this.id).addClass("border-design-3-active");

    doAjaxprocess(
        SITE_URL + "/user/get-content",
        {
            contentId: this.id
        },
        'get',
        'html'
    ).done(function(data) {

        $('.loader-history').addClass('hidden');
        $("#partial-history").append(data);
    });
});
$(document).on("click", ".modal-toggle", function (e) {
    $('.delete-image').attr('data-id', $(this).attr('id')); // sets
    $('.delete-code').attr('data-id', $(this).attr('id')); // sets
    $('.delete-content').attr('data-id', $(this).attr('id')); // sets
    $('.delete-audio').attr('data-id', $(this).attr('id')); // sets
    $('.delete-speech').attr('data-id', $(this).attr('id')); // sets
    $('.modal-delete-audio').attr('data-id', $(this).attr('id')); // sets
    e.preventDefault();
    $('.index-modal').toggleClass('is-visible');
});

$(document).on('click', '.delete-content', function () {
    var contentId = $(this).attr("data-id");
    doAjaxprocess(
        SITE_URL + "/user/deleteContent",
        {
            contentId : contentId,
        },
        'get',
        'json'
    ).done(function(data) {
        $('#partial-history').html('');
        $('.save-content-' + contentId).hide();
        toastMixin.fire({
            title: data.message,
            icon: "success",
        });
        $('#document_'+contentId).remove();
    });
});

$(document).on('click', '.delete-code', function () {
    var id = $(this).attr("data-id");
    doAjaxprocess(
        SITE_URL + "/user/code/delete",
        {
            id : $(this).attr("data-id"),
            _token: CSRF_TOKEN
        },
        'post',
        'json'
    ).done(function(data) {
        toastMixin.fire({
            title: data.message,
            icon: data.status,
        });
        $('#code_'+id).remove();
    });
});

$(document).on('click', '.delete-image', function () {
    var id = $(this).attr("data-id");
    var $loaderTemplates = $('.gallery-dlt').find('.loader-template');

    if ($loaderTemplates) {
        $loaderTemplates.prev('svg').addClass('hidden');
        $loaderTemplates.removeClass('hidden');
    }
    
    doAjaxprocess(
        SITE_URL + "/user/delete-image",
        {
            id : $(this).attr("data-id"),
            _token: CSRF_TOKEN
        },
        'post',
        'json'
    ).done(function(data) {
        toastMixin.fire({
            title: data.message,
            icon: data.status,
        });
        $('#image_'+id).remove();

        if ($(".image-information-modal")) {
            $(".image-information-modal").css("display", "none");
        }
    });
});

$(document).on('click', '.delete-audio', function () {
    var id = $(this).attr("data-id");
    doAjaxprocess(
        SITE_URL + "/user/text-to-speech/delete",
        {
            id : id,
            _token: CSRF_TOKEN
        },
        'post',
        'json'
    ).done(function(data) {
        toastMixin.fire({
            title: data.message,
            icon: data.status,
        });
        $('#audio_'+id).remove();
    });
});

$(document).on('click', '.modal-delete-audio', function () {
    var id = $(this).attr("data-id");
    doAjaxprocess(
        SITE_URL + "/user/text-to-speech/destroy",
        {
            id : id,
            _token: CSRF_TOKEN
        },
        'post',
        'json'
    ).done(function(data) {
        window.location.href = SITE_URL + "/user/text-to-speech-list";
    });
});

$(document).on("click", "#history", function () {
    $.ajax({
        url: SITE_URL + "/api/openai/history",
        type: "get",
        dataType: "html",
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + ACCESS_TOKEN);
        },

        success: function (data) {
            var demo = JSON.parse(data);
            $(".overflow-hidden").html(demo.response.records.html);
        },
        error: function(data) {
         }
    });
});

$(document).on("click", ".copy-code", function () {
    var codeElement = $(this).siblings('code');
    var code = codeElement.text();
    if (code) {
        var message = jsLang("Code Copied Successfully");
        var icon = "success";
    } else {
        var message = jsLang("Nothing To Copy");
        var icon = "error";
    }

    navigator.clipboard.writeText(code);

    toastMixin.fire({
        title: message,
        icon: icon,
    });
});

function download(filename, text) {
    var element = document.createElement('a');
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
    element.setAttribute('download', filename);

    element.style.display = 'none';
    document.body.appendChild(element);

    element.click();

    document.body.removeChild(element);
}

// Start file download.
$(document).on('click', '#download-code', function() {
    var code = $('.code').text();
    if(code) {
       return download("code.txt", $('.code').text());
    } else {
        var message = jsLang("Nothing To Download");
        var icon = "error";

    }
    navigator.clipboard.writeText($('.code').text());

    toastMixin.fire({
        title: message,
        icon: icon,
    });

});

$(document).on("click", ".image-save", function () {
    var imageSrc = [];
    $("#image-content")
        .children("img")
        .map(function () {
            imageSrc.push($(this).attr("src"));
        });
    if (imageSrc.length === 0) {
        toastMixin.fire({
            title: jsLang("No Image Found"),
            icon: "error",
        });
    }
    doAjaxprocess(
        SITE_URL + "/user/save-image",
        {
            imageSource : imageSrc,
            promt : $('#image-description').val(),
            size : $('#size').val(),
            artStyle : $('#art-style').val(),
            artStyle : $('#art-style').val(),
            lightingStyle : $('#ligting-style').val(),
            _token: CSRF_TOKEN
        },
        'post',
        'json'
    ).done(function(data) {
        toastMixin.fire({
            title: data.message,
            icon: "success",
        });
    });
});

$(document).on('click', '.generate-pdf', function () {

    var myContent = tinymce.activeEditor.getContent({format : 'raw'});
    if(!tinymce.activeEditor.getContent({format : 'text'})) {
        flashMessage();
        return true;
    }
    const options = {
        margin: 0.3,
        filename: 'document.pdf',
        image: {
            type: 'jpeg',
            quality: 0.98
        },
        html2canvas: {
            scale: 2
        },
        jsPDF: {
            unit: 'in',
            format: 'a4',
            orientation: 'portrait'
        }
    }

    html2pdf().from(myContent).set(options).save();
});

$(document).on("click", ".generate-word", function () {
    var header =
        "<html xmlns:o='urn:schemas-microsoft-com:office:office' " +
        "xmlns:w='urn:schemas-microsoft-com:office:word' " +
        "xmlns='http://www.w3.org/TR/REC-html40'>" +
        "<head><meta charset='utf-8'><title>Export HTML to Word Document with JavaScript</title></head><body>";
    var myContent = tinymce.activeEditor.getContent({ format: "raw" });
    if(!tinymce.activeEditor.getContent({ format: 'text' })) {
        flashMessage();
        return true;
    }
    $("#basic-example").val(myContent);
    var contentOfHtml = $("#basic-example").val();
    var footer = "</body></html>";
    var sourceHTML = header + contentOfHtml + footer;

   var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
   var fileDownload = document.createElement("a");
   document.body.appendChild(fileDownload);
   fileDownload.href = source;
   fileDownload.download = 'document.doc';
   fileDownload.click();
   document.body.removeChild(fileDownload);
});

function flashMessage() {

    toastMixin.fire({
        title: jsLang("Nothing To Download"),
        icon: "error",
    });

}

$(document).on("click", ".copy-text", function () {
    var myContent = tinymce.activeEditor.getContent({format : 'text'});
    if(myContent) {
        var message = jsLang("Content Copied Successfully");
        var icon = "success";
    } else {
        var message = jsLang("Nothing To Copy");
        var icon = "error";

    }
    navigator.clipboard.writeText(myContent);

    toastMixin.fire({
        title: message,
        icon: icon,
    });
});
var toastMixin = Swal.mixin({
    toast: true,
    icon: "error",
    title: "General Title",
    animation: false,
    position: "top",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: false,
    didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
});

$(document).on("change", ".use-cases", function () {
    if (!(window.location.href.indexOf("content/edit") > -1)) {
        $(".content-name").html("Content Of a" + " " + $(this).val());
    }

    $(".edit-url").attr("href", $(this).val());
    $.ajax({
        url: SITE_URL + "/user/formfiled-usecase/" + $(this).val(),
        type: "get",
        dataType: "html",
        data: {
            useCae: $(this).val(),
            _token: CSRF_TOKEN,
        },
        beforeSend: () => {
            $(".documents-input-loader").removeClass("hidden");
            $("#appended-data").addClass("hidden");
        },
        success: function (response) {
            $("#appended-data").html(response);
        },
        complete: () => {
            $(".documents-input-loader").addClass("hidden");
            $("#appended-data").removeClass("hidden");
        }
    });
});

function nl2br(str, is_xhtml) {
    var breakTag =
        is_xhtml || typeof is_xhtml === "undefined" ? "<br />" : "<br>";
    return (str + "").replace(
        /([^>\r\n]?)(\r\n|\n\r|\r|\n)/g,
        "$1" + breakTag + "$2"
    );
}

$(document).on("submit", "#openai-form", function (e) {
    let contentSlug = "";
    var currentUrl = window.location.href.indexOf("content/edit") > -1;
    if (currentUrl) {
        (parts = window.location.href.split("/")),
            (contentSlug = parts[parts.length - 1]);
    }

    e.preventDefault();
    var gethtml = tinyMCE.activeEditor.getContent();

    var formData = {};
    $(".dynamic-input").each(function (column) {
        formData[this.name] = $(this).val();
    });


    var newUrl =  SITE_URL + "/" + PROMT_URL;
    $(".loader").removeClass('hidden');
    $("#magic-submit-button").attr("disabled", "disabled");
    var isExecuted = 0;
    fetch(newUrl, {
    method: 'POST',
    body: JSON.stringify({
        questions: JSON.stringify(formData),
            promt: $("#promt").val(),
            useCase: $(".use-cases").val(),
            language: $("#language").val(),
            variant: $("#variant").val(),
            temperature: $("#temperature").val(),
            tone: $("#tone").val(),
            previousContent: gethtml,
            contentSlug: contentSlug,
            dataType: 'json',
            _token: CSRF_TOKEN,
    }),
    headers: {
        'Content-type': 'application/json',
        'stream-data': true,
        Authorization: `Bearer ${ACCESS_TOKEN}`
    },
    }).then(async (res) => {
        if (!res.ok) {
            // Log the error
        }
        const reader = res.body.getReader();
        const decoder = new TextDecoder();

        let text = "";
        while (true) {
            const { value, done } = await reader.read();
            if (done) {
                $(".loader").addClass('hidden');
                $("#magic-submit-button").removeAttr("disabled");
                break
            };
            text = decoder.decode(value, { stream: true });

            function isJSONString(str) {
                if (isExecuted == 0) {
                    try {
                        JSON.parse(str);
                        return true;
                    } catch (error) {
                        isExecuted = 1;
                        return false;
                    }
                }
                return false;
            }
            
            if (isJSONString(text)) {
                var stringData = JSON.parse(text)
                if (stringData.text) {
                    var message = stringData.text;
                    errorMessage(message, 'magic-submit-button');
                    return;
                }
                var message = stringData.response.records.response ? stringData.response.records.response : stringData.text;
                errorMessage(message, 'magic-submit-button');
                return;
            } else {
                gethtml += nl2br(filterXSS(text));
                        tinyMCE.activeEditor.setContent(gethtml, { format: "raw" });
                        // Read the next chunk
            }
        }

    }).catch(error => {
            // Log the error
    });

});

$('.select').each(function() {
    var tomSelect = new TomSelect(this, {
        onFocus: function() {
            firstValueOfDropedown = tomSelect.getValue(0);
          },
        onChange: function(value) {
            if (value.length > 0) {
            firstValueOfDropedown = value;
            }

            if (value === '') {
                tomSelect.setValue(firstValueOfDropedown);
            }
        }
    });
});

function errorMessage(message, btnId)
{
    toastMixin.fire({
        title: message,
        icon: 'error'
      });
      $(".loader").addClass('hidden');
      $('#'+ btnId).removeAttr('disabled');
}


$(document).on('submit', '#openai-image-form', function (e) {    
    var gethtml = '';
    e.preventDefault();
    var formData = new FormData();
    formData.append('promt', filterXSS($("#image-description").val()));
    formData.append('file', $("#file_input").length ? $("#file_input")[0].files[0] : '');
    formData.append('variant', $("#variant").val());
    formData.append('resulation',$("#size").val());
    formData.append('artStyle', $("#art-style").val());
    formData.append('lightingStyle', $("#ligting-style").val());
    formData.append('dataType', 'json');
    formData.append('_token', CSRF_TOKEN);

    $.ajax({
        url: SITE_URL + "/" + PROMT_URL,
        type: "POST",
        beforeSend: function (xhr) {
            $(".loader").removeClass('hidden');
            $("#image-creation").attr("disabled", "disabled");
            xhr.setRequestHeader("Authorization", "Bearer " + ACCESS_TOKEN);
        },
        data: formData,
        contentType: false,
        cache: false,
        processData:false,
        success: function(response) {
            $(".static-image-text").addClass('hidden');
            var credit = $('.image-credit-remaining');
            
            if (!isNaN(credit.text()) && response.response.records.imageUrls != null && response.response.records.balanceReduce == 'subscription') {
                credit.text(credit.text() - response.response.records.imageUrls.length);
            }

            gethtml +='<div class="flex flex-wrap justify-center items-center md:gap-6 gap-5 mt-10 image-content1 9xl:mx-32 3xl:mx-16 2xl:mx-5">'
                $.each(response.response.records.imageUrls, function(key,valueObj) {
                    gethtml +='<div class="relative md:w-[300px] md:h-[300px] w-[181px] h-[181px] download-image-container md:rounded-xl rounded-lg">'
                    gethtml += '<img class="m-auto md:w-[300px] md:h-[300px] w-[181px] h-[181px] cursor-pointer md:rounded-xl rounded-lg border border-color-DF dark:border-color-3A object-cover"src="'+ valueObj['url'] +'" alt=""><div class="image-hover-overlay"></div>'
                    gethtml +='<div class=" flex gap-3 right-3 bottom-3 absolute">'
                    gethtml += '<div class="image-download-button"><a class="relative tooltips w-9 h-9 flex items-center m-auto justify-center" href="'+ valueObj['slug_url'] +'">'
                    gethtml +=`<img class="w-[18px] h-[18px]" src="${SITE_URL}/Modules/OpenAI/Resources/assets/image/view-eye.svg" alt="">`
                    gethtml +='<span class="image-download-tooltip-text z-50 w-max text-white items-center font-medium text-12 rounded-lg px-2.5 py-[7px] absolute z-1 top-[138%] left-[50%] ml-[-22px]">View</span>'
                    gethtml += '</a>'
                    gethtml += '</div>'
                    gethtml += '<div class="image-download-button"><a class="file-need-download relative tooltips w-9 h-9 flex items-center m-auto justify-center" href="'+ valueObj['url'] +'" download="'+ filterXSS(valueObj['name']) +'" Downlaod>'
                    gethtml +=`<img class="w-[18px] h-[18px]" src="${SITE_URL}/Modules/OpenAI/Resources/assets/image/file-download.svg" alt="">`
                    gethtml +='<span class="image-download-tooltip-text z-50 w-max text-white items-center font-medium text-12 rounded-lg px-2.5 py-[7px] absolute z-1 top-[138%] left-[50%] ml-[-38px]">Download</span>'
                    gethtml += '</a>'
                    gethtml += '</div>'
                    gethtml += '</div>'
                    gethtml += '</div>'

                });
                gethtml += '</div>';

                $('#image-content').prepend(gethtml);
                $(".loader").addClass('hidden');
                $('#image-creation').removeAttr('disabled');
        },
        error: function (response) {
            var jsonData = JSON.parse(response.responseText);

            if(jsonData.response.records === null) {
                errorMessage(jsonData.response.status.message, 'image-creation');
                return true;
            }

            var message = jsonData.response.records.response ? jsonData.response.records.response : jsonData.response.status.message;
            errorMessage(message, 'image-creation');
         }
    });
});

$(document).on("click", ".speech-update", function (e) {
    if(!tinymce.activeEditor.getContent({format : 'text'})) {
        toastMixin.fire({
            title: jsLang("Nothing To Update"),
            icon: "error",
        });
        return true;
    }

    var id = $(this).attr('data-id');
    $(".loader-update").removeClass("hidden");
    $('.speech-update').addClass('cursor-not-allowed');
    
    doAjaxprocess(
        SITE_URL + "/user/update-speech",
        {
            id: id,
            content: tinymce.activeEditor.getContent(),
            _token: CSRF_TOKEN
        },
        'post',
        'json'
    ).done(function(data) {
        $('.speech-update').removeClass('cursor-not-allowed');
        $('.loader-update').addClass('hidden');
        toastMixin.fire({
            title: data.message,
            icon: data.status,
        });
    });
});

$(document).on('click', '.delete-speech', function () {
    var speechId = $(this).attr("data-id");
    doAjaxprocess(
        SITE_URL + "/user/delete-speech",
        {
            speechId : speechId,
            _token: CSRF_TOKEN
        },
        'POST',
        'json'
    ).done(function(data) {
        toastMixin.fire({
            title: data.message,
            icon: "success",
        });
        $('#speech_'+speechId).remove();
    });
});

$(document).on('submit', '#speech-to-text-form', function (e) {
    e.preventDefault();

    var html = '';
    var formData = new FormData();
    formData.append('language', $("#language").val());
    formData.append('file', $("#file_input")[0].files[0]);
    formData.append('word_filter', $("#word_filter").val());
    formData.append('duration', $("#duration").val());
    formData.append('dataType', 'json');
    formData.append('_token', CSRF_TOKEN);

    $.ajax({
        url: SITE_URL + "/" + PROMT_URL,
        type: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function (xhr) {
            $(".loader").removeClass('hidden');
            $("#text-generate").attr("disabled", "disabled");
            xhr.setRequestHeader("Authorization", "Bearer " + ACCESS_TOKEN);
        },
        
        success: function(data) {

            if (data.response.status.code != 200) {
                errorMessage(data.response.message);
                return true;
            }

            html = data.response.records.text;
            
            tinyMCE.activeEditor.setContent(html, { format: "raw" });

            var credit = $('.minute-credit-remaining');

            if (credit.length > 0) {
                var creditValue = parseFloat(credit.text());

                if (!isNaN(creditValue) && data.response.records != null) {
                    var minutes = creditValue - data.response.records.usage.minutes;
  
                    if (minutes < 0) {
                        minutes = 0;
                    }
                    
                    credit.text( minutes.toFixed(2));
                }
            }
        },

        complete: () => {
            $(".loader").addClass('hidden');
            $('#text-generate').removeAttr('disabled');
        },

        error: function(response) {
            $(".loader").addClass('hidden');
            var jsonData = JSON.parse(response.responseText);

            if(jsonData.response.records === null) {
                errorMessage(jsonData.response.status.message, 'text-generate');
                return true;
            }

            var message = jsonData.response.records ? ( jsonData.response.records.response ? jsonData.response.records.response : jsonData.response.records) : jsonData.response.status.message
            errorMessage(message, 'text-generate');
         }
    });
});

$(document).on('submit', '#openai-code-form', function (e) {
    e.preventDefault();

    $.ajax({
        url: SITE_URL + '/' + PROMT_URL,
        type: "POST",
        beforeSend: function (xhr) {
          $(".loader").removeClass('hidden');
            $('#code-creation').attr('disabled', 'disabled');
            xhr.setRequestHeader('Authorization', 'Bearer ' + ACCESS_TOKEN);
        },
        data: {
            promt: filterXSS($("#code-description").val()),
            language: $("#language").val(),
            codeLabel: $("#code-level").val(),
            dataType: 'json',
            _token: CSRF_TOKEN
        },
        success: function(response) {
            $(".static-code-text").addClass('hidden');
            if (response.response.message) {
                errorMessage(response.response.message);
                return true;
            }

            var strArray = response.response.records.choices[0].message.content.split("```");
            var totalItem = strArray.length;
            var html = '';
            for(var i = 0; i < totalItem; i++) {
                if (i % 2 != 0) {
                    html += '<div><pre class="area relative" data-language="php" id="codetext"><code class="!pt-10 code">' + filterXSS(strArray[i]) + '</code><a href="javaScript:void(0);" class="absolute flex gap-2 items-center justify-center text-color-14 bg-white md:py-2.5 py-1.5 md:px-5 px-3 border border-color-89 rounded-lg top-4 right-4 font-semibold font-Figtree copy-code"><svg class="neg-transition-scale" xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18"fill="none"><g clip-path="url(#clip0_3914_2023)"><path d="M12.5 0.75H3.5C2.675 0.75 2 1.425 2 2.25V12.75H3.5V2.25H12.5V0.75ZM11.75 3.75L16.25 8.25V15.75C16.25 16.575 15.575 17.25 14.75 17.25H6.4925C5.6675 17.25 5 16.575 5 15.75L5.0075 5.25C5.0075 4.425 5.675 3.75 6.5 3.75H11.75ZM11 9H15.125L11 4.875V9Z" fill="#141414" /></g><defs><clipPath id="clip0_3914_2023"><rect width="18" height="18" fill="white" transform="translate(0.5)" /></clipPath></defs></svg> <span>'+copy+'</span> </a> </pre></div>';
                }
                else {
                     html += '<div class="context-area my-5 text-15 text-color-14 dark:text-white width-code break-words ">' + filterXSS(strArray[i]) + '</div>';
                }
            }

            $('.code-area').html(html)
            hljs.highlightAll();

            var total_word_left = $('.total-word-left');
            var total_word_used = $('.total-word-used');
            var credit_limit = $('.credit-limit');

            if (credit_limit.length > 0 && response.response.records.balanceReduce == 'subscription') {
                var word_left_count = jsLang('Unlimited');
                if (total_word_left.text() != jsLang('Unlimited')) {
                    word_left_count = Number(total_word_left.text()) - response.response.records.usage.words;
                }

                var word_used_count = Number(total_word_used.text()) + response.response.records.usage.words;

                if (word_left_count < 0) {
                    word_left_count = 0;
                }

                if (Array.isArray(Number(credit_limit.text().match(/(\d+)/))) && word_used_count > Number(credit_limit.text().match(/(\d+)/)[0])) {
                    word_used_count = Number(credit_limit.text().match(/(\d+)/)[0]);
                }

                total_word_left.text(word_left_count);
                total_word_used.text(word_used_count);
            }
        },
        complete: () => {
            $(".loader").addClass('hidden');
            $('#code-creation').removeAttr('disabled');
        },
        error: function(response) {
            var jsonData = JSON.parse(response.responseText);

            if(jsonData.response.records === null) {
                errorMessage(jsonData.response.status.message, 'code-creation');
                return true;
            }

            var message = jsonData.response.records.response ? jsonData.response.records.response : jsonData.response.status.message
            errorMessage(message, 'code-creation');
         }
    });
});

$(document).on('submit', '#openai-text-to-speech-form', function (e) {
    e.preventDefault();
    
    var ids = [];
    if (!validationCheck(ids, '.textToSpeechInput')) {
        return false;
    };
    
    var textareas = document.querySelectorAll('textarea[name="prompt[]"]');
    var values = [];

    textareas.forEach(function(textarea) {
        var value = textarea.value;
        var langCode = textarea.getAttribute('data-lang-code');
        var name = textarea.getAttribute('data-name');
        var gender = textarea.getAttribute('data-gender');
        var voice = textarea.getAttribute('data-voice');

        values.push({
            prompt: filterXSS(value), 
            language: langCode, 
            voice_name: name, 
            gender: gender,
            voice: voice
        });
    });
    
    $.ajax({
        url: SITE_URL + '/' + PROMT_URL,
        type: "POST",
        beforeSend: function (xhr) {
            $(".loader").removeClass('hidden');
            $('#code-creation').attr('disabled', 'disabled');
            xhr.setRequestHeader('Authorization', 'Bearer ' + ACCESS_TOKEN);
        },
        data: {
            data: values,
            volume: $("#volume").val(),
            pitch: $("#pitch").val(),
            speed: $("#speed").val(),
            audio_effect: $("#audio_effect").val(),
            pause: $("#pause").val(),
            target_format: $('input[name="titles"]:checked').val(),
            dataType: 'json',
            _token: CSRF_TOKEN
        },
        success: function(response) {
            
            if (response.response.message) {
                errorMessage(response.response.message);
                return true;
            }

            var credit = $('.total-character-left');

            if (credit.length > 0) {
                var word_left_count = jsLang('Unlimited');
                if (credit.text() != jsLang('Unlimited')) {
                    word_left_count = Number(credit.text()) - response.response.records.characters;
                }

                if (word_left_count < 0) {
                    word_left_count = 0;
                }

                credit.text(word_left_count);
            }

            if (response.response.status.code == 200) {
                var data = response.response.records;
                $('#text-to-speech-table').prepend(
                `<table class="min-w-full my-3 rounded-xl bg-white dark:bg-[#3A3A39]" id="audio_${data.id}">
                    <tbody id="documents-table-body">
                        <tr class="border-b dark:border-[#474746]" id="speechTableRow">
                            <td class="py-[18px] 3xl:pl-[18px] md:pr-6 px-3">
                                <span class="text-[12px] leading-6 font-Figtree text-color-89 font-medium hidden min-[890px]:block">${jsLang('Prompt')}</span>
                                <a href="${data.view_route}"
                                    class="flex items-center justify-start">
                                    <span class="text-color-14 dark:text-white font-medium text-14 font-Figtree w-[200px] xs:w-[234px] min-[500px]:w-[300px]
                                    md:w-full min-[850px]:w-[260px] lg:w-[350px] xl:w-[265px] 5xl:w-[300px] word-break flex items-center wrap-anywhere">
                                    ${data.prompt}
                                    </span>
                                    
                                </a>
                                <div class="flex gap-2 items-start mt-2 xl:hidden">
                                    <div class="w-[112px] min-[500px]:w-[150px]">
                                        <span class="text-color-89 font-medium text-xs font-Figtree break-words flex items-center ">
                                            ${data.language}
                                        </span>
                                        <span class="text-color-89 mt-2 font-medium text-xs font-Figtree break-words flex items-center">
                                            ${data.created_at}
                                        </span>
                                    </div>
                                    <span class="text-color-89 font-medium text-xs font-Figtree wrap-anywhere flex items-center min-[890px]:hidden w-[112px] min-[500px]:w-[150px]">
                                        ${data.voice} (${data.gender})
                                    </span>
                                </div>
                            </td>
                            <td class="py-[18px] text-color-89 font-medium px-3 w-64 whitespace-nowrap hidden xl:table-cell break-words align-top">
                                <span class="text-[12px] leading-6 font-Figtree pb-1.5 text-color-89 font-medium">${jsLang('Language')}</span>
                                <span class="text-color-14 dark:text-white font-medium text-14 font-Figtree break-words flex items-center">
                                    ${data.language}
                                </span>
                            </td>
                            <td class="py-[18px] text-color-89 font-medium px-3 w-64 whitespace-nowrap hidden min-[890px]:table-cell break-words align-top">
                                <span class="text-[12px] leading-6 font-Figtree pb-1.5 text-color-89 font-medium">${jsLang('Voice')}</span>
                                <span class="text-color-14 dark:text-white font-medium text-14 font-Figtree break-words flex items-center">
                                    ${data.voice} (${data.gender})
                                </span>
                            </td>
                            <td class="py-[18px] text-color-89 font-medium px-3 w-64 whitespace-nowrap hidden xl:table-cell break-words align-top">
                                <span class="text-[12px] leading-6 font-Figtree pb-1.5 text-color-89 font-medium">${jsLang('Date')}</span>
                                <span class="text-color-14 dark:text-white font-medium text-14 font-Figtree break-words flex items-center">
                                    ${data.created_at}
                                </span>
                            </td>
                            <td class="py-[18px] text-color-89 font-medium px-3 w-[135px] whitespace-nowrap hidden xl:table-cell break-words align-top">
                                <span class="text-[12px] leading-6 font-Figtree pb-1.5 text-color-89 font-medium">${jsLang('Characters')}</span>
                                <span class="text-color-14 dark:text-white font-medium text-14 font-Figtree break-words flex items-center">
                                    ${data.characters}
                                </span>
                            </td>
                            <td class="py-[18px] text-color-14 dark:text-white font-medium ltr:3xl:pr-[25px] ltr:pr-3 rtl:3xl:pl-[25px] rtl:pl-3 w-max align-middle text-right">
                                <div class="flex items-center justify-end gap-4 w-[200px] lg:w-[240px]">
                                    <div class="gap-4 justify-end items-center flex">
                                        <div class="relative play-nav">
                                            <a class="speech-tooltip-delete flex items-center border border-color-89 dark:border-color-47 text-color-14 dark:text-white bg-white dark:bg-color-47 play-nav-toggle gap-2 rounded-lg justify-center cursor-pointer" title="${jsLang('Play Audio')}">
                                                <button data-src="${data.audio_url}" class="play-pause-button">
                                                    <svg class="m-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <path d="M12.5451 9.35142L5.38706 13.8632C4.77959 14.2457 4 13.7826 4 13.0115V3.98784C4 3.21795 4.77846 2.75357 5.38706 3.13729L12.5451 7.64911C12.6833 7.7348 12.7981 7.85867 12.878 8.00815C12.9579 8.15764 13 8.32741 13 8.50027C13 8.67312 12.9579 8.84289 12.878 8.99238C12.7981 9.14186 12.6833 9.26573 12.5451 9.35142Z" fill="currentColor"/>
                                                    </svg>
                                                </button>
                                                <div class="play-collapse hidden">
                                                    <div class="flex justify-center gap-2 items-center">
                                                        <div class="w-[60px] waveform"></div>
                                                        <div class="w-9" id="waveform-time-indicator-view">
                                                            <p class="font-medium text-color-14 text-[10px] font-Figtree leading-[14px] dark:text-white ltr:pr-2 rtl:pl-2 time">00:00</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="xl:flex gap-4 hidden">
                                            <div class="relative">
                                                <a href="${data.audio_url}" download=${data.file_name} class="file-need-download speech-tooltip-delete flex items-center border border-color-89 dark:border-color-47 text-color-14 dark:text-white bg-white dark:bg-color-47 p-2 rounded-lg justify-center cursor-pointer" title="${jsLang('Download Audio')}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <path d="M8 11.5L3.625 7.125L4.85 5.85625L7.125 8.13125V1H8.875V8.13125L11.15 5.85625L12.375 7.125L8 11.5ZM1 15V10.625H2.75V13.25H13.25V10.625H15V15H1Z" fill="currentColor"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <a id="${data.id}" class="delete-wavesuffer-audio speech-tooltip-delete relative flex items-center p-2 border border-color-89 dark:border-color-47 bg-white text-color-14 dark:text-white dark:bg-color-47 rounded-lg justify-center modal-toggle" title="${jsLang('Delete Audio')}" href="javascript: void(0)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                    <path d="M3.84615 2.8C3.37884 2.8 3 3.15817 3 3.6V4.4C3 4.84183 3.37884 5.2 3.84615 5.2H4.26923V12.4C4.26923 13.2837 5.0269 14 5.96154 14H11.0385C11.9731 14 12.7308 13.2837 12.7308 12.4V5.2H13.1538C13.6212 5.2 14 4.84183 14 4.4V3.6C14 3.15817 13.6212 2.8 13.1538 2.8H10.1923C10.1923 2.35817 9.81347 2 9.34615 2H7.65385C7.18653 2 6.80769 2.35817 6.80769 2.8H3.84615ZM6.38462 6C6.61827 6 6.80769 6.17909 6.80769 6.4V12C6.80769 12.2209 6.61827 12.4 6.38462 12.4C6.15096 12.4 5.96154 12.2209 5.96154 12L5.96154 6.4C5.96154 6.17909 6.15096 6 6.38462 6ZM8.5 6C8.73366 6 8.92308 6.17909 8.92308 6.4V12C8.92308 12.2209 8.73366 12.4 8.5 12.4C8.26634 12.4 8.07692 12.2209 8.07692 12V6.4C8.07692 6.17909 8.26634 6 8.5 6ZM11.0385 6.4V12C11.0385 12.2209 10.849 12.4 10.6154 12.4C10.3817 12.4 10.1923 12.2209 10.1923 12V6.4C10.1923 6.17909 10.3817 6 10.6154 6C10.849 6 11.0385 6.17909 11.0385 6.4Z" fill="currentColor"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="relative xl:hidden inline-block">
                                        <button class="table-dropdown-click">
                                            <a href="javascript: void(0)" class="cursor-pointer border p-2 border-color-89 dark:bg-color-47 dark:border-color-47 rounded-lg flex justify-end">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                    <path d="M10.6875 14.625C10.6875 15.557 9.93198 16.3125 9 16.3125C8.06802 16.3125 7.3125 15.557 7.3125 14.625C7.3125 13.693 8.06802 12.9375 9 12.9375C9.93198 12.9375 10.6875 13.693 10.6875 14.625ZM10.6875 9C10.6875 9.93198 9.93198 10.6875 9 10.6875C8.06802 10.6875 7.3125 9.93198 7.3125 9C7.3125 8.06802 8.06802 7.3125 9 7.3125C9.93198 7.3125 10.6875 8.06802 10.6875 9ZM10.6875 3.375C10.6875 4.30698 9.93198 5.0625 9 5.0625C8.06802 5.0625 7.3125 4.30698 7.3125 3.375C7.3125 2.44302 8.06802 1.6875 9 1.6875C9.93198 1.6875 10.6875 2.44302 10.6875 3.375Z" fill="#898989"></path>
                                                </svg>
                                            </a>
                                        </button>
                                        <div class="absolute ltr:right-0 rtl:left-0 mt-2 w-[201px] border border-color-89 dark:border-color-47 rounded-lg bg-white dark:bg-[#333332] z-50 table-drop-body dropdown-shadow">
                                            <div>
                                                <a href="${data.audio_url}" download=${data.file_name} class="flex justify-start items-center gap-1.5 text-14 font-normal text-color-14 dark:text-white font-Figtree px-4 py-2 hover:bg-color-F6 dark:hover:bg-[#3A3A39] rounded-t-lg text-left">
                                                    <span class="w-4 h-4">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                            <path d="M8 11.5L3.625 7.125L4.85 5.85625L7.125 8.13125V1H8.875V8.13125L11.15 5.85625L12.375 7.125L8 11.5ZM1 15V10.625H2.75V13.25H13.25V10.625H15V15H1Z" fill="currentColor"/>
                                                        </svg>
                                                    </span>
                                                    <p>${jsLang('Download Audio')}</p>
                                                </a>
                                                <a href="javascript: void(0)" id="${data.id}" class="delete-wavesuffer-audio flex justify-start items-center gap-1.5 text-14 font-normal text-color-14 dark:text-white font-Figtree px-4 py-2 hover:bg-color-F6 dark:hover:bg-[#3A3A39] rounded-t-none rounded-b-lg  modal-toggle text-left">
                                                    <span class="w-4 h-3">
                                                        <svg class="w-3 h-3" width="11" height="12" viewBox="0 0 11 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M0.846154 0.8C0.378836 0.8 0 1.15817 0 1.6V2.4C0 2.84183 0.378836 3.2 0.846154 3.2H1.26923V10.4C1.26923 11.2837 2.0269 12 2.96154 12H8.03846C8.9731 12 9.73077 11.2837 9.73077 10.4V3.2H10.1538C10.6212 3.2 11 2.84183 11 2.4V1.6C11 1.15817 10.6212 0.8 10.1538 0.8H7.19231C7.19231 0.358172 6.81347 0 6.34615 0H4.65385C4.18653 0 3.80769 0.358172 3.80769 0.8H0.846154ZM3.38462 4C3.61827 4 3.80769 4.17909 3.80769 4.4V10C3.80769 10.2209 3.61827 10.4 3.38462 10.4C3.15096 10.4 2.96154 10.2209 2.96154 10L2.96154 4.4C2.96154 4.17909 3.15096 4 3.38462 4ZM5.5 4C5.73366 4 5.92308 4.17909 5.92308 4.4V10C5.92308 10.2209 5.73366 10.4 5.5 10.4C5.26634 10.4 5.07692 10.2209 5.07692 10V4.4C5.07692 4.17909 5.26634 4 5.5 4ZM8.03846 4.4V10C8.03846 10.2209 7.84904 10.4 7.61538 10.4C7.38173 10.4 7.19231 10.2209 7.19231 10V4.4C7.19231 4.17909 7.38173 4 7.61538 4C7.84904 4 8.03846 4.17909 8.03846 4.4Z" fill="currentColor"/>
                                                        </svg>
                                                    </span>
                                                    
                                                    <p>${jsLang('Remove from History')}</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody
                </table
                `);

            }

        },
        complete: () => {
            $(".loader").addClass('hidden');
            $('#voice-generation').removeAttr('disabled');
            $('#textFieldsContainer').find('div.mt-3').remove();
            $('#textToSpeech-0').val('');
        },
        error: function(response) {
            var jsonData = JSON.parse(response.responseText);

            if(jsonData.response.records === null) {
                errorMessage(jsonData.response.status.message, 'voice-generation');
                return true;
            }

            var message = jsonData.response.records.response ? jsonData.response.records.response : jsonData.response.status.message
            errorMessage(message, 'voice-generation');
         }
    });
});

if ($(".code-view-area").find("#code-view-content").length) {
    $(document).ready(function () {
        hljs.highlightAll();
    });
}

$(document).ready(function(){
    $('.dropdown-click').on("click",function(event){
        event.stopPropagation();
         $(".drop-down").slideToggle(200);
    });

    $(document).on('click', '.play-pause-button', function () {
        toggleAudio($(this));
    });

    $(document).on('click', '.play-nav-toggle', function () {
        var $collapse = $(this).closest(".play-nav").find(".play-collapse");
        $collapse.slideDown(200, function () {
            var isCollapsedVisible = $collapse.is(":visible");
            var waveformElement = $collapse.find(".waveform");
            var audio = $(this)
                .closest(".play-nav") // Find the closest element with class "play-nav"
                .find("button.play-pause-button")
                .data("src");
        });
        $(".play-collapse").not($collapse).slideUp(200);
    });

    $(document).on("click", ".delete-wavesuffer-audio", function () {
        var audioFile = $(this).closest("#speechTableRow").find(".play-pause-button").data("src");
        
        if (audioFile && wavesurfers[audioFile] && wavesurfers[audioFile].isPlaying()) {
            wavesurfers[audioFile].pause();
            $(this).closest("#speechTableRow").find(".play-pause-button").html('<svg class="m-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M12.5451 9.35142L5.38706 13.8632C4.77959 14.2457 4 13.7826 4 13.0115V3.98784C4 3.21795 4.77846 2.75357 5.38706 3.13729L12.5451 7.64911C12.6833 7.7348 12.7981 7.85867 12.878 8.00815C12.9579 8.15764 13 8.32741 13 8.50027C13 8.67312 12.9579 8.84289 12.878 8.99238C12.7981 9.14186 12.6833 9.26573 12.5451 9.35142Z" fill="currentColor"></path></svg>');

        }
    });

  });
  $(document).on("click", function () {
    $(".drop-down").hide();
  });

  setTimeout(() => {
        $('iframe#basic-example_ifr').contents().on('click', function(event) {  $(".drop-down").hide(); });
        $('.tox.tox-tinymce').contents().on('click', function(event) {  $(".drop-down").hide(); });
  }, 1000);
$(document).ready(function(){
    $('.dot-click').on("click",function(event){
        event.stopPropagation();
        $(this).closest(".drop-parents").find(".drop-body").slideToggle(200);
    });
  });

$(document).on("click", function () {
    $(".drop-body").hide();
});

$(document).ready(function(){
    $('.user-header-dropdown-click').on("click",function(event){
        event.stopPropagation();
        $(".user-header-drop-down").slideToggle(200);
    });
});
$(document).on("click", function () {
    $(".user-header-drop-down").hide();
});

let wavesurfers = {}; // Use an object to store multiple instances
let currentAudio = null; // Store the currently playing audio

function toggleAudio(button) {
    $(
        ".play-pause-button"
    ).html(`<svg class="m-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path d="M12.5451 9.35142L5.38706 13.8632C4.77959 14.2457 4 13.7826 4 13.0115V3.98784C4 3.21795 4.77846 2.75357 5.38706 3.13729L12.5451 7.64911C12.6833 7.7348 12.7981 7.85867 12.878 8.00815C12.9579 8.15764 13 8.32741 13 8.50027C13 8.67312 12.9579 8.84289 12.878 8.99238C12.7981 9.14186 12.6833 9.26573 12.5451 9.35142Z" fill="currentColor"/>
            </svg>`);
    var audioFile = button.data("src");
    var correctedUrl = audioFile.replace(/\\/g, '/');

    var audioFile = SITE_URL+'/proxy.php?url='+correctedUrl;

    var waveformElement = button.closest(".play-nav").find(".waveform")[0];

    // Check if a wavesurfer instance already exists for this audio file
    if (!wavesurfers[audioFile]) {
        wavesurfers[audioFile] = initializeWaveSurfer(
            waveformElement,
            audioFile
        );
    }
    const wavesurfer = wavesurfers[audioFile];

    if (wavesurfer.isPlaying()) {
        wavesurfer.pause();
        button.html(`<svg class="m-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
            <path d="M12.5451 9.35142L5.38706 13.8632C4.77959 14.2457 4 13.7826 4 13.0115V3.98784C4 3.21795 4.77846 2.75357 5.38706 3.13729L12.5451 7.64911C12.6833 7.7348 12.7981 7.85867 12.878 8.00815C12.9579 8.15764 13 8.32741 13 8.50027C13 8.67312 12.9579 8.84289 12.878 8.99238C12.7981 9.14186 12.6833 9.26573 12.5451 9.35142Z" fill="currentColor"/>
        </svg>`);
    } else {
        // Stop the previous audio if it's different from the current one
        if (currentAudio && currentAudio !== audioFile) {
            var previousWavesurfer = wavesurfers[currentAudio];
            previousWavesurfer.pause();
            var previousButton = $(
                `.play-pause-button[data-src="${currentAudio}"]`
            );
            previousButton.html(`<svg class="m-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path d="M12.5451 9.35142L5.38706 13.8632C4.77959 14.2457 4 13.7826 4 13.0115V3.98784C4 3.21795 4.77846 2.75357 5.38706 3.13729L12.5451 7.64911C12.6833 7.7348 12.7981 7.85867 12.878 8.00815C12.9579 8.15764 13 8.32741 13 8.50027C13 8.67312 12.9579 8.84289 12.878 8.99238C12.7981 9.14186 12.6833 9.26573 12.5451 9.35142Z" fill="currentColor"/>
            </svg>`);
        }

        wavesurfer.play();
        button.html(`<svg class="m-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7 13.5H4.5V2.5H7V13.5ZM11.5 13.5H9V2.5H11.5V13.5Z" fill="currentColor"/>
        </svg>
        `);
        currentAudio = audioFile;
    }
}

function initializeWaveSurfer(container, audioFile) {
    const wavesurfer = WaveSurfer.create({
        container,
        waveColor: "#898989",
        progressColor: "#E22861",
    });

    wavesurfer.on("ready", updateTimer);
    wavesurfer.on("audioprocess", updateTimer);

    wavesurfer.on("seek", updateTimer);

    function updateTimer() {
        var formattedTime = secondsToTimestamp(wavesurfer.getCurrentTime());
        $("#waveform-time-indicator-view .time").text(formattedTime);
    }

    function secondsToTimestamp(seconds) {
        seconds = Math.floor(seconds);
        var m = Math.floor(seconds / 60);
        var s = seconds % 60;
    
        m = m < 10 ? "0" + m : m;
        s = s < 10 ? "0" + s : s;
    
        return m + ":" + s;
    }

    wavesurfer.on("ready", function () {
        wavesurfer.play();
    });

    wavesurfer.on("finish", function () {
        $(".play-pause-button").each((k, v) => {
            $(v)
                .html(`<svg class="m-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M12.5451 9.35142L5.38706 13.8632C4.77959 14.2457 4 13.7826 4 13.0115V3.98784C4 3.21795 4.77846 2.75357 5.38706 3.13729L12.5451 7.64911C12.6833 7.7348 12.7981 7.85867 12.878 8.00815C12.9579 8.15764 13 8.32741 13 8.50027C13 8.67312 12.9579 8.84289 12.878 8.99238C12.7981 9.14186 12.6833 9.26573 12.5451 9.35142Z" fill="currentColor"></path>
             </svg>`);
        });
    });

    wavesurfer.load(audioFile);
    return wavesurfer;
}

$(document).on("click", function () {
$(".drop-body").hide();
});

$(document).on('click', '.file-need-download', function(e) {
    e.preventDefault();
    
    var fileUrl = $(this).attr('href');
    
    var title = $(this).attr('download');
    if (!/\.$/i.test(title)) {
        title += '.' + fileUrl.split('.').pop();
    }

    $.ajax({
        url:  SITE_URL + "/user/download/file",
        type: 'POST',
        data: { file_url: fileUrl, _token: CSRF_TOKEN },
        xhrFields: {
            responseType: 'blob'
        },
        success: function (data) {
            // Create a Blob object and generate a download link
            var blob = new Blob([data]);
            var link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = title;
            link.click();
        }
    });
});
