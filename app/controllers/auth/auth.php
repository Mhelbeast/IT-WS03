<?php

function loginUser($email, $password) {
    $config = require basePath('config/db.php');
    $db = new Database($config);

    // Fetch user by email
    $sth = $db->conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $sth->execute(['email' => $email]);
    $user = $sth->fetch();

    if (!$user) {
        return false;
    }

    $storedPassword = (string) $user->password;
    $isLegacyPassword = password_get_info($storedPassword)['algo'] === 0;
    $isValidPassword = password_verify($password, $storedPassword)
        || (hash_equals($storedPassword, $password));
    if ($isValidPassword) {
        if ($isLegacyPassword) {
            $newPassword = password_hash($password, PASSWORD_DEFAULT);
            $update = $db->conn->prepare("UPDATE users SET password = :password WHERE id = :id");
            $update->execute([
                'password' => $newPassword,
                'id' => $user->id,
            ]);
        }

        // Password is correct, log in the user
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user->id;
        return true;
    }

    return false;
}

function registerUser($givenName, $lastName, $email, $password) {
    $config = require basePath('config/db.php');
    $db = new Database($config);

    $sth = $db->conn->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
    $sth->execute(['email' => $email]);

    if ($sth->fetch()) {
        throw new Exception("Email is already registered.");
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $insert = $db->conn->prepare(
        "INSERT INTO users (given_name, last_name, email, password)
         VALUES (:given_name, :last_name, :email, :password)"
    );

    $insert->execute([
        'given_name' => $givenName,
        'last_name' => $lastName,
        'email' => $email,
        'password' => $hashedPassword,
    ]);

    return (int) $db->conn->lastInsertId();
}

?>