<?php
namespace App\Oop;

require_once(__DIR__."/Book.php");

class PaperBook extends Book{
  private Counter $counterPB;

  public function __construct(string $name, string $isbn, array $authors, string $preview, int $issueYear, int $shelfId){
    parent::__construct();
    $this->counterPB = new Counter();
  }

  public function getBookCounter(): int {
    return $this->counterPB->getCounter();
  }

  public function getBook(string $name = "", string $author = "") : string{
    if ($name === PaperBook::getName()) {
      $this->counterPB->counterIncrement();
      return PaperBook::getShelfId();
    }
    if (in_array($author, PaperBook::getAuthors())) {
      return PaperBook::getShelfId();
    }
    return "Подходящей книги нет";
  }

} 

$a = new PaperBook("Капитан", "123", ["Коля"], "Описание", 1990, 001);

echo $a->getName();