<?php
/**
 * Created by PhpStorm.
 * User: Тимурка
 * Date: 17.11.2017
 * Time: 21:45
 */
//Задание 1
//объявляем абстрактный класс
abstract class BaseGood{
    protected $name;        //название
    protected $cost;      //себестоимость
    protected $price;       //цена = себестоимость*наценку
    const markup=0.5;         //заложеная наценка 50%
    abstract protected function setPrice($vl=0);
    function __construct($name,$cost)
    {
        $this->name=$name;
        $this->cost=$cost;
    }
    public function getProfit($count)
    {
        $res=$count*($this->price-$this->cost);
        echo $res.'<br>';
    }
}

//штучный товар наследник абстрактного
class pGood extends BaseGood{
    public function __construct($name, $cost)
    {
        parent::__construct($name, $cost);
        $this->setPrice();
    }

    protected function setPrice($vl=0)
    {
        $this->price=$this->cost+$this->cost*self::markup;
    }
}

//цифровой товар наследник от штучного, с отличием, что себестоимость - 50% от себестоимости штучного
class dGood extends pGood{
    public function __construct(pGood $obj)
    {
        $this->cost=$obj->cost/2;
        $this->name=$obj->name;
        $this->markup=$obj->markup;
        parent::setPrice();
    }
}

//весовой товар наследник абстрактного
class wGood extends BaseGood{

    protected function setPrice($vl = 0)    //цена в зависимости от количества
    {
        if ($vl>100){
            $discount=0.3;
        }
        elseif ($vl>70){
            $discount=0.2;
        }
        elseif ($vl>40){
            $discount=0.1;
        }
        else{
            $discount=0;
        }
        $price=$this->cost+$this->cost*self::markup;
        $this->price=$price-$price*$discount;
    }

    public function getProfit($count)
    {
        $this->setPrice($count);
        parent::getProfit($count);
    }
}


$pGood=new pGood('test',10);
$pGood->getProfit(50);
$dGood=new dGood($pGood);
$dGood->getProfit(50);
$wGood=new wGood('test',10);
$wGood->getProfit(80);

//конец задания 1

//Задание 2
trait singleton{
    private static $single=false;   //инициализируем статическую переменную

    private function __construct()  //замыкаем конструктор на нужный нам метод класса
    {
        $this->__instance();
    }
    private function __clone()      //запрещаем клонирование
    {
    }
    private function __wakeup()  //запрещаем восстановление ресурсов объекта
    {
    }

    public static function getInstance(){
        if(self::$single===false){      //если не создавали класс
            self::$single=new self();   //то создаем
        }
        return self::$single;
    }
}

class mySingle{
    use singleton;
    private function __instance(){
        echo "Вызвали класс";
    }
}

mySingle::getInstance(); //пишет результат
mySingle::getInstance();//не пишет
mySingle::getInstance();//не пишет