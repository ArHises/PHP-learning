<?php

namespace HW04\secondTask;

abstract class Book {

    protected string $name;
    protected string $author;
    protected int $pages;

    public function __construct(string $name, string $author, int $pages) {
        $this->name = $name;
        $this->pages = $pages;
        $this->author = $author;
    }
    public function getName(): string {
        return $this->name;
    }
    public function getPages(): int {
        return $this->pages;
    }
    public function getAuthor(): string {
        return $this->author;
    }

    abstract public function borrow(): string;
    abstract public function statistic(): int;
}

class PaperBook extends Book {

    protected string $adress;
    private static int $borrowed = 0;

    function __construct(string $name, string $author, int $pages, string $adress) {
        parent::__construct($name, $author, $pages);
        $this->adress = $adress;
    }

    public function borrow(): string {
        self::$borrowed++;
        return $this->adress;
    }

    public function statistic(): int{
        return self::$borrowed;
    }
}

class EBook extends Book{

    protected string $downloadLink;
    private static int $borrowed = 0;

    function __construct(string $name, string $author, int $pages) {
        parent::__construct($name, $author, $pages);
        $this->downloadLink = "www.$name-By-$author.com";
    }

    public function borrow(): string {
        self::$borrowed++;
        return $this->downloadLink;
    }

    public function statistic(): int{
        return self::$borrowed;
    }
}

$bookOne = new Ebook("Eren","Jeger",999);
$bookTwo = new PaperBook("Police Man","ACDC",99,"Bruklin 99");

$bookOne->borrow();
$bookOne->borrow();
$bookOne->borrow();

$bookTwo->borrow();
$bookTwo->borrow();
$bookTwo->borrow();
$bookTwo->borrow();

print_r($bookOne->statistic() . PHP_EOL);
print_r($bookTwo->statistic() . PHP_EOL);
