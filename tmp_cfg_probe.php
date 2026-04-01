<?php
$urls = [
  'http://127.0.0.1:8000/api/app-configuration',
  'http://127.0.0.1:8000/api/v2/app-configuration',
  'http://192.168.29.33:8000/api/app-configuration',
  'http://192.168.29.33:8000/api/v2/app-configuration'
];
foreach($urls as $u){
  $ctx = stream_context_create(['http'=>['timeout'=>20,'ignore_errors'=>true]]);
  $res = @file_get_contents($u,false,$ctx);
  $status = $http_response_header[0] ?? 'NO_STATUS';
  echo "URL=$u\nSTATUS=$status\n";
  if($res===false){ echo "FAILED\n\n"; continue; }
  $json = json_decode($res,true);
  if(!is_array($json)){ echo "INVALID_JSON\n\n"; continue; }
  $data = $json['data'] ?? $json;
  foreach(['enable_movie','enable_tvshow','enable_livetv','enable_video','continue_watch'] as $k){
    $v = $data[$k] ?? null;
    $t = gettype($v);
    $vs = is_scalar($v) ? (string)$v : json_encode($v);
    echo "$k => type=$t value=$vs\n";
  }
  echo "\n";
}
