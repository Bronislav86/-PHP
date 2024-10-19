<?php
namespace App\Oop;


class PaperBook extends Book{
  private int $pagesCount;
  private Counter $counterPB;

  public function __construct(string $name, string $isbn, array $authors, string $preview, int $issueYear, int $shelfId, int $pagesCount){
    parent::__construct();
    $this->pagesCount = $pagesCount;
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
