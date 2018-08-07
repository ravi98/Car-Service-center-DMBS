<?php 
	session_start();

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'carservice');

	// variable declaration
	$brand = "";
	$model    = "";
    $year = "";
    $regno = "";
    $fuel = "";
    $kms = "";
	$errors   = array(); 

	// call the register() function if register_btn is clicked
	if (isset($_POST['Upload_btn'])) {
		upload();
	}
   
    // send message
    if (isset($_POST['send'])) {
		send();
	}

	// call the login() function if register_btn is clicked
	if (isset($_POST['login_btn'])) {
		login();
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: ../login.php");
	}

    //MESSAGE
     function send(){
         global $db, $errors;
        $name  =  e($_POST['Name']);
	    $email  =   e($_POST['Email']);
        $mess =  e($_POST['Message']);
         
         $query = "INSERT INTO message (name,email,message) 
						  VALUES ('$name','$email', '$mess')";
				mysqli_query($db, $query);
         
     }



	// REGISTER USER
	function upload(){
		global $db, $errors;
        $brand  =  e($_POST['brand']);
	    $model  =   e($_POST['model']);
        $year =  e($_POST['year']);
        $regno =  e($_POST['regno']);
        $fuel =  e($_POST['fuel']);
        $kms =  e($_POST['kms']);
	   
		// receive all input values from the form


		// form validation: ensure that the form is correctly filled
		if (empty($model)) { 
			array_push($errors, "model is required"); 
		}
		if (empty($regno)) { 
			array_push($errors, "regno is required"); 
		}
        if (empty($year)) { 
			array_push($errors, "year number is required"); 
		}
		if (empty($fuel)) { 
			array_push($errors, "fuel is required"); 
		}
        if (empty($brand)) { 
            array_push($errors, "brand is required"); 
		}
        if (empty($kms)) { 
			array_push($errors, "kms is required"); 
		}
        
     
		
		// register user if there are no errors in the form
		if (count($errors) == 0) {
            
            $oid = $_SESSION['user']['id'];
		            
$query = "INSERT INTO car_details (oid,reg_no,brand,model,year,fuel,kms) 
						  VALUES ('$oid','$regno', '$brand' ,'$model' ,'$year' ,'$fuel' ,'$kms')";
				mysqli_query($db, $query);  
				$_SESSION['success']  = "Upload successfull!!";
				header('location: userhome.php');
			}
    }

	

	// return user array from their id
	function getUserById($id){
		global $db;
		$query = "SELECT * FROM users WHERE id=" . $id;
		$result = mysqli_query($db, $query);

		$user = mysqli_fetch_assoc($result);
		return $user;
	}

	// LOGIN USER
	function login(){
		global $db, $username, $errors;

		// grap form values
		$username = e($_POST['username']);
		$password = e($_POST['password']);

		// make sure form is filled properly
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		// attempt login if no errors on form
		if (count($errors) == 0) {
			$password = md5($password);

			$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) { // user found
				// check if user is admin or user
				$logged_in_user = mysqli_fetch_assoc($results);
				if ($logged_in_user['user_type'] == 'admin') {

					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					header('location: admin/home.php');		  
				}else{
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";

				    header('location: user/userhome.php');
				}
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	function isLoggedIn()
	{
		if (isset($_SESSION['user'])) {
			return true;
		}else{
			return false;
		}
	}

	function isAdmin()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
			return true;
		}else{
			return false;
		}
	}

	// escape string
	function e($val){
		global $db;
		return mysqli_real_escape_string($db, trim($val));
	}

	function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}

?>