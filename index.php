<?php include "layouts/header.php"; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 p-3 shadow rounded">
            <h2 class="p-3 col text-center mt-3 text-white bg-dark rounded">
                Home
            </h2>
            <form method="post" action="insertion-data.php" enctype="multipart/form-data">

                <?php
                    
                    $name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : '';
                    $email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
                    $website = isset($_GET['website']) ? htmlspecialchars($_GET['website']) : '';
                    ?>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name" value="<?php echo $name; ?>">
                    <?php if (isset($_GET['error']) && isset($_GET['error']['name'])): ?>
                        <div class="text-danger"><?php echo htmlspecialchars($_GET['error']['name']); ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" value="<?php echo $email; ?>">
                    <?php if (isset($_GET['error']) && isset($_GET['error']['email'])): ?>
                        <div class="text-danger"><?php echo htmlspecialchars($_GET['error']['email']); ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password">
                    <?php if (isset($_GET['error']) && isset($_GET['error']['password'])): ?>
                        <div class="text-danger"><?php echo htmlspecialchars($_GET['error']['password']); ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" placeholder="Confirm your password" name="confirm_password">
                    <?php if (isset($_GET['error']) && isset($_GET['error']['confirm_password'])): ?>
                        <div class="text-danger"><?php echo htmlspecialchars($_GET['error']['confirm_password']); ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="male" name="gender" value="Male">
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="female" name="gender" value="Female">
                    <label class="form-check-label" for="female">Female</label>
                </div>
                <?php if (isset($_GET['error']) && isset($_GET['error']['gender'])): ?>
                    <div class="text-danger"><?php echo htmlspecialchars($_GET['error']['gender']); ?></div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" id="website" placeholder="Enter your website URL" name="website" value="<?php echo $website?>">
                    <?php if (isset($_GET['error']) && isset($_GET['error']['website'])): ?>
                        <div class="text-danger"><?php echo htmlspecialchars($_GET['error']['website']); ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="profile_picture">Profile Picture</label>
                    <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
                    <?php if (isset($_GET['error']) && isset($_GET['error']['profile_picture'])): ?>
                        <div class="text-danger"><?php echo htmlspecialchars($_GET['error']['profile_picture']); ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="terms_accepted" name="terms_accepted" value="1">
                    <label class="form-check-label" for="terms_accepted">I accept all terms and conditions</label>
                    <?php if (isset($_GET['error']) && isset($_GET['error']['terms_accepted'])): ?>
                        <div class="text-danger"><?php echo htmlspecialchars($_GET['error']['terms_accepted']); ?></div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                <button type="reset" class="btn btn-secondary mt-3">Reset</button>
            </form>
        </div>
    </div>
</div>

<?php include "layouts/footer.php"; ?>
