<?php

class Books extends Controller
{
    public function index()
    {
        $books = $this->getAllBooks();
        $this->view('books', ['books' => $books]);
    }

    public function getAllBooks()
    {
        $bookModel = new BookManager();
        return $bookModel->getAllBooksWithOwners();
    }
}