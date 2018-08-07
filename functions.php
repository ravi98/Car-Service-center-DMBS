<?php 
	session_start();


	$db = mysqli_connect('localhost', 'root', '', 'carservice');

	// variable declaration
	$username = "";
	$email    = "";
    $phone = "";
    $brand = "";
	$model    = "";
    $year = "";
    $regno = "";
    $fuel = "";
    $kms = "";
    $fname  =  "";
    $lname="";
    $address = "";
    $xp = "";
    $sal ="";
	$errors   = array(); 


	// call the register() function if register_btn is clicked

   	if (isset($_POST['addmech_btn'])) {
		addmech();
	}

   if (isset($_POST['register_btn'])) {
		register();
	}

    if (isset($_POST['cregister_btn'])) {
		cregister();
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

    if(isset($_POST['Alogin_btn'])){
        
        
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
            $query= "SELECT * FROM admin WHERE username='$username' AND password='$password' LIMIT 1";

			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) { 
				$logged_in_user = mysqli_fetch_assoc($results);
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "Welcome Admin";
					header('location: admin/home.php');		  
				
			}else {
				array_push($errors, "Error");
			}
		}
	}



    if(isset($_POST['mlogin_btn'])){
        
        
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
            $query= "SELECT * FROM mechanics WHERE fname='$username' AND phone='$password' LIMIT 1";

			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) { 
				$logged_in_user = mysqli_fetch_assoc($results);
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "Welcome Mechanic";
					header('location: mechdisp.php');		  
				
			}else {
				array_push($errors, "MEchanic");
			}
		}
	}




    	// ADD MECHANIC
	function addmech(){
		global $db, $errors;

		// receive all input values from the form
		$fname    =  e($_POST['fname']);
        $lname    =  e($_POST['lname']);
        $phone    =  e($_POST['phone']);
        $email    =  e($_POST['email']);
        $address   =  e($_POST['address']);
        $xp   =  e($_POST['xp']);
        $sal    =  e($_POST['sal']);

        if (empty($fname)) { 
			array_push($errors, "name is required"); 
		}
		if (empty($email)) { 
			array_push($errors, "Email is required"); 
		}
        if (empty($phone)) { 
			array_push($errors, "Phone number is required"); 
		}
        
        if (count($errors) == 0) {
				$spec = e($_POST['spec']);
				$query = "INSERT INTO mechanics (fname, lname, phone, email, address, spec, xp, salary) 
						  VALUES('$fname', '$lname', '$phone', '$email','$address','$spec','$xp','$sal')";
				mysqli_query($db, $query);
				$_SESSION['success']  = "Data added successfully !!";
				header('location: home.php');
            
    }
        else{
            
            					$_SESSION['success']  = "ERROR";
        }
    }


     //Create user

	function cregister(){
		global $db, $errors;

		// receive all input values from the form
		$username    =  e($_POST['username']);
		$email       =  e($_POST['email']);
        $phone =  e($_POST['phone']);
		$password_1  =  e($_POST['password_1']);
		$password_2  =  e($_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { 
			array_push($errors, "Username is required"); 
		}
		if (empty($email)) { 
			array_push($errors, "Email is required"); 
		}
        if (empty($phone)) { 
			array_push($errors, "Phone number is required"); 
		}
		if (empty($password_1)) { 
			array_push($errors, "Password is required"); 
		}
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database

			
				$query = "INSERT INTO users (username, email, user_type, password, phone) 
						  VALUES('$username', '$email', 'user', '$password','$phone')";
				mysqli_query($db, $query);
				$_SESSION['success']  = "New user successfully created!!";		
			}

		}

	


	// REGISTER USER
	function register(){
		global $db, $errors;

		// receive all input values from the form
		$username    =  e($_POST['username']);
		$email       =  e($_POST['email']);
        $phone =  e($_POST['phone']);
		$password_1  =  e($_POST['password_1']);
		$password_2  =  e($_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { 
			array_push($errors, "Username is required"); 
		}
		if (empty($email)) { 
			array_push($errors, "Email is required"); 
		}
        if (empty($phone)) { 
			array_push($errors, "Phone number is required"); 
		}
		if (empty($password_1)) { 
			array_push($errors, "Password is required"); 
		}
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database

			if (isset($_POST['user_type'])) {
				$user_type = e($_POST['user_type']);
				$query = "INSERT INTO users (username, email, user_type, password, phone) 
						  VALUES('$username', '$email', '$user_type', '$password','$phone')";
				mysqli_query($db, $query);
				$_SESSION['success']  = "New user successfully created!!";
				header('location: home.php');
			}
            else{
				$query = "INSERT INTO users (username, email, user_type, password, phone) 
						  VALUES('$username', '$email', 'user', '$password','$phone')";
				mysqli_query($db, $query);

				// get id of the created user
				$logged_in_user_id = mysqli_insert_id($db);

				$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
				
				header('location: user/userhome.php');				
			}

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



    
    if (isset($_POST['pmec'])) {
	    
        $pid = $_POST['pid'];   
        $amt=  $_POST['amt'];
        $mid=  $_POST['mid'];
	    mysqli_query($db,"UPDATE purchase SET amount='$amt', mechid='$mid'
        WHERE pid='$pid'");
        $_SESSION['message'] = "details updated!"; 
         
        header('location: admin/orders.php');
}


    if (isset($_GET['delpp'])) {
	$pid = $_GET['delpp'];
	mysqli_query($db, "DELETE FROM purchase WHERE pid='$pid'");
	$_SESSION['message'] = "Data deleted!"; 
	header('location: admin/orders.php');
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