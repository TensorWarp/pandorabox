"use strict";

tinymce.init({
  selector: 'textarea#basic-example',
  statusbar: false,
      menubar:false,
      promotion:false,
      contextmenu:false,
      content_style:"body{color:#898989}",
      toolbar: false,
      plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
        'insertdatetime', 'media', 'table'
      ],
      toolbar: 'bold italic backcolor | alignleft aligncenter ' + 'alignright alignjustify | bullist numlist outdent indent | ' +'undo redo | blocks forecolor | ' +
      'removeformat | ',
  content_css: '../../Modules/OpenAI/Resources/assets/css/rtl.min.css',
  init_instance_callback: function (editor) {
    var lang = document.documentElement.getAttribute("lang");
    function applyTextAlignmentBasedOnLanguage() {
      if (lang == "ar") {
        editor.setContent(`<p class="rtl-text">${editor.getContent()}</p>`);
      } 
      else {
        editor.setContent(editor.getContent().replace(/<div class="rtl-text">|<\/div>/g, ''));
      }
    }
    applyTextAlignmentBasedOnLanguage();
  }
});