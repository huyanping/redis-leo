<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/7/22
 * Time: 9:45
 */

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bootstrap.php';

$hack = new \Vincent\Mice\Redis\RedisHack();
$hack->connect("127.0.0.1", 6379);
$hack->hack();

