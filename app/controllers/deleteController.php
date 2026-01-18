<?php

class DeleteController extends Controller
{
    public function index($id = null)
    {
        $book = $this->getBook($id);
        if ($_SESSION['user'] ?? false) {
            if ($_SESSION['user']->getId() == $book->getUserId() ?? false) {
                $this->deleteUserBook($id);
                header('Location: /P4-TomTroc/public/account/');
                exit();
            }
            else {
                header('Location: /P4-TomTroc/public/books/');
                exit();
            }
        }
        else {
            header('Location: /P4-TomTroc/public/login');
            exit();
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