<?php

class BookController extends Controller
{
    public function index($id = null)
    {
        if ($id) {
            $book = $this->getBook($id);
            if ($_SESSION['user'] ?? false) {
                if ($_SESSION['user']->getId() == $book->getUserId() ?? false) {
                    header('Location: /P4-TomTroc/public/editBook/' . $book->getId());
                }
            }
            else if ($book) {
                $ownerModel = new UserManager();
                $owner = $ownerModel->findById($book->getUserId());
                $this->view('book', ['book' => $book, 'owner' => $owner]);
                return;
            }
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