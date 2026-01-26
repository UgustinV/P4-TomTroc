<?php

class BookController extends Controller
{
    public function index($id = null)
    {
        if ($id) {
            $book = $this->getBook($id);
            if($book) {
                if (isset($_SESSION['user']) && $_SESSION['user']->getId() == $book->getUserId()) {
                    header('Location: /P4-TomTroc/public/editBook/' . $book->getId());
                }
                else {
                    $ownerModel = new UserManager();
                    $owner = $ownerModel->findById($book->getUserId());
                    $this->view('book', ['book' => $book, 'owner' => $owner]);
                    return;
                }
            } else {
                header('Location: /P4-TomTroc/public/error404');
            }
        } else {
            header('Location: /P4-TomTroc/public/error404');
        }
    }

    public function getBook($id)
    {
        $bookModel = new BookManager();
        return $bookModel->getBookById($id);
    }
}