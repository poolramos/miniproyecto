<?php 
function miniProyectoConnect(){ 

$hostname = 'localhost';
$dbName = 'mini_proyecto';
$username = 'root';
$password = '';
$dsn = "mysql:host=$hostname;dbname=$dbName";

try{
  $link = new PDO($dsn, $username, $password);
  return $link;

 } catch (PDOException $e) {
    echo 'Error';
    exit;
  }
}
miniProyectoConnect();
?>