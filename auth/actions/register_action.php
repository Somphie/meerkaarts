<?php
require '../../database/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if (empty($username) || empty($email) || empty($password)) {
        $_SESSION['error'] = "Please fill in all fields.";
        header("Location: ../../../pages/home-page.php?action=register_error");
        exit();
    }

    if (!$email) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: ../../../pages/home-page.php?action=register_error");
        exit();
    }

    if (strlen($password) < 8) {
        $_SESSION['error'] = "Password must be at least 8 characters long.";
        header("Location: ../../../pages/home-page.php?action=register_error");
        exit();
    }

    if ($password !== $password_confirm) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: ../../../pages/home-page.php?action=register_error");
        exit();
    }

    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $_SESSION['error'] = "Username or email already taken.";
        header("Location: ../../../pages/home-page.php?action=register_error");
        exit();
    }
    $stmt->close();

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $stmt->insert_id;
        header("Location: ../../../pages/home-page.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
        header("Location: ../../../pages/home-page.php?action=register_error");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
