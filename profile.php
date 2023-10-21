<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php'); // Redirect to the login page if not authenticated
    exit();
}

include "./connection-db.php";

if (isset($_SESSION['email'])) {
    $userEmail = $_SESSION['email']; // Retrieve the user's email from the session
    
    $sql = "SELECT name, gender FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $gender = $row['gender'];
    }
}

include "layouts/header.php";
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 p-3 shadow rounded">
            <h2 class="p-3 col text-center mt-3 text-white bg-dark rounded">
                My profile
            </h2>
            
            <?php if (isset($gender) && isset($name)) : ?>
                <h5 class="card-title">
                    Welcome <?php if ($gender === "Male") {
                        echo "Mr. ";
                    } elseif ($gender === "Female") {
                        echo "Ms. ";
                    }
                    echo $name;
                    ?>
                </h5>
            <?php endif; ?>

            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</div>

<?php include "layouts/footer.php"; ?>
