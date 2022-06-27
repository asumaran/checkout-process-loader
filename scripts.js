$(function () {
  const intervalID = setInterval(function () {
    $.get('/controller.php?action=get_status')
      .done(function (response) {
        let log = (new Date()).toLocaleTimeString() + ' - ';

        if (response.status) {
          log += JSON.stringify(response);
        } else {
          log += 'Checkout process not initiated';
        }

        $('.response').html(log);
      });
  }, 1000);

  $('.start').on('click', function () {
    $.get('/trigger.php');
  });

  $('.stop').on('click', function () {
    clearInterval(intervalID);
  });

  $('.reset').on('click', function () {
    $.get('/controller.php?action=reset_status');
  });
});
