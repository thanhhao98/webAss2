<?php
include('../auth/auth.php');
$role = getRole();
if($role != 'unknown'){
	header("location: /");
	exit;
}
$username = $email = $phone = $password = $confirm_password = "";
$username_err = $email_err = $phone_err = $password_err = $confirm_password_err = "";
$isAdmin = false;
include ("../models/db.php");
$db = New DbBase();
$Users = new Users($db);
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
		$username = trim($_POST["username"]);
	}
	if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } else{
		if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
			$email_err = "Invalid email format";
		} else {
			if($Users->emailIsExist($_POST["email"])){
				$email_err = "Email is used";
			} else {
				$email = trim($_POST["email"]);
			}
		}
	}
	if(empty(trim($_POST["phone"]))){
        $phone_err = "Please enter a phone number";
    } else{
		if(preg_match("/^[0-9]/", $_POST["phone"])){
			$phone = trim($_POST["phone"]);
		} else {
			$phone_err = "Phone number is not valid";
		}
	}
	if(empty(trim($_POST["password"]))){
		$password_err = "Please enter a password.";     
	} elseif(strlen(trim($_POST["password"])) < 6){
		$password_err = "Password must have atleast 6 characters.";
	} else{
		$password = trim($_POST["password"]);
	}
	// Validate confirm password
	if(empty(trim($_POST["confirm_password"]))){
		$confirm_password_err = "Please confirm password.";     
	} else{
		$confirm_password = trim($_POST["confirm_password"]);
		if(empty($password_err) && ($password != $confirm_password)){
			$confirm_password_err = "Password did not match.";
		}
	}
	if ($_POST["isAdmin"] == "admin"){
		$isAdmin = true;
	}
	if ($username_err == "" and $email_err =="" and $phone_err == "" and $password_err == "" and $confirm_password_err == ""){
		$Users->createUser($username, $email, $phone, $password, $isAdmin);
		$_SESSION["loggedin"] = true;
		$location = "";
		if ($isAdmin){
			$_SESSION["admin"] = true;
			$location = "location: /admin/dashboard.php";
		} else {
			$_SESSION["admin"] = false;
			$location = "location: /";
		}
		$_SESSION["userInfo"] = ["email"=> $email, "username"=> $username, "phone"=> $phone];
		$_SESSION["userId"] = 10;
		header($location);
		exit;

	}
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper" style="margin:0 auto;">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
                <span class="help-block"><?php echo $phone_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
			<label for="vehicle1">I am admin</label>
			<input type="checkbox" id="isAdmin" name="isAdmin" value="admin">
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>
