
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
    include 'conn.php';
    
    if(isset($_POST["submit"])){
        $query="SELECT * FROM officeinfo where office_id = ".$_SESSION["office_id"];
        $sql1="SELECT * FROM regions WHERE id=$region";
        $sql2="SELECT * FROM districts WHERE id=$district";
        $sql3="SELECT * FROM wards WHERE id=$ward";
        //$id=$_SESSION["office_id"];
        $officename=mysqli_real_escape_string($conn, $_POST["office"]);
        $region=mysqli_real_escape_string($conn, $_POST["region"]);
        $district=mysqli_real_escape_string($conn, $_POST["district"]);
        $ward=mysqli_real_escape_string($conn, $_POST["ward"]);

        if($_SESSION['login']=true){
            $sql="UPDATE officeinfo SET officename='$officename', region_id='$region', district_id='$district', id='$ward' WHERE office_id='$_SESSION[office_id]'";
            echo $sql;
            if(mysqli_query($conn,$sql)) {
                header('location:techprofile.php');
            }  else{
                echo "error" .mysqli_error($conn);
            } 
            
            
        }

       

    }
    
?>

        <form action="edit.php" method= 'post'>
        Office name:<br>
        <input type="text" name="office" placeholder="Enter first name"><br>

        <h2>Office location</h2>
        <?php
            include 'conn.php';
            $query = "SELECT * FROM regions ORDER BY name ASC";
        ?>
             Region:<br>
        <div class = "form-group">
        <select name="region" id="mkoa" onchange = "change_region()" >
            <option value="">select region</option>
            <?php
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_array($result))
            {
                ?>
                <option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
                <?php
            }
            ?>
           
        </select>
        </div>
        District:
        <div id="district">
        <select name="disrtict" id ="wilaya" >
            <option value="">select district</option>
        </select>
        </div>
        Ward:
        <div id="ward">
        <select name ="ward" id="kata">
            <option value="">Select ward</option>
        </select>
       </div>
       
        
        
        </div>
        <script type="text/javascript">
        function change_region(){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET","script.php?region="+document.getElementById("mkoa").value,false);
            xmlhttp.send(null);
            //alert(xmlhttp.responseText)
            document.getElementById("district").innerHTML=xmlhttp.responseText;
        }
        function change_district(){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET","script2.php?district="+document.getElementById("wilaya").value,false);
            xmlhttp.send(null);
            document.getElementById("ward").innerHTML=xmlhttp.responseText;
        }
        </script>
        <input type="submit" name="submit" value="Save changes">
        </form>
    </body>
</html>