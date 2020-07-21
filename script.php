<?php 
      
      include 'conn.php';
      $region = $_GET['region'];
  $sql="SELECT * FROM districts WHERE region_id= $region";
if($region!= ""){
    $res=mysqli_query($conn,$sql);
    echo "<select name ='district' id='wilaya' onchange='change_district()' class='form-control office_check'>";
    echo"<option value = > 'Select District'";echo"</option>";
    while($row=mysqli_fetch_array($res)){
   echo"<option value = ".$row["id"].">"; echo$row["name"];echo"</option>";
    }
    echo "</select>";
}

 
  ?>