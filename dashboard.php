<?php
//include 'session.php';
include 'conn.php';
?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <title>
            DASHBOARD
        </title>
    </head>
    <body>
    <div class = "top">
            <h1>
                TECHNICIAN FINDER SYSTEM
            </h1>
        </div>

        <div class ="container-fluid">
            <div class="row">
             <div class="col-md-3">
                 <h5>What are you looking for</h5>
                 <hr>
                 <h6 class="text-info"> Select Experties</h6>
                 <ul class="list-group">
                    <?php 
                    include 'conn.php';
                        $sql="SELECT * FROM experties ORDER BY experties ASC";
                        $res=mysqli_query($conn,$sql);
                        
                        while($row=mysqli_fetch_array($res)){
                            
                            ?>
                            <li class="list-group-item">
                                <div class="form-check">
                                    <label class ="form-check-label">
                                        <input type="checkbox" class="form-check-input office_check" value="<?php echo $row["experties"];?>" id="utaalam">
                                        <?php echo $row["experties"];?>
                                    </label>
                                </div>
                            </li>
                            <?php
                        }
                    ?>
                 </ul>
                 <h6 class="text-info"> Select Place</h6>
                 <ul class="list-group">
                     <li class="list-group-item">
                     Region:<br>
                <div class = "form-group">
            <select name="region" id="mkoa" onchange = "change_region()" class="custom-select "  >
            <option value="">select region</option>
                 <?php
                    include 'conn.php';
                    $query = "SELECT * FROM regions ORDER BY name ASC";
                    $result = mysqli_query($conn, $query);
                     while($row = mysqli_fetch_array($result)){
                    ?>
                    <option value="<?php echo $row["id"];?>" id="mkoa"><?php echo $row["name"];?></option>
                    <?php
                     }
                    ?>
            </select>
                </div>
                    
                District:
                <div class="form-group">
                <div id="district">
            <select name="disrtict" id ="wilaya" class="custom-select" >
            <option value="" class = >select district</option>
            </select>
            </div>
                </div>
        
        Ward:
        <div id="ward">
        <select name ="ward" id="kata" class ="custom-select ">
            <option value="">Select ward</option>
        </select>
       </div>
        <script type="text/javascript">
        function change_region(){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET","script.php?region="+document.getElementById("mkoa").value,false);
            xmlhttp.send(null);
            document.getElementById("district").innerHTML=xmlhttp.responseText;
        }
        function change_district(){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET","script2.php?district="+document.getElementById("wilaya").value,false);
            xmlhttp.send(null);
            document.getElementById("ward").innerHTML=xmlhttp.responseText;
        }
        </script>
         </li>
                 </ul>
             </div>
             <div class="col-lg-9">
                <h5 class="text-center" id="textchange"> All offices</h5>
                <hr>
                <div class = "text-center">
                    <img src="image/loader.gif" id="loader" style="display: none">
                </div>
                <form action="moreinfo.php" method="get">
                <div class="row" id="result">
                    <?php
                   // session_start();
                        $sql2="SELECT * FROM officeinfo";
                        $res2=mysqli_query($conn,$sql2);
                        while($row2=mysqli_fetch_array($res2)){
                            $officeid=$row2["office_id"]
                            ?>
                            
                            <div class ="col-md-3-mb-2" id ="box">
                            <div >
                              <div>
                              <div class ="card">
                                    <div class = "card-body">
                                        <h5><?php echo $row2["officename"];?></h5>
                                        <p id="mkoa">
                                        Region:
                                       <?php 
                                       $sql3 ="SELECT * FROM regions WHERE id=".$row2["region_id"];
                                       $sql4 ="SELECT * FROM districts WHERE id=".$row2["district_id"];
                                       $sql5 ="SELECT * FROM wards WHERE id=".$row2["id"];
                                        $res3=mysqli_query($conn,$sql3);
                                        $row3=mysqli_fetch_array($res3);
                                        echo $row3["name"]
                                       ?>
                                        </p>
                                        <p id="wilaya">
                                        District:
                                        <?php 
                                         $res4=mysqli_query($conn,$sql4);
                                         $row4=mysqli_fetch_array($res4);
                                         echo $row4["name"]
                                        ?>
                                        </p id>
                                        <p id="kata">
                                        Ward:
                                        <?php 
                                         $res5=mysqli_query($conn,$sql5);
                                         $row5=mysqli_fetch_array($res5);
                                         echo $row5["name"]
                                        ?>
                                        </p>
                                        <p id ="utaalam">
                                            Experties:
                                            <?php 
                                             $sql6="SELECT * FROM (experties INNER JOIN officeexperties on experties.experties_id=officeexperties.experties_id ) WHERE officeexperties.office_id=".$row2["office_id"];
                                             $res6=mysqli_query($conn,$sql6);
                                             $row6=mysqli_fetch_array($res6);
                                            echo $row6["experties"]
                                            ?>
                                            
                                        </p>
                                        
                                       <!-- <a href="moreinfo.php?officeid=row2[office_id]">More Information </a>-->
                                        <button name="moreinfo" onclick="window.location.href='moreinfo.php?office_id=$row[office_id]'" class="btn btn-info"  value=<?php echo $row2["office_id"];?>> More Information</button>
                                    </div>
                              </div>  
                            </div>
                                
                                </div>
                            </div>
                            </form>
                            
                            <?php
                        }
                    ?>
                </div>
             </div>
            </div>
        </div>
        <script>
           $(document).ready(function(){
                 $(".office_check").click(function(){
                    $("#loader").show();

                    var action='data';
                    var experties=get_filter_text("utaalam");
                    $.ajax({
                        url:'action.php',
                        method:'POST',
                        data:{action:action,experties:experties},
                        success:function(response){
                           $("#result").html(response);
                           $("#loader").hide();
                           $("#textchange").text("Filtered Products"); 
                        }
                    }); 
                 });
               function get_filter_text(text_id){
                  var filterData=[];
                  $('#'+text_id+ ':checked').each(function(){
                      filterData.push($(this).val());
                  }); 
                  return filterData;
               }
           }); 
        </script>
        
       
    </body>
</html>