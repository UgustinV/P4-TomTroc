<?php

class UserProfileController extends Controller
{
    public function index($id = null)
    {
        if(!isset($id)){
            header('Location: /P4-TomTroc/public/error404');
            exit();
        }
        $user = $this->getUserData($id);
        if(isset($user)){
            $books = $this->getUserBooks($id);
            $this->view('userProfile', ['user' => $user, 'books' => $books]);
        }
        else {
            header('Location: /P4-TomTroc/public/error404');
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