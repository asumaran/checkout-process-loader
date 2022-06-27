<?php
use Amp\Parallel\Worker;
use Amp\Promise;
use Amp\Deferred;
use Amp\Loop;

class CheckoutTaskRunner {
  function __construct() {
    $this->init();
  }

  function init () {
    Loop::run(function () {
      $this->save_status('No status');

      $status = yield $this->first_step();
      $this->save_status($status);

      $status = yield $this->second_step();
      $this->save_status($status);

      $status = yield $this->third_step();
      $this->save_status($status);
    });
  }

  function save_status($status) {
    file_put_contents('log.txt', $status.PHP_EOL , FILE_APPEND | LOCK_EX);
  }

  function first_step() {
    $deferred = new Deferred();

    Loop::delay(5 * 1000, function () use ($deferred) {
      $deferred->resolve("step_1");
    });

    return $deferred->promise();
  }

  function second_step() {
    $deferred = new Deferred();

    Loop::delay(5 * 1000, function () use ($deferred) {
        $deferred->resolve("step_2");
    });

    return $deferred->promise();
  }

  function third_step() {
    $deferred = new Deferred();

    Loop::delay(5 * 1000, function () use ($deferred) {
        $deferred->resolve("step_3");
    });

    return $deferred->promise();
  }
}
