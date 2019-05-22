<?php
/**
 * Created by PhpStorm.
 * User: Mikou.hu
 * Date: 2019/5/21
 */

class udp
{
    public $server;
    public function __construct()
    {
        $this->server = new Swoole\Server('127.0.0.1',9502,SWOOLE_PROCESS,SWOOLE_SOCK_UDP);

        $this->server->on('Packet',[$this,'onPacket']);
//        $this->server->on('Packet', function ($serv, $data, $clientInfo) {
//
//        });

        $this->server->start();
    }

    function onPacket($serv, $data, $clientInfo){
        $serv->sendto($clientInfo['address'], $clientInfo['port'], "我收到了你的信息 --  ".$data);
        var_dump($clientInfo);
    }
}
$c = new udp();
