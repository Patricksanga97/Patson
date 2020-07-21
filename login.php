<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="style1.css">
		<title>
			SIGN IN
		</title>
	</head>
	<body>
	<div class = "top">
            <h1>
                TECHNICIAN FINDER SYSTEM
            </h1>
        </div>
	<?php
 session_start();
$msg="";
include 'conn.php';
$_SESSION[''] = false;
$error= array('phone'=>false , 'password'=>false , 'wrong'=>false);
$msg=array('phone'=>'','password'=>'','wrong'=>'');
if(isset($_POST['submit'])){
    $phone =($_POST['phone']);
	$password =($_POST['password']);

	if(empty($_POST["phone"])){
        $msg['phone']= 'Please enter the phone number';
		$error['phone']=true;
		
	}
	
	 if(empty($_POST["password"])){
        $msg['password']= 'Please enter Password';
		$error['password']=true;
		
	}
	if(!$error['phone']||!$error['password']){
		
		$sql="SELECT * FROM officeinfo WHERE phonenumber='$phone' AND  pssword='$password'";
		
		$result= mysqli_query($conn, $sql);
		$row= mysqli_num_rows($result);
		
		if($row==1){
			while ($row = mysqli_fetch_assoc($result)){
				$_SESSION["office_id"]= $row["office_id"] ;
			}
			$_SESSION['login']= true;
			
			header('location:techprofile.php');
			

		}else{
			$msg['wrong']= 'Invalid password or phone';
			$error['wrong']=true;
		}
	}

	


   
	
}

?>
<div class ="text-center">
<div class="d-inline-flex p-2">
<div class="cform">
<div class ="form-control">
<form name="signInDetail" action="login.php"  method="POST">
				<h2>Sign In</h2>
				<div class="form-group">
					Phone Number:<br>
					<input type="text"  name="phone" placeholder="Enter your Phone number">
					<div class = "text-danger"><?php if(isset($msg)){echo $msg['phone'];}  ?></div>
				</div>
				<div class="form-group">
					Password:<br>
					<input type="password"  name="password" placeholder="Enter your password">
					<div class = "text-danger"><?php if(isset($msg)){echo $msg['password'];}  ?></div>
				</div>
				<div class = "form-group">
				<input type="submit" name="submit" value="Sign in">
				</div>
				</form>
				<div class = "text-danger"><?php if(isset($msg)){echo $msg['wrong'];}  ?></div>
				
</div>
			
        </div>
</div>

</div>

		
	</body>
</html>

