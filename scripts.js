$(function () {
  let intervalID;

  function startCheckoutProcess() {
    intervalID = setInterval(function () {
      $.get('/controller.php?action=get_status')
        .done(function (response) {
          let log = (new Date()).toLocaleTimeString() + ' - ' + JSON.stringify(response);
          if (response.status === 'step_3') {
            log += ' - Checkout process finished';
            clearInterval(intervalID);
          }
          $('.response').html(log);
        });
    }, 1000);
  }

  $('.start').on('click', function () {
    $.get('/trigger.php');
    startCheckoutProcess();
  });

  $('.stop').on('click', function () {
    clearInterval(intervalID);
  });

  $('.reset').on('click', function () {
    $.get('/controller.php?action=reset_status');
  });
});
