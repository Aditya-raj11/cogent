<?php
$url = 'http://127.0.0.1:8000/api/app-configuration';
$ctx = stream_context_create(['http' => ['timeout' => 15]]);
$res = @file_get_contents($url, false, $ctx);
if ($res === false) {
    echo "FAILED\n";
    exit(1);
}
echo "OK length=" . strlen($res) . "\n";
