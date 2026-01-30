<?php

class Controller
{
    public function __construct()
    {
        session_start();
    }

    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    public function view($viewName, $data = [])
    {
        if (isset($_SESSION['user'])) {
            $messageManager = new MessagesManager();
            $data['unreadMessagesCount'] = $messageManager->countAllUnreadMessagesForUser($_SESSION['user']->getId());
        } else {
            $data['unreadMessagesCount'] = 0;
        }
        $content = $this->render($viewName, $data);
        $title = 'TomTroc - ' . ucfirst($viewName);
        ob_start();
        require('../app/views/templates/main.php');
        $template = ob_get_clean();
        echo $template;
    }

    public function render($viewName, $data = []) : string
    {
        if(file_exists('../app/views/templates/' . $viewName . '.php')){
            extract($data);
            ob_start();
            require_once '../app/views/templates/' . $viewName . '.php';
            return ob_get_clean();
        } else {
            // TODO : PAGE 404
            throw new Exception("La vue '$viewName' est introuvable.");
        }
    }
}