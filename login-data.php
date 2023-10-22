<?php
session_start();
include "./connection-db.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entered_email = $_POST['email'];
    $entered_password = $_POST['password'];

    $errors = array();
    if (empty($entered_email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($entered_email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }
    if (empty($entered_password) || strlen($entered_password) < 6) {
        $errors['password'] = "Password must be at least 6 characters.";
    }
    if (!empty($errors)) {
        $errorParams = http_build_query(array('error' => $errors));
        header('Location: login.php?' . $errorParams);
        exit();
    }

    $sql = "SELECT id, email, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $entered_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $stored_password = $user['password'];

        if (password_verify($entered_password, $stored_password)) {
            $_SESSION['logged_in'] = true;
            $_SESSION['email'] = $entered_email; 
            header('Location: profile.php'); 
            exit();
        }
    }
    $errors['password'] = "Invalid email or password. Please try again.";
    $errorParams = http_build_query(array('error' => $errors));
    header('Location: login.php?' . $errorParams);
}
?>
