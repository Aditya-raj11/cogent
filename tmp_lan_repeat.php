<?php
for($i=1;$i<=5;$i++){
  $u = 'http://192.168.29.33:8000/api/app-configuration';
  $start = microtime(true);
  $ctx = stream_context_create(['http'=>['timeout'=>25,'ignore_errors'=>true]]);
  $res = @file_get_contents($u,false,$ctx);
  $t = round((microtime(true)-$start),2);
  $status = isset($http_response_header[0]) ? $http_response_header[0] : 'NO_STATUS';
  $len = $res === false ? 0 : strlen($res);
  echo "try#$i => $status | t={$t}s | len=$len\n";
}
