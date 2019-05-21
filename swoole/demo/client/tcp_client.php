<?php
// 连接 swoole tcp 服务
//$client = new swoole_client(SWOOLE_SOCK_TCP);
//
//if(!$client->connect("127.0.0.1", 9501)) {
//    echo "连接失败";
//    exit;
//}
//
///// php cli常量
//fwrite(STDOUT, "请输入消息:");
//$msg = trim(fgets(STDIN));
//
//// 发送消息给 tcp server服务器
//$client->send($msg);
//
//// 接受来自server 的数据
//$result = $client->recv();
//echo $result;


$client = new Swoole\Client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);
$client->on("connect", function (swoole_client $cli) {
    $cli->send('我发起请求连接') . PHP_EOL;
});
$client->on("receive", function (swoole_client $cli, $data) {
    echo "服务端返回的消息: $data" . PHP_EOL;
    fwrite(STDOUT, "请输入消息:");
    $msg = trim(fgets(STDIN));
    $cli->send($msg);
    sleep(1);
});
$client->on("error", function (swoole_client $cli) {
    echo "error\n";
});
$client->on("close", function (swoole_client $cli) {
    echo "Connection close\n";
});
$client->connect('127.0.0.1', 9501);

