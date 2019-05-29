<?php

abstract class  Creator
{
    //
    protected abstract function factoryMethod();

    //返回一个对象
    public function startFactory()
    {
        $msg = $this->factoryMethod();
        return $msg;
    }

}

#################两个具体工厂类扩展 Creator ####################

/**
 * 以下两个工厂实现是类似的 只是创建的实例不同
 */
class TextFactory extends Creator
{

    protected function factoryMethod()
    {
        return (new TextProduct())->getProperties();
    }

}


class GraphicFactory extends Creator
{
    protected function factoryMethod()
    {
        return (new GraphicProduct())->getProperties();
    }
}


interface Product
{
    public function getProperties();
}

class TextProduct implements Product
{
    private $mfgProduct;

    public function getProperties()
    {
        return $this->mfgProduct;
    }
}

class GraphicProduct implements Product
{
    private $mfgProduct;

    public function getProperties()
    {
        return $this->mfgProduct;
    }
}


/**

 * client 对象并没有向产品直接作出请求，而是通过工厂类请求

 */
class Client
{
    private $someGraphiObject;
    private $someTextObject;
    public function  __construct()
    {
        $this->someGraphiObject = new GraphicFactory();
        echo $this->someGraphiObject->startFactory().PHP_EOL;

        $this->someTextObject = new TextFactory();
        echo $this->someTextObject->startFactory().PHP_EOL;

    }
}