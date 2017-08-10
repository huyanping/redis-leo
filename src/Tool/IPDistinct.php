<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/5/24
 * Time: 14:07
 */

namespace Vincent\Mice\Tool;


class IPDistinct
{
    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function distinct() {
        $lines = file($this->file);
        $ip_distinct = array();
        foreach($lines as $line) {
            $ip_distinct[trim($line)] = 0;
        }
        $content = "";
        foreach($ip_distinct as $ip=>$value) {
            $content .= $ip . PHP_EOL;
        }
        file_put_contents($this->file, $content);
    }
}