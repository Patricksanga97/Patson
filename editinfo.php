<?php
include 'session.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>

        </title>
    </head>
    <body>
        <?php
       // session_start();
         include 'conn.php';
            if(isset($_POST["submit"])){
                $query="SELECT * FROM officeinfo where office_id = ".$_SESSION["office_id"];
                $officemanager=mysqli_real_escape_string($conn, $_POST["manager"]);
                $phone=mysqli_real_escape_string($conn, $_POST["pnumber"]);
                $email=mysqli_real_escape_string($conn, $_POST["email"]);
               
                if($_SESSION['login']=true){
                    $sql="UPDATE officeinfo SET managername='$officemanager', phonenumber='$phone', email ='$email' WHERE office_id='$_SESSION[office_id]'";
                    if(mysqli_query($conn,$sql)){
                        header('location:techprofile.php');
                    }else{
                        echo "error:". mysqli_error($conn);
                    }
                }
            }
         ?>

         <form action="editinfo.php" method="post">
        Office Manager:<br>
        <input type="text" name="manager" placeholder="Enter Manger name"><br>
        Office Number:<br>
        <input type="text" name="pnumber" placeholder="Enter Office Phone number"><br>
        Office email:<br>
        <input type="text" name="email" placeholder="Enter office email"><br>

        <input type="submit" name="submit" onclick="location.href='techprofile.php'" value="save changes"><br>
         </form>
    </body>
</html>