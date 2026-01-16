<?php

class BookController extends Controller
{
    public function index($id = null)
    {
        if ($id) {
            $book = $this->getBook($id);
            $this->view('book', ['book' => $book]);
        } else {
            $this->view('book', ['book' => null]);
        }
    }

    public function getBook($id)
    {
        $bookModel = new BookManager();
        return $bookModel->getBookById($id);
    }
}