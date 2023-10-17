<?php

// Lampirkan dbconfig
require_once "config.php";

// Cek status login user
if($user->isLoggedIn()) {
    header("location: index.php"); //Redirect ke index
}

//Cek adanya data yang dikirim
if(isset($_POST['kirim'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Registrasi user baru
    if($user->register($nama, $email, $password)) {
        // Jika berhasil set variable success ke true
        $success = true;
    } else {
        // Jika gagal, ambil pesan error
        $error = $user->getLastError();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" href="style.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>

</head>
<body>

<div class="container">
  <form action="" method="POST">
    <div class="form-group">
        
<?php if (isset($error)) {
                    echo "<div class='alert alert-warning alert-dismissible'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            $error
                            </div>";
                    } 
            ?>

            <?php if (isset($success)) {
                    echo "<div class='alert alert-success alert-dismissible'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            Berhasil mendaftar silahkan login.
                            </div>";
                    } 
            ?>
      <label for="name">name:</label>
      <input type="name" class="form-control" name="nama" placeholder="Enter nama" required="">
      <label for="email">email:</label>
      <input type="email" class="form-control" name="email" placeholder="Enter email" required="">
      <div class="form-group">
      <label for="password">password:</label>
      <input type="password" class="form-control" name="password" placeholder="Enter password" required="">
      <input type="submit" name="kirim" class="btn btn-primary" style="float:right;" value="Submit">
      <p class="message">Already registered? <a href="login.php">Sign In</a></p>

    </div>
</div>



</body>
</html>


