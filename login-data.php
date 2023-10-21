<?php
session_start();

include "./connection-db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entered_email = $_POST['email'];
    $entered_password = $_POST['password'];

    $errors = array();

    // Validation for email
    if (empty($entered_email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($entered_email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    // Validation for password
    if (empty($entered_password) || strlen($entered_password) < 6) {
        $errors['password'] = "Password must be at least 6 characters.";
    }

    // If there are validation errors, redirect back to login.php with error parameters in the URL
    if (!empty($errors)) {
        $errorParams = http_build_query(array('error' => $errors));
        header('Location: login.php?' . $errorParams);
        exit();
    }

    // Proceed with user authentication
    $sql = "SELECT id, email, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $entered_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $stored_password = $user['password'];

        if (password_verify($entered_password, $stored_password)) {
            // Authentication successful
            $_SESSION['logged_in'] = true;
            $_SESSION['email'] = $entered_email; // Set the user's email in the session
            header('Location: profile.php'); // Redirect to the profile page
            exit();
        }
    }

    // Authentication failed, redirect back to login.php with an error message
    $errors['password'] = "Invalid email or password. Please try again.";
    $errorParams = http_build_query(array('error' => $errors));
    header('Location: login.php?' . $errorParams);
}
?>
