<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="style1.css">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <title>

        </title>

    </head>
    <body>
        <?php
        session_start();
        include 'conn.php';
        $query="SELECT * FROM experties ORDER BY experties ASC";

        if(isset($_POST['submit'])){
        //$sql1="SELECT * FROM experties WHERE experties_id='$experties'";
        $experties=$_POST["experties"];
        $desc=$_POST["desc"];
        
        if($_SESSION['login']=true){
            
             $sql="INSERT INTO officeexperties ( office_id, experties_id, descr)values ('$_SESSION[office_id]','$experties','$desc')";
            if(mysqli_query($conn,$sql)){
                header('location:techprofile.php');
            }else{
                echo "error:". mysqli_error($conn);
            }
           
        }
        }
        ?>
        <div class ="form-control">
        <form action="addexperties.php" method="post">
            <div class = "form group">
            Experties:<br>
            </div>
            <?php
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_array($result))
            {
                ?>
                
                <input type= "checkbox" name = "experties" value="<?php echo $row["experties_id"];?>"><?php echo $row["experties"];?></option><br>
                 
                <?php
            }
            ?>
      

            Description: <br>
            <input type="text"  name="desc" placeholder="Enter your experties description"><br>
            <input type="submit"  name="submit" value="Add"><br>
        
        </form>
        </div>
        
    </body>
</html>