<?php
class Book {
  /**
   * Public variables
   */
  public $title;
  public $pages;
  public $author;

  /**
   * Construct the book
   * 
   * @param {String} $title The title of the book
   * @param {Int} $pages The total pages of the book
   * @param {String} $author The author of the book
   */
  public function __construct($title, $pages, $author) {
    $this->title = $title;
    $this->pages = $pages;
    $this->author = $author;
  }

  /**
   * Book
   * 
   * @return {String} Booktitle (Pages), Author
   */
  public function getBook() {
    return "$this->title ($this->pages), $this->author";
  }
}

$book = new Book('Moby dick', 1877, 'Herman Melville');

echo $book->getBook();