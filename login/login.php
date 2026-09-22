<?php
session_start();
include 'connect.php'; // Assuming connect.php is in the same 'login' directory

if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify password against the hashed version in database
        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['firstName'] = $row['firstName']; // Store first name if needed
            
            // Correct the header location:
            // 'login.php' is in 'flower_shop/login/', 'index.php' is in 'flower_shop/'
            // So, you need to go up one directory: '../index.php'
            header("Location: /flower_shop/index.php"); 
            exit();
        } else {
            $error = "Incorrect password";
        }
    } else {
        $error = "Email not found";
    }
    
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../edaproject.css">
    <style>
        .error {
            color: red;
            margin: 15px 0;
            padding: 10px;
            border: 1px solid red;
            background-color: #ffeeee;
        }
    </style>
</head>
<body>
    <header>
        <h1>Login to Our Flower Shop</h1>
    </header>
    <nav>
        <ul>
            <li><a href="/flower_shop/index.php">Home</a></li>
            <li><a href="#shop">Shop</a></li>
            <li><a href="./login/login.php">Login</a></li>
            <li><a href="./login/register.php">Register</a></li>
            <?php if (isset($_SESSION['email'])): ?>
                <li><a href="./login/logout.php">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="login.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" name="signIn">Login</button>
    </form>

    <p class="register-prompt">Don't have an account? <a href="./register.php">Register here</a></p>
</body>
</html>