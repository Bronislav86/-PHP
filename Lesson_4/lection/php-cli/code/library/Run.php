<?php
namespace App\Oop;

use library\Book, code\digitalGood, library\Room, library\Shelf;

// $book1 = new PaperBook("Книга", "1345678", ["Толстой", "Перов"], "Хорошая книга",1997, 555, 998);

// echo $book1->getBookCounter() . PHP_EOL;
// echo $book1->getBook('Книга') . PHP_EOL;
// echo $book1->getBookCounter() . PHP_EOL;

// class A {
//   public function foo() {
//   static $x = 0;
//   echo ++$x;
//   }
//   }
//   $a1 = new A();
//   $a2 = new A();
//   $a1->foo();
//   $a2->foo();
//   $a1->foo();
//   $a2->foo(); // после каждого вывзова функции переменная $x увеличивается, т.к. она одна для всех экземпляров класса А

  class A {
    public function foo() {
    static $x = 0;
    echo ++$x;
    }
    }
    class B extends A {
    }
    $a1 = new A();
    $b1 = new B();
    $a1->foo();
    $b1->foo();
    $a1->foo();
    $b1->foo();
    //т.к. В является наследником класса А то здесь опять $x общий для всех предстввителей обоих классов.