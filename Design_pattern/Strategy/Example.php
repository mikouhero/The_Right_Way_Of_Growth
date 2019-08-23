
<?php
/**
 * Created by PhpStorm.
 * Date: 2019/8/12
 */

class Client
{
    public function insertData()
    {
        $content = new Context(new DataEntry());
        $content->algorithm();
    }

    public function findData()
    {
        $content = new Context(new SearchData());
        $content->algorithm();
    }

    public function showAll()
    {
        $content = new Context(new SearchData());
        $content->algorithm();
    }


    public function changeData()
    {
        $content = new Context(new SearchData());
        $content->algorithm();
    }
    public function killer()
    {
        $content = new Context(new SearchData());
        $content->algorithm();
    }

}


class Context
{
    private $strategy;

    /**
     * @return mixed
     */
   public function __construct(IStrategy $strategy)
   {
       $this->strategy = $strategy;
   }

   public function algorithm()
   {
       $this->strategy->algorithm();
   }
}

interface IStrategy
{
    public function algortithm();

}

class DataEntry implements IStrategy
{
    public function algortithm()
    {
        $hookup = UniversalConnect::doConnect();
        $test  = $hookup->real_escape_string($_POST['data']);
        echo "THiS data has benn entered {$test} ".PHP_EOL;
    }
}

interface IConnectInfo
{
    const HOST = '127.0.0.1';
    const UNAME = 'root';
    const PWD = 'root';
    const DBNAME = 'test';

    public function doConnect();

}

class UniversalConnect implements  IConnectInfo
{
    private static $server = IConnectInfo::HOST;
    private static $currentDB = IConnectInfo::DBNAME;
    private static $user = IConnectInfo::UNAME;
    private static $pass = IConnectInfo::PWD;
    private static $hookup;

    public function doConnect()
    {
        self::$hookup = mysqli_connect(self::$server,self::$user,self::$pass,self::$currentDB);

        if(self::$hookup){
            echo "Successful connection to MySQL".PHP_EOL;
        }elseif(mysqli_connect_errno(self::$hookup)){
            echo "Failed to MySQL".PHP_EOL;
        }

        return self::$hookup;
    }

}

class SecureData
{

}