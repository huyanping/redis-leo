<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/5/25
 * Time: 17:01
 */

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bootstrap.php';

$zoomeye = new \Vincent\Mice\Redis\ZoomeyeRedisIpFinder();
$ips = $zoomeye->start();