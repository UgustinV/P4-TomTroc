<?php

class DeleteController extends Controller
{
    public function index($id = null)
    {
        $book = $this->getBook($id);
        if (isset($_SESSION['user']) && $_SESSION['user']->getId() == $book->getUserId()) {
            $this->deleteUserBook($id);
            header('Location: ' . BASE_URL . 'account/');
        }
        else {
            header('Location: ' . BASE_URL . 'login');
        }
    }

    public function deleteUserBook($id)
    {
        $bookModel = new BookManager();
        return $bookModel->deleteBook($id);
    }

    public function getBook($id)
    {
        $bookModel = new BookManager();
        return $bookModel->getBookById($id);
    }
}