"use strict";
const slugify = (str) => str.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
// tiny mce plugin customization
tinymce.init({
    selector: 'textarea#basic-example',
    statusbar: false,
    menubar:false,
    promotion:false,
    contextmenu:false,
    toolbar: false,
    plugins: [
      'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
      'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
      'insertdatetime', 'media', 'table',
    ],
    toolbar: 'bold italic backcolor | alignleft aligncenter ' + 'alignright alignjustify | bullist numlist outdent indent | ' +'undo redo | blocks forecolor | ' +
    'removeformat | '
  });
  tomSelect()
  var para = {
    allowEmptyOption: true,
	  create: false
  };


  function tomSelect()
  {
    document.querySelectorAll('.select').forEach((el)=>{
        let settings = {}
        new TomSelect(el,(settings,para));
      });
  }


