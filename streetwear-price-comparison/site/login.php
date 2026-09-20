<?php

$db_host = getenv('DB_HOST');  
$db_user = getenv('DB_USER');  
$db_password = getenv('DB_PASSWORD');  
$db_name = getenv('DB_NAME'); 




if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name) or die("connection failed:" . mysqli_connect_error());

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        header('Location: index.html');
        exit;
    } else {
        // Authentication failed
        $error_message = "Invalid username or password.";
    }
}



?>