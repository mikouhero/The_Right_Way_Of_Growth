<?php

//计算美元
class DollarCalc
{
    private $dollar;
    private $product;
    private $service;
    public $rate = 1;

    public function requestCalc($productNow, $serviceNow)
    {
        $this->product = $productNow;
        $this->service = $serviceNow;
        $this->dollar = $this->product + $this->service;

        return $this->requestTotal();
    }

    public function requestTotal()
    {
        $this->dollar *= $this->rate;
        return $this->dollar;
    }

}


// 计算欧元
class EuroCalc
{
    private $euro;
    private $product;
    private $service;
    public $rate = 1;

    public function requestCalc($productNow, $serviceNow)
    {
        $this->product = $productNow;
        $this->service = $serviceNow;
        $this->euro = $this->product + $this->service;

        return $this->requestTotal();
    }

    public function requestTotal()
    {
        $this->euro *= $this->rate;
        return $this->euro;
    }
}


// 创建接口
interface ITarget
{
    function requester();
}


// 计算适配器 继承 欧元计算类
class EuroAdaper extends EuroCalc implements ITarget
{
    public function __construct()
    {
        $this->requester();
    }
    public function requester()
    {
        $this->rate = .81111;
        return $this->rate;
    }
}

class Client
{
    private $requestNow;
    private $dollarRequest;

    public function __construct()
    {
        $this->requestNow = new EuroAdaper();
        $this->dollarRequest = new DollarCalc();
        $euro = '&#8364';
        echo "Euro :$euro " .$this->makeAdapterRequest($this->requestNow) . PHP_EOL;
        echo "Dollars : $ ".$this->makeDollarRequest($this->dollarRequest);
    }

    // 
    private function makeAdapterRequest(ITarget $req)
    {
        return $req->requestCalc(40,50);
    }

    private function makeDollarRequest(DollarCalc $req)
    {
        return $req->requestCalc(40,50);
    }

}

$worker = new Client();