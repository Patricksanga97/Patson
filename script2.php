<?php 
      
      include 'conn.php';
  $district = $_GET['district'];
$sql2="SELECT * FROM wards WHERE district_id= $district";
if($district!= ""){
    $res=mysqli_query($conn,$sql2);
    echo "<select name = 'ward' id = 'kata' class='form-control office_check'>";

    while($row=mysqli_fetch_array($res)){
   echo"<option value = ".$row["id"].">"; echo$row["name"];echo"</option>";
    }
    echo "</select>";
}
 
  ?>