<!DOCTYPE html>
<?php
session_start();
$_SESSION['username']=false;
header("Location: index.php");
?>