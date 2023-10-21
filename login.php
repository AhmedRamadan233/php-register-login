<?php include "layouts/header.php"; 


if (isset($_GET['error'])) {
    $errors = $_GET['error'];
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 p-3 shadow rounded">
            <h2 class="p-3 col text-center mt-3 text-white bg-dark rounded">
                Login
            </h2>
            <form action="login-data.php" method="POST">
                <?php
                    if (isset($_GET['success'])) {
                        ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo htmlspecialchars($_GET['success']); ?>
                        </div>
                        <?php
                    }
                ?>
                
   
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <?php if (isset($errors) && isset($errors['password'])): ?>
                <div class="text-danger"><?php echo htmlspecialchars($errors['password']); ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include "layouts/footer.php"; ?>
