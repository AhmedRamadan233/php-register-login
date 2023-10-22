<?php include "layouts/header.php"; 
include "./connection-db.php";

$sql = "SELECT name, profile_picture FROM users ORDER BY id DESC LIMIT 3";
$result = $conn->query($sql);
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 p-3 shadow rounded">
            <h2 class="p-3 col text-center mt-3 text-white bg-dark rounded">
                Home
            </h2>
            <div class="row">
                <?php
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $name = $row['name'];
                        $profile_picture = $row['profile_picture'];
                ?>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="<?php echo "uploads/" . $profile_picture; ?>" class="card-img-top" alt="<?php echo $name; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $name; ?></h5>
                        </div>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo "Error in the SQL query: " . $conn->error;
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include "layouts/footer.php"; ?>
