<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/5/24
 * Time: 14:10
 */

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bootstrap.php';

if($argc <= 1) {
    echo "need ip file param", PHP_EOL;
    exit;
}
$file = $argv[1];

$distinct = new \Vincent\Mice\Tool\IPDistinct($file);
$distinct->distinct();