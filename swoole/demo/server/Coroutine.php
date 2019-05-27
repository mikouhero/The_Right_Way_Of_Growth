<?php

/**
 * Created by PhpStorm.
 * User: Mikou.hu
 * Date: 2019/5/24
 */
class Coroutine
{

    protected  $http ;
    protected  $db ;

    protected  $config = [
        'host' => '127.0.0.1',
        'port' => 3306,
        'user' => 'root',
        'password' => 'root',
        'database' => 'test',
    ];
    public function __construct()
    {
        $this->http = new swoole\http\server('0.0.0.0',9505);
        $this->http->on('request',[$this,'onRequest']);
//        $this->http->on('request', function ($request, $response) {
//            $db = new Swoole\Coroutine\MySQL();
//            $db->connect([
//                'host' => '127.0.0.1',
//                'port' => 3306,
//                'user' => 'user',
//                'password' => 'pass',
//                'database' => 'test',
//            ]);
//            $data = $db->query('select * from test_table');
//            var_dump($data);
//            $response->end(json_encode($data));
//        });

        $this->http->start();
    }

    public function onRequest($srever,$response){
        $this->db = new Swoole\Coroutine\MySQL();

        $this->db->connect($this->config);
        $data = $this->db->query('select * from table_1');

        $response->end(json_encode($data));

    }

}

$c = new Coroutine();