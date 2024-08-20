<?php

namespace HW04\firstTask;

class Book {

    protected string $name;
    protected string $author;
    protected int $pages;

    public function __construct(string $name, int $pages, string $author) {
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
}

class Ebook extends Book{
    protected string $key;

    function __construct(string $name, int $pages, string $author) {
        parent::__construct($name, $pages, $author);
        $this->key = Date("d-m-Y");
    }
}

$bookOne = new Ebook("lol",69,"pussy");

print_r($bookOne);