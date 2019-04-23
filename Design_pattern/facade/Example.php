<?php
/**
 * Created by PhpStorm.
 * User: Mikou.hu
 * Date: 2019/4/23
 */
class Ali{
    public function buy()
    {
        echo "buy ali";
    }

    public function sell()
    {
        echo 'sell ali';
    }
}
class Jd{
    public function buy()
    {
        echo "buy Jd";
    }

    public function sell()
    {
        echo 'sell Jd';
    }
}
class Tentent{
    public function buy()
    {
        echo "buy Tentent";
    }

    public function sell()
    {
        echo 'sell Tentent';
    }
}

class FacadeCompany{
    private $ali;
    private $jd;
    private $tentent;

    public function __construct()
    {
        $this->ali = new Ali();
        $this->jd = new Jd();
        $this->tentent = new Tentent();
    }

    public function buy()
    {
        $this->ali->buy();
        $this->jd->buy();
    }

    public function sell()
    {
        $this->tentent->sell();
    }
}


$lurenA=new FacadeCompany();
$lurenA->buy();
$lurenA->sell();


