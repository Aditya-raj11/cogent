<?php
$u = 'http://127.0.0.1:8000/api/app-configuration?is_authenticated=0';
$ctx = stream_context_create(['http' => ['ignore_errors' => true, 'timeout' => 10]]);
$r = @file_get_contents($u, false, $ctx);
if ($r === false) {
    echo "REQUEST_FAILED\n";
} else {
    echo substr($r, 0, 500) . "\n";
}
if (isset($http_response_header)) {
    echo implode("\n", $http_response_header) . "\n";
}
