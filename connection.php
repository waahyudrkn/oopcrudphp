<?php
	class siswa
	{
		private $servername = "localhost";
		private $username   = "root";
		private $password   = "";
		private $database   = "learn";
		public  $con;
		// Database Connection 
		public function __construct()
		{
		    $this->con = new mysqli($this->servername, $this->username,$this->password,$this->database);
		    if(mysqli_connect_error()) {
			 trigger_error("Failed to connect to MySQL: " . mysqli_connect_error());
		    }else{
			return $this->con;
		    }
		}
		// Insert customer data into customer table
		public function insertData($post)
		{
			$nama = $this->con->real_escape_string($_POST['nama']);
			$kelas = $this->con->real_escape_string($_POST['kelas']);
			$jurusan = $this->con->real_escape_string($_POST['jurusan']);
			$kelamin = $this->con->real_escape_string($_POST['kelamin']);
			$query="INSERT INTO users(nama,kelas,jurusan, kelamin) VALUES('$nama','$kelas','$jurusan', '$kelamin')";
			$sql = $this->con->query($query);
			if ($sql==true) {
			    header("Location:index.php?msg1=insert");
			}else{
			    echo "Registration failed try again!";
			}
		}
		// Fetch customer records for show listing
		public function displayData()
		{
		    $query = "SELECT * FROM users";
		    $result = $this->con->query($query);
		if ($result->num_rows > 0) {
		    $data = array();
		    while ($row = $result->fetch_assoc()) {
		           $data[] = $row;
		    }
			 return $data;
		    }else{
			 echo "No found records";
		    }
		}
		// Fetch single data for edit from customer table
		public function displyaRecordById($id)
		{
		    $query = "SELECT * FROM users WHERE id = '$id'";
		    $result = $this->con->query($query);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			return $row;
		    }else{
			echo "Record not found";
		    }
		}
		// Update customer data into customer table
		public function updateRecord($postData)
		{
		    $nama = $this->con->real_escape_string($_POST['unama']);
		    $kelas = $this->con->real_escape_string($_POST['ukelas']);
		    $jurusan = $this->con->real_escape_string($_POST['ujurusan']);
		    $kelamin = $this->con->real_escape_string($_POST['ukelamin']);
		    $id = $this->con->real_escape_string($_POST['id']);

            
		if (!empty($id) && !empty($postData)) {
			$query = "UPDATE users SET nama = '$nama', kelas = '$kelas', jurusan = '$jurusan' , kelamin= '$kelamin' WHERE id = '$id'";
			$sql = $this->con->query($query);
			if ($sql==true) {
			    header("Location:index.php?msg2=update");
			}else{
			    echo "Registration updated failed try again!";
			}
		    }
			
		}
		// Delete customer data from customer table
		public function deleteRecord($id)
		{
		    $query = "DELETE FROM users WHERE id = '$id'";
		    $sql = $this->con->query($query);
		if ($sql==true) {
			header("Location:index.php?msg3=delete");
		}else{
			echo "Record does not delete try again";
		    }
		}
        public function batal()
        {
            // Redirect ke halaman sebelumnya
            header('Location: index.php');
            exit;
        }
}

?>