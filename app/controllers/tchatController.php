<?php

class TchatController extends Controller
{
    public function index($otherUserId = null)
    {
        $messageModel = new MessagesManager();
        $userModel = new UserManager();
        $tchatModel = new TchatRoomManager();
        $otherUser = $userModel->findById($otherUserId);
        if(!isset($_SESSION['user'])) {
            header('Location: /P4-TomTroc/public/login');
        }
        if ($otherUserId !== null) {
            if (!ctype_digit(strval($otherUserId))) {
                header('Location: /P4-TomTroc/public/error404');
            }
            $otherUserId = (int)$otherUserId;
            $userModel = new UserManager();
            $otherUser = $userModel->findById($otherUserId);
            if ($otherUser == null) {
                header('Location: /P4-TomTroc/public/error404');
            }
        }
        if ($otherUser == null) {
            $currentUserId = $_SESSION['user']->getId();
            $rooms = $tchatModel->getAllTchatRoomsForUser($currentUserId);
            $currentRoom = $tchatModel->getLatestMessageRoom($currentUserId);
            $otherUserId = $currentRoom ? (($currentRoom->getUser1() === $currentUserId) ? $currentRoom->getUser2() : $currentRoom->getUser1()) : null;
            $otherUser = $userModel->findById($otherUserId);
            $messageModel->markMessagesAsRead($currentRoom->getId(), $currentUserId);
            $messages = $currentRoom ? $messageModel->getMessagesByTchatRoomId($currentRoom->getId()) : [];
            $this->view('tchat', ['messages' => $messages, 'user' => $otherUser, 'rooms' => $rooms]);
        }
        else {
            $currentUserId = $_SESSION['user']->getId();
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $content = htmlspecialchars($_POST['message']);
                $tchatRoom = $tchatModel->getUserTchatRoom($currentUserId, $otherUserId);
                if($tchatRoom === null) {
                    $tchatModel->createTchatRoom($currentUserId, $otherUserId, null);
                    $tchatRoom = $tchatModel->getUserTchatRoom($currentUserId, $otherUserId);
                }
                $latestId = $messageModel->createMessage($content, $tchatRoom->getId(), $currentUserId);
                $tchatModel->updateLatestMessage($tchatRoom->getId(), $latestId);

                header("Location: /P4-TomTroc/public/tchat/{$otherUserId}");
            }
            else {
                $rooms = $tchatModel->getAllTchatRoomsForUser($currentUserId);
                $currentRoom = $tchatModel->getUserTchatRoom($currentUserId, $otherUserId);
                if($currentRoom) {
                    $messageModel->markMessagesAsRead($currentRoom->getId(), $currentUserId);
                    $messages = $messageModel->getMessagesByTchatRoomId($currentRoom->getId());
                } else {
                    $messages = [];
                }
                $otherUser = $userModel->findById($otherUserId);
    
                $this->view('tchat', ['messages' => $messages, 'user' => $otherUser, 'rooms' => $rooms]);
            }
        }
    }
}