<?php

try {
    $con = new PDO('mysql:host=localhost;dbname=learn', 'root', '', array(PDO::ATTR_PERSISTENT => true));
} catch (PDOException $e) {
    echo $e->getMessage();
}

include_once ('auth.php');

$user = new Auth($con);