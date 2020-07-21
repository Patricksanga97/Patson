<?php 
include 'conn.php';
if(isset($_POST["action"])){
    $sql2 ="SELECT *  FROM officeinfo";
    $res2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_array($res2);
    $sql6="SELECT * FROM (experties INNER JOIN officeexperties on experties.experties_id=officeexperties.experties_id ) WHERE experties.experties!=''";//.$row2["office_id"];
    if(isset($_POST["utaalam"])){
        $experties=implode("','",$_POST["utaalam"]);
        $sql6.="AND experties.experties IN('".$experties."')";
        $row6=mysqli_fetch_array($res6);
    print_r($row6);

    }
   
    
    //$res= mysqli_query($conn,$sql);
   

    $res6= mysqli_query($conn,$sql6);
    $sql3 ="SELECT * FROM regions WHERE id=".$row2["region_id"];
    $sql4 ="SELECT * FROM districts WHERE id=".$row2["district_id"];
    $sql5 ="SELECT * FROM wards WHERE id=".$row2["id"];
     $res3=mysqli_query($conn,$sql3);
     $row3=mysqli_fetch_array($res3);
     $sql4 ="SELECT * FROM districts WHERE id=".$row2["district_id"];
     $res4=mysqli_query($conn,$sql4);
     $row4=mysqli_fetch_array($res4);
     $sql5 ="SELECT * FROM wards WHERE id=".$row2["id"];
     $res5=mysqli_query($conn,$sql5);
     $row5=mysqli_fetch_array($res5);

    
    $output=''; 
    
   

    if($res6->num_rows>0 ){
       
        while($row6=mysqli_fetch_array($res6) ){
             $sql6="SELECT * FROM (experties INNER JOIN officeexperties on experties.experties_id=officeexperties.experties_id ) WHERE officeexperties.office_id=".$row2["office_id"];
             $res6=mysqli_query($conn,$sql6);
             $row6=mysqli_fetch_array($res6);
            $output='  <div class ="col-md-3-mb-2" id ="box">
            <div >
              <div>
              <div class ="card">
                    <div class = "card-body">
                        <h5> '.
                        $row2["officename"].'</h5>
                        <p id="mkoa">
                        Region:
                        
                       '.
                         $row3["name"].'
                       
                        </p>
                        <p id="wilaya">
                        District:
                         
                         '.
                          $row4["name"].'
                        
                        </p id>
                        <p id="kata">
                        Ward:
                        
                         '.
                          $row5["name"].'
                        
                        </p>
                        <p id ="utaalam">
                            Experties:
                           
                            '. 
                           
                             $row6["experties"].'
                           
                            
                        </p>
                        
                        <button name="moreinfo" onclick="window.location.href=moreinfo.php" class="btn btn-info"  value= '.$row2["office_id"].'> More Information</button>
                    </div>
              </div>  
            </div>
                </div>
            </div>';
           
        }

    }
   
       
       else{
           $output="<h4>Office not found!</h4>";
       }
       print_r($output);
       //echo $output;
}
   
?>