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

function searchPopulateUseCases(searchValue, categoryId, isFavorites = false) {

    $.ajax({
        url: useCaseSearchURL + "?search=" + searchValue + "&category_id=" + categoryId + "&is_favorites=" + isFavorites,
        type: 'GET',
        dataType: "html",
        beforeSend: () => {
            $(".template-loader").removeClass("hidden");
            $(".tab-content").addClass("hidden");
        },
        success: function(response) {
            $("#tabs-search-results-tab").html(response);
            $(".tab-pane").removeClass("active show");
            $("#tabs-search-results-tab").addClass("active show");
        },
        complete: () => {
            $(".template-loader").addClass("hidden");
            $(".tab-content").removeClass("hidden");
        }
    });
}

function delay(fn, ms) {
    let timer = 0;

    return function (...args) {
        clearTimeout(timer)
        timer = setTimeout(fn.bind(this, ...args), ms || 0)
    }
}

function toggleFavorite(useCaseId, toggleState, childDiv, element) {
    $.ajax({
        url: useCaseToggleFavoriteUrl,
        type: 'POST',
        dataType: "json",
        data: {
            _token: CSRF_TOKEN,
            use_case_id: useCaseId,
            toggle_state: String(toggleState)
        },
        beforeSend: () => {
            element.classList.add('cursor-not-allowed');
            element.parentElement.querySelector('a').classList.add('cursor-not-allowed');
            $(".tab-content-"+useCaseId).addClass("opacity-0");

            var html ='<div class="loader-template items-center">';
            html += '<svg class="animate-spin h-7 w-7 m-auto" xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 72 72" fill="none">';
            html += '<mask id="path-1-inside-1_1032_3036" fill="white">';
            html += '<path d="M67 36C69.7614 36 72.0357 38.2493 71.6534 40.9841C70.685 47.9121 67.7119 54.4473 63.048 59.7573C57.2779 66.3265 49.3144 70.5713 40.644 71.6992C31.9736 72.8271 23.1891 70.761 15.9304 65.8866C8.67173 61.0123 3.4351 53.6628 1.19814 45.2104C-1.03881 36.7579 -0.123172 27.7803 3.77411 19.9534C7.67139 12.1266 14.2839 5.98568 22.3772 2.67706C30.4704 -0.631565 39.4912 -0.881694 47.7554 1.97337C54.4353 4.28114 60.2519 8.49021 64.5205 14.0322C66.2056 16.2199 65.3417 19.2997 62.9417 20.6656L60.8567 21.8524C58.4567 23.2183 55.4379 22.3325 53.5977 20.2735C50.9338 17.2927 47.5367 15.0161 43.7066 13.6929C38.2888 11.8211 32.3749 11.9851 27.0692 14.1542C21.7634 16.3232 17.4284 20.3491 14.8734 25.4802C12.3184 30.6113 11.7181 36.4969 13.1846 42.0381C14.6511 47.5794 18.0842 52.3975 22.8428 55.5931C27.6014 58.7886 33.3604 60.1431 39.0445 59.4037C44.7286 58.6642 49.9494 55.8814 53.7321 51.5748C56.4062 48.5302 58.2325 44.8712 59.0732 40.9628C59.6539 38.2632 61.8394 36 64.6008 36H67Z" />';
            html += '</mask>';
            html += '<path d="M67 36C69.7614 36 72.0357 38.2493 71.6534 40.9841C70.685 47.9121 67.7119 54.4473 63.048 59.7573C57.2779 66.3265 49.3144 70.5713 40.644 71.6992C31.9736 72.8271 23.1891 70.761 15.9304 65.8866C8.67173 61.0123 3.4351 53.6628 1.19814 45.2104C-1.03881 36.7579 -0.123172 27.7803 3.77411 19.9534C7.67139 12.1266 14.2839 5.98568 22.3772 2.67706C30.4704 -0.631565 39.4912 -0.881694 47.7554 1.97337C54.4353 4.28114 60.2519 8.49021 64.5205 14.0322C66.2056 16.2199 65.3417 19.2997 62.9417 20.6656L60.8567 21.8524C58.4567 23.2183 55.4379 22.3325 53.5977 20.2735C50.9338 17.2927 47.5367 15.0161 43.7066 13.6929C38.2888 11.8211 32.3749 11.9851 27.0692 14.1542C21.7634 16.3232 17.4284 20.3491 14.8734 25.4802C12.3184 30.6113 11.7181 36.4969 13.1846 42.0381C14.6511 47.5794 18.0842 52.3975 22.8428 55.5931C27.6014 58.7886 33.3604 60.1431 39.0445 59.4037C44.7286 58.6642 49.9494 55.8814 53.7321 51.5748C56.4062 48.5302 58.2325 44.8712 59.0732 40.9628C59.6539 38.2632 61.8394 36 64.6008 36H67Z"stroke="url(#paint0_linear_1032_3036)" stroke-width="24" mask="url(#path-1-inside-1_1032_3036)" />';
            html += '<defs> <linearGradient id="paint0_linear_1032_3036" x1="46.8123" y1="63.1382" x2="21.8195" y2="6.73779" gradientUnits="userSpaceOnUse"> <stop stop-color="#E60C84" /><stop offset="1" stop-color="#FFCF4B" /></linearGradient></defs>';
            html += '<p class="text-center text-color-14 dark:text-white text-16 font-normal font-Figtree mt-5">';
            html +=  processing;
            html += '</p>';
            html += '</div>';
            $(childDiv).html(html);

        },
        success: function (response) {
            let responseObj = JSON.parse(response);
            let useCase = $(".favorite-use-case-" + useCaseId);

            if (toggleState) {
                useCase.each(function(k, v) {
                    var rand = Math.ceil(Math.random() * 1000);
                    $(v).html(`<svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.06383 17.3731C3.62909 17.5965 3.13682 17.206 3.22435 16.7071L4.15779 11.3864L0.195168 7.6102C-0.175161 7.25729 0.0165395 6.61204 0.512652 6.54156L6.02344 5.7587L8.48057 0.891343C8.70191 0.452886 9.3015 0.452886 9.52285 0.891343L11.98 5.7587L17.4908 6.54156C17.9869 6.61204 18.1786 7.25729 17.8083 7.6102L13.8456 11.3864L14.7791 16.7071C14.8666 17.206 14.3743 17.5965 13.9396 17.3731L9.00171 14.8351L4.06383 17.3731Z" fill="url(#paint0_linear_301_431_${rand}_${useCaseId})"/>
                        <defs>
                        <linearGradient id="paint0_linear_301_431_${rand}_${useCaseId}" x1="11.7048" y1="15.3605" x2="6.10185" y2="1.87361" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E60C84"/>
                        <stop offset="1" stop-color="#FFCF4B"/>
                        </linearGradient>
                        </defs>
                    </svg>`)
                })

            } else {
                useCase.html(`<svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.22435 16.7071C3.13682 17.206 3.62909 17.5965 4.06383 17.3731L9.00171 14.8351L13.9396 17.3731C14.3743 17.5965 14.8666 17.206 14.7791 16.7071L13.8456 11.3864L17.8083 7.6102C18.1786 7.25729 17.9869 6.61204 17.4908 6.54156L11.98 5.7587L9.52285 0.891343C9.3015 0.452886 8.70191 0.452886 8.48057 0.891343L6.02344 5.7587L0.512652 6.54156C0.0165395 6.61204 -0.175161 7.25729 0.195168 7.6102L4.15779 11.3864L3.22435 16.7071ZM8.74203 13.5929L4.59556 15.7241L5.37659 11.2722C5.41341 11.0623 5.34418 10.8474 5.1935 10.7038L1.92331 7.58745L6.48215 6.93983C6.67061 6.91305 6.83516 6.79269 6.92406 6.61658L9.00171 2.50096L11.0794 6.61658C11.1683 6.79269 11.3328 6.91305 11.5213 6.93983L16.0801 7.58745L12.8099 10.7038C12.6592 10.8474 12.59 11.0623 12.6268 11.2722L13.4079 15.7241L9.26139 13.5929C9.0976 13.5088 8.90582 13.5088 8.74203 13.5929Z" fill="#898989"/>
                            </svg>`)
            }

            $(".favorite-use-case-" + useCaseId).each((index, element) => {
                let value = (toggleState) ? 'true' : 'false';
                element.setAttribute("data-is-favorite", value);
                $('#' + useCaseId ).hide();

                if (toggleState) {
                    $(element).closest('.parent-template').removeClass('non-favorite').addClass('favorated');

                } else {
                    $(element).closest('.parent-template').removeClass('favorated').addClass('non-favorite');

                    if ($('#favorites_filter').attr('data-textval') == 'all') {
                        $(".non-favorite").hide();

                        var id = $(".nav-item.nav-scroller-item").find("a[aria-selected='true']").attr('href');

                        templateNotFoundNotification(id)
                    }
                }
            });

            toastMixin.fire({
                title: responseObj.message,
                icon: 'success'
            });
        },
        error: function (xhr, status, error) {
            let responseObj = JSON.parse(xhr.responseJSON);

            toastMixin.fire({
                title: responseObj.message,
                icon: 'error'
            });
        },
        complete: () => {
            element.classList.remove('cursor-not-allowed');
            element.parentElement.querySelector('a').classList.remove('cursor-not-allowed');
            $(".tab-content-"+useCaseId).removeClass("opacity-0");
            $(".loader-template").remove();

        }
    });
}

const onClickFavoriteFunction = (event) => {
    event.preventDefault();
    let element = event.currentTarget;
    let useCaseId = element.getAttribute('data-use-case-id');
    let beforeIsFavorite = String(element.getAttribute('data-is-favorite'));
    let afterIsFavorite = (beforeIsFavorite == "true") ? false : true;
    let childDiv = event.currentTarget.parentElement.parentElement.lastElementChild;
    toggleFavorite(useCaseId, afterIsFavorite, childDiv, element);
};

function createToggleFavoriteEventListeners() {
    let elements = document.querySelectorAll(".dynamic-use-case");

    elements.forEach((element) => element.removeEventListener("click", onClickFavoriteFunction));
    elements.forEach((element) => element.addEventListener("click", onClickFavoriteFunction));
}

function observeDynamicContent() {
    let targetNode = document.getElementById("tabs-search-results-tab");
    let config = { attributes: false, childList: true, subtree: true };

    let callback = (mutationList, observer) => {
        createToggleFavoriteEventListeners();
    };

    dynamicDataObserver = new MutationObserver(callback);
    dynamicDataObserver.observe(targetNode, config);
}

function observeDynamicFavorite() {

    let id = $('ul.nav-tabs').find('li>a.active').data('bs-target');
    let nav_item = $('div'+id);
    let parent = nav_item.children('div');
    let childrens = parent.children('div');

    jQuery.each( childrens, function(children) {

        var div = childrens[$(childrens).length - 1 - children];

        var fav = $(div).hasClass('favorated');

        if (fav) {
            $(parent).prepend(div);
        }

    });
}

function setFavorite(parent) {
    $('#favorites_filter').attr('data-textval', 'all');
    $(".non-favorite").hide();
    $(parent).html(`<svg width="17" height="17" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.06383 17.3731C3.62909 17.5965 3.13682 17.206 3.22435 16.7071L4.15779 11.3864L0.195168 7.6102C-0.175161 7.25729 0.0165395 6.61204 0.512652 6.54156L6.02344 5.7587L8.48057 0.891343C8.70191 0.452886 9.3015 0.452886 9.52285 0.891343L11.98 5.7587L17.4908 6.54156C17.9869 6.61204 18.1786 7.25729 17.8083 7.6102L13.8456 11.3864L14.7791 16.7071C14.8666 17.206 14.3743 17.5965 13.9396 17.3731L9.00171 14.8351L4.06383 17.3731Z" fill="url(#paint0_linear_301_431)"/>
                    <defs>
                    <linearGradient id="paint0_linear_301_431" x1="11.7048" y1="15.3605" x2="6.10185" y2="1.87361" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#E60C84"/>
                    <stop offset="1" stop-color="#FFCF4B"/>
                    </linearGradient>
                    </defs>
                </svg>
                <p class="dark:text-white text-color-14 font-semibold mt-1">${jsLang('Favorites')}</p>
                `)
}

function setNotFavorite(parent) {
    $('#favorites_filter').attr('data-textval', 'favorated');
    $(".non-favorite").show();
    $(parent).html(`<svg class="dark:text-white text-color-14" width="17" height="17" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.50784 12.9944C2.43976 13.3824 2.82264 13.6862 3.16077 13.5124L7.00134 11.5384L10.8419 13.5124C11.18 13.6862 11.5629 13.3824 11.4948 12.9944L10.7688 8.8561L13.8509 5.91904C14.1389 5.64456 13.9898 5.14269 13.6039 5.08788L9.31778 4.47899L7.40667 0.693267C7.23452 0.352244 6.76817 0.352244 6.59601 0.693267L4.68491 4.47899L0.398743 5.08788C0.0128776 5.14269 -0.136223 5.64456 0.151811 5.91904L3.23385 8.8561L2.50784 12.9944ZM6.79937 10.5723L3.57434 12.2299L4.18181 8.76724C4.21044 8.60402 4.1566 8.43687 4.0394 8.32519L1.49592 5.90135L5.04169 5.39764C5.18827 5.37682 5.31625 5.2832 5.3854 5.14623L7.00134 1.94519L8.61729 5.14623C8.68643 5.2832 8.81442 5.37682 8.961 5.39764L12.5068 5.90135L9.96328 8.32519C9.84609 8.43687 9.79224 8.60402 9.82088 8.76724L10.4284 12.2299L7.20332 10.5723C7.07592 10.5068 6.92676 10.5068 6.79937 10.5723Z" fill="currentColor"/>
                    </svg>
                    <p class="dark:text-white text-color-14 font-semibold mt-1">${jsLang('Favorites')}</p>
                    `);
}

$(() => {
    let elements = document.querySelectorAll(".toggle-favorite");
    elements.forEach((element) => element.addEventListener("click", onClickFavoriteFunction));

    $("#search-use-case-input").on('keyup', delay((event) => {
        let searchValue = event.target.value;
        let categoryId = $('ul.nav-tabs').find('li>a.active').data('category-id');

        searchPopulateUseCases(searchValue, categoryId);
    }, 1000));

    $('#favorites_filter').on('click', function () {
        if ($("#favorites_filter").attr("data-textval") == 'all') {
            setNotFavorite(this);
        } else {
            setFavorite(this);
        }

        var id = $(".nav-item.nav-scroller-item").find("a[aria-selected='true']").attr('href');

        templateNotFoundNotification(id)

    });

    $(".nav-link").on('click', (event) => {
        $("#search-use-case-input").val('');

        observeDynamicFavorite();
    });

    observeDynamicContent();
});


// scroll to left right template menu

var dir = document.documentElement.getAttribute("dir");
if(dir == "ltr")
{
const navScroller = function({
  wrapperSelector: wrapperSelector = '.nav-scroller-wrapper',
  selector: selector = '.nav-scroller',
  contentSelector: contentSelector = '.nav-scroller-content',
  buttonLeftSelector: buttonLeftSelector = '.nav-scroller-btn--left',
  buttonRightSelector: buttonRightSelector = '.nav-scroller-btn--right',
  scrollStep: scrollStep = 300
} = {}) {

let scrolling = false;
let scrollingDirection = '';
let scrollOverflow = '';
let timeout;

let navScrollerWrapper;

if (wrapperSelector.nodeType === 1) {
  navScrollerWrapper = wrapperSelector;
}
else {
  navScrollerWrapper = document.querySelector(wrapperSelector);
}
if (navScrollerWrapper === undefined || navScrollerWrapper === null) return;

let navScroller = navScrollerWrapper.querySelector(selector);
let navScrollerContent = navScrollerWrapper.querySelector(contentSelector);
let navScrollerLeft = navScrollerWrapper.querySelector(buttonLeftSelector);
let navScrollerRight = navScrollerWrapper.querySelector(buttonRightSelector);


// Sets overflow
const setOverflow = function() {
  scrollOverflow = getOverflow(navScrollerContent, navScroller);
  toggleButtons(scrollOverflow);
}


// Debounce setting the overflow with requestAnimationFrame
const requestSetOverflow = function() {
  if (timeout) {
    window.cancelAnimationFrame(timeout);
  }

  timeout = window.requestAnimationFrame(() => {
    setOverflow();
  });
}


// Get overflow value on scroller
const getOverflow = function(content, container) {
  let containerMetrics = container.getBoundingClientRect();
  let containerWidth = containerMetrics.width;
  let containerMetricsLeft = Math.floor(containerMetrics.left);

  let contentMetrics = content.getBoundingClientRect();
  let contentMetricsRight = Math.floor(contentMetrics.right);
  let contentMetricsLeft = Math.floor(contentMetrics.left);

  // Offset the values by the left value of the container
  let offset = containerMetricsLeft;
  containerMetricsLeft -= offset;
  contentMetricsRight -= offset + 1; // Due to an off by one bug in iOS
  contentMetricsLeft -= offset;
  if (containerMetricsLeft > contentMetricsLeft && containerWidth < contentMetricsRight) {
      return 'both';
  } else if (contentMetricsLeft < containerMetricsLeft) {
      return 'left';
  } else if (contentMetricsRight > containerWidth) {
      return 'right';
  } else {
      return 'none';
  }
}
// Move the scroller with a transform
const moveScroller = function(direction) {
  if (scrolling === true) return;
  setOverflow();
  let scrollDistance = scrollStep;
  let scrollAvailable;
  if (scrollOverflow === direction || scrollOverflow === 'both') {
    if (direction === 'left') {
      scrollAvailable = navScroller.scrollLeft;
    }
    if (direction === 'right') {
      let navScrollerRightEdge = navScroller.getBoundingClientRect().right;
      let navScrollerContentRightEdge = navScrollerContent.getBoundingClientRect().right;
      scrollAvailable = Math.floor(navScrollerContentRightEdge - navScrollerRightEdge);
    }
    // If there is less that 1.5 steps available then scroll the full way
    if (scrollAvailable < (scrollStep * 1.5)) {
      scrollDistance = scrollAvailable;
    }
    if (direction === 'right') {
      scrollDistance *= -1;
    }
    navScrollerContent.classList.remove('no-transition');
    navScrollerContent.style.transform = 'translateX(' + scrollDistance + 'px)';

    scrollingDirection = direction;
    scrolling = true;
  }
}
// Set the scroller position and removes transform, called after moveScroller()
const setScrollerPosition = function() {
  var style = window.getComputedStyle(navScrollerContent, null);
  var transform = style.getPropertyValue('transform');
  var transformValue = Math.abs(parseInt(transform.split(',')[4]) || 0);
  if (scrollingDirection === 'left') {
    transformValue *= -1;
  }
  navScrollerContent.classList.add('no-transition');
  navScrollerContent.style.transform = '';
  navScroller.scrollLeft = navScroller.scrollLeft + transformValue;
  navScrollerContent.classList.remove('no-transition');
  scrolling = false;
}
// Toggle buttons depending on overflow
const toggleButtons = function(overflow) {
  navScrollerLeft.classList.remove('active');
  navScrollerRight.classList.remove('active');
  if (overflow === 'both' || overflow === 'left') {
    navScrollerLeft.classList.add('active');
  }
  if (overflow === 'both' || overflow === 'right') {
    navScrollerRight.classList.add('active');
  }
}
const init = function() {
  // Determine scroll overflow
  setOverflow();
  // Scroll listener
  navScroller.addEventListener('scroll', () => {
    requestSetOverflow();
  });
  // Resize listener
  window.addEventListener('resize', () => {
    requestSetOverflow();
  });
  // Button listeners
  navScrollerLeft.addEventListener('click', () => {
    moveScroller('left');
  });
  navScrollerRight.addEventListener('click', () => {
    moveScroller('right');
  });
  // Set scroller position
  navScrollerContent.addEventListener('transitionend', () => {
    setScrollerPosition();
  });
};
// Init is called by default
init();
// Reveal API
return {
  init
};
};
const navScrollerTest = navScroller();
}
else if (dir === 'rtl') {
  const navScroller = function({
    wrapperSelector: wrapperSelector = '.nav-scroller-wrapper',
    selector: selector = '.nav-scroller',
    contentSelector: contentSelector = '.nav-scroller-content',
    buttonLeftSelector: buttonLeftSelector = '.nav-scroller-btn--right',
    buttonRightSelector: buttonRightSelector = '.nav-scroller-btn--left',
    scrollStep: scrollStep = -300
  } = {}) {
  let scrolling = false;
  let scrollingDirection = '';
  let scrollOverflow = '';
  let timeout;
  let navScrollerWrapper;
  if (wrapperSelector.nodeType === 1) {
    navScrollerWrapper = wrapperSelector;
  }
  else {
    navScrollerWrapper = document.querySelector(wrapperSelector);
  }
  if (navScrollerWrapper === undefined || navScrollerWrapper === null) return; 
  let navScroller = navScrollerWrapper.querySelector(selector);
  let navScrollerContent = navScrollerWrapper.querySelector(contentSelector);
  let navScrollerLeft = navScrollerWrapper.querySelector(buttonLeftSelector);
  let navScrollerRight = navScrollerWrapper.querySelector(buttonRightSelector);    
  // Sets overflow
  const setOverflow = function() {
    scrollOverflow = getOverflow(navScrollerContent, navScroller);
    toggleButtons(scrollOverflow);
  } 
  // Debounce setting the overflow with requestAnimationFrame
  const requestSetOverflow = function() {
    if (timeout) {
      window.cancelAnimationFrame(timeout);
    }  
    timeout = window.requestAnimationFrame(() => {
      setOverflow();
    });
  }
  // Get overflow value on scroller
  const getOverflow = function(content, container) {
    let containerMetrics = container.getBoundingClientRect();
    let containerWidth = containerMetrics.width;
    let containerMetricsLeft = Math.floor(containerMetrics.left);
    let contentMetrics = content.getBoundingClientRect();
    let contentMetricsRight = Math.floor(contentMetrics.right);
    let contentMetricsLeft = Math.floor(contentMetrics.left);
    // Offset the values by the left value of the container
    let offset = containerMetricsLeft;
    containerMetricsLeft -= offset;
    contentMetricsRight -= offset + 1; // Due to an off by one bug in iOS
    contentMetricsLeft -= offset;
    if (containerMetricsLeft > contentMetricsLeft && containerWidth < contentMetricsRight) {
        return 'both';
    } else if (contentMetricsLeft < containerMetricsLeft) {
        return 'left';
    } else if (contentMetricsRight > containerWidth) {
        return 'right';
    } else {
        return 'none';
    }
  }
  // Move the scroller with a transform
  const moveScroller = function(direction) {
    if (scrolling === true) return;
    setOverflow();  
    let scrollDistance = scrollStep;
    let scrollAvailable;   
    if (scrollOverflow === direction || scrollOverflow === 'both') {  
      if (direction === 'left') {
        scrollAvailable = navScroller.scrollLeft;
      }  
      if (direction === 'right') {
        let navScrollerRightEdge = navScroller.getBoundingClientRect().right;
        let navScrollerContentRightEdge = navScrollerContent.getBoundingClientRect().right; 
        scrollAvailable = Math.floor(navScrollerContentRightEdge - navScrollerRightEdge);
      }  
      // If there is less that 1.5 steps available then scroll the full way
      if (scrollAvailable < (scrollStep * 1.5)) {
        scrollDistance = scrollAvailable;
      } 
      if (direction === 'right') {
        scrollDistance *= -1;
      }  
      navScrollerContent.classList.remove('no-transition');
      navScrollerContent.style.transform = 'translateX(' + scrollDistance *(-1) + 'px)';  
      scrollingDirection = direction;
      scrolling = true;
    }  
  }  
  // Set the scroller position and removes transform, called after moveScroller()
  const setScrollerPosition = function() {
    var style = window.getComputedStyle(navScrollerContent, null);
    var transform = style.getPropertyValue('transform');
    var transformValue = Math.abs(parseInt(transform.split(',')[4]) || 0);
    if (scrollingDirection === 'left') {
      transformValue *= -1;
    } 
    navScrollerContent.classList.add('no-transition');
    navScrollerContent.style.transform = '';
    navScroller.scrollLeft = navScroller.scrollLeft + transformValue;
    navScrollerContent.classList.remove('no-transition'); 
    scrolling = false;
  } 
  // Toggle buttons depending on overflow
  const toggleButtons = function(overflow) {
    navScrollerLeft.classList.remove('active');
    navScrollerRight.classList.remove('active'); 
    if (overflow === 'both' || overflow === 'left') {
      navScrollerLeft.classList.add('active');
    }
    if (overflow === 'both' || overflow === 'right') {
      navScrollerRight.classList.add('active');
    }
  }
  const init = function() { 
    // Determine scroll overflow
    setOverflow();  
    // Scroll listener
    navScroller.addEventListener('scroll', () => {
      requestSetOverflow();
    });  
    // Resize listener
    window.addEventListener('resize', () => {
      requestSetOverflow();
    });  
    // Button listeners
    navScrollerLeft.addEventListener('click', () => {
      moveScroller('left');
    });  
    navScrollerRight.addEventListener('click', () => {
      moveScroller('right');
    }); 
    // Set scroller position
    navScrollerContent.addEventListener('transitionend', () => {
      setScrollerPosition();
    });  
  };  
  // Init is called by default
  init();  
  // Reveal API
  return {
    init
  };
  };
  const navScrollerTest = navScroller();
}
function templateNotFoundNotification(id) {
    var template = $(id).find('.parent-template').length - $(id).find(".parent-template[style*='display: none;']").length;

    $(id).find('.template_not_found_child').remove();

    if (template == 0) {
        $(id).append($('#template_not_found').html());
    }
}

$(document).on('click', '.nav-item.nav-scroller-item', function() {
    var id = $(this).find('a').attr('href');

    templateNotFoundNotification(id)
})
