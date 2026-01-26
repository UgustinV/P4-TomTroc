<?php

class AccountController extends Controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']->getId();
            $nickname = $_POST['nickname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $image = $_FILES['image'] ?? null;

            $userManager = new UserManager();
            $userManager->update($nickname, $email, $password, $image, $_SESSION['user']);

            // Refresh session user data
            $_SESSION['user'] = $this->getUserData($userId);

            header('Location: ' . BASE_URL . 'account');
            exit();
        }
        else if (isset($_SESSION['user']) && $_SESSION['user']->getId()) {
            $userId = $_SESSION['user']->getId();
            $user = $this->getUserData($userId);
            $books = $this->getUserBooks($userId);
            $this->view('account', ['user' => $user, 'books' => $books]);
        }
        else {
            header('Location: ' . BASE_URL . 'login');
            exit();
        }
    }

    public function getUserData($userId)
    {
        $userManager = new UserManager();
        return $userManager->findById($userId);
    }

    public function getUserBooks($userId)
    {
        $bookManager = new BookManager();
        return $bookManager->getUserBooks($userId);
    }
}