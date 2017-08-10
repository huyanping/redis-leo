<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/5/24
 * Time: 11:15
 */

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bootstrap.php';

if($argc <= 1) {
    echo "need ip file param", PHP_EOL;
    exit;
}

$ips = file($argv[1]);

$pool = new \Jenner\SimpleFork\FixedPool(20);
foreach($ips as $ip) {
    $ip = trim($ip);
    $process = new \Vincent\Mice\Redis\HackProcess($ip, array(6379));
    $pool->execute($process);
}

$pool->wait(true);