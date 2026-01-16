<?php

class HomeController extends Controller
{
    public function index()
    {
        $latestBooks = $this->getLatestBooks();
        $this->view('home', ['books' => $latestBooks]);
    }

    public function getLatestBooks()
    {
        $bookModel = new BookManager();
        return $bookModel->getLatestBooks();
    }
}