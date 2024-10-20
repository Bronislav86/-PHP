<?php
namespace App\dz;

class PaperBook extends Book{
  private static Counter $counterPB;

  public function __construct($name, $author, $issueYear, $address){
    parent::__construct($name, $author, $issueYear, $address);

    self::$counterPB = new Counter();
  }

  public function getBookIssues(): int {
    return PaperBook::$counterPB->getCounter();
  }

  public function getBook(string $name = "", string $author = "") : string{
    if ($name == $this->getName()) {
      PaperBook::$counterPB->counterIncrement();
      return $this->__toString() . " может быть получена по адресу: " . $this->getAddress();
    }
    if ($author == $this->getAuthor()) {
      PaperBook::$counterPB->counterIncrement();
      return $this->__toString() . " может быть получена по адресу: " . $this->getAddress();
    }
    return "Подходящей книги нет";
  }

}