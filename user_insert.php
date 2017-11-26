<?php
include("includes/connection.php");
require_once( dirname( __FILE__ ) . '/functions/validation.php' );
			$validate_email = new validate_email;
			
	if(isset($_POST['sign_up'])){
		$first_name=mysqli_real_escape_string($con,$_POST['first_name']);
		$last_name=mysqli_real_escape_string($con,$_POST['last_name']);
		$email=mysqli_real_escape_string($con,$_POST['email']);
		$password=mysqli_real_escape_string($con,$_POST['password']);
		$gender=$_POST['gender'];
		
		$birthday=mysqli_real_escape_string($con,$_POST['birthday']);
		$birth_date = date('Y-m-d',strtotime($birthday));
		
		$status="unverified";
		$posts="no";
                if($gender=='male'){
                    $image='male.png';
                }else if($gender=='female'){
                    $image='female.jpg';
                }
		
		
			
			if ( $validate_email->validate_by_domain($email)==true ) {
			/*return true; */
			 /*echo "Valid";*/
			 
			 /* start: check if email is already registered*/
				$get_email="select * from users where user_email='$email'" ;
				$run_email=mysqli_query($con,$get_email);
				$check=mysqli_num_rows($run_email);
		
				if($check==1){
				
					echo "<script>alert('This email is already registered');</script>";
					exit();
			/* end: check if email is already registered*/
				}else{
					
					$insert="insert into users(user_first_name,user_last_name,user_password,user_email,user_gender,user_birthday,user_image,register_date,last_login,status,posts)
					values('$first_name','$last_name','$password','$email','$gender','$birth_date','$image',NOW(),NOW(),'$status','$posts')";
					
					$run_insert=mysqli_query($con,$insert);
					if($run_insert){
						$_SESSION['user_email']=$email;
						echo "<script>alert('Registration Successful');</script>";
						echo "<script>window.open('home.php','_self')</script>";
					}
				}
				
				
			
			} else{
			/*return false; */
			echo "<script>alert('Invalid email');</script>";
			exit();
			}
			
				
		
	}
?>