<?php

$servername = "localhost" ;
$db = "youcodescumboard";
$username = "root";
$password = "";

  $conn = new mysqli($servername, $username, $password,$db);
  // set the PDO error mode to exception
  if ($conn -> connect_errno) {
      echo "Failed to connect to MySQL: " . $conn -> connect_error;
      exit();
    }


if(isset($_POST["add"])){
      print_r($_POST);
      $title=$_POST["title"];
      $status=$_POST["status"];
      $type=$_POST["type"];
      $description=$_POST["description"];
      $date=$_POST["date"];
      $priority=$_POST["priority"];

      $sql="insert into task (title, type, priority, status, date, description )
       values ('$title' ,'$type', '$priority', '$status', '$date', '$description');";
       echo($sql);
      $conn->query($sql);
      header("Location: index.php");
}

?>