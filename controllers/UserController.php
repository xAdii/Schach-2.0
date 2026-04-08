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

    private function redirectWithError($error)
    {
        $url = $_SERVER['PHP_SELF'] . '?error=' . urlencode($error);

        $url .= '&nav=' . urlencode(isset($_POST['nav']) ? $_POST['nav'] : (isset($_GET['nav']) ? $_GET['nav'] : ''));

        header('Location: ' . $url);
        exit;
    }

    private function handleUserSignup()
    {
        // Validate input
        if (!isset($_POST['username']) || !isset($_POST['password'])) {
            $this->redirectWithError('emptyFields');
        }

        if (empty($_POST['username']) || empty($_POST['password'])) {
            $this->redirectWithError('emptyFields');
        }

        if (trim($_POST['username']) === '' || preg_match('/\s/', $_POST['username'])) {
            $this->redirectWithError('invalidUsername');
        }

        if (trim($_POST['password']) === '' || preg_match('/\s/', $_POST['password'])) {
            $this->redirectWithError('invalidPassword');
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Check if user already exists
        if ($this->userModel->fetchUser($username)) {
            $this->redirectWithError('usernameTaken');
        } else {

            // Encrypt password
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // Create user
            $this->userModel->createUser($username, $password_hash);
        }

        // Get user from database
        $user = $this->userModel->fetchUser($username);

        // Set session
        $_SESSION['user'] = [
            'ID' => $user['ID'],
            'name' => $user['name']
        ];
    }

    private function handleUserLogin()
    {
        // Validate input
        if (!isset($_POST['username']) || !isset($_POST['password'])) {
            $this->redirectWithError('emptyFields');
        }

        if (empty($_POST['username']) || empty($_POST['password'])) {
            $this->redirectWithError('emptyFields');
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Get user from database
        $user = $this->userModel->fetchUser($username);

        // Check if user exists
        if (!$user) {
            $this->redirectWithError('userNotFound');
        }

        // Check if password is correct
        if (!password_verify($password, $user['password'])) {
            $this->redirectWithError('wrongPassword');
        }

        // Set session
        $_SESSION['user'] = [
            'ID' => $user['ID'],
            'name' => $user['name']
        ];
    }

    private function handleUserLogout()
    {
        unset($_SESSION['user']);
    }

    private function handleUserDelete()
    {
        $this->userModel->deleteUser($_SESSION['user']['ID']);
        unset($_SESSION['user']);
    }

    private function handleUserUpdateName()
    {
        // Validate input
        if (!isset($_POST['username']) || empty($_POST['username']) || trim($_POST['username']) === '' || preg_match('/\s/', $_POST['username'])) {
            return;
        }

        $username = $_POST['username'] ?? '';
        // Get user from database
        $user = $this->userModel->fetchUser($username);

        // Check if user exists
        if ($user) {
            $this->redirectWithError('usernameTaken');
        }
        $this->userModel->updateUserName($_SESSION['user']['ID'], $username);

        $_SESSION['user']['name'] = $username;
    }

    private function handleUserUpdatePassword()
    {
        // Validate input
        if (!isset($_POST['password']) || empty($_POST['password']) || trim($_POST['password']) === '' || preg_match('/\s/', $_POST['password'])) {
            $this->redirectWithError('invalidPassword');
            return;
        }
        if (!isset($_POST['old_password']) || empty($_POST['old_password'])) {
            $this->redirectWithError('emptyFields');
            return;
        }

        $password = $_POST['password'] ?? '';
        $old_password = $_POST['old_password'] ?? '';

        // Check if old password is correct
        $user = $this->userModel->fetchUser($_SESSION['user']['name']);
        if (!password_verify($old_password, $user['password'])) {
            $this->redirectWithError('wrongPassword');
            return;
        }

        // Encrypt password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $this->userModel->updateUserPassword($_SESSION['user']['ID'], $password_hash);
    }

    public function getUsernameByID($userID)
    {
        return $this->userModel->fetchUserByID($userID)['name'] ?? 'Unbekannt';
    }
}