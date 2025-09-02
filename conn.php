<?php
// $con_PDO=new PDO("mysql:host=localhost;dbname=samadata;charset=utf8;","cti","CTIcti#1?");
//$con_PDO = new PDO("mysql:host=localhost;dbname=samadata;charset=utf8;", "root", "");
// $con_mysqli=mysqli_connect("localhost","cti","CTIcti#1?","samadata");
//$con_mysqli = mysqli_connect("localhost:4308", "root", "", "samadata");
$con_PDO = new PDO("mysql:host=localhost;port=4308;dbname=samadata;charset=utf8;", "root", "");
$con_mysqli = mysqli_connect("localhost:4308", "root", "", "samadata");
