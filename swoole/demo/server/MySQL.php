<?php

/**
 * Created by PhpStorm.
 * User: Mikou.hu
 * Date: 2019/5/23
 *
 * 以下方法仅在版本 < 4.3 才能使用 否则会抛出  swoole\mysql not found
 */
class MySQL
{

    public function __construct()
    {
        $db = new  Swoole\Mysql;

        $server = array(
            'host' => '127.0.0.1',
            'user' => 'test',
            'password' => 'test',
            'database' => 'test',
        );

        $db->connect($server, function ($db, $result) {
            $db->query("show tables", function (Swoole\MySQL $db, $result) {
                var_dump($result);
                $db->close();
            });
        });

//        $redis = new Swoole\Redis;
//        $redis->connect('127.0.0.1', 6379, function ($redis, $result) {
//            $redis->set('test_key', 'value', function ($redis, $result) {
//                $redis->get('test_key', function ($redis, $result) {
//                    var_dump($result);
//                });
//            });
//        });
    }
}

$db = new MySQL();