<?php
$urls=[
'http://127.0.0.1:8000/api/v2/dashboard-detail',
'http://127.0.0.1:8000/api/v2/dashboard-detail-data'
];
foreach($urls as $u){
  $res=@file_get_contents($u);
  echo "URL=$u\n";
  if($res===false){echo "FAILED\n\n";continue;}
  $json=json_decode($res,true);
  if(!is_array($json)){echo "INVALID_JSON\n\n";continue;}
  $data=$json['data']??[];
  echo 'keys='.implode(',', array_keys($data))."\n";
  foreach(['slider','continue_watch','top_10','latest_movie','popular_movie','popular_tvshow','popular_videos','tranding_movie'] as $k){
    if(array_key_exists($k,$data)){
      $v=$data[$k];
      $c=is_array($v)?count($v):-1;
      echo "$k=$c\n";
    }
  }
  echo "\n";
}
