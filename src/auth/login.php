<?php
include('../auth/auth.php');
$role = getRole();
if($role == 'admin'){
	header("location: /admin/dashboard.php");
	exit;
} else if($rolle == 'user'){
	header("location: /");
	exit;
}
$email = $password = "";
$email_err = $password_err = "";
include("../models/db.php");
$db = New DbBase();
$Users = new Users($db);
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty
	if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } else{
		if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
			$email_err = "Invalid email format";
		} else {
			$email = trim($_POST["email"]);
		}
	}
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
	} elseif(strlen(trim($_POST["password"])) < 6){
		$password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
		$result = $Users->login($email, $password);
		if ($result){
			$_SESSION["loggedin"] = true;
			if ($result['isAdmin'] === '1'){
				$_SESSION["admin"] = true;
			} else {
				$_SESSION["admin"] = false;
			}
			$_SESSION["userInfo"] = ["email"=> $result["email"], "username"=> $result["name"], "phone"=> $resullt["phone"]];
			$_SESSION["userId"] = $result['id'];
			header("location: /admin/dashboard.php");
			exit;
		} else {
			echo "<script type='text/javascript'>alert('Email or password is incorrect.');</script>";
		}
	}
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper" style="margin:0 auto;">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>
