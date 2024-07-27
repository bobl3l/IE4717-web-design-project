<?php
session_start();

include 'config.php';
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            echo "Login successful!";
            // Here to set up sessions
            $_SESSION['username'] = $user['username'];
            if ($user['role'] == 'admin') {
                $_SESSION['role'] = 'admin';
                header("Location: ../admin.php");
                exit;
            } else {
                $_SESSION['role'] = 'user';
            }
            $_SESSION['message'] = 'Welcome, ' . $user['username'] . '! You have logged in successfully!';
            $_SESSION['user_id'] = $user['id'];
            header("Location: ../home.php");
        } else {
            header("Location: ../login.html?error=Invalid username or password!");
        }
    } else {
        header("Location: ../login.html?error=Invalid username or password!");
    }
}
?>