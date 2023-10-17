<?php
  
  // Include database file
  include 'connection.php';
  $siswaObj = new siswa();
  // Edit customer record
  if(isset($_GET['editId']) && !empty($_GET['editId'])) {
    $editId = $_GET['editId'];
    $siswa = $siswaObj->displyaRecordById($editId);
  }
  // Update Record in customer table
  if(isset($_POST['update'])) {
    $siswaObj->updateRecord($_POST);
  }  
   
if (isset($_POST['batal'])) {
    $siswaObj->batal();
}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>data siswa smk wiraswasta</title>
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
  <form action="update.php" method="POST">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" name="unama" value="<?php echo $siswa['nama']; ?>" required="">
    </div>
    <div class="form-group">
      <label for="kelas">kelas:</label>
      <select class="form-control" name="ukelas">
        <option value="10" <?php if ($siswa['kelas'] == '10') echo 'selected'; ?>> 10</option>
        <option value="11" <?php if ($siswa['kelas'] == '11') echo 'selected'; ?>> 11</option>
        <option value="12" <?php if ($siswa['kelas'] == '12') echo 'selected'; ?>> 12</option>
    </select>
    </div>
    <div class="form-group">
      <label for="jurusan">jurusan:</label>
      <select class="form-control" name="ujurusan">
        <option value="rpl" <?php if ($siswa['jurusan'] == 'rpl') echo 'selected'; ?>>RPL</option>
        <option value="tav" <?php if ($siswa['jurusan'] == 'tav') echo 'selected'; ?>>TAV</option>
        <option value="tkr" <?php if ($siswa['jurusan'] == 'tkr') echo 'selected'; ?>>TKR</option>
        <option value="tmi" <?php if ($siswa['jurusan'] == 'tmi') echo 'selected'; ?>>TMI</option>
        <option value="tbsm" <?php if ($siswa['jurusan'] == 'tbsm') echo 'selected'; ?>>TBSM</option>
    </select>
    </div>
    <div class="form-group">
      <label for="kelamin">kelamin:</label>
      <select class="form-control" name="ukelamin">
        <option value="laki-laki" <?php if ($siswa['kelamin'] == '10') echo 'selected'; ?>> laki-laki</option>
        <option value="perempuan" <?php if ($siswa['kelamin'] == '11') echo 'selected'; ?>> perempuan</option>
    </select>
    </div>
    <div class="form-group">
      <input type="hidden" name="id" value="<?php echo $siswa['id']; ?>">
      <input type="submit" name="update" class="btn btn-primary" style="float:right;" value="Update">
    <input type="submit" name="batal" class="btn btn-danger" style="float:left;" value="batal">
    </div>
  </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

