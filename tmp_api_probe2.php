<?php
$url = 'http://127.0.0.1:8000/api/app-configuration';
$ctx = stream_context_create(['http' => ['timeout' => 20, 'ignore_errors' => true]]);
$res = @file_get_contents($url, false, $ctx);
if (isset($http_response_header)) {
    echo implode("\n", $http_response_header) . "\n";
}
if ($res === false) {
    $e = error_get_last();
    echo "FAILED\n";
    if ($e) { echo $e['message'] . "\n"; }
    exit(1);
}
echo "BODY_LEN=" . strlen($res) . "\n";
echo substr($res, 0, 300) . "\n";
