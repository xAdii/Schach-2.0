<?php
class UserController
{
    private $userModel;

    public function __construct($userModel)
    {
        $this->userModel = $userModel;
    }

    public function handleRequest()
    {

        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        // Validate action
        if (!isset($_POST['action']) || empty($_POST['action'])) {
            return;
        }

        $userActions = ['signup', 'login'];
        if (in_array($_POST['action'], $userActions)) {
            $this->handleUserAction($_POST['action']);
        }
    }

    private function handleUserAction($action)
    {
        // Validate username and password
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            return;
        }

        // Handle user actions
        switch ($action) {
            case 'signup':
                $this->userModel->createUser($username, $password);
                break;
            case 'login':
                break;
        }
    }
}
