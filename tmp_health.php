<?php
$u='http://127.0.0.1:8000/api/app-configuration';
$r=@file_get_contents($u);
echo $r===false ? "DOWN\n" : "UP len=".strlen($r)."\n";
