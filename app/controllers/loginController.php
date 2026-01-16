<?php

class LoginController extends Controller
{
    public function index()
    {
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->login();
        } else {
            $this->view('login', []);
        }
    }

    public function login()
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $errors = [];

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Une adresse email valide est requise";
        }

        if (empty($password)) {
            $errors[] = "Le mot de passe est requis";
        }

        if (empty($errors)) {
            $userModel = new UserManager();
            $user = $userModel->findByEmail($email);
            if ($user && password_verify($password, $user->getPassword())) {
                $_SESSION['user'] = $user;
                header('Location: /P4-TomTroc/public/books');
                exit;
            } else {
                $errors[] = "Email ou mot de passe incorrect";
            }
        }

        $this->view('login', [
            'errors' => $errors,
            'email' => $email
        ]);
    }
}