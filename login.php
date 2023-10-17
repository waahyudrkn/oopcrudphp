<?php

// Lampirkan dbconfig
require_once "config.php";

// Cek status login user
if ($user->isLoggedIn()) {
    header("location: index.php"); //redirect ke index
}

//jika ada data yg dikirim
if (isset($_POST['kirim'])) {
    $email = $_POST['email'];

    $password = $_POST['password'];

    // Proses login user
    if ($user->login($email, $password)) {
        header("location: index.php");
    } else {
        // Jika login gagal, ambil pesan error
        $error = $user->getLastError();
    }
}

?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>

    <title>Login</title>
</head>
<body>

<div class="container">
  <form action="" method="POST">
    <div class="form-group form-floating">
      <label for="email">email:</label>
      <input type="text" class="form-control" name="email" placeholder="Enter email" required="">
      <div class="form-group">
      <label for="password">password:</label>
      <input type="password" class="form-control" name="password" placeholder="Enter password" required="">
      <input type="submit" name="kirim" class="btn btn-primary" style="float:right;" value="Submit">
      <p class="message">Not registered? <a href="register.php">Create an account</a></p>
    </div>
</div>

</body>
</html>


