<?php

/**
 * Created by PhpStorm.
 * User: Mikou.hu
 * Date: 2019/5/30
 */
abstract class CloneMe
{
    public $name;
    public $picture;

    abstract function __clone();
}


class Person extends CloneMe
{
    public function __construct()
    {
        $this->name = 'name';
        $this->picture = 'picture';

        // 克隆不会启动构造函数的动作
        echo 1;
    }

    public function display()
    {
        echo 'display';
    }

    public function __clone()
    {
        // TODO: Implement __Clone() method.
    }
}

//$worker = new Person();
//$worker->display();
//
////克隆Person 实例  属性方法一致
//$worker_copy = clone $worker;
//$worker_copy->display();


########################################

abstract class IPrototype
{
    public $eyeColor;
    public $winBeat;
    public $unitEyes;

    abstract function __clone();
}


class MaleProto extends IPrototype
{
    const  gender = 'MALE';

    public $mated;

    public function __construct()
    {
        $this->eyeColor = 'red';
        $this->winBeat = '00';
        $this->unitEyes = '00';

    }

    public function __clone()
    {
        // TODO: Implement __clone() method.
    }
}

class FemaleProto extends IPrototype
{
    const  gender = 'FEMALE';

    public $fecundity;

    public function __construct()
    {
        $this->eyeColor = 'red';
        $this->winBeat = '00';
        $this->unitEyes = '00';

    }

    public function __clone()
    {
        // TODO: Implement __clone() method.
    }
}


class Client
{
    //用于直接实例化
    private $fly1;
    private $fly2;

    // 用于克隆
    private $c1fly;
    private $c2fly;
    private $updatedCloneFly;

    public function __construct()
    {
        // 实例化
        $this->fly1 = new MaleProto();
        $this->fly2 = new FemaleProto();

        //克隆
        $this->c1fly = clone $this->fly1;
        $this->c2fly = clone $this->fly2;
        $this->updatedCloneFly = clone $this->fly2;


        // 更新克隆
        $this->fly1->mated = true;
        $this->fly2->fecundity = 188;

        $this->updatedCloneFly->eyeColor = 'purple';
        $this->updatedCloneFly->fecundity = '11111';
        $this->updatedCloneFly->unitEyes = '222222';
        $this->updatedCloneFly->fecundity ='333333';


        $this->showFly($this->fly1);
        $this->showFly($this->fly2);
        $this->showFly($this->updatedCloneFly);


    }

    public function showFly(IPrototype $fly)
    {
        echo $fly->eyeColor.PHP_EOL;
        echo $fly->winBeat.PHP_EOL;
        echo $fly->unitEyes.PHP_EOL;

    }


}

$work = new Client();
