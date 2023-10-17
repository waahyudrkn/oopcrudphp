<?php  

// Lampirkan dbconfig  
require_once "config.php";  

// Logout! hapus session user  
$user->logout();  

// Redirect ke login  
header('location: login.php');