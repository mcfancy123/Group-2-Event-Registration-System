<?php
session_start();

$error = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if a user is even registered in the session
    if (isset($_SESSION['email'])) {
        // Authenticate credentials
        if ($email === $_SESSION['email'] && $password === $_SESSION['password']) {
            $_SESSION['is_logged_in'] = true;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "No user found. Please register first.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Campus Event</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <header><h1>Login</h1></header>
    <nav>
        <a href="index.html">Home</a>
        <a href="register.php">Register</a>
    </nav>

    <section>
        <?php if($error) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <button type="submit" name="login">Login</button>
           
        </form>
    </section>

    <footer><p>&copy; 2026 Campus Event System</p></footer>
</body>
</html>