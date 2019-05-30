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


//$server = new Swoole\Server('127.0.0.1', 9501);
//
///**
// * 用户进程实现了广播功能，循环接收管道消息，并发给服务器的所有连接
// */
//$process = new Swoole\Process(function($process) use ($server) {
//    while (true) {
//        $msg = $process->read();
//        echo $msg.PHP_EOL;
//        foreach($server->connections as $conn) {
//            $server->send($conn, $msg);
//        }
//    }
//});
//
//$server->addProcess($process);
//
//$server->on('receive', function ($serv, $fd, $reactor_id, $data) use ($process) {
//    //群发收到的消息
////    var_dump($data);
//    $process->write($data);
//});
//
//$server->start();


$http = new swoole_http_server("127.0.0.1", 9501);

$http->on("request", function ($request, $response) {
    $client = new Swoole\Coroutine\Client(SWOOLE_SOCK_TCP);
    $client->connect("127.0.0.1", 8888, 0.5);
    //调用connect将触发协程切换
    $client->send("hello world from swoole");
    //调用recv将触发协程切换
    $ret = $client->recv();
    $response->header("Content-Type", "text/html; charset=utf-8");

    $response->end($ret);
    $client->close();
});

$http->start();