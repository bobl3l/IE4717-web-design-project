<?php
include 'config.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $contact = isset($_POST['contact']) ? $_POST['contact'] : '';
    $fulladdress = isset($_POST['fulladdress']) ? $_POST['fulladdress'] : '';

    $checkUser = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($checkUser);

    if ($result->num_rows > 0) {
        // echo "Username or Email already exists";
        header("Location: ../register.html?error=Username or Email already exists");
        exit;
    }
    else {
        $sql = "INSERT INTO users (username, password, fullname, email, contact, fulladdress) VALUES ('$username', '$password', '$fullname', '$email', '$contact', '$fulladdress')";
        if ($conn->query($sql) == TRUE){
            // echo "New record created successfully";
            header("Location: ../login.html?success=You have successfully registered. Let's go SHOPPING!");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>