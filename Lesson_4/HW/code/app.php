<?php
namespace App\dz;


require_once 'vendor/autoload.php';

$book1 = new PaperBook("Книга 1", "Автор 1", 2024, "Ближайшая публичная библиотека");

$ebook = new DigitalBook("Книга 2", "Автор", 2024, "Ближайшая публичная библиотека", "www.dom-knigi.ru");

echo $ebook->getName() . PHP_EOL;
echo $book1->__toString() . PHP_EOL;

echo $ebook->getBook("Книга 2") . PHP_EOL;
echo $ebook->getBookIssues() . PHP_EOL;
echo $book1->getBookIssues() . PHP_EOL;
echo $book1->getBook("Книга 1") . PHP_EOL;
echo $ebook->getBookIssues() . PHP_EOL;
echo $book1->getBookIssues() . PHP_EOL;

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

  // class A {
  //   public function foo() {
  //   static $x = 0;
  //   echo ++$x;
  //   }
  //   }
  //   class B extends A {
  //   }
  //   $a1 = new A();
  //   $b1 = new B();
  //   $a1->foo();
  //   $b1->foo();
  //   $a1->foo();
  //   $b1->foo();
    //т.к. В является наследником класса А то здесь опять $x общий для всех предстввителей обоих классов.