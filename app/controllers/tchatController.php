<?php

class TchatController extends Controller
{
    public function index($otherUserId = null)
    {
        $currentUserId = $_SESSION['user']->getId() ?? null;
        $messageModel = new MessagesManager();
        $userModel = new UserManager();
        if($currentUserId === null) {
            header('Location: /P4-TomTroc/public/login');
            exit();
        }
        else if (!$otherUserId) {
            $tchatModel = new TchatRoomManager();
            $rooms = $tchatModel->getAllTchatRoomsForUser($currentUserId);
            $otherUsers = [];
            $currentRoom = $tchatModel->getLatestMessageRoom($currentUserId);
            $otherUserId = $currentRoom ? (($currentRoom->getUser1() === $currentUserId) ? $currentRoom->getUser2() : $currentRoom->getUser1()) : null;
            $otherUser = $userModel->findById($otherUserId);
            $messageModel->markMessagesAsRead($currentRoom->getId(), $currentUserId);
            $messages = $currentRoom ? $messageModel->getMessagesByTchatRoomId($currentRoom->getId()) : [];
            foreach($rooms as $room) {
                $otherUsers[] = ($room->getUser1() === $currentUserId) ? $room->getUser2() : $room->getUser1();
            }
            $this->view('tchat', ['messages' => $messages, 'user' => $otherUser, 'otherUsers' => $otherUsers, 'rooms' => $rooms]);
        }
        else {
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $content = htmlspecialchars($_POST['message']);
                $tchatModel = new TchatRoomManager();
                $tchatRoom = $tchatModel->getUserTchatRoom($currentUserId, $otherUserId);
                $messageModel = new MessagesManager();
                if($tchatRoom === null) {
                    $tchatModel->createTchatRoom($currentUserId, $otherUserId, null);
                    $tchatRoom = $tchatModel->getUserTchatRoom($currentUserId, $otherUserId);
                }
                $latestId = $messageModel->createMessage($content, $tchatRoom->getId(), $currentUserId);
                $tchatModel->updateLatestMessage($tchatRoom->getId(), $latestId);

                header("Location: /P4-TomTroc/public/tchat/{$otherUserId}");
                exit();
            }
            else {
                $tchatModel = new TchatRoomManager();
                $rooms = $tchatModel->getAllTchatRoomsForUser($currentUserId);
                $currentRoom = $tchatModel->getUserTchatRoom($currentUserId, $otherUserId);
                $otherUsers = [];
                foreach($rooms as $room) {
                    $otherUsers[] = ($room->getUser1() === $currentUserId) ? $room->getUser2() : $room->getUser1();
                }
                if($currentRoom) {
                    $messageModel->markMessagesAsRead($currentRoom->getId(), $currentUserId);
                    $messages = $messageModel->getMessagesByTchatRoomId($currentRoom->getId());
                } else {
                    $messages = [];
                }
                $otherUser = $userModel->findById($otherUserId);
    
                $this->view('tchat', ['messages' => $messages, 'user' => $otherUser, 'otherUsers' => $otherUsers, 'rooms' => $rooms]);
            }
        }
    }
}