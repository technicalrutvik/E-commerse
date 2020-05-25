<?php
 require('connection.php');
 require('function.php');
 $name=get_safe_value($con,$_POST['name']);
 $email=get_safe_value($con,$_POST['email']);
 $mobile=get_safe_value($con,$_POST['mobile']);
 $password=get_safe_value($con,$_POST['password']);


 
 $check_user=mysqli_num_rows(mysqli_query($con,"SELECT * from users where email='$email'"));
 if($check_user>0){
 	echo 'email_present';
 }
 else{
 	$added_on=date('Y-m-d h:i:s');
 	mysqli_query($con,"INSERT into users (name,email,mobile,password,added_on) values('$name','$email','$mobile','$password','$added_on')");	
 	echo 'insert';		
 }
 ?>