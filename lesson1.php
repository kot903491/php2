<?php
/**
 * Created by PhpStorm.
 * User: Тимурка
 * Date: 11.11.2017
 * Time: 2:59
 */

/*Задание 1-4*/
class Comics{           //создаем класс комиксов с общими свойствами
    protected $price;         //цена
    protected $autor;         //ценник
    protected $name;          //название
    public function __construct($name,$price,$autor){   //присваиваем значения
        $this->price=$price;
        $this->autor=$autor;
        $this->name=$name;
    }
    protected function info(){          //формируем информационную строку с основными данными
        return "Комикс \"".$this->name."\", автор ".$this->autor.", цена ".$this->price."<br>";
    }
}
class ComicsPubl extends Comics{        //создаем дочерний класс
    protected $publ;                          //со свойством Издательство (DC, Marvel, Bubble и тд)
    public function __construct($name,$price, $autor,$publ)    //присваиваем значения
    {
        parent::__construct($name,$price,$autor);
        $this->publ=$publ;
        $this->info();
    }
    public function info(){     //дополняем родительский метод info новыми данными и выводим их на экран
        echo parent::info()."Выпускается издательством ".$this->publ."<br>";
    }
}
new ComicsPubl('Зеленая стрела.Год первый',800,'Энди Дигг','DC');
///////////////////////////////////////////////////////
///
///
/*Задание 5 */
class A {                   //создаем класс
    public function foo() { //объявляем общий метод
        static $x = 0;      //задаем статичную переменную х со значением 0. Значение задаем только 1 раз
        echo ++$x . "<br>";          //ПЕРЕД выводом увеличиваем ее на 1
    }                       //в отличии от локальной переменной, статик сохраняет значение после завершения функции
}
$a1 = new A();              //создаем экземпляр класса а1
$a2 = new A();              //создаем экземпляр класса а2
$a1->foo();                 //выведет 0+1=1 СНАЧАЛА УВЕЛИЧЕНИЕ, ПОТОМ ВЫВОД
$a2->foo();                 //выведет 2
$a1->foo();                 //выведет 3
$a2->foo();                 //выведет 4


/*Задание 5 дополненое*/
class Ab {                      //создаем класс
    public function foo() {     //объявляем метод класса
        static $y = 0;          //задаем статичную переменную у со значением 0. Значение задаем только 1 раз
        echo ++$y . "<br>";              //ПЕРЕД выводом увеличиваем ее на 1
    }
}
class B extends Ab {            //создаем дочерний класс
}
$a1 = new Ab();                 //создаем экземпляр класса а1
$b1 = new B();                  //создаем экземпляр класса а1
$a1->foo();                     //вызывааем метод родительского класса, у=0, на экран выведет 1
$b1->foo();                     //вызываем метод дочернего класса, у=0, на экран выведет 1
$a1->foo();                     //вызывааем метод родительского класса, у=1, на экран выведет 2
$b1->foo();                     //вызывааем метод дочернего класса, у=1, на экран выведет 2
/*В отличии от задания 5, создаются методы разных классов с общим методом, поэтому у задается в каждом классе отдельно*/

/*Задание 6*/
class Aс {
    public function foo() {
        static $x = 0;
        echo ++$x . "<br>";
    }
}
class С extends Aс {
}
$a1 = new Aс;
$b1 = new С;
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();
/*То же самое, что и в задании 5+. Нами не задан конструктор класса,
поэтому класс можно создавать как со скобками, так и без*/
