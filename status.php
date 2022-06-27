<?php
include './provider.php';

header('Content-type: application/json');

$provider = new Provider();

$status = $provider->get_status();

$response = ["status" => $status];

echo json_encode($response);
