<?php
include "./connection-db.php";

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function isEmailUnique($email, $conn) {
  $sql = "SELECT email FROM users WHERE email = '$email'";
  $result = $conn->query($sql);

  return ($result->num_rows == 0);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = validate($_POST["name"]);
    $email = validate($_POST["email"]);
    $password = validate($_POST["password"]);
    $confirm_password = validate($_POST["confirm_password"]);
    $gender = validate($_POST["gender"]);
    $website = validate($_POST["website"]);
    $terms_accepted = isset($_POST["terms_accepted"]) ? 1 : 0;
    $profile_picture = $_FILES["profile_picture"];

    $data = 'email=' . urlencode($email) . '&name=' . urlencode($name) . '&website=' . urlencode($website);
    $errors = array();

    if (empty($name)) {
        $errors['name'] = "Name is required.";
    } elseif (!preg_match("/^[a-zA-Z'-]+$/", $name)) {
        $errors['name'] = "Name can only contain letters, apostrophes, and hyphens.";
    }
    
    if (empty($email)) {
      $errors['email'] = "Email is required.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "Invalid email format.";
  } elseif (!isEmailUnique($email, $conn)) {
      $errors['email'] = "Email is already in use.";
  }

    if (empty($password) || strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters.";
    }

    if ($password !== $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match.";
    }

    if (empty($gender)) {
        $errors['gender'] = "Gender is required.";
    }
    if (!$terms_accepted) {
      $errors['terms_accepted'] = "You must accept the terms and conditions.";
    }
    if (!empty($errors)) {
      $redirect_url = "Location: index.php?" . http_build_query(array('error' => $errors)) . '&' . $data;
      header($redirect_url);
      exit;
    }

    $profile_picture = "default.jpg"; 

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === 0) {
        $file_name = $_FILES['profile_picture']['name'];
        $file_size = $_FILES['profile_picture']['size'];
        $file_tmp = $_FILES['profile_picture']['tmp_name'];
        $file_type = $_FILES['profile_picture']['type'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $allowed_extensions)) {
            if ($file_size <= 2097152) {
                $profile_picture = uniqid() . "." . $file_ext;
                move_uploaded_file($file_tmp, "uploads/" . $profile_picture);
            } else {
                $errors['profile_picture_size'] = "File size must be less than or equal to 2 MB.";
            }
        } else {
            $errors['profile_picture_format'] = "Only JPEG, JPG, and PNG files are allowed.";
        }
    }

    if (!empty($errors)) {
        header("Location: index.php?error=".urlencode(serialize($errors))."&".$data);
        exit;
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password, gender, website, profile_picture, terms_accepted)
        VALUES ('$name', '$email', '$hashed_password', '$gender', '$website', '$profile_picture', '$terms_accepted')";

        if ($conn->query($sql) === TRUE) {
            $sm = "Account created successfully";
            header("Location: login.php?success=$sm");
            exit;
        } else {
            $em = "Error: " . $sql . "<br>" . $conn->error;
            header("Location: index.php?error=$em");
            exit;
        }
    }
} else {
    header("Location: index.php");
    exit;
}
?>
