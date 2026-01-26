<?php

class UploadController extends Controller
{
    public function index()
    {
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->store();
        } else if (isset($_SESSION['user']) && $_SESSION['user']->getId()) {
            $this->view('upload', []);
        } else {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
    }

    public function store()
    {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $writer = trim($_POST['writer'] ?? '');
        $image = $_FILES['image'] ?? null;
        $is_available = $_POST['is_available'] ?? null;
        $user_id = $_SESSION['user']->getId() ?? null;

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

        if (empty($image)) {
            $errors[] = "L'image est requise";
        }

        if (empty($user_id)) {
            $errors[] = "Utilisateur non authentifié";
        }

        if (empty($is_available)) {
            $errors[] = "La disponibilité est requise";
        }

        if (empty($errors)) {
            $bookModel = new BookManager();
            if (empty($errors)) {
                if ($bookModel->create($title, $description, $writer, $image, $is_available, $user_id)) {
                    $book = $bookModel->getLastInserted();
                    header('Location: ' . BASE_URL . 'books/' . $book->getId());
                    exit;
                } else {
                    $errors[] = "Erreur lors de l'inscription. Veuillez réessayer.";
                }
            }
        }
        $this->view('upload', []);

    }
}