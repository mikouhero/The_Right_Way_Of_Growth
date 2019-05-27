<?php

/**
 * Created by PhpStorm.
 * User: Mikou.hu
 * Date: 2019/5/27
 */
//$serv = new swoole_server("127.0.0.1", 9501);
//$serv->set(['worker_num' => 1]);
//$serv->on('receive', function ($serv, $fd, $from_id, $data) {
//    sleep(10);
//    $serv->send($fd, 'Swoole: '.$data);
//});
//$serv->start();

//
//$server = new Swoole\Http\Server('127.0.0.1', 9500);
//
//$i = 1;
//
//$server->on('Request', function ($request, $response) {
//    global $i;
//    $response->end($i++);
//});
//
//$server->start();


//$server = new Swoole\Http\Server('127.0.0.1', 9500);
//
//$atomic = new Swoole\Atomic(1);
//
//$server->on('Request', function ($request, $response) use ($atomic) {
//    $response->end($atomic->add(1));
//});
//
//$server->start();