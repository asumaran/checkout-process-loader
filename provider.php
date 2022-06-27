<?php
include './tail.php';

class Provider {
  public function get_status() {
    $last_status = tailCustom('./log.txt');
    return $last_status;
  }
}
