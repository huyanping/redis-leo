<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/5/25
 * Time: 16:52
 */

namespace Vincent\Mice\Redis;


use Dotenv\Dotenv;
use Vincent\Zoomeye\Query\HostQuery;
use Vincent\Zoomeye\Zoomeye;

class ZoomeyeRedisIpFinder
{
    public function start() {
        $ips = array();
        try{
            $client = Zoomeye::create();
            $client->login(getenv("ZOOMEYE_USER_NAME"), getenv("ZOOMEYE_PASSWORD"));

            $query = new HostQuery();
            $query->setPort("6379");
            if(!empty(getenv("ZOOMEYE_COUNTRY"))) {
                $query->setCountry(getenv("ZOOMEYE_COUNTRY"));
            }
            $query->setCountry("印度");

            try{
                $page = 1;
                while(true) {
                    $response = $client->hostSearch($query, $page);
                    foreach($response['matches'] as $record) {
                        if(!array_key_exists('ip', $record)) continue;
                        $ips[] = $record['ip'];
                        echo $record['ip'], PHP_EOL;
                    }
                    $page ++;
                }
            }catch(\Exception $e) {
                echo $e->getMessage(), PHP_EOL;
                echo $e->getTraceAsString(), PHP_EOL;
            }
        }catch(\Exception $e) {
            echo $e->getMessage(), PHP_EOL;
            echo $e->getTraceAsString(), PHP_EOL;
        }

        return $ips;
    }
}