window.addEventListener('load', () => {

  if (!document.querySelector('.contact-form')) {
    return false
  } else {

    // form inputs
    const contactForm = document.querySelector('.contact-form')

    // toggle form
    const contactFormBtn = document.querySelector('.contact-form-btn')
    const contactFormClose = contactForm.querySelector('.contact-form__close')
    const contactFormOverlay = document.querySelector('.contact-form__overlay')

    const toggleContactForm = () => {
      contactForm.classList.toggle('active')
      contactFormBtn.classList.toggle('disabled')
      contactFormOverlay.classList.toggle('active')
      document.body.classList.toggle('body_fix')
    }

    contactFormBtn.addEventListener('click', toggleContactForm)
    contactFormClose.addEventListener('click', toggleContactForm)
    contactFormOverlay.addEventListener('click', toggleContactForm)

    // input file
    const inputFile = contactForm.querySelector('.contact-form__file input')
    const inputFileLabel = inputFile.nextElementSibling
    const labelValue = inputFileLabel.querySelector('.contact-form__file-txt')

    inputFile.addEventListener('change', function (event) {
      let countFiles
      if (this.files && this.files.length >= 1) {
        countFiles = this.files.length
      }
      if (countFiles) {
        labelValue.innerText = 'Выбрано файлов: ' + countFiles
      } else {
        labelValue.innerText = 'Прикрепить файл'
      }
    })

    // textarea
    const textarea = document.querySelector('.contact-form textarea')

    textarea.addEventListener('focus', () => textarea.parentElement.classList.add('focus'))

    textarea.addEventListener('blur', () => textarea.parentElement.classList.remove('focus'))

    // request

    function usernameTest(input) {
      return !/^[a-zA-Zа-яА-ЯёЁ'][a-zA-Z-а-яА-ЯёЁ' ]+[a-zA-Zа-яА-ЯёЁ']?$/.test(input.value)
    }

    [].forEach.call(document.querySelectorAll('._phone'), function (input) {
      var keyCode;

      function mask(event) {
        event.keyCode && (keyCode = event.keyCode);
        var pos = this.selectionStart;
        if (pos < 3) event.preventDefault();
        var matrix = "+7 (___)-___-____",
          i = 0,
          def = matrix.replace(/\D/g, ""),
          val = this.value.replace(/\D/g, ""),
          new_value = matrix.replace(/[_\d]/g, function (a) {
            return i < val.length ? val.charAt(i++) || def.charAt(i) : a
          });
        i = new_value.indexOf("_");
        if (i !==  -1) {
          i < 5 && (i = 3);
          new_value = new_value.slice(0, i)
        }
        var reg = matrix.substr(0, this.value.length).replace(/_+/g,
          function (a) {
            return "\\d{1," + a.length + "}"
          }).replace(/[+()]/g, "\\$&");
        reg = new RegExp("^" + reg + "$");
        if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
        if (event.type === "blur" && this.value.length < 5) this.value = ""
      }

      input.addEventListener("input", mask, false);
      input.addEventListener("focus", mask, false);
      input.addEventListener("blur", mask, false);
      input.addEventListener("keydown", mask, false)

    });

    $('#callForm').submit(function () {
      $.ajax({
        type: "POST",
        url: '/send.php',
        data: $('#callForm').serialize(),
        success: function (data) {
          $('#callForm').find('.sent').html('Заявка отправлена!');
          $(':input', '#callForm')
            .not(':button, :submit, :reset, :hidden')
            .val('')
            .prop('checked', false)
            .prop('selected', false);
          setTimeout(function () {
            $('#callForm').find('.sent').html('Оставить заявку');
          }, 1500);
        },
      });
      return false;
    });

    $('#contactPageForm').submit(function () {
      $.ajax({
        type: "POST",
        url: '/send.php',
        data: $('#contactPageForm').serialize(),
        success: function (data) {
          $('#contactPageForm').find('.sent').html('Отправлено!');
          $(':input', '#contactPageForm')
            .not(':button, :submit, :reset, :hidden')
            .val('')
            .prop('checked', false)
            .prop('selected', false);
          setTimeout(function () {
            $('#contactPageForm').find('.sent').html('Отправить');
          }, 1500);
        },
      });
      return false;
    });

    $('#contactForm').submit(function () {
      $.ajax({
        type: "POST",
        url: '/send.php',
        data: new FormData(document.getElementById('contactForm')),
        processData: false,
        contentType: false,
        success: function (data) {
          $('#contactForm').find('.sent').html('Отправлено!');
          $(':input', '#contactForm')
            .not(':button, :submit, :reset, :hidden')
            .val('')
            .prop('checked', false)
            .prop('selected', false);
          setTimeout(function () {
            $('#contactForm').find('.sent').html('Отправить');
          }, 1500);

        },
      });
      return false;
    });
  }


  function usernameTest(input) {
    return !/^[a-zA-Zа-яА-ЯёЁ'][a-zA-Z-а-яА-ЯёЁ' ]+[a-zA-Zа-яА-ЯёЁ']?$/.test(input.value)
  }

  [].forEach.call(document.querySelectorAll('._phone'), function (input) {
    var keyCode;

    function mask(event) {
      event.keyCode && (keyCode = event.keyCode);
      var pos = this.selectionStart;
      if (pos < 3) event.preventDefault();
      var matrix = "+7 (___)-___-____",
        i = 0,
        def = matrix.replace(/\D/g, ""),
        val = this.value.replace(/\D/g, ""),
        new_value = matrix.replace(/[_\d]/g, function (a) {
          return i < val.length ? val.charAt(i++) || def.charAt(i) : a
        });
      i = new_value.indexOf("_");
      if (i != -1) {
        i < 5 && (i = 3);
        new_value = new_value.slice(0, i)
      }
      var reg = matrix.substr(0, this.value.length).replace(/_+/g,
        function (a) {
          return "\\d{1," + a.length + "}"
        }).replace(/[+()]/g, "\\$&");
      reg = new RegExp("^" + reg + "$");
      if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
      if (event.type == "blur" && this.value.length < 5) this.value = ""
    }

    input.addEventListener("input", mask, false);
    input.addEventListener("focus", mask, false);
    input.addEventListener("blur", mask, false);
    input.addEventListener("keydown", mask, false)

  });

  $('#callForm').submit(function () {
    $.ajax({
      type: "POST",
      url: '/send.php',
      data: $('#callForm').serialize(),
      success: function (data) {
        $('#callForm').find('.sent').html('Заявка отправлена!');
        $(':input', '#callForm')
          .not(':button, :submit, :reset, :hidden')
          .val('')
          .prop('checked', false)
          .prop('selected', false);
        setTimeout(function () {
          $('#callForm').find('.sent').html('Оставить заявку');
        }, 1500);
      },
    });
    return false;
  });

  $('#contactPageForm').submit(function () {
    $.ajax({
      type: "POST",
      url: '/send.php',
      data: $('#contactPageForm').serialize(),
      success: function (data) {
        $('#contactPageForm').find('.sent').html('Отправлено!');
        $(':input', '#contactPageForm')
          .not(':button, :submit, :reset, :hidden')
          .val('')
          .prop('checked', false)
          .prop('selected', false);
        setTimeout(function () {
          $('#contactPageForm').find('.sent').html('Отправить');
        }, 1500);
      },
    });
    return false;
  });

  $('#contactForm').submit(function () {
    $.ajax({
      type: "POST",
      url: '/send.php',
      data: new FormData(document.getElementById('contactForm')),
      processData: false,
      contentType: false,
      success: function (data) {
        $('#contactForm').find('.sent').html('Отправлено!');
        $(':input', '#contactForm')
          .not(':button, :submit, :reset, :hidden')
          .val('')
          .prop('checked', false)
          .prop('selected', false);
        setTimeout(function () {
          $('#contactForm').find('.sent').html('Отправить');
        }, 1500);

      },
    });
    return false;
  });

})
