<?php


trait Singleton
{
    private static $instance;
    static  $args = '';

    // 传参会有坑
    static function getInstance(...$args)
    {

        if(!isset(self::$instance) || self::$args != $args){
            self::$args = $args;
            self::$instance = new static(...$args);
        }
        return self::$instance;
    }

    public function get()
    {
        var_dump(self::$args);
    }
}

class Db
{
    use Singleton;

    function index()
    {
        echo 1;
    }
}
Db::getInstance(1)->get();
Db::getInstance(2)->get();