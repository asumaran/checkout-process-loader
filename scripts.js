$(function () {
  const intervalID = setInterval(function () {
    $.get('/status.php')
      .done(function (response) {
        console.log('response –>',response);
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
});
