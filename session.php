<?php
   include('conn.php');
   session_start();
   
   $user_check = $_SESSION['login'];
   
   $ses_sql = mysqli_query($conn,"select phonenumber from officeinfo where phonenumber = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['phone'];
   
   if(!isset($_SESSION['login'])){
      header("location:login.php");
      die();
   }
?>