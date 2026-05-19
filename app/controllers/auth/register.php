<?php

require __DIR__ . "/auth.php";

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$givenName = trim($_POST['first_name'] ?? '');
	$lastName = trim($_POST['last_name'] ?? '');
	$email = trim($_POST['email'] ?? '');
	$password = $_POST['password'] ?? '';
	$passwordConfirm = $_POST['password_confirm'] ?? '';

	if ($givenName === '') {
		$errors[] = 'First name is required.';
	}

	if ($lastName === '') {
		$errors[] = 'Last name is required.';
	}

	if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors[] = 'A valid email address is required.';
	}

	if ($password === '') {
		$errors[] = 'Password is required.';
	} elseif (strlen($password) < 6) {
		$errors[] = 'Password must be at least 6 characters long.';
	}

	if ($password !== $passwordConfirm) {
		$errors[] = 'Passwords do not match.';
	}

	if (!count($errors)) {
		try {
			$userId = registerUser($givenName, $lastName, $email, $password);
			session_regenerate_id(true);
			$_SESSION['user_id'] = $userId;

			header('Location: /');
			exit;
		} catch (Exception $e) {
			$errors[] = $e->getMessage();
		}
	}
}

loadView("auth/register", [
	'errors' => $errors,
	'old' => [
		'first_name' => $_POST['first_name'] ?? '',
		'last_name' => $_POST['last_name'] ?? '',
		'email' => $_POST['email'] ?? '',
	],
]);

?>