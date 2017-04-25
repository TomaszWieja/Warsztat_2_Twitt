<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Book {
    private $title;
    private $catalogNumber;
    
    public function _construct() {
        $this->title = "nd";
        $this->catalogNumber = 1;
        echo "Tworzę nową książkę<br>";
    }
    
    public function printInfo() {
        echo 'Tytuł: ' . $this->title;
    }
    
    public function setCatalogNumber($number) {
        $this->catalogNumber = $number;
    }
    public function setTitle($title) {
        $this->title = $title;
    }
    public function setAuthor($author) {
        $this->author = $author;
    }
}

$jakasKsiazka = new Book();
$jakasKsiazka->setTitle("Tytuł testowy");
$jakasKsiazka->setCatalogNumber(100);
$jakasKsiazka->setAuthor("John Doe");

var_dump($jakasKsiazka);
