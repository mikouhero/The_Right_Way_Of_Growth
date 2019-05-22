<?php

/**
 * Created by PhpStorm.
 * User: Mikou.hu
 * Date: 2019/5/22
 */
class web
{
    protected $web;
    public  function  __construct()
    {
        $this->web =  new Swoole\http\server('0.0.0.0',9503);
        $this->web->on('Request',[$this,'onRequest']);

        $this->web->start();
    }
    function onRequest($request,$response)
    {
        var_dump($request->get, $request->post);
        $response->header("Content-Type", "text/html; charset=utf-8");
        $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");

    }

}

$web  = new web();