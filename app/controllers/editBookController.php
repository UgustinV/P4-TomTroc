<?php

class EditBookController extends Controller
{
    public function index($id = null)
    {
        if ($id) {
            $bookModel = new BookManager();
            $book = $bookModel->getBookById($id);
            if (!$book || $book->getUserId() !== ($_SESSION['user']->getId() ?? null)) {
                header('Location: /P4-TomTroc/public/home');
                exit;
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
               $this->store($book);
           } else if ($_SESSION['user']->getId() ?? false) {
               $this->view('editBook', ['book' => $book]);
           }
        } else {
            header('Location: /P4-TomTroc/public/home');
            exit;
        }
    }

    public function store($book)
    {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $writer = trim($_POST['writer'] ?? '');
        $image = $_FILES['image'] ?? null;
        $is_available = $_POST['is_available'];

        $errors = [];

        if (empty($title)) {
            $errors[] = "Le titre est requis";
        }

        if (empty($description)) {
            $errors[] = "La description est requise";
        }

        if (empty($writer)) {
            $errors[] = "L'auteur est requis";
        }

        if (empty($errors)) {
            $bookModel = new BookManager();
            if (empty($errors)) {
                if ($bookModel->update($title, $description, $writer, $image, $is_available, $book)) {
                    header('Location: /P4-TomTroc/public/book/' . $book->getId());
                    exit;
                } else {
                    $errors[] = "Erreur lors de l'inscription. Veuillez réessayer.";
                }
            }
        }
        $this->view('editBook', ['errors' => $errors, 'book' => $book]);

    }
}