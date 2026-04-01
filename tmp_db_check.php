<?php
mysqli_report(MYSQLI_REPORT_OFF);
$host = '127.0.0.1';
$user = 'root';
$db = 'streamit';
$tests = ['', 'root', '1234', '12345', '123456', 'admin', 'password'];
foreach ($tests as $p) {
    $m = @new mysqli($host, $user, $p, $db, 3306);
    if (!$m->connect_errno) {
        echo "SUCCESS password=[{$p}]\n";
        $m->close();
        exit(0);
    }
    echo "FAIL password=[{$p}] err={$m->connect_errno} {$m->connect_error}\n";
}
exit(1);
