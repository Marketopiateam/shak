/**
 * Form Editors
 */

'use strict';

(function () {
  const fullToolbar = [
    [
      {
        font: []
      },
      {
        size: []
      }
    ],
    ['bold', 'italic', 'underline', 'strike'],
    [
      {
        color: []
      },
      {
        background: []
      }
    ],
    [
      {
        script: 'super'
      },
      {
        script: 'sub'
      }
    ],
    [
      {
        header: '1'
      },
      {
        header: '2'
      },
      'blockquote',
      'code-block'
    ],
    [
      {
        list: 'ordered'
      },
      {
        list: 'bullet'
      },
      {
        indent: '-1'
      },
      {
        indent: '+1'
      }
    ],
    [{ direction: 'rtl' }],
    ['link', 'image', 'video', 'formula'],
    ['clean']
  ];
  const fullEditor = new Quill('.content_en', {
    bounds: '.content_en',
    placeholder: 'Type Something...',
    modules: {
      formula: true,
      toolbar: fullToolbar
    },
    theme: 'snow'
  });
  const fullEditor2 = new Quill('.content_ar', {
    bounds: '.content_ar',
    placeholder: 'Type Something...',
    modules: {
      formula: true,
      toolbar: fullToolbar
    },
    theme: 'snow'
  });
})();
