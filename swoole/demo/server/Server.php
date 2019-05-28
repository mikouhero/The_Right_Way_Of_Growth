<?php

/**
 * Created by PhpStorm.
 * User: Mikou.hu
 * Date: 2019/5/27
 */
class Server
{

    protected $server;

    /**
     * @var 监听的IP 地址
     */
    protected $host = '0.0.0.0';

    /**
     * @var 监听的端口
     * 如果$sock_type为UnixSocket Stream/Dgram，此参数将被忽略
     * 端口小于1024 需要root 权限
     * 端口占用 启动失败
     */
    protected $port = 9501;

    /**
     * @var 运行模式
     *  SWOOLE_PROCESS多进程模式（默认）
     * SWOOLE_BASE基本模式
     */
    protected $mode=SWOOLE_PROCESS;

    /**
     * @var array
     * 用于设置运行时的各项参数。服务器启动后通过$serv->setting来访问Server->set方法设置的参数数组。
     */
    protected $set_config = [
    ];

    /**
     * @var $sock_type指定Socket的类型，支持TCP、UDP、TCP6、UDP6、UnixSocket Stream/Dgram 6种
     */
    protected $sock_type=SWOOLE_SOCK_TCP;


    public function __construct()
    {
        $this->server = new Swoole\Server($this->host, $this->port, $this->mode, $this->sock_type);

        $this->server->set(
            $this->set_config
        );

        $this->init();

        $this->server->start();

    }

    protected function init()
    {
        $this->server->on('Connect',[$this,'onConnect']);
        $this->server->on('Receive',[$this,'onReceive']);
        $this->server->on('Close',[$this,'onClose']);

        $this->master_pid();
    }

    public function onConnect($server,$fd,$reactor_id)
    {
        echo '连接成功'.PHP_EOL;
        $this->send($this->server,$fd,$reactor_id,'连接消息');

        $this->getClientInfo($server,$fd,0,false);
        $this->getClientList();
    }

    public function onReceive($server,$fd,$reactor_id,$data)
    {
        echo '接收成功'.PHP_EOL;
        $this->send($server,$fd,$reactor_id,'你发送的是'.$data);
//        $this->sendfile($server,$fd,$reactor_id);

        static $i=0;
        $i++;
        if($i>5){
            $this->pause($fd);
        }
    }

    public function onClose($server,$fd)
    {
        echo '关闭'.PHP_EOL;
    }

    //发送消息
    public function send($server,$fd,$reactor_id,$msg)
    {
        $server->send($fd,$msg);
    }


    public function sendfile($server,$fd,$reactor_id)
    {
        $server->sendfile($fd,'./1.txt');
    }



    // 获取客户端信息
    public function getClientInfo($server,$fd,$extraDdata=0,$ignoreError=false)
    {
        $client = $server->getClientInfo($fd,$extraDdata,$ignoreError);
//        var_dump($client);
    }

    public function pause($fd)
    {
        $this->server->pause($fd);
    }

    public function resume($fd)
    {
        $this->server->resume($fd);

    }

    public function getClientList()
    {
        $list = $this->server->getClientList();
        var_dump($list);

    }

    public function master_pid()
    {
        echo $this->server->master_pid;
    }


}

new Server();