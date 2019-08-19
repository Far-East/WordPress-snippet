(function ($) {
  "use strict";

 //Ваше сообщение отправлено и сообщение об ошибке в лайтбоксе Bootstrap 4 и CF_7.
  document.addEventListener('wpcf7mailsent', function (event) {
    $('#call-to-action').modal('hide');
    $("#CF7success").modal('show');
  }, false);

})(jQuery);

