<?php

class Books extends Controller
{
    public function index()
    {
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        
        if (!empty($search)) {
            $books = $this->searchBooks($search);
        } else {
            $books = $this->getAllBooks();
        }
        
        $this->view('books', ['books' => $books]);
    }

    public function getAllBooks()
    {
        $bookModel = new BookManager();
        return $bookModel->getAllBooksWithOwners();
    }

    public function searchBooks($searchTerm)
    {
        $bookModel = new BookManager();
        return $bookModel->searchBooks($searchTerm);
    }
}