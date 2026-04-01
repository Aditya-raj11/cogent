<?php
$urls = [
 'http://127.0.0.1:8000/api/app-configuration',
 'http://127.0.0.1:8000/api/dashboard-detail'
];
foreach($urls as $u){
  $start = microtime(true);
  $ctx = stream_context_create(['http'=>['timeout'=>40,'ignore_errors'=>true]]);
  $res = @file_get_contents($u,false,$ctx);
  $t = round((microtime(true)-$start),2);
  $status = isset($http_response_header[0]) ? $http_response_header[0] : 'NO_STATUS';
  $len = $res === false ? 0 : strlen($res);
  echo "$u => $status | t={$t}s | len=$len\n";
}
