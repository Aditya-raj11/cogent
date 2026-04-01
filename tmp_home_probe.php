<?php
$urls = [
 'http://192.168.29.33:8000/api/v2/dashboard-detail',
 'http://192.168.29.33:8000/api/v2/dashboard-detail-data',
 'http://192.168.29.33:8000/api/v2/dashboard-detail?user_id=2&profile_id=1',
 'http://192.168.29.33:8000/api/v2/dashboard-detail-data?user_id=2&profile_id=1',
 'http://192.168.29.33:8000/api/v2/dashboard-detail?user_id=3&profile_id=1',
 'http://192.168.29.33:8000/api/v2/dashboard-detail-data?user_id=3&profile_id=1'
];
foreach($urls as $u){
  $start = microtime(true);
  $ctx = stream_context_create(['http'=>['timeout'=>45,'ignore_errors'=>true]]);
  $res = @file_get_contents($u,false,$ctx);
  $t = round((microtime(true)-$start),2);
  $status = isset($http_response_header[0]) ? $http_response_header[0] : 'NO_STATUS';
  $len = $res === false ? 0 : strlen($res);
  echo "$u => $status | t={$t}s | len=$len\n";
}
