<?php

/**
 * Created by PhpStorm.
 * User: Mikou.hu
 * Date: 2019/5/22
 */
class WebSocket
{
    public $ws;

    public function __construct()
    {
        $this->ws = new Swoole\WebSocket\Server('0.0.0.0', 9504);

        $this->ws->on('open',[$this,'onOpen']);
        $this->ws->on('message',[$this,'onMessage']);
        $this->ws->on('close',[$this,'onClose']);
        $this->ws->start();
    }


    public function onOpen($ws,$request)
    {
        var_dump($request->fd, $request->get, $request->server);
        $ws->push($request->fd,'你开啦--'.PHP_EOL);
    }

    public function onMessage($ws,$frame)
    {
//        var_dump($frame);
            echo "Message: {$frame->data}\n";
            $ws->push($frame->fd, "server: 你的信息 -- {$frame->data}");
    }

    public function onClose($ws,$fd)
    {
        var_dump($fd);
    }
}

$ws  = new WebSocket();

$ws = new swoole_websocket_server("0.0.0.0", 9504);

//监听WebSocket连接打开事件
//$ws->on('open', function ($ws, $request) {
//    var_dump($request->fd, $request->get, $request->server);
//    $ws->push($request->fd, "hello, welcome\n");
//});
//
////监听WebSocket消息事件
//$ws->on('message', function ($ws, $frame) {
//    echo "Message: {$frame->data}\n";
//    $ws->push($frame->fd, "server: {$frame->data}");
//});
//
////监听WebSocket连接关闭事件
//$ws->on('close', function ($ws, $fd) {
//    echo "client-{$fd} is closed\n";
//});
//
//$ws->start();