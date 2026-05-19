<?php

require __DIR__ . "/auth.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate input
    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        // Attempt to log in the user
        if (loginUser($email, $password)) {
            header("Location: /");
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    }
}

loadView("auth/login", [
    'error' => $error ?? null
]);

?>