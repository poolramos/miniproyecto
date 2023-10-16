<?php

require_once '../models/user-model.php';
require_once '../library/functions.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'login':
        $userEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $userEmail = checkEmail($userEmail);
        $userPassword = filter_input(INPUT_POST, 'pssword');

        if (empty($userEmail) || empty($userPassword)) {
            $message = '<p class="notice">Please provide a valid email address and password.</p>';
            include '../views/login.php';
            exit;
        }

        $userData = getUserByEmail($userEmail);

        if (!$userData) {
            $message = '<p class="notice">Please check your email and password and try again.</p>';
            include '../views/login.php';
            exit;
          }

        $hashCheck = password_verify($userPassword, $userData['pssword']);

        if (!$hashCheck) {
            
            $message = '<p class="notice">Paso Please check your email and password and try again.</p>';
            include '../views/login.php';
            exit;
          }

        array_pop($userData);
        
        session_start();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['userData'] = $userData;

        include '../views/personal-info.php';
        exit;
        break;

    case 'createUser':
        $fullname = trim(filter_input(INPUT_POST, 'fullname'));
        $bio = trim(filter_input(INPUT_POST, 'bio'));
        $phone = trim(filter_input(INPUT_POST, 'phone'));
        $email = trim(filter_input(INPUT_POST, 'email'));
        $photo = trim(filter_input(INPUT_POST, 'photo'));
        $pssword = trim(filter_input(INPUT_POST, 'pssword'));

        if (empty($email) || empty($pssword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../views/create-user.php';
            exit;
        }

        $existingEmail = checkExistingEmail($email);

        if ($existingEmail) {
            $message = '<p>The email address already exists. Do you want to login instead?</p>';
            include '../views/login.php';
            exit;
          }

        $hashedPassword = password_hash($pssword, PASSWORD_DEFAULT);

        $regOutcome = createUser($fullname, $bio, $phone, $email, $photo, $hashedPassword);

        if ($regOutcome === 1) {
            $message = '<p class="registering-message">Thanks for registering. Please use your email and password to login.</p>';
            include '../views/login.php';
            exit;
        } else {
            $message = '<p class="error-message">Sorry, but the registration failed. Please try again.</p>';
            include '../views/create-user.php';
            exit;
        }

    case 'updateUser':
        session_start();
        $userId = $_SESSION['userData']['id'];
        $fullname = trim(filter_input(INPUT_POST, 'fullname'));
        $bio = trim(filter_input(INPUT_POST, 'bio'));
        $phone = trim(filter_input(INPUT_POST, 'phone'));
        $email = trim(filter_input(INPUT_POST, 'email'));
        $photo = trim(filter_input(INPUT_POST, 'photo'));
        $pssword = trim(filter_input(INPUT_POST, 'pssword'));

        if ($email) {
            $existingEmail = checkExistingEmail($email);

            if ($existingEmail) {
                $message = '<p class="error-message">The email address already exists</p>';
                include '../views/update-info.php';
                exit;
              }
        }

        if ($pssword) {
            $pssword = password_hash($pssword, PASSWORD_DEFAULT);
        }

        $regOutcome = updateUser($userId, $fullname, $bio, $phone, $email, $photo, $pssword);

        if ($regOutcome === 1) {
            $message = "<p>Thanks for updating your info $fullname.</p>";
            $_SESSION['userData'] = getUserById($userId);
            include '../views/personal-info.php';
            exit;
        } else {
            $message = '<p class="error-message">Sorry, but the update failed. Please try again.</p>';
            include '../views/update-info.php';
            exit;
        }
    case 'updateView':
        session_start();
        $userId = $_SESSION['userData']['id'];
        $userData = getUserById($userId);
        include '../views/update-info.php';
        exit;
        break;

    case 'personalView':
        session_start();
        $userId = $_SESSION['userData']['id'];
        $userData = getUserById($userId);
        include '../views/personal-info.php';
        exit;
        break;
}

