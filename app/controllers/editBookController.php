<?php

class EditBookController extends Controller
{
    public function index($id = null)
    {
        if ($id) {
            $bookModel = new BookManager();
            $book = $bookModel->getBookById($id);
            if (!$book || !isset($_SESSION['user']) || $book->getUserId() !== ($_SESSION['user']->getId())) {
                header('Location: ' . BASE_URL . 'error404');
                exit;
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
               $this->store($book);
           } else if (isset($_SESSION['user']) && $_SESSION['user']->getId()) {
               $this->view('editBook', ['book' => $book]);
           }
        } else {
            header('Location: ' . BASE_URL . 'home');
            exit;
        }
    }

    public function store($book)
    {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $writer = trim($_POST['writer'] ?? '');
        $image = $_FILES['image'] ?? null;
        $is_available = $_POST['is_available'] ?? null;

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

        if (empty($is_available)) {
            $errors[] = "La disponibilité est requise";
        }

        if (empty($errors)) {
            $bookModel = new BookManager();
            if (empty($errors)) {
                if ($bookModel->update($title, $description, $writer, $image, $is_available, $book)) {
                    header('Location: ' . BASE_URL . 'book/' . $book->getId());
                    exit;
                } else {
                    $errors[] = "Erreur lors de l'inscription. Veuillez réessayer.";
                }
            }
        }
        $this->view('editBook', ['errors' => $errors, 'book' => $book]);

    }
}