<?php
include 'session.php';

?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <link rel="stylesheet" href="style1.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>
        HOME
    </title>
    </head>
        <body>
            <div>
                
            </div>
        <div class = "top">
            <div class = "heading">
            <h1>
                TECHNICIAN FINDER SYSTEM
            </h1>
            </div>
            
            
    <div class= "nav">
      <a href="address2.php">My appointments</a>
      <a href="#">Contact us</a>
      <a href="logout.php">Log Out</a>
    </div>
   
        </div>

        <div>

        </div>
        <div class = "mx-auto">
        <?php
    include 'conn.php';
   if($_SESSION["login"]){
    $query="SELECT * FROM officeinfo where office_id = ".$_SESSION["office_id"];
    //$query="SELECT region_id FROM officeinfo where office_id = ".$_SESSION["office_id"];
    //$query="SELECT * FROM officeinfo where office_id = ".$_SESSION["office_id"];

    $res=mysqli_query($conn,$query);
  
   }
    
    while($row=mysqli_fetch_array($res)){

      
    ?>
    <div class="container">
    <h2>Office address</h2>
    <div class ="row">
        <div class ="col-md-6">
        Office name:
        </div>
        <div class = "col-md-6"><?php echo $row["officename"];?></div>
        </div>
        <div class = "row">
            <div class = "col-md-6">
            Region
            </div>
        <div class = "col-md-6"><?php 
        $sql="SELECT * FROM regions WHERE id=".$row["region_id"];
        $sql2 ="SELECT * FROM districts WHERE id=".$row["district_id"];
        $sql3 ="SELECT * FROM wards WHERE id=".$row["id"];
        $results=mysqli_query($conn,$sql);
        $row2 = mysqli_fetch_array($results);
        echo $row2["name"];?></div>
        </div>
        <div class = "row">
        <div class = "col-md-6">
        District:
        </div>
        <div class = "col-md-6"><?php 
        $results=mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_array($results);
        echo $row2["name"];?></div>
        </div>
        <div class = "row">
        <div class = "col-md-6">
        Ward
        </div>
        
        <div class = "col-md-6">
        <?php 
        $results=mysqli_query($conn,$sql3);
        $row3 = mysqli_fetch_array($results);
        echo $row3["name"];
        ?></div>
        </div>
        <input type="button" onclick="location.href='edit.php'" value = "Edit Address">

        <h2>Office information</h2>
        <div class="row">
        <div class ="col-md-6">
        Office Manager:
        </div>
        <div class = "col-md-6"><?php echo $row["managername"];?></div>
        </div>
        <div class="row">
        <div class="col-md-6">
        Office Number:
        </div>
        <div class = "col-md-6"><?php echo $row["phonenumber"];?></div>
        </div>
        <div class="row">
        <div class="col-md-6">
        Office email:
        </div>
        <div class = "col-md-6"><?php echo $row["email"];?></div>
        </div>
        <input type="button" onclick="location.href='editinfo.php'" value = "Edit Information">


        <h2> Specialized in</h2>
        <?php
        $query2="SELECT * FROM officeexperties WHERE office_id='$_SESSION[office_id]'";
        $res3=mysqli_query($conn,$query2);
        while($row4=mysqli_fetch_array($res3)){
            ?>
            <div class="row">
                <div class = "col-md-6">
                Experties:
                </div>
            <div>
                <?php
                $sql4="SELECT * FROM experties WHERE experties_id=".$row4["experties_id"];
                $res5=mysqli_query($conn,$sql4);
                $row5=mysqli_fetch_array($res5);
                echo $row5["experties"];
                ?>
            </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                Description:
                </div>
            <div> <?php echo $row4["descr"]?></div>
            </div>
          
            <?php
        }
        ?>
        <input type="button" onclick="location.href='addexperties.php'" value = "add Experties">
    </div>
    
    <?php
    
    }
    ?>
        </div>
       
        </body>
</html>