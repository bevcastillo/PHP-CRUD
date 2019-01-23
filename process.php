<?php

session_start();
//connecting to the database
$mysqli = new mysqli('127.0.0.1','root','','crud') or die(mysqli_error($mysqli));

$id=0;
$lastname="";
$firstname="";
$update=false;

//inserting data into the database
if(isset($_POST['save'])){
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];

    $mysqli->query("INSERT INTO tblsample (lastname, firstname) VALUES('$lastname', '$firstname')") 
                  or die(mysqli_error($mysqli));

    $_SESSION['message'] = "Successfully added!";

    header("location: index.php");
}

//delete
if(isset($_GET['delete'])){
  $id = $_GET['delete'];

  $mysqli->query("DELETE FROM tblsample WHERE id=$id") or die(mysqli_error($mysqli));

  $_SESSION['message'] = "Record has been deleted";

  header("location: index.php");
}

//edit button
if(isset($_GET['edit'])){
  $id = $_GET['edit'];
  $update=true;

  $result = $mysqli->query("SELECT * FROM tblsample WHERE id=$id") or die(mysqli_error($mysqli));
  $row = $result->fetch_array();
  $lastname = $row['lastname'];
  $firstname = $row['firstname'];
}

//update
if(isset($_POST['update'])){
  $id = $_POST['id'];
  $lastname = $_POST['lastname'];
  $firstname = $_POST['firstname'];

  $mysqli->query("UPDATE tblsample SET lastname='$lastname', firstname='$firstname' WHERE id=$id") or die($mysqli->error());

  $_SESSION['message'] = "Record has been updated!";

  header("location: index.php");
}

?>