<?php
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flowershop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error variable
$error = "";

// Process form when submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signUp'])) {
    // Get and sanitize form data
    $firstName = $conn->real_escape_string($_POST['firstName']);
    $lastName = $conn->real_escape_string($_POST['lastName']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate passwords match
    if ($password !== $confirm_password) {
        $error = "Error: Passwords do not match";
    } else {
        // Check if email already exists
        $check_email = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check_email->bind_param("s", $email);
        $check_email->execute();
        $check_email->store_result();

        if ($check_email->num_rows > 0) {
            $error = "This email is already registered. Please login or use a different email.";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert into database
            $sql = "INSERT INTO users (firstName, lastName, email, password) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $firstName, $lastName, $email, $hashed_password);

            if ($stmt->execute()) {
                // Registration successful - redirect to homepage
                header("Location: /flower_shop/index.php");
                exit();
            } else {
                $error = "Error: " . $stmt->error;
            }
            $stmt->close();
        }
        $check_email->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/flower_shop/edaproject.css">
    <style>
        .error {
            color: red;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid red;
            border-radius: 5px;
            background-color: #ffeeee;
        }
    </style>
</head>
<body>
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
    <header>
        <h1>Create Your Account</h1>
    </header>

    <?php if (!empty($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" required value="<?php echo isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : ''; ?>">

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" required value="<?php echo isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : ''; ?>">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <button type="submit" name="signUp">Register</button>
    </form>
</body>
</html>