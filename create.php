<?php
  // Include database file
  include 'connection.php';
  $siswaObj = new siswa();
  // Insert Record in customer table
  if(isset($_POST['submit'])) {
    $siswaObj->insertData($_POST);
  }

  
if (isset($_POST['batal'])) {
    $siswaObj->batal();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>data siswa smk wiraswastaL</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
</head>
<body>
<div class="card text-center" style="padding:15px;">
  <h4>data siswa smk wiraswasta</h4>
</div><br> 
<div class="container">
  <form action="create.php" method="POST">
    <div class="form-group">
      <label for="name">Nama:</label>
      <input type="text" class="form-control" name="nama" placeholder="Enter name" required="" value="masukan nama">
    </div>
    <div class="form-group">
      <label for="email">kelas:</label>
      <select class="form-control" name="kelas">
        <!-- Gunakan class "custom-select" untuk desain option -->
        <option value="10" class="custom-select">10</option>
        <option value="11" class="custom-select">11</option>
        <option value="12" class="custom-select">12</option>
      </select>
    </div>
    <div class="form-group">
      <label for="username">jurusan:</label>
      <select class="form-control" name="jurusan">
        <option value="rpl" class="custom-select">RPL</option>
        <option value="tav" class="custom-select">TAV</option>
        <option value="tkr" class="custom-select">TKR</option>
        <option value="tmi" class="custom-select">TMI</option>
        <option value="tbsm" class="custom-select">TBSM</option>
      </select>
    </div>
    <div class="form-group">
      <label for="kelamin">kelamin:</label>
      <select class="form-control" name="kelamin">
        <!-- Gunakan class "custom-select" untuk desain option -->
        <option value="laki-laki" class="custom-select">laki-laki</option>
        <option value="perempuan" class="custom-select">perempuan</option>
      </select>
    </div>
    <input type="submit" name="submit" class="btn btn-primary" style="float:right;" value="Submit">
    <input type="submit" name="batal" class="btn btn-danger" style="float:left;" value="batal">
  </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>