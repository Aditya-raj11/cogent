<?php
$urls = [
  'http://127.0.0.1:8000/api/reels',
  'http://127.0.0.1:8000/reels',
  'http://127.0.0.1:8000/app/reels'
];
foreach($urls as $u){
  $ctx = stream_context_create(['http'=>['timeout'=>20,'ignore_errors'=>true]]);
  $res = @file_get_contents($u, false, $ctx);
  $status = $http_response_header[0] ?? 'NO_STATUS';
  $len = $res === false ? 0 : strlen($res);
  echo "$u => $status len=$len\n";
}
