"use strict";

let dynamicDataObserver = null;

var toastMixin = Swal.mixin({
    toast: true,
    icon: 'error',
    title: 'General Title',
    position: 'top',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: false,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

function toggleBookmark(documentId, toggleState, childDiv) {
    let div = $('#bookmark-document-' + documentId);
    $.ajax({
        url: documentToggleBookmarkURL,
        type: 'POST',
        dataType: "json",
        data: {
            _token: CSRF_TOKEN,
            document_id: documentId,
            toggle_state: String(toggleState)
        },
        beforeSend: () => {
            $(div).hide();
            var html ='<div class="document-loader">';
            html += '<svg class="animate-spin h-7 w-7" xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 72 72" fill="none">';
            html += '<mask id="path-1-inside-1_1032_3036" fill="white">';
            html += '<path d="M67 36C69.7614 36 72.0357 38.2493 71.6534 40.9841C70.685 47.9121 67.7119 54.4473 63.048 59.7573C57.2779 66.3265 49.3144 70.5713 40.644 71.6992C31.9736 72.8271 23.1891 70.761 15.9304 65.8866C8.67173 61.0123 3.4351 53.6628 1.19814 45.2104C-1.03881 36.7579 -0.123172 27.7803 3.77411 19.9534C7.67139 12.1266 14.2839 5.98568 22.3772 2.67706C30.4704 -0.631565 39.4912 -0.881694 47.7554 1.97337C54.4353 4.28114 60.2519 8.49021 64.5205 14.0322C66.2056 16.2199 65.3417 19.2997 62.9417 20.6656L60.8567 21.8524C58.4567 23.2183 55.4379 22.3325 53.5977 20.2735C50.9338 17.2927 47.5367 15.0161 43.7066 13.6929C38.2888 11.8211 32.3749 11.9851 27.0692 14.1542C21.7634 16.3232 17.4284 20.3491 14.8734 25.4802C12.3184 30.6113 11.7181 36.4969 13.1846 42.0381C14.6511 47.5794 18.0842 52.3975 22.8428 55.5931C27.6014 58.7886 33.3604 60.1431 39.0445 59.4037C44.7286 58.6642 49.9494 55.8814 53.7321 51.5748C56.4062 48.5302 58.2325 44.8712 59.0732 40.9628C59.6539 38.2632 61.8394 36 64.6008 36H67Z" />';
            html += '</mask>';
            html += '<path d="M67 36C69.7614 36 72.0357 38.2493 71.6534 40.9841C70.685 47.9121 67.7119 54.4473 63.048 59.7573C57.2779 66.3265 49.3144 70.5713 40.644 71.6992C31.9736 72.8271 23.1891 70.761 15.9304 65.8866C8.67173 61.0123 3.4351 53.6628 1.19814 45.2104C-1.03881 36.7579 -0.123172 27.7803 3.77411 19.9534C7.67139 12.1266 14.2839 5.98568 22.3772 2.67706C30.4704 -0.631565 39.4912 -0.881694 47.7554 1.97337C54.4353 4.28114 60.2519 8.49021 64.5205 14.0322C66.2056 16.2199 65.3417 19.2997 62.9417 20.6656L60.8567 21.8524C58.4567 23.2183 55.4379 22.3325 53.5977 20.2735C50.9338 17.2927 47.5367 15.0161 43.7066 13.6929C38.2888 11.8211 32.3749 11.9851 27.0692 14.1542C21.7634 16.3232 17.4284 20.3491 14.8734 25.4802C12.3184 30.6113 11.7181 36.4969 13.1846 42.0381C14.6511 47.5794 18.0842 52.3975 22.8428 55.5931C27.6014 58.7886 33.3604 60.1431 39.0445 59.4037C44.7286 58.6642 49.9494 55.8814 53.7321 51.5748C56.4062 48.5302 58.2325 44.8712 59.0732 40.9628C59.6539 38.2632 61.8394 36 64.6008 36H67Z"stroke="url(#paint0_linear_1032_3036)" stroke-width="24" mask="url(#path-1-inside-1_1032_3036)" />';
            html += '<defs> <linearGradient id="paint0_linear_1032_3036" x1="46.8123" y1="63.1382" x2="21.8195" y2="6.73779" gradientUnits="userSpaceOnUse"> <stop stop-color="#E60C84" /><stop offset="1" stop-color="#FFCF4B" /></linearGradient></defs>';
            html += '</div>';

            $(childDiv).html(html);
        },
        success: function (response) {
            let doc = $("#bookmark-document-" + documentId);
            var url = window.location.href;
            if (!url.includes('/favourite-documents')) {
                if (toggleState) {
                    doc.html(`<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.25 2.25C2.25 1.00736 3.25736 0 4.5 0H13.5C14.7426 0 15.75 1.00736 15.75 2.25V17.4375C15.75 17.6449 15.6358 17.8356 15.4529 17.9334C15.27 18.0313 15.0481 18.0206 14.8755 17.9055L9 14.7385L3.12452 17.9055C2.95191 18.0206 2.72998 18.0313 2.54708 17.9334C2.36418 17.8356 2.25 17.6449 2.25 17.4375V2.25ZM4.5 1.125C3.87868 1.125 3.375 1.62868 3.375 2.25V16.3865L8.68798 13.5945C8.87692 13.4685 9.12308 13.4685 9.31202 13.5945L14.625 16.3865V2.25C14.625 1.62868 14.1213 1.125 13.5 1.125H4.5Z" fill="url(#paint0_linear_140_371_${documentId})"/>
                                <path d="M2.25 2.25V17.4375C2.25 17.636 2.35465 17.8199 2.52536 17.9212C2.69608 18.0225 2.90757 18.0264 3.08185 17.9313L9 14.7032L14.9181 17.9313C15.0924 18.0264 15.3039 18.0225 15.4746 17.9212C15.6453 17.8199 15.75 17.636 15.75 17.4375V2.25C15.75 1.00736 14.7426 0 13.5 0H4.5C3.25736 0 2.25 1.00736 2.25 2.25Z" fill="url(#paint1_linear_140_371_${documentId})"/>
                                <defs>
                                <linearGradient id="paint0_linear_140_371_${documentId}" x1="11.0273" y1="15.7845" x2="3.63951" y2="3.2807" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#E60C84"/>
                                <stop offset="1" stop-color="#FFCF4B"/>
                                </linearGradient>
                                <linearGradient id="paint1_linear_140_371_${documentId}" x1="11.0273" y1="15.7845" x2="3.63951" y2="3.2807" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#E60C84"/>
                                <stop offset="1" stop-color="#FFCF4B"/>
                                </linearGradient>
                                </defs>
                            </svg>`)
                } else {
                    doc.html(`<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.25 2.25C2.25 1.00736 3.25736 0 4.5 0H13.5C14.7426 0 15.75 1.00736 15.75 2.25V17.4375C15.75 17.6449 15.6358 17.8356 15.4529 17.9334C15.27 18.0313 15.0481 18.0206 14.8755 17.9055L9 14.7385L3.12452 17.9055C2.95191 18.0206 2.72998 18.0313 2.54708 17.9334C2.36418 17.8356 2.25 17.6449 2.25 17.4375V2.25ZM4.5 1.125C3.87868 1.125 3.375 1.62868 3.375 2.25V16.3865L8.68798 13.5945C8.87692 13.4685 9.12308 13.4685 9.31202 13.5945L14.625 16.3865V2.25C14.625 1.62868 14.1213 1.125 13.5 1.125H4.5Z" fill="#898989"/>
                                <path d="M2.25 2.25V17.4375C2.25 17.636 2.35465 17.8199 2.52536 17.9212C2.69608 18.0225 2.90757 18.0264 3.08185 17.9313L9 14.7032L14.9181 17.9313C15.0924 18.0264 15.3039 18.0225 15.4746 17.9212C15.6453 17.8199 15.75 17.636 15.75 17.4375V2.25C15.75 1.00736 14.7426 0 13.5 0H4.5C3.25736 0 2.25 1.00736 2.25 2.25Z" fill="#898989"/>
                            </svg>`)
                }

                let value = (toggleState) ? 'true' : 'false';
                const element = document.getElementById("bookmark-document-" + documentId);
                element.setAttribute("data-is-bookmarked", value);

                if (toggleState) {
                    $(element).closest('tr').removeClass('non-bookmarked').addClass('bookmarked');
                } else {
                    $(element).closest('tr').removeClass('bookmarked').addClass('non-bookmarked');

                    if ($('#bookmarks_filter').attr('data-is-filtered') == 'false') {
                        $('.non-bookmarked').hide();

                        notFoundMessage();
                    }
                }

                toastMixin.fire({
                    title: response.message,
                    icon: 'success'
                });
            } else {

                let parentDiv = $('#document_' + documentId);

                if (!toggleState) {
                    $(parentDiv).remove();
                }
    
                var tbody = document.getElementById('documents-table-body');
                var rows = tbody.getElementsByTagName('tr');
    
                if (rows.length == 0) {
                    notFoundMessage();
                }

            }
        },
        error: function (xhr, status, error) {
            let responseObj = JSON.parse(xhr.responseJSON);

            toastMixin.fire({
                title: responseObj.message,
                icon: 'error'
            });
        },
        complete: () => {
            $(div).show();
            $('.document-loader').remove();
        }
    });
}

const notFoundMessage = () => {
    $('#documents-table-body').find('.document-not-found-child').remove();
    if ($('#documents-table-body tr:visible').length == 0) {
        $('#documents-table-body').append($('#document_not_found tbody').html());
    }
}

const onClickBookmarkFunction = (event) => {
    event.preventDefault();

    let element = event.currentTarget;
    let documentId = element.getAttribute('data-document-id');
    let newToggleState = (String(element.getAttribute('data-is-bookmarked')) == "true") ? false : true;
    let childDiv = $(event.currentTarget.parentElement).find('.document-spinner');
    toggleBookmark(documentId, newToggleState, childDiv);
};

function createToggleBookmarkEventListeners() {
    let elements = document.querySelectorAll(".dynamic-content");

    elements.forEach((element) => element.removeEventListener("click", onClickBookmarkFunction));
    elements.forEach((element) => element.addEventListener("click", onClickBookmarkFunction));
}

function observeDynamicContent() {
    let targetNode = document.getElementById("documents-table-body");
    let config = { attributes: false, childList: true, subtree: true };

    let callback = (mutationList, observer) => {
        createToggleBookmarkEventListeners();
    };

    dynamicDataObserver = new MutationObserver(callback);
    dynamicDataObserver.observe(targetNode, config);
}

$(() => {
    let elements = document.querySelectorAll(".toggle-bookmark");
    elements.forEach((element) => element.addEventListener("click", onClickBookmarkFunction));

    observeDynamicContent();
});

// bookmark tooltips
var dir = $("html").attr("dir");
if(dir == "ltr")
{
    $(".toggle-bookmark").tooltip({
        position: {
            at: "left-30 center"
        }
    });
}
else if(dir == "rtl"){
    $(".toggle-bookmark").tooltip({
        position: {
            at: "right-32 center"
        }
    });
}
