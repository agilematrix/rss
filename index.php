<!-- index.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCPC RSS Feed</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-6">
            <h2 class="mb-4">Login</h2>

            <?php
            // Check if there is an error parameter in the URL
            if (isset($_GET['error']) && $_GET['error'] == 1) {
                echo '<div class="alert alert-danger" role="alert">
                        Invalid username or password. Please try again.
                      </div>';
            }
            ?>

            <form action="validate.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
