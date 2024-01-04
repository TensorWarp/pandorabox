"use strict";

var useCaseImage;
var firstValue;

const tomSelectConfig = {
    render: {
        option: (data) => {
            return `<div><img src="${data.src}"><span class="line-clamp-single">${data.text}</span></div>`;
        },
        item: (item) => {
            return `<div><img src="${item.src}"><span class="line-clamp-single">${item.text}</span></div>`;
        },
    },
    onFocus: () => {
        firstValue = useCaseImage.getValue(0);
    },
    onChange: (value) => {
        if (value.length > 0) {
            firstValue = value;
        }
        if (value === '') {
            useCaseImage.setValue(firstValue);
        }
    },
};


$('#use-case-image').each(function () {
    useCaseImage = new TomSelect(this, tomSelectConfig);
});