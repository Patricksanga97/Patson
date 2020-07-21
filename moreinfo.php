

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <title>
        MORE 
        </title>
    </head>
    <body>
    <div class = "top">
            <h1>
                TECHNICIAN FINDER SYSTEM
            </h1>
        </div>
        <?php
    include 'conn.php';
    session_start();
    
    if(isset($_POST["submit"])){
        $moreinfo = mysqli_real_escape_string($conn,$_POST["moreinfo"]);
       $customername= mysqli_real_escape_string($conn,$_POST["cname"]);
       $phone=mysqli_real_escape_string($conn,$_POST["cphone"]);
       $problem=mysqli_real_escape_string($conn,$_POST["problem"]);
       $appointment=mysqli_real_escape_string($conn,$_POST["date"]);
       

       //$sql2="SELECT * FROM officeinfo WHERE office_id=".$_GET["moreinfo"];
       
       //$res2=mysqli_query($conn,$sql2);
       //$row2=mysqli_fetch_array($res2);

       $sql9="INSERT INTO appointment(appointment_id,office_id,customername,pnumber,problem,appointmentdate,datenow) VALUES('','$moreinfo','$customername','$phone','$problem','$appointment',now())";
     
       if(mysqli_query($conn,$sql9)){
           echo "sucess";
           header('location: ?moreinfo='.$moreinfo);
       }else{
           echo "error:".mysqli_error($conn);
           //header('location: ?moreinfo='.$moreinfo);
       }
   }

  
   

    if(isset($_GET["moreinfo"])){

        $sql2="SELECT * FROM officeinfo WHERE office_id=".$_GET["moreinfo"];
        
        $res2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_array($res2);
       
            $sql3 ="SELECT * FROM regions WHERE id=".$row2["region_id"];
            $sql4 ="SELECT * FROM districts WHERE id=".$row2["district_id"];
            $sql5 ="SELECT * FROM wards WHERE id=".$row2["id"];
            $sql6="SELECT * FROM (experties INNER JOIN officeexperties on experties.experties_id=officeexperties.experties_id ) WHERE officeexperties.office_id=".$row2["office_id"];

           
    }
    
?>
    <div class="container">
    <h2>Office address</h2>
    <div class ="row">
        <div class ="col-md-6">
        Office name:
        </div>
        <div class = "col-md-6"><?php
         $sql2="SELECT * FROM officeinfo WHERE office_id=".$_GET["moreinfo"];
         $res2=mysqli_query($conn,$sql2);
         $row2=mysqli_fetch_array($res2);
        echo $row2["officename"];?></div>
        </div>
        <div class = "row">
            <div class = "col-md-6">
            Region
            </div>
        <div class = "col-md-6"><?php 
         $sql3 ="SELECT * FROM regions WHERE id=".$row2["region_id"];
         $sql4 ="SELECT * FROM districts WHERE id=".$row2["district_id"];
         $sql5 ="SELECT * FROM wards WHERE id=".$row2["id"];
        $res3=mysqli_query($conn,$sql3);
        $row3 = mysqli_fetch_array($res3);
        echo $row3["name"];?></div>
        </div>
        <div class = "row">
        <div class = "col-md-6">
        District:
        </div>
        <div class = "col-md-6"><?php 
        $res4=mysqli_query($conn,$sql4);
        $row4 = mysqli_fetch_array($res4);
        echo $row4["name"];?></div>
        </div>
        <div class = "row">
        <div class = "col-md-6">
        Ward
        </div>
        <div class = "col-md-6">
        <?php 
        $res5=mysqli_query($conn,$sql5);
        $row5 = mysqli_fetch_array($res5);
        echo $row5["name"];
        ?></div>
        </div>
        

        <h2>Office information</h2>
        <div class="row">
        <div class ="col-md-6">
        Office Manager:
        </div>
        <div class = "col-md-6"><?php echo $row2["managername"];?></div>
        </div>
        <div class="row">
        <div class="col-md-6">
        Office Number:
        </div>
        <div class = "col-md-6"><?php echo $row2["phonenumber"];?></div>
        </div>
        <div class="row">
        <div class="col-md-6">
        Office email:
        </div>
        <div class = "col-md-6"><?php echo $row2["email"];?></div>
        </div>
        


        <h2> Specialized in</h2>
       
            <div class="row">
                <div class = "col-md-6">
                Experties:
                </div>
                
            <div>
                <?php
                 $sql6="SELECT * FROM (experties INNER JOIN officeexperties on experties.experties_id=officeexperties.experties_id ) WHERE officeexperties.office_id=".$row2["office_id"];
                $res6=mysqli_query($conn,$sql6);
                $row6=mysqli_fetch_array($res6);
                echo $row6["experties"];
                ?>
            </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                Description:
                </div>
            <div> <?php echo $row6["descr"]?></div>
            </div>
          
    </div>

   
    <div class="container">
    <div class ="form-group">
    <button class="btn btn-info "  onclick="openForm()"> Appointment</button>
    </div>
       <form action="moreinfo.php" class=" form-control appointment2" method="post" id="appointment">
       <div class="form-group">
       Customer Name: <br>
        <input type="text" name="cname" placeholder="Enter full name">
       </div>
       <div class="form-group">
       Phone number: <br>
        <input type="text" name="cphone" placeholder="Enter your phone number">
       </div>
       <div class="form-group">
       Problem Description: <br>
        <input type="text" name="problem" placeholder="Enter Problem description">
        <input type="hidden" name="moreinfo" value="<?php echo $_GET["moreinfo"]; ?>">
       </div>
       <div class="form-group">
       Appointment date: <br>
        <input type="date" name="date" placeholder="Set appointment date">
       </div>
        <button type="submit" name="submit" class="btn btn-success">Send</button>
        <button type="button" class="btn btn-danger" onclick="closeForm()">Close</button>
        </form>
    </div>
    
        <script>
             function openForm() {
                document.getElementById("appointment").style.display = "block";
            }

            function closeForm() {
                document.getElementById("appointment").style.display = "none";
            }

        </script>
    
    </body>
</html>