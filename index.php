<?php
  
  // Include database file
  include_once ('config.php');
  include 'connection.php';
  $siswaObj = new siswa();
  // Delete record from table
  if(isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
      $deleteId = $_GET['deleteId'];
      $siswaObj->deleteRecord($deleteId);
  }
  // Cek status login user  
  if (!$user->isLoggedIn()) {  
      header("location: login.php"); //Redirect ke halaman login  
  }  
  
  // Ambil data user saat ini  
  $currentUser = $user->getUser();  
  
?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
</head>
<body>
<div class="card text-center" style="padding:15px;">
<div class="mt-4 p-5 bg-primary text-white rounded">
<h4>data siswa smk wiraswasta</h4>
</div>
</div><br><br> 
<div class="container">
  <?php
    if (isset($_GET['msg1']) == "insert") {
      echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              berhasil menambahkan data
            </div>";
      } 
    if (isset($_GET['msg2']) == "update") {
      echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              update data berhasil
            </div>";
    }
    if (isset($_GET['msg3']) == "delete") {
      echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              delete data berhasil
            </div>";
    }
?>
  <a href="logout.php" class="btn btn-danger" style="float:left;">logout</a> <br> <br>
  <h2>Tabel Data
    <a href="create.php" class="btn btn-primary" style="float:right;">Add New Record</a>
  </h2>
  <table class="table table-striped table-hover">
    <thead class="table-dark">
      <tr>
        <th>Id</th>
        <th>nama</th>
        <th>kelas</th>
        <th>jurusan</th>
        <th>kelamin</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        <?php 
          $siswa = $siswaObj->displayData(); 
          if (empty($siswa)) {
            echo "<tr><td colspan='5'></td></tr>";
        } else {
            foreach ($siswa as $siswa) {
            
        ?>
        <tr>
          <td><?php echo $siswa['id'] ?></td>
          <td><?php echo $siswa['nama'] ?></td>
          <td><?php echo $siswa['kelas'] ?></td>
          <td><?php echo $siswa['jurusan'] ?></td>
          <td><?php echo $siswa['kelamin'] ?></td>
          <td>
            <a href="update.php?editId=<?php echo $siswa['id'] ?>" style="color:green">
              <i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp
            <a href="index.php?deleteId=<?php echo $siswa['id'] ?>" style="color:red" onclick="confirm('Are you sure want to delete this record')">
              <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
          </td>
        </tr>
      <?php 
        }
    }
     ?>
    </tbody>
  </table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>