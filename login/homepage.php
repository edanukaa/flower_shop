<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="5;url=index.php"> <!-- Redirect to index.php after 5 seconds -->
    <title>Home Page</title>
    <link rel="stylesheet" href="/edaproject.css">
</head>
<body>
    <header>
        <h1>Welcome to Your Home Page</h1>
    </header>
    <p>You are logged in as <?php echo $_SESSION['email']; ?></p>
    <p>You will be redirected to the homepage in a few seconds...</p>
    <a href="./login/logout.php">Logout</a>
</body>
</html>
