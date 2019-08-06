<?php

// 为具体组件和Decorator 参与者抽象者抽象类创建了接口
abstract class IComponent
{
    protected  $site ;

    abstract public function getSite();
    abstract public function getPrice();

}

// 装饰器参与者
abstract class Decorator extends IComponent
{
    // 这任然是一个抽象类
    // 维护IComponet的引用
//    public function getSite()
//    {
//        // TODO: Implement getSite() method.
//    }
//
//    public function getPrice()
//    {
//        // TODO: Implement getPrice() method.
//    }

}


// 具体组件

class BasicSite extends IComponent
{
    public function __construct()
    {
        $this->site  = 'Basic Site';
    }

    public function getPrice()
    {

        return 1200;
    }

    public function getSite()
    {
        return $this->site;

    }
}

// 具体装饰器

class Maintenance extends  Decorator
{
    public function __construct(IComponent $siteNow)
    {
        $this->site = $siteNow;
    }

    public function getSite()
    {
        $fmt = "\t Maintenance";
        return $this->site->getSite().$fmt;
    }

    public function getPrice()
    {
        return 900 + $this->site->getPrice();
    }
}


class Video extends  IComponent
{
    public function __construct(IComponent $siteNow)
    {
        $this->site  = $siteNow;
    }

    public function getPrice()
    {
        return 450 + $this->site->getPrice();

    }

    public function getSite()
    {
        $fmt = "\t video";
        return $this->site->getSite().$fmt;
    }

}

class Client
{
    private $basicSite;

    public function __construct()
    {
        $this->basicSite = new BasicSite();
        $this->basicSite = $this->wrapComponent($this->basicSite);

        $siteShow = $this->basicSite->getSite();
        $price = $this->basicSite->getPrice();
        echo $siteShow ."\t".$price;
    }

    public function wrapComponent(IComponent $component)
    {
        $component = new Maintenance($component);
        $component = new Video($component);

        return $component;

    }

}

$worker = new Client();


