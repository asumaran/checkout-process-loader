<?php
include './provider.php';

$provider = new Provider();

switch ($_GET['action']) {
  case 'get_status':
    $status = $provider->get_status();
    $response = ["status" => $status];
    break;
  case 'reset_status':
    // TODO: This is not enough. We need to stop the runner somehow.
    $provider->reset_status();
    break;

  default:
    $response = 'No action defined';
    break;
}


header('Content-type: application/json');
echo json_encode($response);
