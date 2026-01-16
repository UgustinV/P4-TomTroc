<?php

class UploadController extends Controller
{
    public function index()
    {
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->store();
        } else if ($_SESSION['user']->getId() ?? false) {
            $this->view('upload', []);
        } else {
            header('Location: /P4-TomTroc/public/login');
            exit;
        }
    }

    public function store()
    {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $writer = trim($_POST['writer'] ?? '');
        $image = $_FILES['image'] ?? null;
        $is_available = $_POST['is_available'];
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

        if (empty($errors)) {
            $bookModel = new BookManager();
            if (empty($errors)) {
                if ($bookModel->create($title, $description, $writer, $image, $is_available, $user_id)) {
                    $book = $bookModel->getLastInserted();
                    header('Location: /P4-TomTroc/public/books/' . $book->getId());
                    exit;
                } else {
                    $errors[] = "Erreur lors de l'inscription. Veuillez réessayer.";
                }
            }
        }
        $this->view('upload', []);

    }
}