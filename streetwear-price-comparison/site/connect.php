<?php

$db_host = '';  
$db_user = '';  
$db_password = '';  
$db_name = ''; 




if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name) or die("connection failed:" . mysqli_connect_error());
    
    

    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $hashed = hash('sha512',$password);

        $sql = "INSERT INTO `users` (`Name`, `Email`, `Password`) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashed);

        $query = mysqli_stmt_execute($stmt);

        if ($query) {
            header('Location: https://streetwearsavings.com/index.html');
            exit;
        } else {
            if (mysqli_errno($conn) == 1062) { // MySQL error code for duplicate entry
                echo 'Duplicate Entry';
            } else {
                echo 'Entry Failed: ' . mysqli_error($conn);
            }
        }

        mysqli_stmt_close($stmt);
    }
}
?>