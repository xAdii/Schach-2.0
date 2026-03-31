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

        switch ($_POST['action']) {
            case 'userSignup':
                $this->handleUserSignup();
                break;
            case 'userLogin':
                $this->handleUserLogin();
                break;
            case 'userUpdateName':
                $this->handleUserUpdateName();
                break;
            case 'userUpdatePassword':
                $this->handleUserUpdatePassword();
                break;
            case 'userLogout':
                $this->handleUserLogout();
                break;
            case 'userDelete':
                $this->handleUserDelete();
                break;
        }
    }

    private function handleUserSignup()
    {
        // Validate input
        if (!isset($_POST['username']) || !isset($_POST['password'])) {
            echo "<script>alert('Bitte fülle alle Felder aus.');</script>";
            $_POST['nav'] = 'signup';
        }

        if (empty($_POST['username']) || empty($_POST['password'])) {
            echo "<script>alert('Bitte fülle alle Felder aus.');</script>";
            $_POST['nav'] = 'signup';
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Check if user already exists
        if ($this->userModel->fetchUser($username)) {
            echo "<script>alert('Benutzername ist bereits vergeben.');</script>";
            $_POST['nav'] = 'signup';
        } else {

            // Encrypt password
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // Create user
            $this->userModel->createUser($username, $password_hash);
        }
    }

    private function handleUserLogin()
    {
        // Validate input
        if (!isset($_POST['username']) || !isset($_POST['password'])) {
            echo "<script>alert('Bitte fülle alle Felder aus.');</script>";
            $_POST['nav'] = 'login';
        }

        if (empty($_POST['username']) || empty($_POST['password'])) {
            echo "<script>alert('Bitte fülle alle Felder aus.');</script>";
            $_POST['nav'] = 'login';
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Get user from database
        $user = $this->userModel->fetchUser($username);

        // Check if user exists
        if (!$user) {
            echo "<script>alert('Benutzer nicht gefunden.');</script>";
            $_POST['nav'] = 'login';
            return;
        }

        // Check if password is correct
        if (!password_verify($password, $user['password'])) {
            echo "<script>alert('Passwort inkorrekt.');</script>";
            $_POST['nav'] = 'login';
            return;
        }

        // Set session
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name']
        ];
    }

    private function handleUserLogout()
    {
        unset($_SESSION['user']);
    }

    private function handleUserDelete()
    {
        $this->userModel->deleteUser($_SESSION['user']['id']);
        unset($_SESSION['user']);
    }

    private function handleUserUpdateName()
    {
        // Validate input
        if (!isset($_POST['username']) || empty($_POST['username'])) {
            return;
        }

        $username = $_POST['username'] ?? '';

        $this->userModel->updateUserName($_SESSION['user']['id'], $username);

        $_SESSION['user']['name'] =  $username;
    }

    private function handleUserUpdatePassword()
    {
        // Validate input
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            return;
        }

        $password = $_POST['password'] ?? '';

        // Encrypt password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $this->userModel->updateUserPassword($_SESSION['user']['id'], $password_hash);
    }
}
