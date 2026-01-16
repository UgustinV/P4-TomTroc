<?php

class RegisterController extends Controller
{
    public function index()
    {
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->store();
        } else {
            $this->view('register', []);
        }
    }

    public function store()
    {
        $nickname = trim($_POST['nickname'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $errors = [];

        if (empty($nickname)) {
            $errors[] = "Le nickname est requis";
        }

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Une adresse email valide est requise";
        }

        if (empty($password) || strlen($password) < 6) {
            $errors[] = "Le mot de passe doit contenir au moins 6 caractères";
        }

        if (empty($errors)) {
            $userModel = new UserManager();

            if ($userModel->emailExists($email)) {
                $errors[] = "Cette adresse email est déjà utilisée";
            }
            
            if ($userModel->nicknameExists($nickname)) {
                $errors[] = "Ce nickname est déjà utilisé";
            }
            if (empty($errors)) {
                if ($userModel->create($nickname, $email, $password)) {
                    header('Location: /P4-TomTroc/public/login');
                    exit;
                } else {
                    $errors[] = "Erreur lors de l'inscription. Veuillez réessayer.";
                }
            }
        }
        $this->view('register', [
            'errors' => $errors,
            'nickname' => $nickname,
            'email' => $email
        ]);

    }
}