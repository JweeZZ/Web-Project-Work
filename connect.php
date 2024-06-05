<?php
$server = "localhost";
$dbname = "proje";
$user = "root";
$pass = "200224emre";

try {
     $baglanti = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);

} catch (PDOException $pe) {
    echo "Bağlantı hatası". $pe;
}



?>