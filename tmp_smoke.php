<?php
$urls = [
  'http://127.0.0.1:8000/admin/login',
  'http://127.0.0.1:8000/api/app-configuration',
  'http://127.0.0.1:8000/api/dashboard-detail'
];
foreach ($urls as $u) {
  $ctx = stream_context_create(['http' => ['timeout' => 20, 'ignore_errors' => true]]);
  $res = @file_get_contents($u, false, $ctx);
  $status = isset($http_response_header[0]) ? $http_response_header[0] : 'NO_STATUS';
  $len = ($res === false) ? 0 : strlen($res);
  echo $u . " => " . $status . " | len=" . $len . "\n";
}
